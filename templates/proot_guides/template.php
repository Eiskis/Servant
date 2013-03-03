<?php

$output = '
<!DOCTYPE html>
<html lang="en">
	<head>

		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
		<style type="text/css">@-ms-viewport{width: device-width;}</style>

		<title>'.$servant->site()->name().' via Servant</title>
		';

		// Use a favicon if there is one
		foreach (rglob_files($servant->theme()->path('server'), 'ico') as $path) {
			$output .= '<link rel="shortcut icon" href="'.$servant->format()->path($path, 'domain', 'server').'" type="image/x-icon">';
			break;
		}

		// Stylesheets
		foreach ($servant->theme()->stylesheetFiles('domain') as $path) {
			$output .= '<link rel="stylesheet" href="'.$path.'" media="screen">';
		}

		$output .= '
	</head>

	<body class="'.implode(' ', $servant->site()->selected()).'">



		<div class="dark" id="menu">

			<div class="buffer first">
				<div class="contentarea">
					<ol class="plain push-left block reset">
					';

					// Level 1 menu
					$level1 = $servant->site()->articles();
					if (!empty($level1)) {
						foreach ($level1 as $key => $value) {
							$output .= '<li class="reset'.($servant->site()->selected(0) === $key ? ' selected': '').'"><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/'.$key.'/">'.$servant->format()->name($key).'</a></li>';
						}
					}
					unset($level1, $key, $value);

					$output .= '
					</ol>

					<ul class="plain push-right block reset">
						<li><a href="http://eiskis.net/proot/">Proot home</a></li>
					</ul>

					<div class="clear"></div>
				</div>
			</div>

			<div class="buffer second">
				<div class="contentarea">
				
					<ol class="plain push-left block reset">
					';

					// Level 2 menu
					$level2 = $servant->site()->articles($servant->site()->selected(0));
					if (!empty($level2) and is_array($level2)) {
						foreach ($level2 as $key => $value) {
							$output .= '<li class="reset'.($servant->site()->selected(1) === $key ? ' selected': '').'"><a href="'.$servant->paths()->root('domain').$servant->site()->id().'/'.$servant->site()->selected(0).'/'.$key.'">'.$servant->format()->name($key).'</a></li>';
						}
					}
					unset($level2, $key, $value);

					$output .= '
					</ol>

					<select class="hidden" onchange="window.open(this.options[this.selectedIndex].value,\'_top\')">
					';

					// Level 1 menu
					$level1 = $servant->site()->articles();
					if (!empty($level1)) {
						foreach ($level1 as $key => $value) {
							$output .= '<optgroup label="'.$servant->format()->name($key).'">';
							$output .= '</optgroup>';
						}
					}
					unset($level1, $key, $value);

					$output .= '
					</select>

					<div class="clear"></div>
				</div>
			</div>

		</div>



		<div class="buffer" id="content">
			<div class="contentarea">
				
				<h1>'.$servant->site()->name().'</h1>

				<pre>'.dump($servant->site()->selected()).'</pre>

				<div class="clear"></div>
			</div>
		</div>



		<div class="dark buffer" id="footer">
			<div class="contentarea">

				<div class="column six">
					<table>

						<tr>
							<td class="third">Proot home</td>
							<td><a href="http://eiskis.net/proot/" target="_blank">eiskis.net/proot/</a></td>
						</tr>

						<tr>
							<td class="third">Documentation &amp; guides</td>
							<td><a href="http://eiskis.net/proot/guides/" target="_blank">eiskis.net/proot/guides/</a></td>
						</tr>
						<tr>
							<td class="third">Download</td>
							<td><a href="https://bitbucket.org/Eiskis/proot/downloads/proot.zip" target="_blank">Latest release from Bitbucket</a></td>
						</tr>
						<tr>
							<td class="third">Licensed under</td>
							<td><a href="../lgpl.txt" target="_blank">GNU Lesser General Public License</a></td>
						</tr>

					</table>
				</div>

				<div class="column six last">
					<table>

						<tr>
							<td class="third">Development @ Bitbucket</td>
							<td>
								<ul class="plain close">
									<li><a href="https://bitbucket.org/Eiskis/proot/" target="_blank">Project overview</a></li>
									<li><a href="https://bitbucket.org/Eiskis/proot/src" target="_blank">Source code</a></li>
									<li class="last"><a href="https://bitbucket.org/Eiskis/proot/issues?status=new&amp;status=open" target="_blank">Issue management</a></li>
								</ul>
							</td>
						</tr>
						<tr>
							<td class="third">By Jerry Jäppinen</td>
							<td>
								<ul class="plain close">
									<li><a href="https://twitter.com/Eiskis" target="_blank">@Eiskis</a></li>
									<li><a href="http://eiskis.net/" target="_blank">eiskis.net</a></li>
									<li><a href="mailto:eiskis@gmail.com" target="_blank">eiskis@gmail.com</a></li>
									<li class="last"><a href="tel:+358407188776">+358 40 7188776</a></li>
								</ul>
								<div class="clear"></div>
							</td>
						</tr>

					</table>
				</div>

				<div class="clear"></div>
			</div>
		</div>
		';

		// // Scripts
		// $output .= '
		// <script src="assets/prism.js"></script>
		// <script src="assets/respond.min.js"></script>
		// ';

		$output .= '
	</body>
</html>
';

echo $output;
?>