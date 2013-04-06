
# prefix

**Add a prefix to string if needed.** [View source](https://bitbucket.org/Eiskis/baseline-php/src/default/source/strings/prefix/prefix.php?at=default)

	function prefix ($subject, $prefix = '', $caseInsensitive = false)

This function checks if a `$subject` string starts with a specific `$prefix` string, and if it doesn't, returns the prefix and subject strings combined. If the prefix is already part of the subject, the subject is returned as is, meaning that the return value always contains both strings.

**Note!** This function is not the same as [`start_with()`](/strings/start_with/start_with).



## Examples

### Basics

##### Add a prefix to string
	prefix('domain.com', 'www.')
	// Returns 'www.domain.com'

	prefix('www.domain.com', 'http://')
	// Returns 'http://www.domain.com'

##### Behavior is case-sensitive by default
	prefix('HTTP://www.domain.com', 'http://')
	// Returns 'http://HTTP://www.domain.com'

##### Case-insensitive checking, note that the original prefix is preferred
	prefix('HTTP://www.domain.com', 'http://', true)
	// Returns 'HTTP://www.domain.com'



### Parse formulas in JSON

JSON is a common format for sending and storing structured information, but does not support mathematical formulas as such. If you are using JSON for storing settings of your PHP program, `calculate_string()` allows you to store numerical values as strings that include mathematical formulas.

##### settings.json
	{
		"sessionTimeout": "12*60*60"
	}

##### index.php
	// Parse JSON settings
	$settings = parse_json(file_get_contents('settings.json'));

	// Use JSON values as 
	if (isset($settings['sessionTimeout'])) {
		$settings['sessionTimeout'] = calculate_string($settins['sessionTimeout']);
	}

	echo $settings['sessionTimeout'];
	// 43200
