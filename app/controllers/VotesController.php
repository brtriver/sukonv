<?php
namespace app\controllers;

use app\models\Question;
use app\models\Answer;
use app\models\Vote;

class VotesController extends \lithium\action\Controller {
    public function index() {
        $this->redirect(array('controller' => 'questions', 'action' => 'index'));
    }
    public function like($question_id, $answer_id){
        $success = false;
        if ($question = Question::find($question_id)) {
            $answers = $question->answers->to('array');
            if (array_key_exists($answer_id, $answers)) {
                $d = array(
                    'question_id' => $question_id,
                    'answer_id' => $answer_id,
                    );
                $vote = Vote::create();
                $success = $vote->save($d, array('validator'=>false));
    			if ($success) {
    				$this->redirect(array('controller' => 'questions/view/' . $question_id));
    			}
            }
        }
        $this->redirect(array('controller' => 'question', 'action' => 'view', 'options' => array('query_string' => 'test')));   
     }
}