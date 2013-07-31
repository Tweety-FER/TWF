<?php

/**
 * Description of HomeController
 *
 * @author Luka Skukan
 */
class HomeController extends AbstractController {
    
    public function __construct() {
        parent::__construct();
    }
    
    public function action_index($params) {
        $data = array();
        $data['name'] = isset($params->name) ? $params->name : 'Test';
        $view = new Template($this->getController(), 'index');
        $view->setAll($data);
        $view->display();
    }
    
}
