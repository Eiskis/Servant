<?php

class ServantMain extends ServantObject {

	// Shorthand for full execution
	public function run ($paths, $settings, $site = false, $selectedArticle = false) {
		return $this->initialize($paths, $settings)->select($site, $selectedArticle)->templates();
	}



	// The Servant process

	// Override default construction method
	public function __construct () {
		return $this;
	}

	// Paths and settings are needed
	public function initialize ($paths, $settings) {
		$this->setPaths($paths);
		$this->setSettings($settings);
		return $this;
	}

	// Select where to be
	public function select ($site, $selectedArticle) {
		$this->setSite($site, $selectedArticle);
		return $this;
	}

	// Create output via templates
	public function templates () {
		$files = rglob_files($this->paths()->templates('server'), $this->settings()->templateLanguages());
		foreach ($files as $path) {
			echo $this->render()->file($path);
		}
		return $this;
	}



	// Children

	// Properties
	protected $propertyAvailable 	= null;
	protected $propertyFormat 		= null;
	protected $propertyPaths 		= null;
	protected $propertyRender 		= null;
	protected $propertySettings 	= null;
	protected $propertySite 		= null;

	// Public getters for children
	public function paths () {
		return $this->get('paths');
	}
	public function settings () {
		return $this->getAndSet('settings');
	}

	public function available () {
		return $this->getAndSet('available');
	}
	public function format () {
		return $this->getAndSet('format');
	}
	public function render () {
		return $this->getAndSet('render');
	}
	public function site () {
		return $this->getAndSet('site');
	}



	// Setters for children
	protected function setPaths ($paths) {
		return $this->set('paths', new ServantPaths($this, $paths));
	}
	protected function setSettings ($settings = array()) {
		return $this->set('settings', new ServantSettings($this, $settings));
	}

	protected function setAvailable () {
		return $this->set('available', new ServantAvailable($this));
	}
	protected function setFormat () {
		return $this->set('format', new ServantFormat($this));
	}
	protected function setRender () {
		return $this->set('render', new ServantRender($this));
	}
	protected function setSite () {
		return $this->set('site', new ServantSite($this));
	}



}

?>