<?php
class Custom_Archive
{
    public function __construct()
    {
        add_action('init', array($this, 'template_archive'), 0);
    }

    public function template_archive()
    {
        $labels = array(
            'name'                  => _x('Archive catégorie', 'Post Type General Name', 'text_domain'),
            'singular_name'         => _x('Archive catégorie', 'Post Type Singular Name', 'text_domain'),
            'menu_name'             => __('Archives catégorie', 'text_domain'),
            'name_admin_bar'        => __('Archives catégorie', 'text_domain'),
            'archives'              => __('Template Archives', 'text_domain'),
            'attributes'            => __('Template Attributes', 'text_domain'),
            'parent_item_colon'     => __('Parent Template:', 'text_domain'),
            'all_items'             => __('Toutes les pages', 'text_domain'),
            'add_new_item'          => __('Ajouter une page', 'text_domain'),
            'add_new'               => __('Ajouter', 'text_domain'),
            'new_item'              => __('Nouveau', 'text_domain'),
            'edit_item'             => __('Modifier', 'text_domain'),
            'update_item'           => __('Mettre à jour', 'text_domain'),
            'view_item'             => __('Voir page', 'text_domain'),
            'view_items'            => __('Voir pages', 'text_domain'),
            'search_items'          => __('Search Template', 'text_domain'),
            'not_found'             => __('Not found', 'text_domain'),
            'not_found_in_trash'    => __('Not found in Trash', 'text_domain'),
            'featured_image'        => __('Featured Image', 'text_domain'),
            'set_featured_image'    => __('Set featured image', 'text_domain'),
            'remove_featured_image' => __('Remove featured image', 'text_domain'),
            'use_featured_image'    => __('Use as featured image', 'text_domain'),
            'insert_into_item'      => __('Insert into item', 'text_domain'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
            'items_list'            => __('Templates list', 'text_domain'),
            'items_list_navigation' => __('Templates list navigation', 'text_domain'),
            'filter_items_list'     => __('Filter items list', 'text_domain'),
        );
        $args = array(
            'label'                 => __('Archive catégorie', 'text_domain'),
            'description'           => __('Ajouter un template spécifique pour une archive', 'text_domain'),
            'labels'                => $labels,
            'supports'              => array('title', 'editor', 'thumbnail'),
            'taxonomies'            => array('type-formation'),
            'hierarchical'          => false,
            'public'                => false,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_icon'             => 'dashicons-text-page',
            'menu_position'         => 8,
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => false,
            'has_archive'           => true,
            'exclude_from_search'   => true,
            'publicly_queryable'    => false,
            'capability_type'       => 'page',
        );
        register_post_type('template_archive', $args);
    }
}



function wporg_add_custom_box()
{
    $screens = ['template_archive'];
    foreach ($screens as $screen) {
        add_meta_box(
            'tpl_archive',                 // Unique ID
            'Template archive',      // Box title
            'wporg_custom_box_html',  // Content callback, must be of type callable
            $screen,
            'side'                            // Post type
        );
    }
}
add_action('add_meta_boxes', 'wporg_add_custom_box');

function wporg_custom_box_html($post)
{
?>
    <label for="tpl_archive">Assigné un template d'archive à une catégorie</label>
    <?php
    $args = array(
        'public' => true,
        '_builtin' => false
    );
    $return = array();
    $taxonomies = get_taxonomies($args);
    //var_dump($taxonomies);

    $pts = get_post_types($args, 'objects');
    $formatedPts = [];
    foreach ($pts as $pt) {
        //var_dump(get_object_taxonomies($pt,'objects'));
        $formatedPts[$pt->name] = array(
            'label' => $pt->label,
            'taxonomies' => array()
        );
    }
    foreach ($formatedPts as $k => $v) {
        foreach (get_object_taxonomies($k) as $name => $value) {
            $formatedPts[$k]['taxonomies'][$value] = array();
        }

        foreach ($formatedPts[$k]['taxonomies'] as $x => $y) {
            $terms = get_terms(
                $x,
                array(
                    'hide_empty' => false
                )
            );
            foreach ($terms as $term) {
                array_push($formatedPts[$k]['taxonomies'][$x], array(
                    'id' => $term->term_id,
                    'title' => $term->name
                ));
            }
        }
    }
    ?>
    <select name="tpl_archive" id="tpl_archive" class="postbox">
        <?php
        $pts = get_post_types($args, 'objects');
        echo '<pre>';
        //var_dump($pts);
        foreach ($pts as $pt) {
            echo '<option disabled>--' . $pt->name . '--</option>';
        }
        echo '</pre>';
        ?>
    </select>
    <?php
    $pts = get_post_types($args, 'objects');
    echo '<pre>';
    var_dump($pt);
    echo '</pre>';
    ?>
<?php
}

function wporg_save_postdata($post_id)
{
    if (array_key_exists('tpl_archive', $_POST)) {
        update_post_meta(
            $post_id,
            '_tpl_archive_meta_key',
            $_POST['tpl_archive']
        );
    }
}
add_action('save_post', 'wporg_save_postdata');
