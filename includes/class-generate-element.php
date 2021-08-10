<?php

class Generate_Element
{
	const PREFIX = 'm1_';
	public $category = 'M1press';
	public $lang = 'm1_wpb';

	public $name;

	public function __construct($id, $params)
	{
		$this->id = $id;
		$this->params = $params;
		$this->setup($id);
        //add_action('init', [$this, 'display_test']);
	}

	public function setup()
	{
        $fn = $this->id . '_integrateWithVC';
        add_action(
            'vc_before_init',
            $fn = function () {
                $this->generate_element($this->params['name'], $this->id);
            }
        );
	}

	public function generate_element($name, $id)
	{
        $base = [
            "name" => __($name, $this->lang),
            "base" => self::PREFIX . $id,
            "admin_enqueue_css" => "",
            "admin_enqueue_js" => "",
            "content_element" => "",
            "as_child" => "",
            "category" => __($this->category, $this->lang),
            "params" => $this->add_fields(),
        ];
        if (!empty($this->params['add_css'])) {
            $base['admin_enqueue_css'] = $this->params['add_css'];
        }
        if (!empty($this->params['icon'])) {
            $base['icon'] = $this->params['icon'];
        }
        if (!empty($this->params['add_js'])) {
            $base['admin_enqueue_js'] = $this->params['add_js'];
        }
        if (!empty($this->params['js_view'])) {
            $base['js_view'] = $this->params['js_view'];
        }
        if (!empty($this->params['is_container'])) {
            $base['is_container'] = $this->params['is_container'];
        }
        if (!empty($this->params['content_element'])) {
            $base['content_element'] = $this->params['content_element'];
        }
        if (!empty($this->params['as_child'])) {
            $base['as_child'] = $this->params['as_child'];
        }
        if (!empty($this->params['as_parent'])) {
            $base['as_parent'] = $this->params['as_parent'];
        }

        return vc_map($base);

	}

	public function add_fields()
	{
		$arr = [];
        $data = $this->params['params'];
		if (!empty($data)) {
			$base = [];
            $i = -1;
            $data = $this->params['params'];
            foreach($data as $k => $item) {
                $i++;
                $base[$i]['param_name'] = $k;
                foreach($item as $key => $value) {
                    $base[$i][$key] = $value;
                }
            }
            $base[count($base)] = array(
                "param_name" => "add_class",
                "type" => "textfield",
                "edit_field_class" => 'vc_col-xs-12',
                "heading" => __("Nom de la classe additionnelle", "wefor_wpb"),
                "param_name" => "add_class",
                "description" => __(
                    "Utilisez ce champ pour styliser différemment un élément en particulier - avec une classe dans le CSS personnalisé.",
                    "wefor_wpb"
                ),
            );
            return $base;
		} else {
			trigger_error('Data vide', E_USER_ERROR);
		}
	}

    public function display_test() {
        $base = [];
        $i = -1;
        $data = $this->params['params'];
        foreach($data as $k => $item) {
            $i++;
            $base[$i]['param_name'] = $k;
            foreach($item as $key => $value) {
                $base[$i][$key] = $value;
            }
        }
        $base[count($base)] = array(
            "param_name" => "add_class",
            "type" => "textfield",
            "edit_field_class" => 'vc_col-xs-12',
            "heading" => __("Nom de la classe additionnelle", "wefor_wpb"),
            "param_name" => "add_class",
            "description" => __(
                "Utilisez ce champ pour styliser différemment un élément en particulier - avec une classe dans le CSS personnalisé.",
                "wefor_wpb"
            ),
        );
        echo '<pre>';
        var_dump($base);
        echo '</pre>';
    }
}


