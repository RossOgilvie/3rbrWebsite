<?php include("doctype.html"); ?>
<html>
<head>
<title> | 3rd Rose Bay Rovers</title>

<?php include("head.html") ?>

<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>

<script type="text/javascript">
function change() {
	//hide any pic that may be there presently
	$('#pic').css('display','none');
	$('#pic').attr('src','profiles/Ross Ogilvie.jpg');
	$('#pic').attr('onload', "fade_in_pic();");
}

function fade_in_pic() {
	//$('#pic').css('visibility','hidden');
	//$('#pic').css('display','inline');
	$('#pic').fadeIn('fast');
}
</script>
</head>

<body>
<?php include("site-header.html"); ?>
<?php include("nav-menu.html"); ?>

<div class="content">
<img id="pic" src="images/3rbr_shield_transparent.png" height="400px" />
</div>

<a onclick="change();return false;">Click Me</a>

<div id="log"></div>
</body>
</html>
