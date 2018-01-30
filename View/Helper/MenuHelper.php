<?php
/**
 * Menu Helper class file
 *
 * Swallows disallowed menu item elements
 *
 * Date: 24/1/2016
 *
 * After https://github.com/jordanvg/cakephp-menu-helper
 */
App::uses('AppHelper', 'View/Helper');
class MenuHelper extends AppHelper {
    public $helpers = array('Html');
    /**
     * Swallows disallowed menu items otherwise outputs the menu list element.
     * If allowed_roles is NULL then allow menu list element.
     *
     * ### Usage
     * `echo $this->Menu->item('role',$html->link('Example Link', array('controller' => 'example', 'action' => 'view', 3)), array('class' => 'myListClass'));`
     *
     * @param mixed $allowed_roles Either Null, A role string or an array of roles.
     * @param string $link Link in the form <a href="" [...]>.
     * @param array $attributes Options to use for the list element.
     * @return string The passed link with list tags containing the applicable attributes or empty string.
     */
    function item($allowed_roles, $link, $attributes = array()) {

        // Return menu list element if no allowed_roles to check against.
        if (!isset($allowed_roles)) return $this->Html->tag('li', $link, $attributes);
        
        // If string convert to array.
        if (!is_array($allowed_roles)) $allowed_roles = array($allowed_roles);
        
        //Add admin role. Admin always succeeds.
        $allowed_roles[] = 'Admin';
        
        //Get user roles.
        $user_roles = explode(',', AuthComponent::user('roles'));
        $user_roles = array_map('trim', $user_roles);
        
        //Convert to upper case for comparison.
        $allowed_roles = array_map('strtoupper', $allowed_roles);
        $user_roles = array_map('strtoupper', $user_roles);
        
        $matches = array_intersect($user_roles, $allowed_roles);
        
        //If user is allowed.
        if(!empty($matches)) {
            return $this->Html->tag('li', $link, $attributes);
        } else {
            return '';
        }
    }
}