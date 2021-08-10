<?php 

class Generate_Option_Menu 
{
    public $data;
    public function __construct($data) {
        if(isset($data) && !empty($data)) {
            $this->data = $data;
            add_action( 'admin_menu', [$this, 'create_page']);
            if(isset($this->data['has_setting']) && !empty($this->data['has_setting']))
                add_action( 'admin_init', [$this, 'setup_init']);
        }
    }

    public function create_page() {
        $data = $this->data;
        if($data['type'] == 'page')
            add_menu_page($data['titre'], $data['titre'], $data['capability'], $data['id'], [$this, 'load_content'], 'dashicons-icon-m1-dashicons');
        else
            add_submenu_page($data['parent'], $data['titre'], $data['titre'], $data['capability'], $data['id'], [$this, 'load_content']);
    }

    public function load_content() {
        $id = $this->data['id'];
        require plugin_dir_path(__DIR__) . 'admin/pages/' . $id . '.php';
    }

    public function setup_init() {
        $slug = $this->data['id'];
        $section = $this->data['section'];
        register_setting($slug, $section['slug']);
        add_settings_section($section['slug'], $section['title'], '', $slug);
        // $this->fields_slug = [];
        if(!empty($section['fields'])) {
            foreach($section['fields'] as $field) {
                $args = array(
                    'label_for' => $section['slug'],
                    'slug' => $field['slug'],
                    'data' => $field['data']
                );
                add_settings_field($field['slug'], $field['title'], [$this, 's2m_field_cb'], $slug, $section['slug'], $args);
            }
        }
    }

    public function s2m_section_cb() {
        $section = $this->data['section'];
        require plugin_dir_path(__DIR__) . 'admin/pages/' . $section['slug'] . '.php';
    }
    public function s2m_field_cb($args) {
        require plugin_dir_path(__DIR__) . 'admin/pages/field-' . $args['slug'] . '.php';
    }
}