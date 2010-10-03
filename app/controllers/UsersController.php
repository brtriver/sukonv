<?php

namespace app\controllers;
use app\models\User;
use lithium\security\Auth;
use lithium\storage\Session;

class UsersController extends \lithium\action\Controller {

	public function index() {
		$this->render(array('layout' => false));
	}
	public function register() {
        $success = false;
		if ($this->request->data) {
            $user = User::create($this->request->data);
            if ($user->validates()) {
                $success = $user->save();
            }
        } else {
			$user = User::create();
		}
		if ($success) {
			 $this->redirect(array('controller' => 'questions', 'action' => 'index'));
		}
		return compact('user');
	}
	public function login() {
		$success = false;
		if ($this->request->data) {
			if (Auth::check('default', $this->request)) {
			    Session::write('user.email', $this->request->data['email']);
				$this->redirect(array('controller' => 'questions', 'action' => 'index'));
			} else {
				$success = false;
			}
		}
		$user = User::create();
		return compact('user', 'success');
	}
	public function logout() {
		Auth::clear('default');
		$this->redirect(array('controller' => 'users', 'action' => 'login'));
	}

}

?>