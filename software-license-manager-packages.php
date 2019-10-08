<?php
/*
Plugin name: Software License Manager: Packages
Description: Adds package management to the Software License Manager plugin.
Version: 1.0.0
Author: Ultraleet
*/

use Ultraleet\WP\RequirementsChecker;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Loader;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Bootstrap;

require_once('vendor/autoload.php');

$requirementsChecker = new RequirementsChecker(array(
    'title' => 'Software License Manager: Packages',
    'php' => '7.2',
    'wp' => '4.9',
    'file' => __FILE__,
));
if ($requirementsChecker->passes()) {
    Loader::instance()->get(Bootstrap::class);
}
