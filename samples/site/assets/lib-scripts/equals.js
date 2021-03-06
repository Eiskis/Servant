
(function (root) {
	var types = {};

	// (Number) -> boolean
	types.number = function(a){
		// NaN check
		return a !== a;
	};

	// Functions can act as objects
	// (function, function, array) -> boolean
	types['function'] = function(a, b, memos){
		return a.toString() === b.toString() && types.object(a, b, memos) && compare(a.prototype, b.prototype);
	};

	// (date, date) -> boolean
	types.date = function(a, b){
		return +a === +b;
	};

	// (regexp, regexp) -> boolean
	types.regexp = function(a, b){
		return a.toString() === b.toString();
	};

	// (DOMElement, DOMElement) -> boolean
	types.element = function(a, b){
		return a.outerHTML === b.outerHTML;
	};

	// (textnode, textnode) -> boolean
	types.textnode = function(a, b){
		return a.textContent === b.textContent;
	};

	// decorate `fn` to prevent it re-checking objects
	// (function) -> function
	function memoGuard (fn) {
		return function (a, b, memos) {
			if (!memos) return fn(a, b, []);
			var i = memos.length, memo;
			while (memo = memos[--i]) {
				if (memo[0] === a && memo[1] === b) return true;
			}
			return fn(a, b, memos);
		};
	}

	types['arguments'] = types.array = memoGuard(compareArrays);

	// (array, array, array) -> boolean
	function compareArrays(a, b, memos){
		var i = a.length;
		if (i !== b.length) return false;
		memos.push([a, b]);
		while (i--) {
			if (!compare(a[i], b[i], memos)) return false;
		}
		return true;
	}

	types.object = memoGuard(compareObjects);



	// (object, object, array) -> boolean
	var compareObjects = function (a, b, memos) {
		var ka = getEnumerableProperties(a);
		var kb = getEnumerableProperties(b);
		var i = ka.length;

		// same number of properties
		if (i !== kb.length) return false;

		// although not necessarily the same order
		ka.sort();
		kb.sort();

		// cheap key test
		while (i--) if (ka[i] !== kb[i]) return false;

		// remember
		memos.push([a, b]);

		// iterate again this time doing a thorough check
		i = ka.length;
		while (i--) {
			var key = ka[i];
			if (!compare(a[key], b[key], memos)) return false;
		}

		return true;
	};

	// (object) -> array
	var getEnumerableProperties = function (object) {
		var result = [];
		for (var k in object) if (k !== 'constructor') {
			result.push(k);
		}
		return result;
	};


	// (any, any, [array]) -> boolean
	var compare = function (a, b, memos){

		// All identical values are equivalent
		if (a === b) return true;
		var fnA = types[type(a)];
		if (fnA !== types[type(b)]) return false;
		return fnA ? fnA(a, b, memos) : false;
	};

	var equals = function () {
		var i = arguments.length - 1;

		while (i > 0) {
			if (!compare(arguments[i], arguments[--i])) {
				return false;
			}
		}

		return true;
	};

	// Expose equals
	root.equals = equals;

})(window);
