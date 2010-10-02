<?php
use lithium\security\Auth;

if (Auth::check('default')) {
	echo "welcome xxx";
} else {
	echo "sign in";
}
?>