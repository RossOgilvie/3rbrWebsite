<?php include("doctype-html-head.html"); ?>

<title>Photo Gallery | 3rd Rose Bay Rovers</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/lightbox.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />

<script src="js/jquery.lazyload.js" type="text/javascript"></script>

<?php
// Get the names of all rovers with a profile
$groups=array();
$pics=array();
$dir0 = "photos/";  
// Open a known directory, and proceed to read its contents  
if (is_dir($dir0) && $dh0 = opendir($dir0))  
{  
	while (($dir1 = readdir($dh0)) !== false)  
	{
		//for all the nontrivial folders in it, loop through their files
		if(is_dir($dir0."/".$dir1) && $dir1[0] != "." && $dh1 = opendir($dir0."/".$dir1))
		{
			//add the nontrivial folder to the list of groups
			$groups[] = $dir1;
			//prep an array to hold all the files belonging to this group
			$pics[$dir1]=array();
			while (($file = readdir($dh1)) !== false)  
			{
				//again filter the crap files
				if($file[0] != ".")
				{
					//add the real files to the list of docs, indexed by their group
					$pics[$dir1][] = $file;
				}
			}
			closedir($dh1);
			sort($pics[$dir1]);
		}
	}  
	closedir($dh0);
	sort($groups);
}
?>
</head>

<body>
<?php include("site-header.html"); ?>

<div class="content center">
<?php
foreach($groups as $group)
{
	foreach($pics[$group] as $pic)
	{
		echo "<div class='gallery-pic'><a href='photos/$group/$pic' rel='lightbox[all]'><img src='images/grey.gif' data-original='photos/$group/$pic' class='gallery-pic' alt='thumbnail' /></a></div>\n";
	}
}
?>
</div>

<script type="text/javascript" charset="utf-8">
$(function() {
	$("img").lazyload({	effect : "fadeIn"});
	$("img[data-original]").attr('onload', "crop_correctly($(this));");
});

function crop_correctly(img)
{
	var newImg = new Image();

    newImg.onload = function() {
		var height = newImg.height;
		var width = newImg.width;
		var ratio = height/width;
		// we only want to do this when we load the real image, not the placeholder
		if(img.attr("src")!="images/grey.gif")
			if(height >= width) 
			{
				img.css("width","200px");
				img.css("height",Math.round(200*ratio) + "px");
				img.css("margin-top", "-25%");
				img.css("margin-left", "0");
			}
			else
			{
				img.css("height","200px");
				img.css("width",Math.round(200/ratio) + "px");
				img.css("margin-left", "-25%");
				img.css("margin-top", "0");
			}
    }

    newImg.src = img.attr("src");
}
  </script>
</body>
</html>
