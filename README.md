ROVER WEBSITE
=============

How to administer this website
------------------------------

The website is designed to be easy to administer. The pages are either static, and the content can be editted directly in html, or the pages loads content automatically from files in specific folders. Additionially, common elements (such as the site header and nav bar) are stored as html snippets and then magically inserted into each pages as it is requested. This way sitewide changes are easy to maintain.

### Dynamic Pages
The profiles page (profile.php), the documents page (docs.php), and the gallery page (gallery.php) all load their content based on different folders. You should not have to edit these pages directly to add or remove stuff from the website.

### Dynamic Pages: Profiles
The profiles page content is perhaps the most complicated. It loads content from the directory called "profiles". A profile consists of two files, a .profile and a picture. The former is simply a text document written using "markdown" syntax (the same syntax as this document). The latter is a picture file in png or jpg format. Pictures are best if they are portrait and approximately 400px wide. Both files should be named with the full name of the rover. For example
Joe Smith.profile
Joe Smith.png

Instructions on how markdown works can be found [here](http://daringfireball.net/projects/markdown/basics.)

Booted Rovers are collected in a second list. They should be name with a .booted before the file extension
Joe Smith.booted.profile
Joe Smith.booted.png

Finally, if you wish a profile to be still available, but not shown in the list on the profiles page, used a .hidden
Joe Smith.hidden.profile
Joe Smith.hidden.png

### Dynamic Pages: Documents
Items listed on the docs.php page are drawn from documents folder. Additionally, each document must be sorted into a subfolder that gives its grouping on the page. For example, the folder structure might look like this

	documents
	|->	Constitution
	|	|->	Constition.docx
	|	\-> Apendix.docx
	\->	Minutes 2012
		|-> Feb.pdf
		|->	April.pdf
		\->	June.pdf

Documents that are not in a subdirectory of the documents folder will not be shown. For example if there was another folder inside "Minutes 2012" it and its contents would not be shown. Likewise, if there was a douemtn directly in the "documents" folder, it would not be shown

### Dynamic Pages: Gallery
This follows the same rules as the documents folder. Images must be in folders inside the "photos" directory. It doesn't check whether files in these folder are picures or not, so to avoid errors make sure these folders only contain pictures. This systes alows you to group photos together into albums, even though the gallery doesn't show the albums explicitly.

### Static pages
Some pages on the site are static. Specifically the about page (about.php) and the contact page (contact.php). Both pages are relatively straightforward, so should be easy to edit. The map on the about pages is a little tricky, but shouldn't need changing.

### Snippets
There are three common snippets. "doctype-html-head.html" does some technically important things and also loads the website's theme. "site-header.html" is exactly what is sounds like, it has the website's heading and two logo pictures. "nav-menu.html" has a list of links to the pages of the website.


### Others
index.php is the default page for the website. It simply copies the calendar page. The calendar page (calendar.php) is an embedding of the secretary's google calendar. To change that contact, use google calendars. template.php is a page you can copy if you want to make a new page. It has only the things to make it look like all the other pages. In particular, you'll need to set the page title and add content. 404.php is what shows when someone tries to go to a page that doesn't exist.

### Configuration tricks
The server is set up to assume that pages without a file extension should be given a .php extension. For example, going to yoursite.com/calendar shows the page yoursite.com/calendar.php . You can use this feature to make nicer looking urls.
