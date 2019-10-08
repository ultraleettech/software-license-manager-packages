<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Loader;

/**
 * Class loader that is deferred until an instance is needed.
 *
 * @package Ultraleet\WP\SoftwareLicenseManager\Packages
 *
 * @todo Implement __get(), __set(), etc.
 */
class Deferred
{
    protected $className;
    protected $instance;

    public function __construct(string $className)
    {
        $this->className = $className;
    }

    protected function getInstance()
    {
        if (!isset($this->instance)) {
            $this->instance = new $this->className();
        }
        return $this->instance;
    }

    public function __call(string $name, array $arguments)
    {
        $instance = $this->getInstance();
        return call_user_func_array([$instance, $name], $arguments);
    }
}
