<?php

class Template {
    
    private $controller;
    
    private $action;
    
    private $css;
    
    private $js;
    
    private $arguments = array();
    
    public function __construct($controller, $action, $css = DEFAULT_CSS, $js = '') {
        $this->controller = $controller;
        $this->action = $action;
        $this->css = $css;
        $this->js = $js;
    }
    
    public function setAll(array $args) {
        foreach($args as $k => $v) {
            $this->arguments[$k] = $v;
        }
    }
    
    public function __set($name, $value) {
        $this->arguments[$name] = $value;
    }
    
    public function __get($name) {
        return $this->arguments[$name];
    }
    
    public function display() {
        ?><html><?php
        $this->displayHead();
        ?><body><?php
        $this->getElement('header', DEF_HEADER);
        
        $path = TEMPLATE_ROOT . $this->controller . DS . $this->action . TEMPLATE_EXTENSION;
        if(is_readable($path)) {
            echo include($path);
        } else {
            echo include(NOT_FOUND);
        }
        
        $this->getElement('footer', DEF_FOOTER);
        ?>
        </body>
        </html>
        <?php
       
    }
    
    private function displayHead() {
        ?> 
        <head>
            <title><?php echo $this->controller . ' - ' . $this->action ?></title>
            <?php
                if(is_string($this->css) and !empty($this->css)) {
            ?>
            <link type="text/css" rel="stylesheet" href="<?php echo $this->css?>" />
            <?php
                } else if(is_array($this->css)) {
                    foreach($this->css as $src) {
                        ?> 
            <link type="text/css" rel="stylesheet" href="<?php echo $src?>" />
                        <?php
                    } 
                }
                
                if(is_string($this->js) and !empty($this->js)) {
                    ?>
            <script src="<?php echo $this->js?>"></script>
                <?php
                } else if(is_array($this->js)) {
                    foreach($this->js as $src) {
                 ?> 
            <script src="<?php echo $src?>"></script>
                 <?php   
                    }
                }
            ?>
        </head>
        <?php
    }
    
    private function getElement($name, $default) {
        $elem = TEMPLATE_ROOT . $this->controller . DS. $name . TEMPLATE_EXTENSION;
        if(is_readable($elem)) {
            echo include $elem;
        } else {
            echo include($default);
        }
    } 
    
}
