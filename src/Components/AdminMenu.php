<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Components;

use Ultraleet\WP\SoftwareLicenseManager\Packages\Loader;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Pages\ManagePackages;

class AdminMenu
{
    public function __construct()
    {
        add_action('admin_menu', [$this, 'addPages']);
    }

    public function addPages()
    {
        add_submenu_page(
            SLM_MAIN_MENU_SLUG,
            'Manage Packages',
            'Manage Packages',
            SLM_MANAGEMENT_PERMISSION,
            'wp_lic_mgr_packages',
            [Loader::instance()->getDeferred(ManagePackages::class), 'render']
        );
    }
}
