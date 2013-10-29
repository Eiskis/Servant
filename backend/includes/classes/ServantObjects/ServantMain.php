<?php

class ServantMain extends ServantObject {



	/**
	* Override construction (no automatic initialization)
	*/
	public function __construct () {
		return $this;
	}

	/**
	* Initialization
	*/
	public function initialize ($paths, $settings = null, $input = null) {

		// FLAG clear temp directory at this point

		return $this->setPaths($paths)->setSettings($settings)->setInput($input);
	}

	/**
	* Execute Servant to generate a response
	*/
	public function run () {

		// FLAG last-resort thing, not sure how to handle this
		try {

			// Serve a response
			$this->response()->serve();

		} catch (Exception $e) {

			// Fuck
			echo '<p style="margin: 0 auto; padding: 5%; font-family: sans-serif; text-align: center; font-size: 1.4em; color: #333;">What went to shit:<br /><br /><strong style="">'.$e->getMessage().'</strong>.</p>';

		}

		return $this;
	}



	/**
	* Public convenience getters
	*/
	public function action () {
		$arguments = func_get_args();
		return call_user_func_array(array($this->actions(), 'current'), $arguments);
	}
	public function page () {
		$arguments = func_get_args();
		return call_user_func_array(array($this->pages(), 'current'), $arguments);
	}



	/**
	* Child components
	*/

	protected $propertyActions 		= null;
	protected $propertyFiles 		= null;
	protected $propertyFormat 		= null;
	protected $propertyHttpHeaders 	= null;
	protected $propertyInput 		= null;
	protected $propertyPages 		= null;
	protected $propertyParse 		= null;
	protected $propertyPaths 		= null;
	protected $propertyResponse 	= null;
	protected $propertySettings 	= null;
	protected $propertySite 		= null;
	protected $propertyTemplate 	= null;
	protected $propertyTheme 		= null;
	protected $propertyUtilities 	= null;



	// Setters for children
	protected function setActions () {
		return $this->set('actions', create_object(new ServantActions($this))->init());
	}
	protected function setFiles () {
		return $this->set('files', create_object(new ServantFiles($this))->init());
	}
	protected function setFormat () {
		return $this->set('format', create_object(new ServantFormat($this))->init());
	}
	protected function setInput ($input) {
		return $this->set('input', create_object(new ServantInput($this))->init($input));
	}
	protected function setPages () {
		return $this->set('pages', create_object(new ServantPages($this))->init());
	}
	protected function setParse () {
		return $this->set('parse', create_object(new ServantParse($this))->init());
	}
	protected function setPaths ($paths) {
		return $this->set('paths', create_object(new ServantPaths($this))->init($paths));
	}
	protected function setResponse () {
		return $this->set('response', create_object(new ServantResponse($this))->init());
	}
	protected function setSettings ($settings = null) {
		return $this->set('settings', create_object(new ServantSettings($this))->init($settings));
	}
	protected function setSite () {
		return $this->set('site', create_object(new ServantSite($this))->init());
	}
	protected function setTemplate () {
		return $this->set('template', create_object(new ServantTemplate($this))->init());
	}
	protected function setTheme () {
		return $this->set('theme', create_object(new ServantTheme($this))->init());
	}
	protected function setUtilities () {
		return $this->set('utilities', create_object(new ServantUtilities($this))->init());
	}

}

?>