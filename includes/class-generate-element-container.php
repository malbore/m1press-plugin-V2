<?php
class Generate_Element_Container extends Generate_Element
{
    public function __construct($id, $params) {
        $this->id = $id;
		$this->params = $params;
        return vc_map(parent::generate_element($params['name'], $id));
    }
}