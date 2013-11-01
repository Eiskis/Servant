<?php

/**
* A template
*
* NOTE
*   - Template objects work without any actual template files. Their content is set to '' by default.
*
* Dependencies
*   - servant()->files()->read()
*   - servant()->format()->path()
*   - servant()->paths()->actions()
*   - servant()->settings()->defaults()
*/
class ServantTemplate extends ServantObject {

	/**
	* Properties
	*/
	protected $propertyContent 	= null;
	protected $propertyFiles 	= null;
	protected $propertyId 		= null;
	protected $propertyOutput 	= null;
	protected $propertyPath 	= null;



	/**
	* Init
	*/
	public function initialize ($id, $content = null) {
		$contentArguments = func_get_args();
		array_shift($contentArguments);

		// Set ID
		$this->setId($id);

		// Default to empty content
		if (empty($contentArguments)) {
			$contentArguments = array('');
		}

		// Set content
		call_user_func_array(array($this, 'content'), $contentArguments);

		return $this;
	}



	/**
	* Public getters
	*/

	public function content ($content = null) {
		$arguments = func_get_args();
		return $this->getOrSet('content', $arguments);
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
	* Template content, whereever it comes
	*/
	protected function setContent ($input = null) {
		$content = '';

		// Normalize multiple parameters
		$arguments = func_get_args();
		$arguments = array_flatten($arguments);

		// String or numerical input
		if (!empty($arguments)) {

			// Normalize all input
			$valids = array();
			foreach ($arguments as $value) {
				$value = $this->normalizeContent($value);
				if (!empty($value)) {
					$valids[] = $value;
				}
			}

			// Accept new content
			if (!empty($valids)) {
				$content = implode("\n\n", $valids);
			}

		}

		return $this->set('content', $content);
	}

	/**
	* All files of the template
	*/
	protected function setFiles () {
		$files = array();

		$plainPath = $this->path();
		$serverPath = $this->path('server');

		// All template files in directory
		if (!empty($plainPath) and is_dir($serverPath)) {
			foreach (rglob_files($serverPath, $this->servant()->settings()->formats('templates')) as $file) {

				// Store each file's path to plain format
				$files[] = $this->servant()->format()->path($file, false, 'server');

			}
		}

		return $this->set('files', $files);
	}



	/**
	* ID (directory name)
	*/
	protected function setId ($input) {

		// Validate ID
		if (!is_array($input)) {
			return $this->set('id', ''.$input);

		// Fail if ID is inappropriate
		} else {
			return $this->fail('Inappropriate ID given for template');
		}

	}



	/**
	* Full output
	*/
	protected function setOutput () {
		$result = '';
		$files = $this->files('server');

		// Use template files (might or might not include $template->content())
		if (!empty($files)) {
			foreach ($files as $path) {
				$result .= $this->servant()->files()->read($path, array('servant' => $this->servant(), 'template' => $this));
			}

		// No files - use content directly
		} else {
			$result = $this->content();
		}

		return $this->set('output', trim($result));
	}



	/**
	* Template is either a folder within the templates directory
	*/
	protected function setPath () {
		$path = '';
		$id = $this->id();

		// Acceptable path must be a child folder in the templates dir
		if (!empty($id)) {
			$path = suffix($this->servant()->paths()->templates('plain').$this->id(), '/');
		}

		return $this->set('path', $path);
	}



	/**
	* Private helpers
	*/

	private function normalizeContent ($input) {
		$content = '';
		if (is_string($input) or is_numeric($input)) {
			$content = trim(''.$input);
		}
		return $content;
	}

}

?>