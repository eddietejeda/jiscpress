## Introduction ##

The JISCPress platform is a Content Management System for publishing complete documents online in an open and flexible format. Notably, the documents can be annotated, commented on and discussed in considerable detail. Readers can comment on every paragraph and every section of the document as well as reply to earlier comments and develop threaded discussions around a single paragraph of text. As a complete platform, the full text of all documents can be searched and documents can be organised in a way for easy browsing and discovery. In essence, documents published on JISCPress become highly flexible, social objects, native to the web.

## Use Case One: Publishers ##

JISCPress was developed as a prototype for the [Joint Information Systems Committee (JISC)](http://www.jisc.ac.uk/). It is based on our work on [WriteToReply](http://writetoreply.org) and intended as a platform for JISC to publish funding calls and for funded projects to publish their final reports.

Currently, a [typical funding call](http://www.jisc.ac.uk/fundingopportunities/funding_calls/2009/09/0909greenict.aspx) is published as a web page containing an overview of the call and a link to a PDF or Word document containing the full details of the call.

Similarly, when a funded project is completed, the project outputs, including a final report are [published on the JISC website](http://www.jisc.org.uk/whatwedo/programmes/resourcediscovery/googlegen.aspx) with a one page overview and a list of Word or PDF documents for download.

It is also worth noting that for many of JISC's funding calls, a 'Town Meeting' is arranged where people interested in submitting a funding bid can attend a briefing and ask questions related to the programme and funding call. As a networking event, partnerships between institutions may also be formed.

JISCPress can complement each of these areas of a JISC Programme's work.

By publishing the funding call as a document on JISCPress, a managed, structured, navigable XHTML version of the call is published. The full text of the document is searchable and each section and each paragraph of the document can be commented on. For some calls, it may be sufficient for the document itself to become the focus of an asynchronous 'Town Meeting', where interested bidders can ask questions directed at specific parts of the funding call document. JISC Programme Managers can reply to the questions and avoid repetition by replying in public.  The document might also act as a 'hub' for interested people to discuss a bid and possibly partner on a project proposal.

An example of how this worked for the JISCRI funding call can be seen on [WriteToReply](http://writetoreply.org/jiscri/). Note that the document can also contain supporting materials such as a [presentation](http://writetoreply.org/jiscri/2009/03/31/why-rapid-innovation/) or [podcast](http://writetoreply.org/jiscri/2009/03/31/podcast-from-programme-managers/).

### How would it actually work for JISC staff? ###

We see JISCPress complementing and improving the way in which funding calls are currently issued. It is not a replacement for the current method of issuing a call.

Each document has its own unique web address, as does each section and each paragraph. In addition, each paragraph can be easily cited on JISC's existing web pages, by simply copying and pasting the available 'embed code'. We imagine that JISC would highlight the document on the funding call page so that readers are encouraged to go to the site for full details of the call. The existing Word or PDF versions of the call could continue to be hosted on the jisc.ac.uk website (presumably using the existing CMS) or could be hosted on the JISCPress platform alongside the full-text document.

Clearly this is additional work for JISC staff, but we believe the benefits are worth it and the process of publishing a document on JISCPress can be made quite straightforward.

#### Role Management ####

JISCPress (or rather WordPress Multi-User) has the following use roles:

  * Platform Administrator
  * Site Administrator
  * Editor
  * Author
  * Contributor
  * Subscriber

The Platform Administrator controls the entire installation of JISCPress. They do not require any specific technical skills but should be prepared to liaise with the server administrator when performing upgrades to JISCPress. The Platform Administrator can delete document sites, add plugins and control any JISCPress document site. The Platform Administrator also controls the users on the platform and can determine whether new users can sign up to JISCPress and whether they can create document sites. We recommend that the Platform Administrator restricts automated user accounts to LDAP users. This would mean that any member of JISC staff could login to JISCPress using their existing staff username and password and create a document site if they wish. For authors of project final reports, we recommend that a user account is created by the Platform Administrator for each Project Manager who is expected to submit their report. Once the Project Manager has an account, they can create a document site and author their report independently. Ideally, authoring their document in this way would be a requirement of funding.

The Site Administrator controls a document site. Once logged in to JISCPress, they can choose to create a new document site (or not). The creation of a document site is partially automated for the Site Administrator. They will be asked to provide a suitable domain name and enter the title of their document. Following this, the framework of the site is created and will present the user with a WordPress site with a pre-determined category tree, theme, privacy settings, discussion settings, and so on. All that is required is for the Administrator to author the document, select the appropriate categories, provide keywords/tags and, if they wish, add co-authors to their document site. Like the Site Administrator account, these are local accounts, not connected to LDAP.

We recommend that Site Administrators add any further users as Editors of the document. This will allow those individuals to both author text and edit other user's text, including the Site Administrator's text. Editors can publish content but are not able to manage the document site.

The Author role is even further restricted, only allowing a user to author and publish text. They are not able to edit other user's text.

The Contributor role is further restricted and only allows the user to author text. They are not able to edit other user's text or publish any text. Within the controlled environment of JISCPress, this may be unnecessarily restrictive.

The Subscriber role is simply a way for users to register on a document site. If Site Administrators wish to restrict comments to registered users, they can do so by registering (or being registered) as subscribers.

#### Workflow 1 ####

  1. JISC staff member logs in
  1. Clicks on Menu --> My Documents --> Create a Document
  1. Enters sub-domain name, Document title and preferred privacy settings. (Title and privacy can be changed at any time; domain name cannot).
  1. Navigates via Menu to new document 'Dashboard'
  1. Navigates to Post --> Add New
  1. Authors first section of the new document
  1. Selects categories, adds tags, clicks Publish.
  1. Repeats 5 - 7 until all document sections are published.

#### Workflow 2 ####

  1. JISC staff member logs in
  1. Clicks on Menu --> My Documents --> Create a Document
  1. Enters sub-domain name, Document title and preferred privacy settings. (Title and privacy can be changed at any time; domain name cannot).
  1. Adds document site address to Word 2007, Open Office or preferred blogging client.
  1. Authors first section of the new document
  1. Selects categories, adds tags, clicks Publish.
  1. Repeats 5 - 6 until all document sections are published.

It may help here to refer to the PublishingGuidance.

It may be that JISC would prefer a greater amount of administrative control over the creation of document sites and publishing of documents. In that case, the Platform Administrator (there can be more than one person in this role), would create the document site and add users (JISC staff or funded Project Managers) to a document site with the role of Editor, Author or Contributor. Full editorial control by JISC over each document site would require document authors to be given a Contributor role.

## Use Case Two: Readers ##

The role of 'Readers' covers more than one type of JISCPress user who are distinguished from the 'Publisher' user in that they are not document authors.

### Role: Reader ###

A Reader of JISCPress may simply wish to learn more about a funding call or a funded project output. They may be directed to a JISCPress document via a referring link from jisc.ac.uk or from a search engine.  Because the full-text of the document is available and has a URI for each paragraph and each document section, they may be referred to a specific paragraph or document section. Additionally, a JISCPress document is also available as a news feed for reading in a news reader.

Futhermore, JISCPress 'advertises' related existing documents on the platform to the reader of a document in the sidebar. Based on semantic, contextual tagging and term extraction, documents are linked and ranked by relevancy to the document section that is currently being read.

### Role: Commenter ###

The Reader may wish to make a comment, respond to an existing comment or ask a question about the JISCPress document. As they read the document, they are able to direct a comment at any specific paragraph or on the document section as a whole. Depending on the site settings, they may have to enter their name and email address. If they respond to an existing comment, they can click 'reply' and enter a threaded discussion. Similarly, if reading the document from a news reader, direct links are provided to the paragraphs of the source document to facilitate commenting.

### Role: Blogger ###

Similarly, the ability to link to a single paragraph is useful when referencing a JISCPress document from another website. An example of this can be seen on [Prof. Martin Weller's blog](http://nogoodreason.typepad.co.uk/no_good_reason/2009/10/the-ref-a-digital-scholarship-perspective.html) where he discusses the recent [HEFCE REF Consultation](http://writetoreply.org/refconsultation). He has used the paragraph-level URIs to refer his reader to the specific point in the text that he is discussing. He may also have used the embed code that is available for each JISCPress document, to copy and paste the paragraph he is quoting. If the Blogger's software allows, each link to the JISCPress document, can also leave a 'trackback' notification on the JISCPress document, which might be likened to a 'remote comment' on the URI which has been linked to.

### Role: Mashup Artist ###

The JISCPress platform includes a number of features which may interest Mashup Artists. These are documented in detail elsewhere, but a simple overview of their uses is given here.

Each paragraph is available via a URI as JSON, XML, RSS, HTML and TXT. The separation of paragraph data in this way provides the Mashup Artist with an atomised data source for further re-presentation and analysis of the document.

Each document is available as Linked Data (RDF/N3) either directly from the JISCPress document site or from the Talis Commons Platform API.

Comments for a) each paragraph, b) each document section, c) each document and d) each Commenter, are available as RSS.

GeoRSS co-ordinates can be included in the feed for each document. This could be used to map funded project reports by their location.

Each document is semantically tagged using OpenCalais. The tags are included as metadata in the HTML source code and could be scraped.

RSS feeds are available for a) each document, b) document section, c) document category, d) document tag, e)multiple tags and category combinations

### Role: Author/Reader ###

In addition to the Publisher use case described above, document authors may also approach JISCPress documents as a Reader. Document authors may reference existing document on the JISCPress platform in their own Project Reports thereby linking documents across the platform at the paragraph level. Likewise, the cite or embed code could also be used to reference existing documents.

Document authors may also wish to monitor the comments RSS feed or subscribe to comments on the document by email to measure feedback on their work and respond to any questions or comments. They can easily observe who (i.e. within their peer group) is commenting by looking at the 'Commenter' overview page.