<?php

// Footer
echo '<div class="footer container">';

		// Sort pages into pages and categories
		$pages = array();
		$categories = array();
		foreach ($servant->site()->pages() as $key => $value) {
			if (is_array($value)) {
				$categories[] = $key;
			} else if (is_string($value)) {
				$pages[] = $key;
			}
		}

		// Pages & generic stuff
		echo '<div class="row"><div class="span3"><ul class="nav nav-list"><li class="list-header">'.$servant->site()->name().'</li><li><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/sitemap/'.'">Sitemap</a></li>';

		// Create footer links for pages
		foreach ($pages as $id) {
			echo '<li><a href=".">'.$servant->format()->title($id).'</a></li>';
		}
		echo '</ul></div>';

		// Create footer links for categories
		$i = 2;
		foreach ($categories as $id) {
			echo $i === 1 ? '<div class="row">' : '';
			echo '<div class="span3"><ul class="nav nav-list"><li class="list-header">'.$servant->format()->title($id).'</li>';
			foreach ($servant->site()->pages($id) as $key => $value) {
				echo '<li><a href=".">'.$servant->format()->title($key).'</a></li>';
			}
			echo '</ul></div>';

			// Handle counter
			if ($i === 4) {
				echo '</div>';
				$i = 1;
			} else {
				$i++;
			}
		}

echo '</div>';

// Include scripts
echo '<script src="'.$servant->paths()->root('domain').$servant->site()->id().'/scripts/'.implode('/', $servant->site()->page()->tree()).'/'.'"></script>';

// End it all
echo '
	</body>
</html>
';

?>