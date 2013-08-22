<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of BasicForm
 *
 * @author Luka Skukan
 */
class BasicForm extends AbstractFormModel {
    
    protected function getSkeleton() {
        return '<form action="$action" method="post">$elements</form>';
    }
}
