<?php

/**
 * Description of AppRouter
 *
 * @author Luka Skukan
 */
class AppRouter extends AbstractRouter {
    public function parse($url) {
        $pattern = '~^(?P<ctl>\w+?)(?:/(?P<act>\w+?)(?:/(?P<params>.+)))?$~';
        $results = array();
        preg_match($pattern, $url, $results);
        
        $this->controller = isset($results['ctl']) ? $results['ctl'] : 'home';
        $this->action = isset($result['act']) ? $results['act'] : 'index';
        $this->params = $this->parseParams();
        
        return $this;
    }

    private function parseParams() {
        if(!isset($this->params)) {
            return array();
        }
        
        $params = array();
        
        $split = explode('&', $this->params);
        foreach($split as $val) {
            $match = array();
            if(preg_match('~^(?P<name>\w+?)=(?P<val>\w+)$~', $val, $match) !== 1) {
                continue;
            }
            
            $params[$match['name']] = $match['val'];
        }
        
        return $params;
    }
}
