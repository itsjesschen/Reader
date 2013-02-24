<!doctype html>
<html>
<head>
	<title>My Reader</title>
		<?php echo Asset::scripts();?>
		<?php echo Asset::styles();?>
   		<?php echo Asset::container('feeds')->styles();?>
</head>
<body>

	<div id = "HeaderModule">
		<div class="errors">
			{{$errors->first('feedTitle', '<span>:message</span>')}}
			{{$errors->first('feedLocation', '<span>:message</span>')}}
		</div>
	<?php if(Session::get('success')) :?> 
		<div>{{ Session::get('success') }}</div>
	<?php elseif(Session::get('invalidUser')) :?>
		 <div>{{ Session::get('invalidUser') }}</div>
	<?php endif ?>
		<div class = "RSSDIV">
			<form action="<?php echo URL::to('feed/addRSS') ?>" method="post">
				<input type="text" name="feedTitle" value="<?php if(Session::get('invalidUser')) :?>{{ Input::old('feedTitle') }}<?php else:?>RSS Title<?php endif ?>" defaultValue = "RSS Title" onclick="searchFieldDisplay(this)" onfocus="focusedText(this)" onblur="blurText(this)"/>
				<input type="text" name="feedLocation" value="<?php if(Session::get('invalidUser')) :?>{{ Input::old('feedLocation') }}<?php else:?>RSS URL<?php endif ?>" defaultValue = "RSS URL" onclick="searchFieldDisplay(this)" onfocus="focusedText(this)" onblur="blurText(this)"/>
				<input class = "color-btn" type="submit" value = "Add New Feed"/>
			</form>
		</div>
		<h2> Currently Added Feeds </h2>
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

