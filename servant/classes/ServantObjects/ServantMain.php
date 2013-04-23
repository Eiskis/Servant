<?php

class ServantMain extends ServantObject {

	/**
	* Override default construction method
	*/
	public function __construct () {
		return $this;
	}

	/**
	* Startup
	*/
	public function initialize ($paths, $settings, $input = null) {
		return $this->setPaths($paths)->setSettings($settings)->setInput($input);
	}

	/**
	* Execute Servant to generate a response
	*/
	public function execute () {
		$this->response()->serve();
		return $this;
	}



	/**
	* Child components
	*/

	protected $propertyAction 		= null;
	protected $propertyAvailable 	= null;
	protected $propertyFiles 		= null;
	protected $propertyFormat 		= null;
	protected $propertyHttpHeaders 	= null;
	protected $propertyInput 		= null;
	protected $propertyPaths 		= null;
	protected $propertyResponse 	= null;
	protected $propertySettings 	= null;
	protected $propertySite 		= null;
	protected $propertyTemplate 	= null;
	protected $propertyTheme 		= null;
	protected $propertyUtilities 	= null;

	// Public getters for children
	public function article () {
		$arguments = func_get_args();
		return call_user_func_array(array($this->site(), 'article'), $arguments);
	}



	// Setters for children
	protected function setAction ($id = null) {
		return $this->set('action', create_object(new ServantAction($this))->init($id));
	}
	protected function setAvailable () {
		return $this->set('available', create_object(new ServantAvailable($this))->init());
	}
	protected function setFiles () {
		return $this->set('files', create_object(new ServantFiles($this))->init());
	}
	protected function setFormat () {
		return $this->set('format', create_object(new ServantFormat($this))->init());
	}
	protected function setHttpHeaders () {
		return $this->set('httpHeaders', create_object(new ServantHttpHeaders($this))->init());
	}
	protected function setInput ($input) {
		return $this->set('input', create_object(new ServantInput($this))->init($input));
	}
	protected function setPaths ($paths) {
		return $this->set('paths', create_object(new ServantPaths($this))->init($paths));
	}
	protected function setResponse () {
		return $this->set('response', create_object(new ServantResponse($this))->init());
	}
	protected function setSettings ($settings = array()) {
		return $this->set('settings', create_object(new ServantSettings($this))->init($settings));
	}
	protected function setSite ($id = null, $selectedArticle = null) {
		return $this->set('site', create_object(new ServantSite($this))->init($id, $selectedArticle));
	}
	protected function setTemplate ($id = null) {
		return $this->set('template', create_object(new ServantTemplate($this))->init($id));
	}
	protected function setTheme ($id = null) {
		return $this->set('theme', create_object(new ServantTheme($this))->init($id));
	}
	protected function setUtilities () {
		return $this->set('utilities', create_object(new ServantUtilities($this))->init());
	}

}

?>