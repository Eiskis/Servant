<?php

/**
* ServantObject factory
*/
class ServantCreator extends ServantObject {

	public function assets () {
		$arguments = func_get_args();
		array_unshift($arguments, 'assets');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function action () {
		$arguments = func_get_args();
		array_unshift($arguments, 'action');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function category () {
		$arguments = func_get_args();
		array_unshift($arguments, 'category');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function data () {
		$arguments = func_get_args();
		array_unshift($arguments, 'data');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function input () {
		$arguments = func_get_args();
		array_unshift($arguments, 'input');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function manifest () {
		$arguments = func_get_args();
		array_unshift($arguments, 'manifest');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function path () {
		$arguments = func_get_args();
		array_unshift($arguments, 'path');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function page () {
		$arguments = func_get_args();
		array_unshift($arguments, 'page');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function response () {
		$arguments = func_get_args();
		array_unshift($arguments, 'response');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function sitemap () {
		$arguments = func_get_args();
		array_unshift($arguments, 'sitemap');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

	public function template () {
		$arguments = func_get_args();
		array_unshift($arguments, 'template');
		return call_user_func_array(array($this, 'generate'), $arguments);
	}

}

?>