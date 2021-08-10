<?php
class Generate_Widget extends WP_Widget {

	/**
	 * Sets up the widgets name etc
	 */
	public function __construct() {
		$widget_ops = array( 
			'classname' => 'templatera_widget',
			'description' => 'Ajoute un template',
		);
		parent::__construct( 'templatera_widget', 'Templatera Widget', $widget_ops );
	}

	/**
	 * Outputs the content of the widget
	 *
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
        
        $test = get_post($instance['id']);
        //var_dump($test);
        echo do_shortcode($test->post_content);
	}

	/**
	 * Outputs the options form on admin
	 *
	 * @param array $instance The widget options
	 */
	public function form( $instance ) {
        $args = [
            'post_type' => 'templatera',
            'numberposts' => -1
        ];
        $templates = get_posts($args);
        if(!empty($templates)) :
            //var_dump($templates);
            ?>
            <p>
                <label for="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>">Choisir un template</label>
            <select
            id="<?php echo esc_attr( $this->get_field_id( 'id' ) ); ?>"
            name="<?php echo esc_attr( $this->get_field_name( 'id' ) ); ?>">
            <?php
            foreach($templates as $template) :
        ?>
                <option id="<?php  echo $template->ID ?>" value="<?php  echo $template->ID ?>"><?php echo $template->post_title ?></option>
        <?php
            endforeach;
            ?>
            </select>
            </p>
            <?php
        endif;
	}

	/**
	 * Processing widget options on save
	 *
	 * @param array $new_instance The new options
	 * @param array $old_instance The previous options
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['id'] = ( ! empty( $new_instance['id'] ) ) ? sanitize_text_field( $new_instance['id'] ) : '';

		return $instance;
	}
}

add_action( 'widgets_init', function(){
	register_widget( 'Generate_Widget' );
});