repo1
=====
QUICKSITES
----------
Demo: http://warm-springs-2431.herokuapp.com/

A small PHP script, that aids one in building an almost static yet fairly dynamic website, when the requirements are lower than WordPress but higher than a bundle of html documents. 
The common elements, i.e. Branding, Nav, footer e.t.c. are loaded once while the individual page content is dynamically loaded from separate files stored in the 'pages' folder.

A certain page is accessible at example.com/?page=pageName. Which is the kind of URIs to be used in Links to other pages. So a page named about would be at example.com/?page=about. Also, the name at the end of this query and the name of the document containing the page's content have to be identical. 

The themes folder, yep you guessed it! That's where the themes are. The Applied theme is what the first variable in the theming script is set equal to. The string should == the theme's directory's name. Currently, it is set to "default", /themes/default being the directory. All themes should contain 2 files, them being markup.html and attributes.php. The former fetches all the links to stylesheets and all that 'head' content, the metadata e.t.c. The attributes file on the other hand contains this dictionary. If for example in one theme the head tag contains the attribute contenteditable (not that anyone does this) while in another it doesn't, then the attribute would be stored in the dictionary in the attributes file of the first theme but not the second, under a certain key, that could be the tag's name. To fetch attributes for a certain element, the a function has to be called for that certain element in place of the attributes, which would look for any attributes under the specified key in whichever the default theme is.
