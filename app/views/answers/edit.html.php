<h3>Edit Answer</h3>
<?=$this->view()->render(
	array('element' => 'answer_form'),
	compact('answer', 'success', 'mode')
); ?>