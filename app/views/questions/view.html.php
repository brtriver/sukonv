<h3>View Question And Answer</h3>
<p>
<?=$this->html->link('Add Answer', 'answers/add/' . $question->_id) ?>
</p>

<h4>Question</h4>
<h5><?=$question->title ?></h5>
<p>
    <?=$question->description ?>
</p>
<h4>Answers</h4>
<div id="answer-list">
<?php if (!isset($question->answer) || count($question->answer) == 0): ?>
    <p>
        <b>No answer, Could you answer this question?</b>
    </p>
<?php else: ?>
    <?php foreach ($question->answer->to('array') as $answer): ?>
    <div>(<?=implode(",", $answer['framework']) ?>) posted by: XXX</div>
    <h5><?=$answer['description']; ?></h5>
    <?php endforeach ?>
<?php endif ?>
</div>