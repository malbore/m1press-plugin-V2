<?php

class Utilities
{
	public function __construct()
	{
        $this->conf_file = get_template_directory() . '/editor-conf.json';
	}
	public function get_colors()
	{
		$file = get_template_directory() . '/custom/scss/_colors.scss';

		if (is_readable($file)):
			$file_lines = file($file);
			$colors = [];
			array_pop($file_lines);
			array_shift($file_lines);

			foreach ($file_lines as $value) {
				$key = explode(":", $value)[0];
				$key = trim(str_replace('\'', '', $key));
				$val = explode(":", $value)[1];
				$val = trim(str_replace(',', '', $val));
				$colors[$key] = $val;
			}
		else:
			$colors = [
				'noir' => '#000',
				'blanc' => '#fff',
			];
		endif;

		return $colors;
	}

	public function get_buttons_types()
	{
		$file = get_template_directory() . '/custom/scss/_buttons.scss';
		if (is_readable($file)) {
			$file_lines = file($file);
			$line = trim($file_lines[0]);
			$line = str_replace('/*', '', $line);
			$line = str_replace('*/', '', $line);
			$line = str_replace(' ', '', $line);
			$line = explode(',', $line);
			return $line;
		}
	}

	public function get_conf($conf_name)
	{
		if (is_readable($this->conf_file)) {
			$file = file_get_contents($this->conf_file);
			$data = json_decode($file, true);
			return $data[$conf_name];
		} else {
			return [$this->conf_file => ""];
		}
	}

	public function get_product_list() {
		$products = get_posts( array(
			'post_type' => 'product',
			'numberposts' => -1,
			'post_status' => 'publish',
	   ) );
	   $arr = array();
	   foreach($products as $product) {
		   $arr[$product->post_title] = $product->ID;
	   }
	   return $arr;
    }


    public function s2m_get_gabarits() {
        $gabarits = get_option('s2m_gabarits');
        $vc_dp = array();
        if(!empty($gabarits) && isset($gabarits)) {
            foreach($gabarits as $key => $gabarit) {
                $vc_dp[$gabarit['title']] = $key;
            }
        }
        return $vc_dp;
    }

}
