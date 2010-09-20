<?php

namespace app\models;

use \lithium\util\Validator;

class Tag extends \lithium\data\Model {
	/**
 	 * to define validates 
  	 */
	public $validates = array(
	'name' => array(
		array('notEmpty', 'message' => 'Title is empty.'),
		array('isUniqueTitle', 'message' => 'Title must be unique'),
		),
	);
	public static function __init(array $options = array()) {
	    parent::__init($options);
	    $self = static::_instance();
	}
}