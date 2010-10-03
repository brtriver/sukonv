<?php

namespace app\models;

use \lithium\util\Validator;
use \lithium\util\String;
use app\models\Question;
use app\models\User;
use lithium\storage\Session;

class Answer extends \lithium\data\Model {
	/**
 	 * to define validates 
  	 */
	public $validates = array(
	'parent_id' => array(
		array('isParentId', 'message' => 'Related Question does not exist.'),
		),
	'url' => array(
		array('isValidUrl', 'message' => 'URL is invalid.', 'skipEmpty' => true),
		),
	'description' => array(
		array('notEmpty', 'message' => 'Description is empty.'),
		),
	'framework' => array(
		array('notEmptyItems', 'message' => 'Framework is empty.'),
		/**
		 * MEMO: default is required rule, so you want not to validate if empty, you let the required option set to false.
		 *
		 * @author maeda
		 */
		array('inFrameworkItemList', 'message' => 'Framework is not in the list', 'required' => false),
		),
	);
    /**
     * to define framework types
     * 
     * @vars array value of framework
     */
    protected static $_frameworks = array(
    	'symfony1.0', 
    	'symfony1.1', 
    	'symfony1.2', 
    	'symfony1.3', 
    	'symfony1.4', 
    	'Symfony2.0', 
    	'CakePHP1.1',
    	'CakePHP1.2', 
    	'CakePHP1.3',
    	'CakePHP2.0',
    	'Lithium0.x',
    	);
	public static function __init(array $options = array()) {
	    parent::__init($options);
		// for save
	    Answer::applyFilter('save', function($self, $params, $chain) {
			// set created, modified
            // $chain->next($self, $params, $chain);
			// set answer document to question.
			// MEMO: entity ?? data ?? it's changed??
			$question = Question::find($params['entity']->parent_id);
			// find User by Email
			$user = User::findByEmail(Session::read('user.email'))->to('array');
			$params['entity']->user_id = $user['_id'];
			// set others
            $params['entity']->created = date('Y-m-d H:i:s');
			$params['entity']->parent_id = $question->_id;
			$params['entity']->_id = new \MongoID();
			$params['entity']->like = 0;
			$data = ($question->answers)? $question->answers->to('array'): array();
			// if the answers exist, added to array of answers with merge.
			$entity = $params['entity']->to('array');
			if (count($data)) {
				$answers = array_merge($data, array($entity['_id'] => $entity));
			} else {
				$answers = array($entity['_id'] => $entity);
			}
			$question->answers = $answers;
			$question->save();
	        return true;
	    });
		// Validators
		Validator::add('notEmptyItems',function ($value, $format, $options) {
			if (count($value) == 0) {
				$options['message'] = "hoge";
				return false;
			}
			return true;
		});
		Validator::add('inFrameworkItemList', function ($value, $format, $options){
			$flg = true;
			foreach ((array)$value as $v) {
				/**
				 * MEMO:: If call default validator rules, you can call rules like "is"+ "rule_name", "isInList" below.
				 *
				 * @author maeda
				 */
				if (!Validator::isInList($v, null, array('list' => Answer::getFrameworks()))) {
					$flg = false;
					break;
				}
			}
			return $flg;
		});
		Validator::add('isValidUrl', function ($value, $format, $options){
		    //return true;
			return Validator::isUrl($value);
		});
        Validator::add('isParentId', function ($value, $format, $options) {
			$question = Question::find($value);
            // If editing the post, skip the current psot
			return ($question)? true: false;
        });
	}
	/**
	* get defined values of framework
	* 
	* @return array: defined values of framework
	*/
	static public function getFrameworks($pattern=null) {
		$fws = static::$_frameworks;
		if ($pattern) {
			foreach ($fws as $k => $v) {
				if (!preg_match("#". $pattern ."#i", $v)) {
					unset($fws[$k]);
				}
			}
		}
		return $fws;
	}
}