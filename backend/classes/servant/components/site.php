<?php

class ServantSite extends ServantObject {

	// Properties
	protected $propertyArticle 	= null;
	protected $propertyArticles = null;
	protected $propertyId 		= null;
	protected $propertyName 	= null;
	protected $propertyPath 	= null;



	// Select ID and article while initializing
	protected function initialize ($id = null, $selectedArticle = null) {
		if ($id) {
			$this->setId($id);
		}
		if ($selectedArticle) {
			$this->setArticle($selectedArticle);
		}
		return $this;
	}



	// Public getters
	public function article () {
		return $this->getAndSet('article');
	}
	public function articles () {
		return $this->getAndSet('articles', func_get_args());
	}
	public function id () {
		return $this->getAndSet('id');
	}
	public function name () {
		return $this->getAndSet('name');
	}
	public function path ($format = null) {
		$path = $this->getAndSet('path');
		if ($format) {
			$path = $this->servant()->format()->path($path, $format);
		}
		return $path;
	}



	// Setters

	protected function setArticle ($selectedArticle = null) {
		return $this->set('article', new ServantArticle($this->servant(), $this, $selectedArticle));
	}

	protected function setArticles () {
		$results = $this->findArticles($this->path('server'), $this->servant()->settings()->formats('templates'));
		return $this->set('articles', $results);
	}

	protected function setId ($id = '') {

		// Silently fall back to default
		if (!$this->servant()->available()->site($id)) {
			$id = $this->servant()->available()->sites(0);
		}

		return $this->set('id', $id);
	}

	protected function setName () {
		return $this->set('name', $this->servant()->format()->name($this->id()));
	}

	protected function setPath () {
		return $this->set('path', $this->servant()->paths()->sites('plain').$this->id().'/');
	}



	// Private helpers

	// List available articles recursively
	private function findArticles ($path, $filetypes = array()) {
		$results = array();

		// Files on this level
		foreach (glob_files($path, $filetypes) as $file) {
			$results[pathinfo($file, PATHINFO_FILENAME)] = $this->servant()->format()->path($file, 'plain', 'server');
		}

		// Non-empty child directories
		foreach (glob_dir($path) as $subdir) {
			$value = $this->findArticles($subdir);
			if (!empty($value)) {
				$results[pathinfo($subdir, PATHINFO_FILENAME)] = $this->findArticles($subdir);
			}
		}

		// Sort alphabetically
		ksort($results);

		return $results;
	}

	// private function selectArticle ($articlesOnThisLevel, $tree, $level = 0) {

	// 	// No preference or preferred item doesn't exist: auto select
	// 	if (!isset($tree[$level]) or !array_key_exists($tree[$level], $articlesOnThisLevel)) {

	// 		// Cut out the rest of the preferred items
	// 		$tree = array_slice($tree, 0, $level);

	// 		// Auto select first item on this level
	// 		$keys = array_keys($articlesOnThisLevel);
	// 		$tree[] = $keys[0];

	// 	}

	// 	// We need to go deeper
	// 	if (is_array($articlesOnThisLevel[$tree[$level]])) {
	// 		return $this->selectArticle($articlesOnThisLevel[$tree[$level]], $tree, $level+1);

	// 	// That was it
	// 	} else {
	// 		return $tree;
	// 	}

	// }

}

?>