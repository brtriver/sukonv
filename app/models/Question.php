<?php

namespace app\models;

use \lithium\util\Validator;

class Question extends \lithium\data\Model {
	/**
 	 * to define validates 
  	 */
	public $validates = array(
	'title' => array(
		array('notEmpty', 'message' => 'Title is empty.'),
		array('isUniqueTitle', 'message' => 'Title must be unique'),
		),
	'description' => array(
		array('notEmpty', 'message' => 'Description is empty.'),
		),
	'level' => array(
		array('notEmptyItems', 'message' => 'Level is empty.'),
		array('inLevelItemList', 'message' => 'Level is not in the list', 'required' => false),
		),
	'category' => array(
		array('notEmptyItems', 'message' => 'Category is empty.'),
		array('inCategoryItemList', 'message' => 'Cateory is not in the list', 'required' => false),
		),
	);
	/**
	 * to define levels
	 * 
	 * @vars array values of level
	 */
	protected static $_levels = array('beginner', 'intermediate', 'advance');
	/**
	 * to define categories
	 * 
	 * @vars array value of category
	 */
	protected static $_categories = array('routing', 'form', 'model');
	
    public static function __init(array $options = array()) {
        parent::__init($options);
		// for save
        Question::applyFilter('save', function($self, $params, $chain) {
// echo "<pre>";
// 	print_r($params['entity']->to('array'));
// 	echo "data";
// 	print_r($params['data']);
// echo "</pre>";

            // explode tags newly entered to array and add to the tag array
            $form_data = $params['entity']->to('array');
            if (!empty($form_data['tag'])) {
                $new_tags  = preg_split('/[,\s]+/', $form_data['tag']);
                if (count($new_tags)) {
                    if (!is_array($params['data']['tag'])) {
                        $params['data']['tag'] = array();
                    }
                    $params['data']['tag'] = array_merge($params['data']['tag'], $new_tags);
                }
            }

			// set created, modified
            $question = $params['data'];
            if (!$question) {
                $question['created'] = date('Y-m-d H:i:s');
            } else {
                $question['modified'] = date('Y-m-d H:i:s');
            }
            $params['data'] = $question;
            
            return $chain->next($self, $params, $chain);
        });
		// Validators
		Validator::add('notEmptyItems',function ($value, $format, $options) {
			if (count($value) == 0) {
				$options['message'] = "hoge";
				return false;
			}
			return true;
		});
		Validator::add('inLevelItemList', function ($value, $format, $options){
			$flg = true;
			foreach ((array)$value as $v) {
				if (!Validator::isInList($v, null, array('list' => Question::getLevels()))) {
					$flg = false;
					break;
				}
			}
			return $flg;
		});
		Validator::add('inCategoryItemList', function ($value, $format, $options){
			$flg = true;
			foreach ((array)$value as $v) {
				if (!Validator::isInList($v, null, array('list' => Question::getCategories()))) {
					$flg = false;
					break;
				}
			}
			return $flg;
		});
        Validator::add('isUniqueTitle', function ($value, $format, $options) {
            $conditions = array('title' => $value);
            // If editing the post, skip the current psot
            if (isset($options['values']['_id']) && $options['values']['_id'] != "") {
                $conditions[] = sprintf("_id != %s", $options['values']['_id']);
            }
            // Lookup for posts with same title
			return !Question::find('all', array('conditions' => $conditions))->to('array');
        });
	}
	/**
	* get defined values of level
	* 
	* @return array: defined values of level 
	*/
	static public function getLevels() {
		return static::$_levels;
	}
	/**
	* get defined values of category
	* 
	* @return array: defined values of category 
	*/
	static public function getCategories() {
		return static::$_categories;
	}
}

?>
