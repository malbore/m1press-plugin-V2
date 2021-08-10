<?php

class Generate_Shortcode
{
    public $params;
	public function __construct($id, $params)
	{
		$this->params = $params;
        $this->id = $id;
        add_shortcode('m1_' . $id, [$this, 'shortcode']);
    }

	public function shortcode($atts = [], $content = null)
	{
        $params = $this->params['params'];
		$arr = [];
		foreach ($params as $key => $value) {
            if (isset($value['value']) && is_array($value['value'])) {
                $x = array_values($value['value']);
                $arr[$key] = array_slice($x, 0, 1);
            } else {
                if ($key != 'content') {
                    if(isset($value['value'])) {
                        $arr[$key] = $value['value'];
                    }
                }
            }
		}

		if (!empty($atts['add_class'])) {
			$class = $atts['add_class'];
        }
        if(isset($this->id)) {
            $as_child = $this->params;
            if (isset($as_child['as_child'])) {
                extract(shortcode_atts($arr, $atts));
                include PLUGIN_PATH . 'shortcode-templates/' . $this->id . '-shortcode.php';
                return;
            } else {
                extract(shortcode_atts($arr, $atts));
                ob_start();
                include PLUGIN_PATH . 'shortcode-templates/' . $this->id . '-shortcode.php';
                return ob_get_clean();
            }
        } else {
            trigger_error('erreur de shortcode', E_USER_NOTICE);
        }
    }

    public function test($test) {
        $test = $this->params;
        if(isset($test['as_child'])) {
            var_dump($test);
        }
    }
}
