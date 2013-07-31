<?php

/**
 * Description of AppRouter
 *
 * @author Luka Skukan
 */
class DefaultRouter extends AbstractRouter {
    public function parse($url) {
        $pattern = '~^/(?P<ctl>\w+?)/(?P<act>\w+?)(?:/(?P<params>.+))?$~';
        $results = array();

        if(1 !== preg_match($pattern, $url, $results)) {
            $this->isSuccessful = false;
            return $this;
        }
        
        $this->controller = $results['ctl'];
        $this->action = $results['act'];
        $this->params = $this->parseParams($results);
        
        $this->isSuccessful = true;
        return $this;
    }

    private function parseParams($results) {
        if(!isset($results['params'])) {
            return array();
        }
        
        $params = array();
        
        $split = explode('&', $results['params']);
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
