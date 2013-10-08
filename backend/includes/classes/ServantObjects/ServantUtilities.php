<?php

/**
* Utilities component
*
* Loading utilities, called anywhere in the program.
*
* Dependencies
*   - format()->path()
*   - paths()->utilities()
*/
class ServantUtilities extends ServantObject {

	/**
	* Properties
	*/
	protected $propertyFiles 		= null;
	protected $propertyLoaded 		= null;
	protected $propertyPath 		= null;



	/**
	* Load a (new) utility
	*/
	public function load () {
		$arguments = func_get_args();
		$arguments = array_flatten($arguments);

		// Load utilities
		foreach ($arguments as $name) {
			$path = $this->path('server').$name;

			// Utility could already be loaded
			if (!$this->loaded($name)) {

				// Include files if utility is available
				$files = $this->files($name);
				if ($files) {
					foreach ($files as $file) {
							require_once $file;
					}
					$this->setLoaded($name);

				// Not found
				} else {
					$this->fail('Missing utility '.$name);
				}
			}

		}

		return $this;
	}



	/**
	* Public getters
	*/

	/**
	* Loaded
	*/
	public function loaded ($name = null) {

		// Check for a specific utility
		if (!empty($name)) {

			// Use myself to get all loaded utilities
			if (array_search($name, $this->loaded()) === false) {
				return false;
			} else {
				return true;
			}

		// Normal getting
		} else {
			return $this->getAndSet('loaded');
		}

	}

	/**
	* Path
	*/
	public function path ($format = null) {
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
	* List of utilities that have been loaded
	*/
	protected function setLoaded () {
		$arguments = func_get_args();
		$arguments = array_flatten($arguments);

		// Starting point
		$current = $this->get('loaded');
		if ($current === null) {
			$current = array();
		}

		return $this->set('loaded', array_merge($current, $arguments));
	}

	/**
	* Path to the utilities directory
	*/
	protected function setPath () {
		return $this->set('path', $this->servant()->paths()->utilities());
	}

	/**
	* List of available utilities
	*/
	protected function setFiles () {
		$results = array();

		// All dirs under utilities folder
		foreach (glob_dir($this->servant()->paths()->utilities('server')) as $dir) {

			// Accept PHP files
			$files = rglob_files($dir, 'php');
			if (!empty($files)) {
				$results[basename($dir)] = $files;
			}

			unset($files);
		}

		return $this->set('files', $results);
	}

}

?>