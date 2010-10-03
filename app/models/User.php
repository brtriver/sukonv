<?php

namespace app\models;

use \lithium\util\Validator;

class User extends \lithium\data\Model {
	/**
 	 * to define validates 
  	 */
	public $validates = array(
	'email' => array(
		array('notEmpty', 'message' => 'Email is empty.'),
		array('isUniqueEmail', 'message' => 'Email aleady exists.'),
		),
	'password' => array(
		array('notEmpty', 'message' => 'Password is empty.'),
		),
	);
//	protected $_filters = array('password' => array('\lithium\util\String', 'hash'));
	public static function __init(array $options = array()) {
	    parent::__init($options);
		// for save
		User::applyFilter('save', function($self, $params, $chain) {
			$user = $params['data'];
			if (!$user) {
				$user['created'] = date('Y-m-d H:i:s');
			} else {
				$user['modified'] = date('Y-m-d H:i:s');
			}
			// encrypt password field by util\String
			$params['entity']->password = \lithium\util\String::hash($params['entity']->password);
			$params['data'] = $user;
			// filter
			return $chain->next($self, $params, $chain);
		});
	    Validator::add('isUniqueEmail', function ($value, $format, $options) {
	        $conditions = array('email' => $value);
	        // If editing the post, skip the current psot
	        if (isset($options['values']['_id']) && $options['values']['_id'] != "") {
	            $conditions[] = sprintf("_id != %s", $options['values']['_id']);
	        }
	        // Lookup for posts with same Email
			return !User::find('all', array('conditions' => $conditions))->to('array');
	    });
	}

}