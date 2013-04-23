<?php

class ServantTemplate extends ServantObject {

	/**
	* Properties
	*/
	protected $propertyFiles 	= null;
	protected $propertyId 		= null;
	protected $propertyContent 	= null;
	protected $propertyOutput 	= null;
	protected $propertyPath 	= null;



	/**
	* Select ID when initializing
	*/
	public function initialize ($id = null) {
		if ($id) {
			$this->setId($id);
		}
		return $this;
	}



	/**
	* Public getters
	*/

	public function content () {
		$arguments = func_get_args();
		return call_user_func_array(array($this->servant()->action(), 'output'), $arguments);
	}

	/**
	* Files can be fetched with their paths in any format
	*/
	public function files ($format = false) {
		$files = $this->getAndSet('files');
		if ($format) {
			foreach ($files as $key => $filepath) {
				$files[$key] = $this->servant()->format()->path($filepath, $format);
			}
		}
		return $files;
	}

	/**
	* Paths can be fetched in any format
	*/
	public function path ($format = false) {
		$path = $this->getAndSet('path');
		if ($format) {
			$path = $this->servant()->format()->path($path, $format);
		}
		return $path;
	}



	/**
	* Setters
	*/

	/**
	* All files of the template
	*/
	protected function setFiles () {
		$files = array();
		$path = $this->path('server');

		// Individual file
		if (is_file($path)) {
			$files[] = $this->path('plain');

		// All template files in directory
		} else if (is_dir($path)) {
			foreach (rglob_files($path, $this->servant()->settings()->formats('templates')) as $file) {
				$files[] = $this->servant()->format()->path($file, false, 'server');
			}
		}

		return $this->set('files', $files);
	}



	/**
	* Name of the template (file or folder in the templates directory)
	*/
	protected function setId ($input = null) {

		// List our options, in order of preference
		$preferredIds = array(

			// Whatever we got as input parameter here
			$input,

			// Template defined in site settings
			$this->servant()->site()->settings('template'),

			// Template with the same name as site
			$this->servant()->site()->id(),

			// Default from global settings
			$this->servant()->settings()->defaults('template'),

			// Whatever's available
			$id = $this->servant()->available()->templates(0)

		);

		// Go through our options, try to find a template
		foreach ($preferredIds as $id) {
			if ($this->servant()->available()->template($id)) {
				break;
			}
		}

		// Require a valid template
		// FLAG I want Servant to work without a template
		if ($id === null) {
			$this->fail('No templates available');
		}

		return $this->set('id', $id);
	}



	/**
	* Output content
	*/
	protected function setOutput () {
		$result = '';
		foreach ($this->files('server') as $path) {
			$result .= $this->servant()->files()->read($path);
		}
		return $this->set('output', $result);
	}



	/**
	* Template is either a file or a folder within the templates directory
	*/
	protected function setPath () {
		$path = '';
		$serverPath = $this->servant()->paths()->templates('server').$this->id();

		// Search for a directory
		if (is_dir($serverPath.'/')) {
			$path = '/';

		// Search for one file
		} else {

			// Go through acceptable types, break when we find a match
			foreach (array_flatten($this->servant()->settings()->formats('templates')) as $format) {
				if (is_file($serverPath.'.'.$format)) {
					$path = '.'.$format;
					break;
				}
			}

		}

		// Make sure we found a proper path
		if (!empty($path)) {
			$path = $this->servant()->paths()->templates('plain').$this->id().$path;
		}

		return $this->set('path', $path);
	}

}

?>