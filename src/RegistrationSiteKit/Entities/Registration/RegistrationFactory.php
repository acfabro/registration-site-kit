<?php


namespace Acfabro\RegistrationSiteKit\Entities\Registration;


use Acfabro\RegistrationSiteKit\Core\Entity\AbstractEntityFactory;
use Acfabro\RegistrationSiteKit\Core\Exception\ClassNotFoundException;
use Acfabro\RegistrationSiteKit\Core\Exception\InsufficientParametersException;
use Acfabro\RegistrationSiteKit\Core\Validation\ValidatorFactory;
use Acfabro\RegistrationSiteKit\Util\Id\IdGeneratorInterface;
use Illuminate\Support\Arr;

/**
 * Class RegistrationFactory
 *
 * Builds an instance of registration entity.
 *
 * @package Acfabro\RegistrationSiteKit\Entities\Registration
 */
class RegistrationFactory extends AbstractEntityFactory
{
    protected IdGeneratorInterface $idGenerator;
    protected ValidatorFactory $validation;
    protected $config = [];

    public function __construct(IdGeneratorInterface $idGenerator, ValidatorFactory $validation)
    {
        $this->idGenerator = $idGenerator;

        // load config from config files
        $this->config = config('rsk-config.entities.registration');

        //
        $this->validation = $validation;
    }

    /**
     * @param array $data data to fill the registration data
     * @param array $params parameters for the make process
     * @param array $config fill this to override config file settings
     * @return mixed
     * @throws InsufficientParametersException
     * @throws ClassNotFoundException
     */
    public function make(array $data, array $params=[], array $config = []) {
        // see if config overridden
        $config = $config? $config: $this->config;

        // if id is not present in data, treat as new instance
        $idKey = Arr::get($config, 'id', null);
        if ($idKey && !isset($data[$idKey])) {
            $data[$idKey] = $this->idGenerator->generate();
        }

        // get injected parameters
        if (!isset($data['userId'])) {
            if (empty($params['user']->id())) throw new InsufficientParametersException("Insufficient parameter 'user'");

            $data['userId'] = $params['user']->id;
        }
        if (!isset($data['eventId'])) {
            if (empty($params['event']->id())) throw new InsufficientParametersException("Insufficient parameter 'event'");

            $data['eventId'] = $params['event']->id;
        }

        return parent::make($data, $params, $config? $config: $this->config);
    }

}