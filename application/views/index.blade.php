<!doctype html>
<html>
<head>
	<title>My Reader</title>
	<?php echo Asset::scripts();?>
	<?php echo Asset::container('index')->styles();?>
   	<?php echo Asset::styles();?> 
</head>
<body>
	<h1></h1>
<div class="errors">
	{{$errors->first('feedTitle', '<p>:message</p>')}}
	{{$errors->first('feedLocation', '<p>:message</p>')}}
</div>
<?php if(Session::get('success')) :?>
	<div>{{ Session::get('success') }}</div
<?php elseif(Session::get('invalidUser')) :?>
	<div>{{ Session::get('invalidUser') }}</div>
<?php endif ?>
<div class= "text">
	<p> 
</div>
<div id = "choice-div">
	<div class = "form-div">
		<form class = "feed_form" action="<?php echo URL::to('feed/addRSS') ?>" method="post">
			<input type="text" name="feedTitle" value="<?php if(Session::get('invalidUser')) :?>{{ Input::old('feedTitle') }}<?php else:?>RSS Title<?php endif ?>" defaultValue = "RSS Title" onclick="searchFieldDisplay(this)" onfocus="focusedText(this)" onblur="blurText(this)"/>
			<input type="text" name="feedLocation" value="<?php if(Session::get('invalidUser')) :?>{{ Input::old('feedLocation') }}<?php else:?>RSS URL<?php endif ?>" defaultValue = "RSS URL" onclick="searchFieldDisplay(this)" onfocus="focusedText(this)" onblur="blurText(this)"/>
			<input class = "color-btn" type="submit" value = "Add New Feed"/>
		</form>
	</div>
	<div class = "list-div"><a href = "<?php echo URL::to('feed') ?>">Currently Added RSS Feeds <div class = "arrow"></div></a></div>
</div>
</body>
</html>