
# calculate_string

**Calculate a formula in a string.** [View source](https://bitbucket.org/Eiskis/baseline-php/src/default/source/strings/calculate_string.php?at=default)

	function calculate_string ($formula = '', $forceInteger = false)


This function accepts a mathematical formula as a string, calculates the result and returns it. When `$forceInteger` is set to `true`, the return value will be rounded to an integer if it would otherwise be a float value.



## Examples

### Basics

##### Some multiplication
	calculate_string('12*200')			// Returns 2400

##### Seconds in a week
	calculate_string('7*24*60*60')		// Returns 31449600



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
	// Returns 43200
