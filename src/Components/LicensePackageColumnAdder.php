<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Components;

use Ultraleet\WP\SoftwareLicenseManager\Packages\Traits\FiltersAdminPageContents;

class LicensePackageColumnAdder
{
    use FiltersAdminPageContents;

    public function filterPageContents(string $contents): string
    {
        $contents = preg_replace(
            '%Product Reference</th>%',
            'Product Package',
            $contents
        );
        return preg_replace_callback(
            '%data-colname="Product Reference">([a-z_-]+)</td>%',
            function (array $matches) {
                $package = get_posts([
                    'name' => $matches[1],
                    'post_type' => 'license_package',
                    'post_status' => 'publish',
                    'posts_per_page' => 1,
                ])[0];

                return "data-colname=\"Product Package\">{$package->post_title}</td>";
            },
            $contents
        );
    }
}
