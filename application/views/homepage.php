<!doctype html>
<html>
<head>
	<title></title>
	<?php 
		echo HTML::style('css/reset.css');
		echo HTML::style('css/styles.css');
		echo HTML::style('http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
	?>
</head>
<body>
	<div class = "pageHeader">
		<h2> Currently Added Feeds </h2>
	</div>
	<div class = "RSSFeeds">
		<?php 
			echo '<div id="RSSModule">';
			echo '<ul class = Feed>';
			foreach($RSS as $page){
				echo '<div class=article-list>';
					echo "<a href = '#' class=hidden id='$page->url'></a>";
					echo "<li><h3>".$page->name."</h3></li>";
					echo "<div id='".$page->url."_max'>";
					echo "</div>";
					echo "<div id='".$page->url."_min' class= 'rsstitle'>";
					echo '</div>';
				echo '</div>';
			}
			echo '</ul>';
		    echo '</div>';
		?>	
	</div>
	</div>
</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.1/jquery.min.js"></script>
<!-- <script src="../../application/views/home/content_display.js"></script> -->
<script src="../../js/content_display.js"></script>
<script src ="http://code.jquery.com/jquery-1.8.3.js"></script>
<script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>

