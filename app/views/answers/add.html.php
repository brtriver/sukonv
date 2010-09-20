<h3>Add Answer</h3>

<?php
print_r($question->to('array'));
?>

<h4>Question</h4>
<h5><?=$question->title ?></h5>
<p>
    <?=$question->description ?>
</p>

<?=$this->view()->render(
	array('element' => 'answer_form'),
	compact('question', 'answer', 'success', 'mode')
); ?>

