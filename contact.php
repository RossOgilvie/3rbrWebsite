<div class="content" style="text-align: left;">
<div id="contact"></div>

<h2>Other Rover Crews in the Area</h2>
<a href="http://abbotsfordrovers.org.au"><img src="images/abbotsford_crew_logo.jpg" height=150></a>
<a href="http://coogeerovers.org.au"><img src="images/coogee_crew_logo.png" height=150></a>
<!--
<a href="http://rosebayrovers.org.au"><img src="images/rosebay_crew_logo.png" height=150></a>
-->
<a href="http://www.nsw.rovers.com.au/"><img src="images/rover_logo.png" height=150></a>
</div>

<script type="text/javascript" src="js/marked.js"></script>
<script type="text/javascript">
function load_contacts()
{
$.get("contact.txt", function(contact_content)
{
	//if we succeed, parse it as markdown, and load it into "#contact"
	$('#contact').html(marked(contact_content));
}, "text");
}

$(document).ready(load_contacts)
</script>
