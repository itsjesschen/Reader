<!doctype html>
<html>
<head>
	<title>My Reader</title>
			<?php 
			echo HTML::style('css/reset.css');
			echo HTML::style('css/styles.css');
			//echo HTML::style('http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
			?>
			<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet' type='text/css'>
			<link href='http://fonts.googleapis.com/css?family=Droid+Serif:400,700,400italic' rel='stylesheet' type='text/css'>
			<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
			<script src="../../js/content_display.js"></script>
			<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
</head>
<body>
	<div id = "HeaderModule">
		<h2> My RSS Feeds </h2>
	</div>
	<div id = "Reader">
		<div id = "RSSModule">
			<?php 
				foreach($RSS as $page){
						echo "<a href='javascript:void(0)' id='$page->url' class='feed-title' onclick=getRSSWrapper(this) >".$page->name."</a>";
				}?>	
		</div>
		<div id="ArticleModule">
			<h2 class = "title"></h2>
			<ul class = "article-list">
			</ul>
		</div>
	</div>
</body>
</html>

