<?php

namespace Ultraleet\WP\SoftwareLicenseManager\Packages\Components;

use WP_Screen;

class PackageManagement
{
    public function __construct()
    {
        $this->registerPostType();

        add_action('admin_menu', [$this, 'addPages']);
        add_filter('default_hidden_meta_boxes', [$this, 'showSlugByDefault'], 10, 2);
        add_action('admin_head', [$this, 'showActiveMenuWhenEditingPackage']);
    }

    public function registerPostType()
    {
        register_post_type('license_package', [
            'label' => 'Package',
            'labels' => [
                'name' => __('Packages'),
                'singular_name' => __('Package'),
                'menu_name' => __('Packages'),
                'name_admin_bar' => __('Packages'),
                'add_new' => __('Add New'),
                'add_new_item' => __('Add New Package'),
                'edit_item' => __('Edit Package'),
                'new_item' => __('New Package'),
                'view_item' => __('View Package'),
                'search_items' => __('Search Packages'),
                'not_found' => __('No packages found'),
                'not_found_in_trash' => __('No packages found in trash'),
                'all_items' => __('All Packages'),
            ],
            'show_ui' => true,
            'show_in_menu' => false,
            'supports' => ['title'],
        ]);
    }

    public function addPages()
    {
        add_submenu_page(
            SLM_MAIN_MENU_SLUG,
            'Manage Packages',
            'Manage Packages',
            SLM_MANAGEMENT_PERMISSION,
            'edit.php?post_type=license_package'
        );
        add_submenu_page(
            SLM_MAIN_MENU_SLUG,
            'Add Package',
            'Add Package',
            SLM_MANAGEMENT_PERMISSION,
            'post-new.php?post_type=license_package'
        );
    }

    public function showSlugByDefault(array $hidden, WP_Screen $screen)
    {
        if ('license_package' == $screen->post_type) {
            $hidden = array_diff($hidden, ['slugdiv']);
        }
        return $hidden;
    }

    public function showActiveMenuWhenEditingPackage()
    {
        global $parent_file, $post_type;
        if ('license_package' == $post_type) {
            $parent_file = SLM_MAIN_MENU_SLUG;
        }
    }
}
