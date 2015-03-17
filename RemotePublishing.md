# Introduction #

This page documents our testing of desktop blog publishing software that use the XML-RPC and/or AtomPub specifications. Our objective is to ensure compatibility with JISCPress so that as little re-formatting is required to re-publish a document originally authored in popular word processing software. The most popular remote publishing client software has been chosen for Windows, OS X and Linux desktops.

Site used: http://remotepub.jiscpress.org/

# Methodology #

For the testing of each client, the the entire text was selected ('select all'), copied and pasted into the client software and published as a single post to examine how JISCPress (using the Digress plugin and default theme) would format the document without any intervention.  We aim to achieve a presentation which is consistent with the original source document and clearly divides paragraphs and other elements into logical 'atomised' parts which can be commented on.

# Software #

## OS X ##
### Mars Edit ###

[Test 1](http://remotepub.jiscpress.org/2009/07/14/marsedit/). This is a single copy and paste of the entire document. Mars Edit does not appear to preserve Microsoft Word rich text formatting.

### MS Word 2008 (OS X) ###

[Test 2](http://remotepub.jiscpress.org/2009/07/14/ms-word-2008-os-x-to-wordpress-tinymce/). This is a single copy and paste of the entire document. The rich text formatting was preserved. However, the default Digress theme (at time of testing), did not preserve tables, when compared to the Kubrick, default WordPress theme.

## Windows XP ##

### MS Word 2007 ###

[Support](http://office.microsoft.com/en-us/word/HA101640211033.aspx) for using Word 2007 to blog to WordPress.

[Test 3](http://remotepub.jiscpress.org/2009/07/14/ms-word-2007-to-wordpress-tinymce/). This is a single copy and paste of the entire document. The rich text formatting was preserved. However, the default Digress theme (at time of testing), did not preserve tables, when compared to the Kubrick, default WordPress theme.

### MS Live Writer ###

[Test 4](http://remotepub.jiscpress.org/2009/08/07/jisc-strategy-ms-live-writer-with-tables-copy-and-paste-from-word-2007/). This is a single copy and paste from Word 2007 on XP, to MS Live Writer.  It is largely successful in preserving the original formatting and compatible with the DigressIt plugin and theme. At the time of testing, DigressIt does not recognise tables, but that is being added to the next version (so may be fixed if you are reading this at a later date!). The section sub-headings were not preserved in the copy and paste into Live Writer. I manually changed them to **Heading 5** in Live Writer, but this results in headings which are too small in DigressIt. Perhaps **Heading 3** would work better.