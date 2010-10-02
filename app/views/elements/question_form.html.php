<?php
use app\models\Question;
 $this->form->config(array('templates' => array(
 	'label' => '<label for="{:name}">{:title}</label>',
	'error'       => '',
)));
?>

<?php if ($question->errors()): ?>
<p class='error'><h4>Error is occured!</h4></p>
<?php foreach ($question->errors() as $errors):?>
<?php   foreach ($errors as $error):?>
<?php     echo "<p class='error'>" . $error . "</p>"; ?>
<?php   endforeach ?>
<?php endforeach ?>
<?php endif ?>

<?=$this->form->create($question); ?>

    <?=$this->form->field('title');?>
	<?php if ($err = $question->errors('title')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

    <?=$this->form->field('description', array('type' => 'textarea', 'class' => 'description-text'));?>
	<?php if ($err = $question->errors('description')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

    <?=$this->form->field('new_tags');?>
	<?php if ($err = $question->errors('new_tags')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>


	<div class="group-contents">
<?php foreach ($question->tag as $tag): ?>
	<?=$this->form->field(
		'tag', 
		array(
			'type' => 'checkbox-multi', 
			'checked'=>true, 
			'value'=>$tag, 
			'label' => $tag, 
			'template' => 'field-checkbox', 
			'wrap' => "style='display:inline;'"
	)); ?>
<?php endforeach ?>
	</div>
	

	<?=$this->form->label('Level'); ?>
	<?=$this->view()->render(
		array('element' => 'checkbox_multi'),
		array(
			'label' => 'Level',
			'pattern' => '',
			'method' => 'getLevels',
			'name' => 'level',
			'obj' => $question,
			'model' => 'Question',
			)
	); ?>
	<?php if ($err = $question->errors('level')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

	<?=$this->form->label('Category'); ?>
	<?=$this->view()->render(
		array('element' => 'checkbox_multi'),
		array(
			'label' => 'Category',
			'pattern' => '',
			'method' => 'getCategories',
			'name' => 'category',
			'obj' => $question,
			'model' => 'Question',
			)
	); ?>
	<?php if ($err = $question->errors('category')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

    <?=$this->form->submit($mode .' question'); ?>
<?php if ($mode === "edit"): ?>

<?php endif ?>
<?=$this->form->end(); ?>

<?php if ($success): ?>
<p>Question Successfully Saved</p>
<?php endif; ?>
