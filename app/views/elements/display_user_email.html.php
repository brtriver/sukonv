<?php
use app\models\User;
$user = User::find($answer['user_id']);
?>
<?=$user->email ?>