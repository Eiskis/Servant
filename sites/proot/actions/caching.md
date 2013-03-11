
Proot has a built-in support for [saving cache files and sending cache headers](?category=backend&id=caching). If you want to return the *exact same response* every time your action is called with the *same input parameters*, enable caching in your action.

When caching is enabled, the output generated by your action will be saved to the cache directory as a file. The contents of this file will be served for future requests until the file expires, after which it will be recreated. You can also affect the cache headers sent to the browser.



#### `configuration.php`
	$action['cache'] = true;				// Cache file
	$action['browser cache'] = true;		// Cache headers sent to browser

You can set either expiration time (in minutes), or set to `true` to allow that type of caching with system defaults. To force either type of caching disabled for your action, set to `0` or `false`.

You can also speed up cache behavior for your action by opting to *redirect* the user to the cache file. This is exactly the same behavior as when [outputting files](?category=actions&id=output): redirection is faster, but the user will be forwarded to another URL.



#### `configuration.php`
	$action['cache file output'] = 'redirect';

The default for `$action['cache file output']` is `'read file'`.

**Note:** When outputting a file, all cache settings are ignored and cache files will **not** be generated or served. This is because serving a cache file over any other file has virtually no benefit.



### Default behavior

Unless you define otherwise, cache files are not saved but cache headers are set. Both can be disabled in system settings globally, however.