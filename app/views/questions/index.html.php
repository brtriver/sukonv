
<?php foreach($questions as $question): ?>
<article>
    <h3><?=$question->title ?></h3>
	[<?=$this->html->link('edit', 'questions/edit/' . $question->_id) ?>]
    <p><?=$question->description ?></p>
    <p class='tag-list'>tag:<span class='tag'><?php echo implode("</span>,<span class='tag'>", $question->tag) ?></span></p>
    <p><?=$this->html->link('view detail', 'questions/view/' . $question->_id) ?></p>
</article>
<?php endforeach; ?>

<hr />
<p>
<?=$this->html->link('Add Question', 'questions/add/') ?>
</p>
