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
        $form = __session('form', false, true);
        if($form === false) {
            $form = new BasicForm('process', 'Test');
            $form->addField(new EmailInputElement('Email', 'email'));
            $form->addField(new PasswordInputElement('Password', 'length[6]'));
        } else {
            $form = unserialize($form);
        }
        $data['element'] = $form;
        $view = new Template($this->getController(), 'index');
        $view->setAll($data);
        $view->display();
    }
    
    public function action_process($params) {
        $form = __session('form', false, true);
        if($form === false) {
            die();
        }
        
        $form = unserialize($form);
        $result = $form->validate();
        if($result != true) {
            $_SESSION['form'] = serialize($form);
        }
        $this->redirect('index', '/home/index');
    }
    
}
