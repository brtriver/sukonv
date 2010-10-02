
<?php foreach($questions as $question): ?>
<article>
    <h3><?=$question->title ?></h3>
	<p>
		<?=$this->html->link('edit', 'questions/edit/' . $question->_id) ?>
		<?=$this->html->link('view', 'questions/view/' . $question->_id) ?>
	</p>
    <p><?=$question->description ?></p>
</article>
<?php endforeach; ?>

<hr />
<p>
<?=$this->html->link('Add Question', 'questions/add/') ?>
</p>
