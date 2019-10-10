<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Components;

use Ultraleet\WP\SoftwareLicenseManager\Packages\Traits\FiltersAdminPageContents;

class LicensePackageEditor
{
    use FiltersAdminPageContents;

    public function filterPageContents(string $contents): string
    {
        return preg_replace(
            '% {24}<th scope=\"row\">Product Reference</th>.+?</td>%s',
            $this->getPackageRowContents(),
            $contents
        );
    }

    protected function getPackageRowContents()
    {
        global $wpdb;
        if (isset($_GET['edit_record'])) {
            $table = SLM_TBL_LICENSE_KEYS;
            $id = $_GET['edit_record'];
            $sql = $wpdb->prepare("SELECT product_ref FROM $table WHERE id = %s", $id);
            $currentPackage = $wpdb->get_var($sql);
        }
        $packages = get_posts([
            'post_type' => 'license_package',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'order' => 'ASC',
        ]);
        $options = '';
        foreach ($packages as $package) {
            $selected = ($currentPackage ?? null) === $package->post_name ? 'selected' : '';
            $options .= str_pad("<option value=\"{$package->post_name}\" $selected>{$package->post_title}</option>", 32);
        }
        return <<<HTML
                        <th scope="row">Product Package</th>
                        <td>
                            <select name="product_ref" id="product_ref">
                                $options
                            </select>
                            <br/>Select the package this license applies to.
                        </td>
HTML;
    }
}
