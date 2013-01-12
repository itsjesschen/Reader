<!doctype html>
<html>
<head>
	<title>My Reader</title>
			<?php 
			echo HTML::style('css/reset.css');
			echo HTML::style('css/styles.css');
			//echo HTML::style('http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
			?>
</head>
<body>
	<div class = "pageHeader">
		<h2> Currently Added Feeds </h2>
	</div>
	<div id = "RSSModule">
		<?php 
			foreach($RSS as $page){
				echo '<div class=feed>';
					echo "<a href = '#' class=hidden id='$page->url'></a>";
					echo "<h3 class='feed-title'>".$page->name."</h3>";
					echo "<div id='".$page->url."_max'>";
					echo "</div>";
					echo "<div id='".$page->url."_min' class= 'article-list'>";
					echo '</div>';
				echo '</div>';
			}
		?>	
	</div>
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<script src="../../js/content_display.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

