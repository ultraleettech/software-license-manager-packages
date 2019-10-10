<?php
/*
Plugin name: Software License Manager: Packages
Description: Adds package management to the Software License Manager plugin. Replaces product reference field with package selection.
Version: 1.0.0
Author: Ultraleet
*/

use Ultraleet\WP\RequirementsChecker;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Loader;
use Ultraleet\WP\SoftwareLicenseManager\Packages\Bootstrap;

require_once('vendor/autoload.php');

$requirementsChecker = new RequirementsChecker([
    'title' => 'Software License Manager: Packages',
    'file' => __FILE__,
    'php' => '7.2',
    'wp' => '4.9',
    'plugins' => [
        'Software License Manager' => 'software-license-manager/slm_bootstrap.php',
    ],
]);
if ($requirementsChecker->passes()) {
    Loader::instance()->get(Bootstrap::class);
}
