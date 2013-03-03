<?php

class ServantPaths extends ServantObject {

	// Properties
	protected $propertyDocumentRoot = null;
	protected $propertyRoot 		= null;
	protected $propertySites 		= null;
	protected $propertyIndex 		= null;
	protected $propertyClasses 		= null;
	protected $propertyHelpers 		= null;
	protected $propertySettings 	= null;
	protected $propertyTemplates 	= null;
	protected $propertyThemes 		= null;
	protected $propertyUtilities 	= null;


	// Public getters

	// Root paths are a little special
	public function documentRoot () {
		return $this->get('documentRoot');
	}

	public function root ($format = false) {
		if (!$format) {
			return $this->get('root');
		} else {
			return $this->servant()->format()->path('', $format);
		}
	}

	// Others 
	public function sites ($format = false) {
		return $this->servant()->format()->path($this->get('sites'), $format);
	}
	public function index ($format = false) {
		return $this->servant()->format()->path($this->get('index'), $format);
	}
	public function classes ($format = false) {
		return $this->servant()->format()->path($this->get('classes'), $format);
	}
	public function helpers ($format = false) {
		return $this->servant()->format()->path($this->get('helpers'), $format);
	}
	public function settings ($format = false) {
		return $this->servant()->format()->path($this->get('settings'), $format);
	}
	public function templates ($format = false) {
		return $this->servant()->format()->path($this->get('templates'), $format);
	}
	public function themes ($format = false) {
		return $this->servant()->format()->path($this->get('themes'), $format);
	}
	public function utilities ($format = false) {
		return $this->servant()->format()->path($this->get('utilities'), $format);
	}



	// Kickstart all paths
	protected function initialize ($paths) {
		$results = array();

		// Check required paths against against what's given
		foreach ($this->properties() as $key) {
			if (isset($paths[$key]) and !empty($paths[$key])) {
				$this->set($key, $paths[$key]);
			} else {
				fail('Need a proper path for '.$key);
			}
		}

		return $this;
	}



	// Private helpers

	// Settable properties
	private function properties () {
		return array(
			'documentRoot',
			'root',
			'sites',
			'index',
			'classes',
			'helpers',
			'settings',
			'templates',
			'themes',
			'utilities',
		);
	}

}

?>