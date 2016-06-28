<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="js/lightbox.js"></script>
<link href="css/lightbox.css" rel="stylesheet" />

<script src="js/jquery.lazyload.js" type="text/javascript"></script>

<?php
// Get all the photos
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
					//add the real files to the list of pics, indexed by their group
					$pics[$dir1][] = $file;
				}
			}
			closedir($dh1);
			sort($pics[$dir1]);
		}
	}
	closedir($dh0);
	rsort($groups);
}
?>

<div class="content center">
<?php
// FACEBOOK PHOTOS
// Make the query, with app api tied to ross' facebook
$baseUrl = 'https://graph.facebook.com/v2.6/156755564335433';
$query = 'fields=albums.fields(photos.fields(source))';
$access = 'access_token=151333008339356|6b6cbbca6b2d6ec5766a5b46b4d08ad4';
$photosUrl = $baseUrl . '?' . $query . '&' . $access;
// get all the photos as json
$photoResults = file_get_contents($photosUrl);
// decode json into php array
$decoded = json_decode($photoResults, true);
//strip off some cruft
$albums = $decoded["albums"]["data"];

// loop through all the albums
foreach ($albums as $album) {
	//loop through the photos in each album
	foreach ($album["photos"]["data"] as $photo) {
	// grab the url from the array
	$photoSrc = $photo["source"];
	//inject into the page
	echo "<div class='gallery-pic'><a href='$photoSrc' rel='lightbox[all]'><img src='images/grey.gif' data-original='$photoSrc' class='gallery-pic' alt='thumbnail' /></a></div>\n";
	}
}
?>

<?php
// LOCAL PHOTOS
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
