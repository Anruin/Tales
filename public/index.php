<?php
include_once('../engine/World.php');
include_once('../engine/main.php');
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
	<meta charset="utf-8" />
	<meta http-equiv="x-ua-compatible" content="ie=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title><?php echo $world->name; ?></title>
	<link rel="stylesheet" href="css/foundation.css" />
	<link rel="stylesheet" href="css/app.css" />
	<link rel="apple-touch-icon" sizes="57x57" href="/apple-icon-57x57.png">
	<link rel="apple-touch-icon" sizes="60x60" href="/apple-icon-60x60.png">
	<link rel="apple-touch-icon" sizes="72x72" href="/apple-icon-72x72.png">
	<link rel="apple-touch-icon" sizes="76x76" href="/apple-icon-76x76.png">
	<link rel="apple-touch-icon" sizes="114x114" href="/apple-icon-114x114.png">
	<link rel="apple-touch-icon" sizes="120x120" href="/apple-icon-120x120.png">
	<link rel="apple-touch-icon" sizes="144x144" href="/apple-icon-144x144.png">
	<link rel="apple-touch-icon" sizes="152x152" href="/apple-icon-152x152.png">
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-icon-180x180.png">
	<link rel="icon" type="image/png" sizes="192x192"  href="/android-icon-192x192.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="96x96" href="/favicon-96x96.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/manifest.json">
	<meta name="msapplication-TileColor" content="#ffffff">
	<meta name="msapplication-TileImage" content="/ms-icon-144x144.png">
	<meta name="theme-color" content="#ffffff">
</head>
<body>
	<!-- Yandex.Metrika counter -->
	<script type="text/javascript">
		(function (d, w, c) {
			(w[c] = w[c] || []).push(function() {
				try {
					w.yaCounter35225635 = new Ya.Metrika({
						id:35225635,
						clickmap:true,
						trackLinks:true,
						accurateTrackBounce:true
					});
				} catch(e) { }
			});

			var n = d.getElementsByTagName("script")[0],
				s = d.createElement("script"),
				f = function () { n.parentNode.insertBefore(s, n); };
			s.type = "text/javascript";
			s.async = true;
			s.src = "https://mc.yandex.ru/metrika/watch.js";

			if (w.opera == "[object Opera]") {
				d.addEventListener("DOMContentLoaded", f, false);
			} else { f(); }
		})(document, window, "yandex_metrika_callbacks");
	</script>
	<noscript><div><img src="https://mc.yandex.ru/watch/35225635" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
	<!-- /Yandex.Metrika counter -->

	<header class="text-center">
		<svg id="logo">
			<polygon points="0,0 100,0 50,75" style="fill:#a00;stroke:#300;stroke-width:1"></polygon>
		</svg>
		<h1><?php echo $incredible; ?> <?php echo $stories; ?></h1>
		<h3><?php echo $world->name; ?></h3>
		<div class="stat">Истории о <?php echo $tales[0]; ?> и <?php echo $tales[1]; ?></div>
		<div class="row">
			<div class="columns"><h4>Имя субъекта: <span id="subject-name">Герой</span></h4></div>
			<div class="columns"><h4>Время жизни субъекта: <span id="subject-life"></span> ход</h4></div>
		</div>
	</header>

	<div class="row align-stretch text-left">
		<div id="event-container" class="column"></div>
	</div>

	<div id="event-template" class="callout hide"></div>

	<script src="js/vendor/jquery.min.js"></script>
	<script src="js/vendor/what-input.min.js"></script>
	<script src="js/foundation.js"></script>
	<script src="js/app.js"></script>
</body>
</html>
