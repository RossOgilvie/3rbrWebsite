<?php include("doctype.html"); ?>
<html>
<head>
<title>Photo Gallery | 3rd Rose Bay Rovers</title>

<?php include("head.html") ?>

<script src="js/jquery-1.7.2.min.js"></script>
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
		if(is_dir($dir0."/".$dir1) && $dir1 != "." && $dir1 != ".." && $dh1 = opendir($dir0."/".$dir1))
		{
			//add the nontrivial folder to the list of groups
			$groups[] = $dir1;
			//prep an array to hold all the files belonging to this group
			$pics[$dir1]=array();
			while (($file = readdir($dh1)) !== false)  
			{
				//again filter the crap files
				if($file != "." && $file != "..")
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
<?php include("nav-menu.html"); ?>

<div class="content">

<?php
foreach($groups as $group)
{
	//echo "<h2>$group</h2>\n";
	//echo "<ul>\n";
	foreach($pics[$group] as $pic)
	{
		echo "<div class='gallery-pic-div'><a href='photos/$group/$pic' rel='lightbox[all]'><img src='images/grey.gif' data-original='photos/$group/$pic' class='gallery-pic-img'/></a></div>\n";
	}
	//echo "</ul>\n";
}
?>
</div>

<script type="text/javascript" charset="utf-8">
$(function() {
	$("img").lazyload({
		effect : "fadeIn",
	});
});
  </script>
</body>
</html>
