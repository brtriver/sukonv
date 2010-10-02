<h3>View Question And Answer</h3>
<p>
<?=$this->html->link('Add Answer', 'answers/add/' . $question->_id) ?>
</p>

<h4>Question</h4>
<h5 class='title'><?=$question->title ?></h5>
<p class="q-description">
    <?=$question->description ?>
</p>
<h4>Answers</h4>
<div id="answer-list">
<?php if (!isset($question->answers) || count($question->answers) == 0): ?>
    <p>
        <b>No answer, Could you answer this question?</b>
    </p>
<?php else: ?>
    <?php foreach ($question->answers->to('array') as $answer): ?>
	<p class='fw-list'>for <span class='fw'><?php echo implode("</span>,<span class='fw'>", $answer['framework']) ?></span></p>
    <p class='answer-description'><?=$answer['description']; ?></p>
    <p class='posted-by'>by: XXX</p>
    <?php endforeach ?>
<?php endif ?>
</div>