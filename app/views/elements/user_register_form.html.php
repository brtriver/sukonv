<?php
 $this->form->config(array('templates' => array(
 	'label' => '<label for="{:name}">{:title}</label>',
	'error'       => '',
)));
?>

<?php if ($user->errors()): ?>
<p class='error'><h4>Error is occured!</h4></p>
<?php foreach ($user->errors() as $errors):?>
<?php   foreach ($errors as $error):?>
<?php     echo "<p class='error'>" . $error . "</p>"; ?>
<?php   endforeach ?>
<?php endforeach ?>
<?php endif ?>

<?=$this->form->create($user); ?>

<?=$this->form->field('email');?>
<?php if ($err = $user->errors('password')): ?>
<?php     foreach ((array)$err as $e): ?>
	<p class='error'><?=$e ?></p>
<?php     endforeach ?>
<?php endif ?>

<?=$this->form->field('password');?>
<?php if ($err = $user->errors('password')): ?>
<?php     foreach ((array)$err as $e): ?>
	<p class='error'><?=$e ?></p>
<?php     endforeach ?>
<?php endif ?>

    <?=$this->form->submit('Sign up'); ?>
<?=$this->form->end(); ?>