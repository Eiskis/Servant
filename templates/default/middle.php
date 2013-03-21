<?php

// Create classes for body class
$i = 1;
$classes = array();
$tree = $servant->article()->tree();
foreach ($tree as $value) {
	$classes[] = 'article-'.implode('-', array_slice($tree, 0, $i));
	$i++;
}
unset($tree, $i);

$output = '
	<body class="level-'.count($servant->article()->tree()).' '.implode(' ', $classes).'">
		';
		unset($classes);

		$output .= '
		<div id="header">
			<h1><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.'">'.$servant->site()->name().'</a></h1>
			';



			// Level 1 menu
			$level1 = $servant->site()->articles();
			if (count($level1) > 1) {
				$output .= '<ul class="menu-1">';
				foreach ($level1 as $key => $value) {

					// Selected
					if ($servant->article()->tree(0) === $key) {
						$output .= '<li><strong><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.$key.'/">'.$servant->format()->name($key).'</a></strong></li>';

					// Normal link
					} else {
						$output .= '<li><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.$key.'/">'.$servant->format()->name($key).'</a></li>';
					}

				}
				$output .= '</ul>';
			}
			unset($level1, $key, $value);



			// Dropdown menu
			$output .= '<select class="menu-1 menu-2 menu-1-2" onchange="window.open(this.options[this.selectedIndex].value,\'_top\')">';
			foreach ($servant->site()->articles() as $key => $value) {

				// First-level article
				$output .=
				'<option value="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.$key.'/" '.($key === $servant->article()->tree(0) ? ' selected' : '').'>'.
				$servant->format()->name($key).
				'</option>';

			}
			$output .= '</select>';
			unset($key, $value);
			$output .= '<div class="clear"></div>';



			// Body content
		$output .= '
		</div>
		<div id="body">
			';



			// Submenu in a sidebar
			$level2 = $servant->site()->articles($servant->article()->tree(0));
			if (is_array($level2)) {
				$output .= '<div id="sidebar"><ul class="menu-2">';

				// List items
				foreach ($level2 as $key => $value) {
					$output .= '<li>';

					// Link HTML
					$link = '<a href="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.$servant->article()->tree(0).'/'.$key.'/">'.$servant->format()->name($key).'</a>';

					// Selected item
					if ($servant->article()->tree(1) === $key) {
						$output .= '<strong>'.$link.'</strong>';
						unset($link);

						// Possible children
						if (is_array($value)) {
							$output .= '<ul class="menu-3">';

							// Child pages in array
							foreach ($value as $key2 => $value2) {

								// Child item HTML
								$link = '<a href="'.$servant->paths()->root('domain').$servant->site()->id().'/read/'.$servant->article()->tree(0).'/'.$key.'/'.$key2.'/">'.$servant->format()->name($key2).'</a>';
								if ($servant->article()->tree(2) === $key2) {
									$link = '<strong>'.$link.'</strong>';
								}
								$output .= '<li>'.$link.'</li>';
							}
							unset($level3, $key2, $value2);

							$output .= '</ul>';
						}

					// Link only
					} else {
						$output .= $link;
					}
					unset($link);

					$output .= '</li>';
				}

				$output .= '</ul></div>';
			}
			unset($level2, $key, $value);



			// Body content
			$output .= '<div id="article">'.$servant->template()->content().'</div><div class="clear"></div>';

			$output .= '
		</div>
';

echo $output;
?>