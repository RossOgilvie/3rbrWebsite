ROVER WEBSITE
=============

How to administer this website
------------------------------

The website is designed to be easy to administer. The pages are either static, and the content can be editted directly in html, or the pages loads content automatically from files in specific folders. Pages are assembled by a central file, builder.php, which combines common elements (such as the site header and nav bar) and content as it is requested. This way sitewide changes are easy to maintain. Magical htaccess mod_rewrite rules are used for nice urls.

I made a radical simplication of the site. Some of the pages therefore are no longer used, but still present here in case they need to be resurrected in the future.

### Contacts
There are two contacts files, contact.txt and contact.php. Only edit the former, using markdown syntax, and the latter will parse it into a webpage. This is the only file on the website that you should ever need to manually edit, with the possible exception of the about us page. Instructions on how markdown works can be found [here](http://daringfireball.net/projects/markdown/basics).

### About Us
This is a straight forward html page.

### Calendar
This is a straight up html page with the secretary's calendar embedded in it.

### 404
404.php is what shows when someone tries to go to a page that doesn't exist.

### Gallery
The gallery is a hybrid of old and new ways. It is possible to upload photos to the website directly, as outlined below. But it will also pull in all the photos from the crew's facebook page.

Photos uploaded to the website must be in an album folder inside the "photos" directory. It doesn't check whether files in these folder are picures or not, so to avoid errors make sure these folders only contain pictures. This system alows you to group photos together into albums, even though the gallery doesn't show the albums explicitly.

### Documents - Redirected
Uploading things to to website via ftp was a technical process beyond most secretaries. The documents link now takes people directly to the google docs public folder attached to the secretary's account.

### Profiles - Hidden from menu
The profiles were a pain to maintain, and nothing looks worse than a old outdated site.

### Snippets
There are three common snippets. "doctype-html-head.html" does some technically important things and also loads the website's theme. "site-header.html" is exactly what is sounds like, it has the website's heading and two logo pictures. "nav-menu.html" has a list of links to the pages of the website.

### Configuration tricks
As mentioned at the start, magical mod_rewrite rules are in effect. The server is set up to assume that pages without a file extension should be given a .php extension. For example, yoursite.com/calendar is rewritten to yoursite.com/calendar.php. Next a rule matches pages ending in php and redirects them to the builder script -> yoursite.com/builder.php?page=calendar.php . You can use this feature to make nicer looking urls.
