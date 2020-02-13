<?php


namespace Acfabro\RegistrationSiteKit\Core\Data;


use Illuminate\Support\Collection;
use Illuminate\Support\Str;

/**
 * Class BaseRepository
 *
 * Base class that all repository implementations have to extend
 *
 * @package Acfabro\RegistrationSiteKit\Data
 * @property $model
 */
abstract class BaseRepository implements BaseRepositoryInterface
{
    /**
     * The model implementation/data access layer
     */
    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    /**
     * Change all keys in an array to camel case
     * @param $array
     * @return Collection
     */
    protected function toCamel($array)
    {
        return collect($array)->map(function($value, $key) {
            return [Str::camel($key) => $value];
        });
    }

    /**
     * Change all keys in an array to snake case
     * @param $array
     * @return Collection
     */
    protected function toSnake($array)
    {
        return collect($array)->map(function($value, $key) {
            return [Str::snake($key) => $value];
        });
    }

}