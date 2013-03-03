<?php

class ServantTemplate extends ServantObject {

	// Properties
	protected $propertyFiles 	= null;
	protected $propertyId 		= null;
	protected $propertyPath 	= null;



	// Select ID when initializing
	protected function initialize ($id = false) {
		if ($id) {
			$this->setId($id);
		}
		return $this;
	}



	// Public getters
	public function files ($format = false) {
		$files = $this->getAndSet('files');
		if ($format) {
			foreach ($files as $key => $filepath) {
				$files[$key] = $this->servant()->format()->path($filepath, $format);
			}
		}
		return $files;
	}
	public function id () {
		return $this->getAndSet('id');
	}
	public function path ($format = false) {
		$path = $this->getAndSet('path');
		if ($format) {
			$path = $this->servant()->format()->path($path, $format);
		}
		return $path;
	}



	// Setters

	protected function setFiles () {
		$files = array();
		$dir = $this->path('server');
		if (is_dir($dir)) {
			foreach (rglob_files($dir, $this->servant()->settings()->templateFiles()) as $key => $path) {
				$files[$key] = $this->servant()->format()->path($path, false, 'server');
			}
		}
		return $this->set('files', $files);
	}

	protected function setId ($id = false) {

		// Silent fallback
		if (!$this->servant()->available()->template($id)) {

			// Site's own template
			if ($this->servant()->available()->template($this->servant()->site()->id())) {
				$id = $this->servant()->site()->id();

			// Global default, whatever's available
			} else {
				$id = $this->servant()->available()->templates(0);
				if ($id === null) {
					$this->fail('No templates available');
				}
			}
		}

		return $this->set('id', $id);
	}

	protected function setPath () {
		return $this->set('path', $this->servant()->paths()->templates('plain').$this->id().'/');
	}

}

?>