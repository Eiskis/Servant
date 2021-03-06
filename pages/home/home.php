
<!-- Intro -->
<div class="row row-intro" id="about">
	<div class="row-content buffer">



		<div class="limit">

			<!-- Intro -->
			<h1 class="squeeze-bottom">Servant</h1>

			<p class="discreet">A practical, approachable micro web framework. Designed for us humans who frequently whip up new web sites.</p>

			<p class="discreet">Drop-in setup. On PHP. Open-source.</p>

			<p><a href="#features" class="scroll button pull-left push-right">Read more</a> <a href="#download" class="scroll button">Download</a></p>

		</div>



	</div>
</div>



<!-- Features -->
<div class="row row-features inverted" id="features">

	<div class="row-content buffer">

		<h2>When you just need a web site</h2>

		<div class="column seven">

			<div class="limit">

				<p>Servant turns your text, Markdown, HTML etc. files into a sitemap, styled with the assets you throw at it &ndash; no questions asked. It runs without elaborate database, configuration or deployment routines.</p>

				<p>Develop your own layout or use existing themes and templates for immediate output. <em>You</em> choose. Hell, you don’t even have to write a single line of PHP if you don’t want to!</p>

				<p>Just move Servant’s files on your server and it works.</p>

				<p class="discreet">Servant is for <em>web sites</em> &ndash; it’s not a web app platform. Use something else for authentication and heavy database operations. You can set up your frontend with Servant even if you use e.g. <a href="http://www.playframework.com/" target="_blank">Play Framework</a> for business logic and APIs.</p>

			</div>

		</div>

		<div class="column four last lists">

			<ul>
				<li>Human-readable URLs</li>
				<li>Fully automated asset pipeline</li>
				<li>Automatic caching</li>
				<li>Extendable backend actions</li>
				<li>HTML meta tag generation</li>
			</ul>

			<ul>
				<li>CSS, LESS + SCSS styles</li>
				<li>Plain text, Markdown, Textile, HTML pages</li>
				<li>PHP, Twig, HAML, Jade scripting</li>
			</ul>



		</div>
		<div class="clear"></div>

	</div>



	<!-- App screenshot -->
	<div class="buffer-right buffer-bottom buffer-left reel">

		<p class="main"><img src="apps/safari.png" alt="Safari" title="Safari" class="keep-center"></p>
		<div class="clear"></div>

		<p class="column half"><img src="apps/sublime.png" alt="Sublime" title="Sublime"></p>
		<p class="column half last"><img src="apps/finder.png" alt="Finder" title="Finder"></p>
		<div class="clear"></div>

	</div>



	<!-- Samples -->
	<div class="row-content buffer quotes">
		<div class="overflow">

			<blockquote>

				<div class="column half">
					<p class="keep-right align-right discreet limit"><strong>Usable for everyone in our team.</strong> Producers, designers and developers can all contribute.</p>

					<p class="keep-right align-right discreet limit"><strong>Lightweight alternative to WordPress</strong>. Gives us the things we need with no bloat.</p>

				</div>

				<div class="column half last">

					<p class="discreet limit">Publishes our <strong>Markdown documentation</strong>. Docs stay clean for us, users get a full-featured web site.</p>

					<p class="discreet limit">I use Servant whenever <strong>I don’t need or want a database</strong>. It’s made for the frontend.</p>

				</div>

				<div class="reset"></div>

			</blockquote>

		</div>
	</div>

</div>



<!-- Download -->
<div class="row row-download inverted" id="download">
	<div class="row-content buffer even">

		<div class="column right twothirds">
			<div class="limit">

				<h2 class="squeeze-top">Download Servant</h2>

				<p><big>We’re currently at alpha, and provide only full repository snapshots. Release packages coming soon.</big></p>

				<p class="discreet">Repo contains Servant core and a placeholder site, plus full documentation and samples. Have fun!</p>

			</div>

			<p><a href="https://github.com/Eiskis/Servant/archive/master.zip" class="button push-right">Download Servant <?php echo $servant->version(); ?></a> <input type="text" class="plain pull-left cloneurl" value="git clone https://github.com/Eiskis/Servant.git" readonly="readonly"></p>

		</div>

		<div class="column right third last align-right">

			<p class="reset-bottom">source &amp; repo</p>

			<p class="reset-top"><a href="https://github.com/Eiskis/Servant/">Github</a></p>

			<p class="reset-bottom">license</p>

			<p class="reset-top"><a href="http://www.gnu.org/copyleft/lesser.html">LGPL</a></p>

			<p class="reset-bottom">latest version</p>

			<p class="reset-top discreet"><?php echo $servant->version(); ?></p>

			<p class="reset-bottom">requirements</p>

			<p class="reset discreet">PHP 5.3+</p>

			<p class="reset-top discreet">Apache &amp; rewrite module</p>

		</div>

		<div class="clear"></div>

	</div>
</div>



<!-- Resources -->
<div class="row row-resources" id="resources">
	<div class="row-content buffer">



		<h2>More Servant</h2>

		<div class="limit">

			<dl>

				<dt class="reset-top"><a href="/guides" class="button pull-left">Tutorials &amp; guides</a></dt>

				<dt><a href="/docs" class="button pull-left">Full documentation</a></dt>

			<!-- <dt><a href="https://groups.google.com/forum/?fromgroups#!forum/servant" class="button pull-left">Support on Google Groups</a></dt> -->

				<dt><a href="https://github.com/Eiskis/Servant/" class="button pull-left">Development on Github</a></dt>

			</dl>

			<p class="discreet">Authored by <a href="http://eiskis.net/">Jerry Jäppinen</a>.</p>

		</div>

	</div>
</div>
