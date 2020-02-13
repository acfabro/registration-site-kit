<?php


namespace Acfabro\RegistrationSiteKit\Core\Entity;


interface EntityInterface
{
    /**
     * generate a hash of the values of the entity
     *
     * @return string
     */
    public function hash(): string;

    /**
     * returns attributes as an array
     *
     * @return array
     */
    public function toArray(): array;

    /**
     * returns attributes as json
     *
     * @return string
     */
    public function toJson(): string;

    /**
     * Clone this object with new data; use this to "edit" objects while keeping them immutable
     *
     * @param array $data The new data
     * @param bool $all Set to true if update all data. if false, will update entries in data only
     * @return mixed
     */
    public function cloneWithNewData($data, $all = true): EntityInterface;

}