<?php


namespace Acfabro\RegistrationSiteKit\Entities\User;


use Acfabro\RegistrationSiteKit\Core\Entity\AbstractEntityFactory;
use Acfabro\RegistrationSiteKit\Util\Id\IdGeneratorInterface;
use Illuminate\Support\Arr;

class UserFactory extends AbstractEntityFactory
{
    protected $idGenerator;
    protected $config = [];

    public function __construct(IdGeneratorInterface $idGenerator)
    {
        $this->idGenerator = $idGenerator;
        $this->config = config('rsk-config.entities.user');
    }

    /**
     * @param array $data data to fill the registration user
     * @param array $params
     * @param array $config
     * @return mixed
     * @throws \Exception
     */
    public function make(array $data, array $params=[], array $config = []) {
        // see if config overridden
        $config = $config? $config: $this->config;

        // if id is not present in data, treat as new instance
        $idKey = Arr::get($config, 'id', null);
        if ($idKey && !isset($data[$idKey])) {
            $data[$idKey] = $this->idGenerator->generate();
        }

        return parent::make($data, $params, $config? $config: $this->config);
    }
}