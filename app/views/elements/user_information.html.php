<div style="float: right;">
<?php
use lithium\security\Auth;
use lithium\storage\Session;
?>
<?php if (Auth::check('default')): ?>
your email is <em><?=Session::read('user.email') ?></em>. [<?=$this->html->link('Sign out', 'users/logout/') ?>]
<?php else: ?>
<?=$this->html->link('Sign in', 'users/login/') ?>
<?php endif ?>
</div>
<br style="clear:both">