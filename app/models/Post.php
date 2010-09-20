<?php

namespace app\models;

class Post extends \lithium\data\Model {
     public $validates = array(
	      'title' => array(
	          array('notEmpty', 'message' => 'Email is empty.'),
	      )
	 );
}

?>