<!doctype html>
<html>
<head>
	<title></title>
</head>
<body>
	<h1></h1>
<div class="errors">
	{{$errors->first('tRealName', '<p>:message</p>')}}
	{{$errors->first('tUserName', '<p>:message</p>')}}
	{{$errors->first('rFeedTitle', '<p>:message</p>')}}
	{{$errors->first('rFeedLocation', '<p>:message</p>')}}
</div>
<?php if(Session::get('success')) :?>
	<div>{{ Session::get('success') }}</div>
<?php elseif(Session::get('invalidUser')) :?>
	<div>{{ Session::get('invalidUser') }}</div>
<?php endif ?>
<?php			echo HTML::style('css/styles.css'); ?>
	<div class = "TwitterDIV">
		<h2> Add Twitter Feed </h2>
		<form action="<?php echo URL::to('addfeed/addTwitter') ?>" method="post">
			<label> Twitter Real Name </label>
			<input type="text" name="tRealName" value="{{ Input::old('tRealName') }}"/>
			<label> Twitter User Name </label>
			<input type="text" name="tUserName"value="{{ Input::old('tUserName') }}"/>
			<input type="submit"/>
		</form>
	</div>
	<div class = "RSSDIV">
		<hr>
		<h2> Add RSS Feed </h2>

		<form action="<?php echo URL::to('addfeed/addRSS') ?>" method="post">
			<label>RSS Feed Title</label>
			<input type="text" name="rFeedTitle"value="{{ Input::old('rFeedTitle') }}"/>
			<label>RSS Feed URL</label>
			<input type="text" name="rFeedLocation"value="{{ Input::old('rFeedLocation') }}"/>
			<input type="submit"/>
		</form>
	</div>
		<hr>
	<div class = "LIST"><a href = "<?php echo URL::to('addfeed/listUsers') ?>">Added Tweeters and Feeds</a></div>
</body>
</html>