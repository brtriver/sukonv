<h3>Sign In</h3>

<?=$this->view()->render(
	array('element' => 'user_login_form')
	, compact('user')
); ?>