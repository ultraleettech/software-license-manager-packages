<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages;

use Ultraleet\WP\SoftwareLicenseManager\Packages\Components\AdminMenu;

class Bootstrap
{
    public function __construct()
    {
        add_action('plugins_loaded', function() {
            if ($this->isSlmActive()) {
                add_action('init', [$this, 'init']);
            }
        });
    }

    /**
     * Initialize the plugin.
     */
    public function init()
    {
        if (!is_admin()) {
            return;
        }
        Loader::instance()->get(AdminMenu::class);
    }

    /**
     * Make sure parent plugin is installed and active.
     *
     * @return bool
     */
    private function isSlmActive(): bool
    {
        $activePlugins = apply_filters('active_plugins', get_option('active_plugins'));
        return in_array('software-license-manager/slm_bootstrap.php', $activePlugins);
    }
}
