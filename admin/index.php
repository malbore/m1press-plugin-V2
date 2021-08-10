<?php

if (!defined('ABSPATH'))
    exit;

if (!class_exists('WebissimeGen_autoloader')) {
    include_once PLUGIN_PATH . '/includes/class-webissime-gen-autoloader.php';
}
$shortcodes = ['[gb_image_a_la_une]', '[gb_titre]', '[gb_extrait]', '[gb_categorie]', '[gb_lien]', '[gb_auteur]', '[gb_champ_perso id=""]'];
$s2m_pages = [
    [
        'titre' => "M1Press",
        'capability' => "manage_options",
        'id' => 's2m_plus',
        'type' => 'page'
    ],
    'rs' => [
        'titre' => 'Réseaux sociaux',
        'capability' => "manage_options",
        'id' => "m1press_rs",
        'type' => 'sous-page',
        'parent' => 's2m_plus',
        'has_setting' => true,
        'section' => [
            'slug' => 'm1press_rs_conf',
            'title' => 'Vos réseaux sociaux',
            'fields' => [
                [
                    'title' => 'Facebook',
                    'slug' => 'm1press_rs_facebook',
                    'data' => '[rs_facebook]'
                ],
                [
                    'title' => 'Instagram',
                    'slug' => 'm1press_rs_instagram',
                    'data' => '[rs_instagram]'
                ],
                [
                    'title' => 'Twitter',
                    'slug' => 'm1press_rs_twitter',
                    'data' => '[rs_twitter]'
                ],
                [
                    'title' => 'Linkedin',
                    'slug' => 'm1press_rs_linkedin',
                    'data' => '[rs_linkedin]'
                ],
                [
                    'title' => 'Youtube',
                    'slug' => 'm1press_rs_youtube',
                    'data' => '[rs_youtube]'
                ],
                [
                    'title' => 'Pinterest',
                    'slug' => 'm1press_rs_pinterest',
                    'data' => '[rs_pinterest]'
                ],
                [
                    'title' => 'Vimeo',
                    'slug' => 'm1press_rs_vimeo',
                    'data' => '[rs_vimeo]'
                ],
            ]
        ]
    ],
    [
        'titre' => "Gabarits HTML archive",
        'capability' => "manage_options",
        'id' => 's2m_plus_gabarits_html',
        'type' => 'sous-page',
        'parent' => 's2m_plus',
        'has_setting' => true,
        'section' => [
            'slug' => 's2m_gabarits',
            'title' => 'Mes gabarits',
            'fields' => [
                [
                    'title' => 'Gabarit 1',
                    'slug' => 'gabarit_1',
                    'data' => $shortcodes
                ],
                [
                    'title' => 'Gabarit 2',
                    'slug' => 'gabarit_2',
                    'data' => $shortcodes
                ],
            ]
        ]
    ],
    [
        'titre' => 'Configuration',
        'capability' => "manage_options",
        'id' => "m1press_configuration",
        'type' => 'sous-page',
        'parent' => 's2m_plus',
        'has_setting' => true,
        'section' => [
            'slug' => 'm1press_conf',
            'title' => 'Modifier la configuration',
            'fields' => [
                [
                    'title' => 'Activer les archives',
                    'slug' => 'm1_custom_archive',
                    'data' => true
                ],
            ]
        ]
    ]
];

add_shortcode('rs_facebook', 'rs_facebook_cb');
function rs_facebook_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_facebook'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_instagram', 'rs_instagram_cb');
function rs_instagram_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_instagram'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_linkedin', 'rs_linkedin_cb');
function rs_linkedin_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_linkedin'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_youtube', 'rs_youtube_cb');
function rs_youtube_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_youtube'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_twitter', 'rs_twitter_cb');
function rs_twitter_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_twitter'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_pinterest', 'rs_pinterest_cb');
function rs_pinterest_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_pinterest'];
    return ob_get_clean();
    //return 'bonjour';
}
add_shortcode('rs_pinterest', 'rs_vimeo_cb');
function rs_vimeo_cb() {
    $option = get_option('m1press_rs_conf');
    ob_start();
    echo $option['m1press_rs_vimeo'];
    return ob_get_clean();
    //return 'bonjour';
}


foreach ($s2m_pages as $item) {
    new Generate_Option_Menu($item);
}




function wpdocs_selectively_enqueue_admin_script()
{
    // code mirror
    wp_enqueue_script('codemirror-lib', plugin_dir_url(__FILE__) . 'assets/codemirror/lib/codemirror.js', array(), '1.0');
    wp_enqueue_script('codemirror', plugin_dir_url(__FILE__) . 'assets/codemirror/xml.js', array(), '1.0');
    wp_enqueue_style('codemirror-lib-css', plugin_dir_url(__FILE__) . 'assets/codemirror/lib/codemirror.css', array(), '1.0');

    // code perso
    wp_enqueue_script('s2m_perso', plugin_dir_url(__FILE__) . 'assets/s2m_perso.js', array(), '1.0');
    wp_enqueue_style('s2m_perso-css', plugin_dir_url(__FILE__) . 'assets/s2m_perso.css', array(), '1.0');
}
add_action('admin_enqueue_scripts', 'wpdocs_selectively_enqueue_admin_script');



add_filter('manage_pages_columns', 'revealid_add_id_column', 1);
add_action('manage_pages_custom_column', 'revealid_id_column_content', 5, 2);
add_filter('manage_posts_columns', 'revealid_add_id_column', 1);
add_action('manage_posts_custom_column', 'revealid_id_column_content', 5, 2);
add_filter('manage_media_columns', 'revealid_add_id_column', 1);
add_action('manage_media_custom_column', 'revealid_id_column_content', 5, 2);
add_filter("manage_categorie_columns', 'revealid_add_id_column", 1);
add_action("manage_categorie_custom_column', 'revealid_id_column_content", 5, 2);


function revealid_add_id_column($columns)
{
    $checkbox = array_slice($columns, 0, 1);
    $columns = array_slice($columns, 1);

    $id['revealid_id'] = 'ID';
    $columns = array_merge($checkbox, $id, $columns);
    return $columns;
}

function revealid_id_column_content($column, $id)
{
    if ('revealid_id' == $column) {
        echo $id;
    }
}


add_action('admin_head', 'custom_css');

function custom_css()
{
    echo '<style>
   #revealid_id, .revealid_id {
      width: 50px;
    }
  </style>';
}



function add_dashicons_m1() {
    wp_register_style('my_plugin_name_dashicons', PLUGIN_URL . 'admin/assets/css/dashicons.css');
    wp_enqueue_style('my_plugin_name_dashicons');
}
add_action('admin_enqueue_scripts', 'add_dashicons_m1');