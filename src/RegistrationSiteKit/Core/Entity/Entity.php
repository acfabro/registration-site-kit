<?php


namespace Acfabro\RegistrationSiteKit\Core\Entity;


use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use Illuminate\Database\Eloquent\JsonEncodingException;
use Illuminate\Database\Eloquent\MassAssignmentException;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use JsonSerializable;

/**
 * Class Entity
 *
 * Parent class for entities. Based on Eloquent, without the data persistence layer.
 * Entities should be plain, from a data perspective. The only add one here are utilities,
 * and not related to other layers' concerns
 *
 * @package Acfabro\RegistrationSiteKit\Core\Entity
 */
abstract class Entity implements EntityInterface, Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    use Concerns\HasAttributes,
        Concerns\HidesAttributes,
        Concerns\GuardsAttributes,
        Concerns\HasTimestamps;

    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The name of the "created at" column.
     *
     * @var string
     */
    const CREATED_AT = 'created_at';

    /**
     * @var array Fillable attributes for the entity
     */
    protected $fillable = [];

    /**
     * Validation rules compliant with Illuminate\Validation.
     * An array of validation rule sets.
     *
     * @var array
     */
    protected $validationRules = [];

    /**
     * The name of the "updated at" column.
     *
     * @var string
     */
    const UPDATED_AT = 'updated_at';

    public function __construct($data, $config = [])
    {
        //
        if (!empty($config)) $this->setConfig($config);

        // finally, fill the object
        if (!empty($data)) $this->fill($data);
    }

    protected function setConfig($config)
    {
        // see if fillables are configured
        if ($fillable = Arr::get($config, 'entities.registration.fillable')) {
            $this->fillable = $fillable;
        }

        // see if validation rules are required
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @param  array  $attributes
     * @return $this
     *
     * @throws \Illuminate\Database\Eloquent\MassAssignmentException
     */
    public function fill(array $attributes)
    {
        $totallyGuarded = $this->totallyGuarded();

        foreach ($this->fillableFromArray($attributes) as $key => $value) {
            $key = $this->removeTableFromKey($key);

            // The developers may choose to place some attributes in the "fillable" array
            // which means only those attributes may be set through mass assignment to
            // the model, and all others will just get ignored for security reasons.
            if ($this->isFillable($key)) {
                $this->setAttribute($key, $value);
            } elseif ($totallyGuarded) {
                throw new MassAssignmentException(sprintf(
                    'Add [%s] to fillable property to allow mass assignment on [%s].',
                    $key, get_class($this)
                ));
            }
        }

        return $this;
    }

    /**
     * Remove the table name from a given key.
     *
     * @param  string  $key
     * @return string
     */
    protected function removeTableFromKey($key)
    {
        return Str::contains($key, '.') ? last(explode('.', $key)) : $key;
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        return $this->attributesToArray();
    }

    /**
     * @inheritDoc
     */
    public function offsetExists($offset)
    {
        return ! is_null($this->getAttribute($offset));
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
    public function offsetGet($offset)
    {
        return $this->getAttribute($offset);
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
    public function offsetSet($offset, $value)
    {
        $this->setAttribute($offset, $value);
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
    public function offsetUnset($offset)
    {
        unset($this->attributes[$offset]);
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return $this->incrementing;
    }

    /**
     * Convert the model instance to JSON.
     *
     * @param  int  $options
     * @return string
     *
     * @throws JsonEncodingException
     */
    public function toJson($options = 0): string
    {
        $json = json_encode($this->jsonSerialize(), $options);

        if (JSON_ERROR_NONE !== json_last_error()) {
            throw JsonEncodingException::forModel($this, json_last_error_msg());
        }

        return $json;
    }

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->toArray();
    }

    /**
     * @inheritDoc
     */
    public function hash(): string
    {
        return hash('sha1', implode('', $this->attributesToArray()));
    }

    /**
     * to string
     * @return string
     */
    public function __toString()
    {
        return $this->toJson();
    }

    /**
     * Dynamically retrieve attributes on the model.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->getAttribute($key);
    }

    /**
     * Dynamically set attributes on the model.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return void
     */
    public function __set($key, $value)
    {
        $this->setAttribute($key, $value);
    }

    /**
     * Unset an attribute on the model.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }

    /**
     * Clone the object with new data; used to "modify" immutable objects
     * @param array $data
     * @param bool $all Set to true to replace all existing data; otherwise just those on $data
     * @return EntityInterface
     */
    public function cloneWithNewData($data, $all = true): EntityInterface
    {
        $data = $all? $data: array_merge($this->getAttributes(), $data);

        $class = clone $this;
        $class->fill($data);

        return new $class($data);
    }

    /**
     * Return a validation rule set
     *
     * @param $set
     * @return mixed
     * @throws \Exception
     */
    public function validationRules($set)
    {
        if (empty($this->validationRules[$set])) {
            throw new \Exception("Validation rule set '{$set}' not found");
        };

        return $set;
    }

    /**
     * Create a new instance of entity
     * @param array|object $data user data
     * @param array $params
     * @param array $config
     * @return static
     * @deprecated
     */
    public static function factory(array $data, array $params=[], array $config = []) {
        //
        $idKey = Arr::get($config, 'id', null);

        // if id is not present in data, treat as new instance
        if ($idKey && !isset($data[$idKey])) {
            $idGenerator = $params['idGenerator'];
            $data[$idKey] = $idGenerator->generate();
        }

        // instantiate the instance
        $class = get_called_class();

        return new $class($data, $config);
    }

}
