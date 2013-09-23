<?php

echo '
<!DOCTYPE html>
<html lang="'.$servant->site()->language().'">
	<head>
		';

		// Basic meta stuff - charset, scaling...
		echo '
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<style type="text/css">
			@-ms-viewport{width: device-width;}
			@-o-viewport{width: device-width;}
			@viewport{width: device-width;}
		</style>
		';

		// Site title
		echo '
		<title>'.$servant->site()->name().'</title>
		<meta name="application-name" content="'.$servant->site()->name().'">
		';

		// Custom web site icon
		$icon = $servant->site()->icon('domain');
		if (empty($icon)) {
			$icon = $servant->theme()->icon('domain');
		}
		if (!empty($icon)) {
			$extension = pathinfo($icon, PATHINFO_EXTENSION);

			// .ico for browsers
			if ($extension === 'ico') {
				echo '<link rel="shortcut icon" href="'.$icon.'" type="image/x-icon">';

			// Images for browsers, iOS, Windows 8
			} else {
				echo '
				<link rel="icon" href="'.$icon.'" type="'.$servant->settings()->contentTypes($extension).'">
				<link rel="apple-touch-icon-precomposed" href="'.$icon.'" />
				<meta name="msapplication-TileImage" content="'.$icon.'"/>';
				// echo '<meta name="msapplication-TileColor" content="#d83434"/>';
			}

			unset($extension);
		}
		unset($icon);



		// Stylesheets
		echo '<link rel="stylesheet" href="'.$servant->paths()->root('domain').$servant->site()->id().'/stylesheets/'.implode('/', $servant->site()->page()->tree()).'/'.'" media="screen">';

		echo '
	</head>
';

?>