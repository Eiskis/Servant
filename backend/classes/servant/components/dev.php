<?php

// Generic development helpers
class ServantDev extends ServantObject {

	// All paths in all formats
	public function paths () {
		$results = array();
		$methods = array(
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
		foreach ($methods as $method) {
			$results[$method] = array(
				'plain' => $this->servant()->paths()->$method(),
				'domain' => $this->servant()->paths()->$method('domain'),
				'server' => $this->servant()->paths()->$method('server'),
			);
		}
		return $results;
	}

	// All things available
	public function available () {
		$results = array();
		$methods = array(
			'sites',
			'templates',
			'themes',
		);
		foreach ($methods as $method) {
			$results[$method] = $this->servant()->available()->$method();
		}
		return $results;
	}

}

?>