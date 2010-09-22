<?php
 $this->form->config(array('templates' => array(
 	'label' => '<label for="{:name}">{:title}</label>',
	'error'       => '',
)));
?>

<?php if ($answer->errors()): ?>
<p class='error'><h4>Error is occured!</h4></p>
<?php foreach ($answer->errors() as $errors):?>
<?php   foreach ($errors as $error):?>
<?php     echo "<p class='error'>" . $error . "</p>"; ?>
<?php   endforeach ?>
<?php endforeach ?>
<?php endif ?>

<?=$this->form->create($answer); ?>

    <?=$this->form->field('description', array('type' => 'textarea', 'class' => 'description-text'));?>
	<?php if ($err = $answer->errors('description')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

    <?=$this->form->field('url');?>
	<?php if ($err = $answer->errors('tag')): ?>
	<?php     foreach ((array)$err as $e): ?>
		<p  class='error'><?=$e ?></p>
	<?php     endforeach ?>
	<?php endif ?>

    <?=$this->form->label('framework'); ?>

    <p class="group-title">symfony</p>
    <?=$this->view()->render(
    	array('element' => 'checkbox_multi'),
    	array(
    		'pattern' => '^symfony',
    		'method' => 'getFrameworks',
    		'name' => 'framework',
    		'obj' => $answer,
			'model' => 'Answer',
    		)
    ); ?>

    <p class="group-title">CakePHP</p>
    <?=$this->view()->render(
    	array('element' => 'checkbox_multi'),
    	array(
    		'label' => 'CakePHP',
    		'pattern' => '^cakephp',
    		'method' => 'getFrameworks',
    		'name' => 'framework',
    		'obj' => $answer,
			'model' => 'Answer',
    		)
    ); ?>

    <p class="group-title">Lithium</p>
    <?=$this->view()->render(
    	array('element' => 'checkbox_multi'),
    	array(
    		'label' => 'Lithium',
    		'pattern' => '^lithium',
    		'method' => 'getFrameworks',
    		'name' => 'framework',
    		'obj' => $answer,
			'model' => 'Answer',
    		)
    ); ?>
    <?php if ($err = $question->errors('framework')): ?>
    <?php     foreach ((array)$err as $e): ?>
    	<p  class='error'><?=$e ?></p>
    <?php     endforeach ?>
    <?php endif ?>

    <?=$this->form->submit($mode .' answer'); ?>
<?=$this->form->hidden('parent_id', array('value' => $question->_id)); ?>
<?=$this->form->end(); ?>

<?php if ($success): ?>
<p>Answer Successfully Saved</p>
<?php endif; ?>