<?php
use app\models\Question;
use app\models\Answer;

$items = ($model == "Answer")? Answer::$method($pattern): Question::$method($pattern);
?>
	<div class="group-contents">
<?php foreach ( $items as $v): ?>
	<?=$this->form->field(
		$name, 
		array(
			'type' => 'checkbox-multi', 
			'checked'=>(is_array($obj->$name) && in_array($v, $obj->$name))? true: false, 
			'value'=>$v, 
			'label' => $v, 
			'template' => 'field-checkbox', 
			'wrap' => "style='display:inline;'"
	)); ?>
<?php endforeach ?>
	</div>