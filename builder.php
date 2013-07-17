<?php include("doctype-html-head.html"); ?>

<title>3rd Rose Bay Rovers</title>
</head>

<body>
<?php 
include("site-header.html");

$page = "calendar.php";

if (isset($_GET['page'])) 
{
	$page = $_GET['page'];
}

include $page

?>
</body>
</html>
