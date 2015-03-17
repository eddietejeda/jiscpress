# Publishing a JISCPress document #

## Introduction ##

JISCPress is a WordPress-based platform so many of the same methods and conventions for writing a WordPress blog post apply to JISCPress. The significant difference is that JISCPress documents occupy an entire 'blog' or WordPress site. This allows you to divide your document into sections and each section is a WordPress blog post.  It can get confusing discussing blog posts and document sections, so from hereon, note the following:

WordPress blog site = A single JISCPress document

WordPress blog post = A single JISCPress document section

You can publish large (100 + section) documents or small (1 section) documents on JISCPress. It helps if your sections are relatively short. We are, afterall, publishing on the web, and long sections will take longer for the reader to download in their browser. There is nothing to stop you publishing sub-sections separately.

## How JISCPress works ##

JISCPress uses [digress.it](http://digress.it) to transform your site into a self-contained document with a Table of Contents. The reader can easily navigate backwards and forwards from one section to another using the links at the top and bottom of each document section.

digress.it automatically discovers the paragraphs in each document section and assigns them a unique link (URI) so that people can comment, annotate or discuss specific paragraphs of text.

Other parts of your document structure are also auto-discovered by digress.it. If you have images, tables, quotes, headings or lists in your document, digress.it will find them and assign a unique link for those, too. Our tests have shown digress.it to be very accurate in reading your document section structure and (ideally) you should not have to make any adjustments. If you repeatedly find a problem, please let us know.

digress.it has options to allow you to order your sections in a number of ways. However, the simplest option is to author your document sections in chronological order, starting with the title page or introduction and finishing with the conclusion of the document.  Normally, WordPress would publish blog posts, with the most recent, first. digress.it merely reverses the order and displays the sections in the order that you authored them (unless you have configured it otherwise).

As with any Wordpress site, you can significantly alter the presentation of a site by developing your own WordPress theme or making adjustments to the stylesheet of an existing theme. digress.it allows you to select different stylesheets. Currently we offer two: 'default' and 'classic'.

## Ways to author a document for JISCPress ##

We appreciate that many documents are written using a Word Processor and have tried to ensure that documents written in this way can be easily published on JISCPress. However, if you do not need to author your document in a Word Processor, there are advantages to authoring directly in the WordPress online editor:

  * Multiple authors can easily collaborate on a single document
  * A complete revision history of the document is maintained with the ability to roll-back to earlier versions.
  * Produces a web-ready document, native to JISCPress. There is no two-stage process of 're-publishing' on JISCPress. You just write and publish.
  * You can embed video and other objects, using the full power and versatility of WordPress.


Document that are written in Word Processors can be posted to JISCPress using built in blogging features in Word 2007 and Open Office. This uses a method called XML-RPC and 'posts' content from your desktop software to WordPress/JISCPress.

You can also use dedicated [desktop blogging software](http://codex.wordpress.org/Weblog_Client). We have seen very good results with JISCPress, simply copying from your Word document, into a desktop client and posting to WordPress.

Alternatively, you can select text from your original document, copy it and paste it into the WordPress editor. The original formatting is usually maintained.

In summary, you can author and publish in the following ways, to suit your workflow:

  1. Author directly in the WordPress editor
  1. Author directly in a desktop blogging client i.e. Windows Live Writer
  1. Author in Microsoft Word or Open Office and post to JISCPress
  1. Author in Word or Open Office and copy and paste into a desktop blogging client
  1. Author in Word or Open Office and copy and paste into the WordPress editor

The Wordpress editor has an icon with the Microsoft Word icon on it. If you use that, to paste your text into the WordPress editor, your original formatting should be faithfully retained. You can also edit your original document once it's on JISCPress, adding multimedia, gadgets and widgets. If it is supported by WordPress, it is supported by JISCPress.

Recent versions of both Word (2007+) and WordPress (2.8+) have improved compatibility. You should be able to simply copy from Word directly into the WordPress editor, without using the Microsoft Word icon.

Whichever way you choose to author and publish your document, digress.it should discover standard formatting conventions and publish them accurately.  If you have created a highly stylised document in your Word Processor with unconventional layout, this will be lost, as will the original typography.  You can control the typography through adjustments to the digress.it stylesheet (if you are able to upload new stylesheets to the server).

## Publishing your document ##

Once you have your document sections finished and saved as drafts, preview them to ensure that digress.it renders your content faithfully.  Proof read your document carefully as it is much better to make minor changes prior to publishing than after publishing.  it is important that once you publish each document section, you do not alter the paragraph structure of the section. This is because people will comment on specific paragraphs that are identified by unique links (URIs). If you add or remove a paragraph after someone has commented on a section, their comment will point to the wrong paragraph.

We are looking for a solution to allow comments to 'follow' paragraphs if they location, but this has not yet been implemented. Nevertheless, it is good practice to take your time preparing your document and once it is published, do not add or remove a paragraph from a section that has one or more comments.  If a document section has received no comments, it is safe to make changes.

When you have previewed and proof-read your document, you can batch publish each section at once using the WordPress 'Bulk Actions' feature under 'Posts - Edit'.