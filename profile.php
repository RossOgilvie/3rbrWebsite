<?php include("doctype-html-head.html"); ?>

<title>Profiles | 3rd Rose Bay Rovers</title>

<script src="//ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script type="text/javascript" src="js/marked.js"></script>
<script type="text/javascript">
//detect hash change and then 
$(window).bind('hashchange', check_url_hash);

//This strips out the name after the hash from the url
function check_url_hash() {
	var hash = window.location.hash.slice(1); //hash to string (= "User Name")
	switch_profile(hash);
}    
    
//This function switches between different rover's profiles based on their name
function switch_profile(name)
{
	// have cool nickname translation
	var nicknames = {Awesome:"Ross Ogilvie", awesome:"Ross Ogilvie", lammy:"Lauren Scott"};
	if(name in nicknames) name = nicknames[name];
	
	// Some profiles have names like Nick Wolf.booted.profile. Try to match an ordinary type, then fall back to the other types
	var profile_path="";
	
	if(url_exists('profiles/' + name + '.profile'))
		profile_path='profiles/' + name;
	else if(url_exists('profiles/' + name + '.booted.profile'))
		profile_path='profiles/' + name + '.booted';
	else if(url_exists('profiles/' + name + '.hidden.profile'))
		profile_path='profiles/' + name + '.hidden';

	// retrieve the file at "profile_path.profile" = "profile/Ross Ogilvie.profile"
	// the $.now() bit is to make unique requests and avoid caching
	//$.get(profile_path + ".profile", { "_": $.now() }, function(profile_content)
	$.get(profile_path + ".profile", function(profile_content)
	{
		//if we succeed, parse it as markdown, and load it into "#profile-div"
		$('#profile-bio').html(marked(profile_content));

		//hide any pic that may be there presently
		$('#profile-pic-img').css('display','none');
		
		// We look for profile pics with the following exts, listed in order of preference
		var profile_pic_exts=[".png",".jpg"];
		for(var i = 0; i < profile_pic_exts.length; i++) {
			if(url_exists(profile_path + profile_pic_exts[i])) {
				// If you find one, then swap it in
				$('#profile-pic-img').attr('src', profile_path + profile_pic_exts[i]);
				//only after the new image has loaded should we display it
				$('#profile-pic-img').attr('onload', "$('#profile-pic-img').fadeIn('fast');");
				// Once we find the profile picture, don't keep looking
				break;
			}
		}
	});
}

//tests whether a given file exists. Can fail is the server gives soft 404s
function url_exists(url)
{
    var http = new XMLHttpRequest();
    http.open('HEAD', url, false);
    http.send();
    return http.status!=404;
}
</script>

<?php
// Get the names of all rovers with a profile
$rovers=array();
$booted=array();
$dir = "profiles/";  
// Open a known directory, and proceed to read its contents  
if (is_dir($dir) && $dh = opendir($dir))  
{  
	while (($file = readdir($dh)) !== false)  
	{
		$parts = explode(".",$file);
		if(count($parts)==2 && $parts[1]=="profile")
				$rovers[] = $parts[0];
		if(count($parts)==3 && $parts[1]=="booted" && $parts[2]=="profile") //booted rovers
			$booted[] = $parts[0];
	}  
	closedir($dh);  
}

//Sort the names
sort($rovers);
sort($booted);
?>
</head>

<body onload="check_url_hash();">
<?php include("site-header.html"); ?>

<div id="profile-box-wrapper">
	<div id="profile-box">
		<div id="profile-pic">
			<img id="profile-pic-img" alt="Profile Picture" />
		</div>

		<div id="profile-bio">
			<p>Please select a profile from the menu.</p>
		</div>
	</div>
</div>

<div id="profile-menu">
<ul>
<?php
//make a menu item for each rover, which will load their profile when clicked.
foreach($rovers as $rover)
{
	echo "<li><a onClick='window.location.hash = \"$rover\";'>$rover</a></li>\n";
}

//if there are any booted rovers, also list them
if(count($booted) != 0)
{
	echo "<hr />";
	//echo "<ul>";
	foreach($booted as $boot)
	{
		echo "<li><a onClick='window.location.hash = \"$boot\";'>$boot</a></li>\n";
	}
	//echo "</ul>";
}
?>
</ul>
</div>


</body>
</html>
