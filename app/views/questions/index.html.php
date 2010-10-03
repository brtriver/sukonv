
<?php foreach($questions as $question): ?>
<article>
    <h3><?=$question->title ?></h3>
	[<?=$this->html->link('edit', 'questions/edit/' . $question->_id) ?>]
    <p><?=$question->description ?></p>
	<p><?=$this->html->link('view detail', 'questions/view/' . $question->_id) ?></p>
</article>
<?php endforeach; ?>

<hr />
<p>
<?=$this->html->link('Add Question', 'questions/add/') ?>
</p>
