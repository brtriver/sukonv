<?php

namespace app\models;

use \lithium\util\Validator;
use app\models\Question;
use app\models\Answer;

class Vote extends \lithium\data\Model {
	public static function __init(array $options = array()) {
	    parent::__init($options);
		// for save
	    Vote::applyFilter('save', function($self, $params, $chain) {
			// set created, modified
            $d = $params['data'];
			$question = Question::find($d['question_id']);
			$answers = $question->answers->to('array');
			$answers[$d['answer_id']]['like']++;
			$question->answers = $answers;
			$question->save();
	        return true;
	    });
	}
}