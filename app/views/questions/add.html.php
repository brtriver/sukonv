<h3>Add Question</h3>

<?=$this->view()->render(
	array('element' => 'question_form'),
	compact('question', 'success', 'mode')
); ?>

