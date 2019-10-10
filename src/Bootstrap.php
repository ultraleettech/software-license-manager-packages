<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages;

use WP_Screen;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Components\PackageManagement;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Components\LicensePackageEditor;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Components\LicensePackageColumnAdder;

class Bootstrap
{
    public function __construct()
    {
        add_action('init', [$this, 'init']);
    }

    /**
     * Initialize the plugin.
     */
    public function init()
    {
        if (!is_admin()) {
            return;
        }
        Loader::instance()->get(PackageManagement::class);
        add_action('current_screen', [$this, 'adminScreen']);
    }

    public function adminScreen(WP_Screen $screen)
    {
        if ('license-manager_page_wp_lic_mgr_addedit' == $screen->id) {
            Loader::instance()->get(LicensePackageEditor::class);
        }
        if ('toplevel_page_slm-main' == $screen->id) {
            Loader::instance()->get(LicensePackageColumnAdder::class);
        }
    }
}
