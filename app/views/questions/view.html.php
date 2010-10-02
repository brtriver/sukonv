

<h3>View Question And Answer</h3>
<p>
<?=$this->html->link('Add Answer', 'answers/add/' . $question->_id) ?>
</p>

<h4>Question</h4>
<h5 class='title'><?=$question->title ?></h5>
<p class="q-description">
    <?=$question->description ?>
</p>
<p class='tag-list'>tag:<span class='tag'><?php echo implode("</span>,<span class='tag'>", $question->tag) ?></span></p>
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
    <p class='posted-by' style="text-align: left">by: <?=$this->view()->render(array('element' => 'display_user_email'), compact('answer')); ?></p>
    <p> <?=$this->html->link('like!', sprintf("/votes/like/%s/%s", $question->_id, $answer['_id'])) ?>[<?=$answer['like'] ?>]</p>
    <?php endforeach ?>
<?php endif ?>
</div>
