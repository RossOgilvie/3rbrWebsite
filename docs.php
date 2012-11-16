<?php include("doctype-html-head.html"); ?>

<title>Documents | 3rd Rose Bay Rovers</title>

<?php
// Get the names of all rovers with a profile
$groups=array();
$docs=array();
$dir0 = "documents/";  
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
			$docs[$dir1]=array();
			while (($file = readdir($dh1)) !== false)  
			{
				//again filter the crap files
				if($file != "." && $file != "..")
				{
					//add the real files to the list of docs, indexed by their group
					$docs[$dir1][] = $file;
				}
			}
			closedir($dh1);
			sort($docs[$dir1]);
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
	echo "<h2>$group</h2>\n";
	echo "<ul>\n";
	foreach($docs[$group] as $doc)
	{
		echo "<li><a href='documents/$group/$doc'>$doc</a></li>\n";
	}
	echo "</ul>\n";
}
?>
</div>
</body>
</html>
