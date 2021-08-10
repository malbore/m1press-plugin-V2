<?php 

class Generate_Settings {
    public function __construct($data) {
        $this->data = $data;
        add_action( 'admin_init', [$this, 's2m_setup']);
    }

    public function s2m_setup() {
        register_setting( 'plugin_options', 'plugin_options', 'plugin_options_validate' );
        add_settings_section('plugin_main', 'Main Settings', [$this, 'plugin_section_text'], 'plugin');
        add_settings_field('plugin_text_string', 'Plugin Text Input', 'plugin_setting_string', 'plugin', 'plugin_main');
    }

    public function plugin_section_text() {
        echo '<p>Main description of this section here.</p>';
    }
}