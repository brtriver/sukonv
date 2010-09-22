<?php
namespace app\controllers;

use app\models\Question;

class QuestionsController extends \lithium\action\Controller {
    public function index() {
        $questions = Question::all(array('order' => array('modified' => -1)));
        return compact('questions');
    }
    public function view($id = null){
		$success = false;
		$mode = 'view';
		$question = Question::find($id);
        if (empty($question)) {
            $this->redirect(array('controller' => 'questions', 'action' => 'index'));
        }
        return compact('question', 'mode');    
    }
    public function add(){
        $success = false;
		$mode = 'add';
        if ($this->request->data) {
            $question = Question::create($this->request->data);
            if ($question->validates()) {
				//unset($question->_id);
                $success = $question->save();
            }
        } else {
			$question = Question::create();
		}
		if ($success) {
			 $this->redirect(array('controller' => 'questions', 'action' => 'index'));
		}
        return compact('success', 'question', 'mode');    
    }
	public function edit($id = null)
	{
		$success = false;
		$mode = 'edit';
		$question = Question::find($id);
        if (empty($question)) {
            $this->redirect(array('controller' => 'questions', 'action' => 'index'));
        }
        if ($this->request->data) {
			unset($this->request->data['_id']); // The ID that Lithium has is different from MongoDB one.
            if ($success = $question->save($this->request->data)) {
                $this->redirect(array('controller' => 'questions', 'action' => 'index'));
            }
		}
		return compact('question', 'success', 'mode');
 	}
}