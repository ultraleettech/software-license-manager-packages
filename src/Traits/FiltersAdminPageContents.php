<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Traits;

trait FiltersAdminPageContents
{
    public function __construct()
    {
        $this->addAdminPageFilterHooks();
    }

    protected function addAdminPageFilterHooks()
    {
        add_action('in_admin_header', [$this, 'startBuffering']);
        add_action('in_admin_footer', [$this, 'printFilteredPageContents']);
    }

    public function startBuffering()
    {
        ob_start();
    }

    public function printFilteredPageContents()
    {
        print $this->filterPageContents(ob_get_clean());
    }
}
