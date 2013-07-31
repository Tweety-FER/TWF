<?php

class Template {
    
    /**
     * The name of the controller which constructs the template.
     * @var string
     */
    private $controller;
    
    /**
     * The action called by the controller.
     * @var string
     */
    private $action;
    
    /**
     * Css file or files to link to
     * @var string|string[]
     */
    private $css;
    
    /**
     * Javascript file or files to link to
     * @var string|string[]
     */
    private $js;
    
    /**
     * Array of mixed-type key-value pairs used by the template to represent<br/>
     * its public variables.
     * @var array
     */
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
        ?>
        <!DOCTYPE html>
        <html>
        <?php
        $this->displayHead();
        ?>
            <body>
        <?php
        $path = TEMPLATE_ROOT . strtolower($this->controller) . DS . 
                strtolower($this->action) . TEMPLATE_EXTENSION;
        
        if(is_readable($path)) { 
            $this->getElement('header', DEF_HEADER);
            include($path);
            $this->getElement('footer', DEF_FOOTER);
        } else {
            include(NOT_FOUND);
        }
        ?>
            </body>
        </html>
        <?php
       
    }
    
    protected function insert($template) {
        if(is_readable($template)) {
            include($template);
        } else {
            echo '<div class="not_found"><em>Not Found</em></div>';
        }
    }
    
    public static function show404() {
        include(NOT_FOUND);
    }
    
    private function displayHead() {
        ?>
        <head>
            <title>
                <?php echo $this->controller . ' - ' . ucfirst($this->action) ?>
            </title>
            <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
            <?php
                if(is_string($this->css) and !empty($this->css)) {
            ?>
            <link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR 
                . $this->css . '.css'?>" />
            <?php
                } else if(is_array($this->css)) {
                    foreach($this->css as $src) {
                        ?> 
            <link type="text/css" rel="stylesheet" href="<?php echo CSS_DIR . 
                    $src . '.css' ?>" />
                        <?php
                    } 
                }
                
                if(is_string($this->js) and !empty($this->js)) {
                    ?>
            <script src="<?php echo JS_DIR . $this->js .'.js'?>"></script>
                <?php
                } else if(is_array($this->js)) {
                    foreach($this->js as $src) {
                 ?> 
            <script src="<?php echo JS_DIR . $src .'.js'?>"></script>
                 <?php   
                    }
                }
            ?>
        </head>
        <?php
    }
    
    private function getElement($name, $default) {
        $elem = TEMPLATE_ROOT . strtolower($this->controller) . DS. 
                strtolower($name) . TEMPLATE_EXTENSION;
        if(is_readable($elem)) {
            include $elem;
        } else {
            include($default);
        }
    } 
    
}
