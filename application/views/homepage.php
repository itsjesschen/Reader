<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
<div id="TwitterFeeds">
	<h2> Currently Added Twitter Users </h2>
	<hr>
		<?php 
			echo '<div id="TweeterModule">';
			echo '<ul class=FeedContent>';
			foreach($Tweeters as $tweeter){
				echo "<a href = '#' name='Clickable' class=hidden id='$tweeter->url'></a>";
				echo "<div class=FeedBlock id ='".$tweeter->url."_min'></div>";
			}
			echo '</ul>';
			echo '</div>';
		?>
	</div>

	<div class = "RSSFeeds">
		<h2> Currently Added Feeds </h2>
		<hr>
		<?php 
			echo HTML::style('css/styles.css');
			echo HTML::style('http://code.jquery.com/ui/1.9.2/themes/base/jquery-ui.css');
			echo '<div id="RSSModule">';
			echo '<ul class = FeedContent>';
			foreach($RSS as $page){
				// $channel = $pages->channel; 
				echo '<div class=FeedBlock>';
					echo "<a href = '#' class=hidden id='$page->url'></a>";
					echo "<li><h3>".$page->name."</h3></li>";
					echo "<div id='".$page->url."_max' class='hidden'></div>";
					echo "<div id='".$page->url."_min' class=''>";
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

