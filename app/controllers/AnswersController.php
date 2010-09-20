<?php
namespace app\controllers;

use app\models\Question;
use app\models\Answer;

class AnswersController extends \lithium\action\Controller {
    public function index() {
        $this->redirect(array('controller' => 'questions', 'action' => 'index'));
    }
    public function add($id){
		if (!$id || !($question = Question::find($id))) {
			$this->redirect(array('controller' => 'questions', 'action' => 'index'));
		}
        $success = false;
		$mode = 'add';
        if ($this->request->data) {
            $answer = Answer::create($this->request->data);
            if ($answer->validates()) {
				unset($answer->_id);
                $success = $answer->save();
            }
        } else {
			$answer = Answer::create(array(),compact('id'));
		}
        return compact('success', 'answer', 'question', 'mode');    
     }
	public function edit($id = null)
	{
		$success = false;
		$mode = 'edit';
		$answer = Answer::find($id);
        if (empty($answer)) {
            $this->redirect(array('controller' => 'answers', 'action' => 'index'));
        }
        if ($this->request->data) {
            if ($success = $answer->save($this->request->data)) {
                $this->redirect(array('controller' => 'answers', 'action' => 'index'));
            }
		}
		return compact('answer', 'question', 'success', 'mode');
 	}
}