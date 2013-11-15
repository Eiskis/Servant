<?php

/**
* A traversable node with potential for parents or children
*/
class ServantNode extends ServantObject {

	/**
	* Properties
	*/
	protected $propertyDepth 		= null;
	protected $propertyId 			= null;
	protected $propertyIndex 		= null;
	protected $propertyName 		= null;
	protected $propertyParent 		= null;
	protected $propertyTree 		= null;



	/**
	* Convenience
	*/

	public function sibling () {
		$arguments = func_get_args();
		return array_traverse($this->siblings(), $arguments);
	}

	public function siblings () {
		return $this->parent()->children();
	}



	/**
	* Getter-setters
	*/

	public function id () {
		$arguments = func_get_args();
		return $this->getOrSet('id', $arguments);
	}

	public function name () {
		$arguments = func_get_args();
		return $this->getOrSet('name', $arguments);
	}



	/**
	* Parent(s)
	*/

	public function parents () {
		$parents = array();
		$parent = $this->parent();

		// Inherit grandparents
		if (!$parent->root()) {
			$parents = $parent->parents();
			$parents[] = $parent;
		}

		return $parents;
	}



	/**
	* Setters
	*/

	/**
	* Depth
	*/
	protected function setDepth () {
		return $this->set('depth', count($this->parents()));
	}

	/**
	* ID
	*/
	protected function setId ($input) {

		// Allow overriding auto set
		if (is_string($input)) {
			$input = trim_whitespace($input);
			if (!empty($input)) {
				$id = $input;
			}
		}

		// Default
		if (!isset($id)) {
			$this->fail('Invalid ID passed to node.');
		}

		return $this->set('id', $id);
	}

	/**
	* Location of this page relative to its siblings
	*/
	protected function setIndex () {
		$result = 0;
		foreach ($this->siblings() as $i => $sibling) {
			if ($sibling === $this) {
				$result = $i;
				break;
			}
		}
		return $this->set('index', $result);
	}

	/**
	* Human-readable name
	*/
	protected function setName ($input = null) {

		// Allow overriding automatic ID manually
		if (is_string($input)) {
			$input = trim_text($input, true);
			if (!empty($input)) {
				$id = $input;
			}
		}

		// Default
		if (!isset($name)) {
			$name = $this->generateTitle($this->id());
		}

		return $this->set('name', $name);
	}

	// Parent node
	protected function setParent ($category) {

		// FLAG should check for any subclass
		if ($this->getServantClass($category) !== 'categoryNode') {
			$this->fail('Pages need a category parent to take care of them.');
		}

		// FLAG this behavior isn't very clear...
		$category->addChildren($this);

		return $this->set('parent', $category);
	}

	// List of parent IDs + own ID
	protected function setTree () {
		$results = array();
		foreach ($this->parents() as $parent) {
			$results[] = $parent()->id();
		}
		$results[] = $this->id();
		return $this->set('tree', $results);
	}



	/**
	* Private helpers
	*/

	/**
	* Generate human-readable title for page from string
	*/
	private function generateTitle ($string) {
		$name = $string;

		// Explicit names given for this string
		$replacements = $this->servant()->site()->pageNames();
		$key = mb_strtolower($string);
		if ($replacements and is_array($replacements) and array_key_exists($key, $replacements)) {
			$name = $replacements[$key];

		// Generate
		} else {
			$conversions = $this->servant()->settings()->namingConvention();
			$name = ucfirst(trim(str_ireplace(array_keys($conversions), array_values($conversions), $string)));
		}

		return $name;
	}

}

?>