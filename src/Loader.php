<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages;

use Ultraleet\WP\SoftwareLicenseManager\Packages\Loader\Deferred;

/**
 * Loader for various plugin components.
 *
 * @package Ultraleet\WP\SoftwareLicenseManager\Packages
 */
final class Loader
{
    private static $instance;
    private $components = [];

    private function __construct()
    {
    }

    /**
     * Get loader instance.
     *
     * @return Loader
     */
    public static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    public function get(string $className)
    {
        if (!isset($this->components[$className])) {
            $this->load($className);
        }
        return $this->components[$className];
    }

    public function getDeferred(string $className)
    {
        if (!isset($this->components[$className])) {
            $this->components[$className] = new Deferred($className);
        }
        return $this->components[$className];
    }

    private function load(string $className)
    {
        $this->components[$className] = new $className();
    }
}
