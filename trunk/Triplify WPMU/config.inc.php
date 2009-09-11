<?php
/* This file contains the configuration for triplify (and Wordpress Multi User 2.7+).
 * Triplify rapidly simplifies the creation of structured content for Web 2.0
 * mashups and Semantic Web applications.
 *
 * Triplyfy uses a number of SQL queries, whose results are converted into
 * either RDF/N3, JSON or Linked Data.
 *
 * @version $Id:$
 * @license LGPL
 * @copyright 2008 Sšren Auer (soeren.auer@gmail.com)
 * @copyright 2009 Andrei Mih&#259;il&#259; (andrei.mihaila@gmail.com) (modifications for Wordpress 2.7)
 * @copyright 2009 Alex Bilbie (alex@alexbilbie.com) (modifications for Wordpress MU)
 */


/* Triplify uses a PDO object to connect to the database.
 * The following line creates an appropriate PDO object for a MySQL database.
 * Please adjust the values for database name, user and password.
 * For maximum security, you can create a database user specificially for
 * Triplify, which has solely readable access to the columns of your database
 * schema, which should be made public. Alternatively, you can include the
 * configuration of your Web application and reuse its credentials here.
 */
 
// use credentials from the Wordpress config file
require "../wp-config.php";
$triplify['db']=new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD);


/*
 * WPMU's wp-config.php doesn't have a $table_prefix setting and as WPMU gives each
 * blog it's own set of tables we need to manually set this.
 */

// If blogs are on subdomains
if(VHOST == "yes"){
	$wpmu_host = $_SERVER['SERVER_NAME'];
} else {
// If blogs are on sub-directories
	die("This configuration script currently only supports WPMU blogs that are hosted on subdomains (as opposed to blogs in sub-directories)");
}

// Get the blog id from the host
$get_blog_id_sql = "SELECT `blog_id` FROM wp_blogs WHERE `domain` = '{$wpmu_host}'";
$wpmu_connect = mysql_connect(DB_HOST, DB_USER, DB_PASSWORD);
if($wpmu !== FALSE){
	$get_blog_id = mysql_query($get_blog_id_sql);
	if($get_blog_id !== FALSE){
		$result = mysql_fetch_assoc($get_blog_id);
		// Set the table prefix
		$table_prefix = "wp_".$result['blog_id']."_";
		mysql_close($wpmu_connect);
	} else {
		die("Mysql error when trying to get the blog ID:<br/><code>".mysql_error()."</code>");
	}
} else {
	die("Can't connect to MYSQL db to get the blog ID");
}



/* Triplify uses URIs to identify objects. In order to simplify their handling
 * you should define shortcuts (i.e. namespace prefixes) for all namespaces
 * from which you want to use URIs.
 * A 'vocabulary' entry entry is mandatory - it specifies, which default prefix
 * should be used for vocabulary elements such as classes and properties. Other
 * than the prefix for instances this prefix should be shared between different
 * installations of a certain Web application on the Web.
 */
 
$triplify['namespaces']=array(
	'vocabulary'=>'http://sdp.iasi.rdsnet.ro/semantic-wordpress/vocabulary/',
	'rdf'=>'http://www.w3.org/1999/02/22-rdf-syntax-ns#',
	'rdfs'=>'http://www.w3.org/2000/01/rdf-schema#',
	'owl'=>'http://www.w3.org/2002/07/owl#',
	'foaf'=>'http://xmlns.com/foaf/0.1/',
	'sioc'=>'http://rdfs.org/sioc/ns#',
	'sioctypes'=>'http://rdfs.org/sioc/types#',
	'dc'=>'http://purl.org/dc/elements/1.1/',
	'dcterms'=>'http://purl.org/dc/terms/',
	'skos'=>'http://www.w3.org/2004/02/skos/core#',
	'tag'=>'http://www.holygoat.co.uk/owl/redwood/0.1/tags/',
	'xsd'=>'http://www.w3.org/2001/XMLSchema#',
	'update'=>'http://triplify.org/vocabulary/update#',
);

/* The core of triplify are SQL queries, which select the information to be made
 * available.
 *
 * You can provide a number of arbitrary queries. Each query, however, should
 * select information about an object of a certain type. This type, which serves
 * as an index in the associative queries configuration array, is also used to
 * construct corresponding URIs for the objects returned by the query.
 *
 * The first column returned by the query represents the ID of the object and
 * has to be named "id", all other columns represent characteristics (or
 * properties of this object). As column identifier you should reuse existing
 * vocabularies whenever possible. If your "user" table, for example, contains a
 * column named "first_name" this can be easily mapped to the corresponding FOAF
 * property using: "SELECT id,first_name AS 'foaf:firstName' FROM user".
 *
 * You can use the following column naming convention in order to inform
 * Triplify about the datatype or language of a column:
 *SELECT id,price AS 'price^^xsd:decimal',desc AS 'rdf:label@en' FROM products
 * However, Triplify tries to autodetect and convert timestamps appropriately.
 *
 * Similarly, you can indicate that a column represents an objectProperty
 * pointing to other objects (foreign key):
 * SELECT id,user_id 'sioc:has_creator->user'
 *
 * Only select information, which does not contain sensitive information and
 * can be made public. For example, email adresses and password (hashes) should
 * never be exposed. However, you can use the database function SHA to
 * mask email addresses, e.g.:
 *SELECT SHA(CONCAT('mailto:',email)) AS 'foaf:mbox_sha1sum' FROM users
 *
 * The following queries are example queries and have to be replaced by queries
 * suitable for your database schema.
 */
 
$triplify['queries']=array(
	'post'=>array(
		/* posts and pages */
		"SELECT id, post_author 'sioc:has_creator', post_date 'dcterms:created', post_title 'dc:title', post_content 'sioc:content', post_modified 'dcterms:modified'
		FROM {$table_prefix}posts WHERE post_status='publish'",
		/* excerpts for posts/pages where they are set */
		"SELECT id, post_excerpt 'dcterms:abstract'
		FROM {$table_prefix}posts WHERE post_status='publish' AND LENGTH(post_excerpt) > 0",
		/* number of comments for posts */
		"SELECT id, comment_count 'sioc:num_replies'
		FROM {$table_prefix}posts WHERE post_status='publish' AND comment_count > 0",
		/* attachments */
		"SELECT p2.id id, p1.id 'sioc:has_attachment'
		FROM {$table_prefix}posts p1
		INNER JOIN {$table_prefix}posts p2 ON p1.post_parent = p2.id
		INNER JOIN {$table_prefix}postmeta m on p1.id = m.post_id AND m.meta_key = '_wp_attached_file'
		WHERE p1.post_type = 'attachment' AND (p1.post_status = 'publish' OR (p1.post_status = 'inherit' AND p2.post_status = 'publish'))",
		/* tags for all tagged posts/pages */
		"SELECT {$table_prefix}posts.ID AS id, {$table_prefix}terms.term_id AS 'tag:taggedWithTag'
		FROM {$table_prefix}posts LEFT JOIN {$table_prefix}term_relationships ON {$table_prefix}term_relationships.object_id = {$table_prefix}posts.ID
		LEFT JOIN {$table_prefix}term_taxonomy ON {$table_prefix}term_taxonomy.term_taxonomy_id = {$table_prefix}term_relationships.term_taxonomy_id
		LEFT JOIN {$table_prefix}terms ON {$table_prefix}terms.term_id = {$table_prefix}term_taxonomy.term_id
		WHERE {$table_prefix}posts.post_status = 'publish' and {$table_prefix}term_taxonomy.taxonomy = 'post_tag'",
		/* categories for all categorized posts/pages */
		"SELECT {$table_prefix}posts.ID AS id, {$table_prefix}terms.term_id AS 'belongsToCategory'
		FROM {$table_prefix}posts LEFT JOIN {$table_prefix}term_relationships ON {$table_prefix}term_relationships.object_id = {$table_prefix}posts.ID
		LEFT JOIN {$table_prefix}term_taxonomy ON {$table_prefix}term_taxonomy.term_taxonomy_id = {$table_prefix}term_relationships.term_taxonomy_id
		LEFT JOIN {$table_prefix}terms ON {$table_prefix}terms.term_id = {$table_prefix}term_taxonomy.term_id
		WHERE {$table_prefix}posts.post_status = 'publish' and {$table_prefix}term_taxonomy.taxonomy = 'category'"
	),
	'attachment'=>array(
		"SELECT p1.id id, p1.post_author 'sioc:has_creator', p1.post_date 'dcterms:created', p1.post_title 'dc:title', p1.post_modified 'dcterms:modified', p1.post_content 'dcterms:description', concat((SELECT option_value from {$table_prefix}options WHERE option_name = 'siteurl'), '/wp-content/uploads/', m.meta_value) 'dcterms:URI', p1.post_mime_type 'dcterms:format'
		FROM {$table_prefix}posts p1
		INNER JOIN {$table_prefix}posts p2 ON p1.post_parent = p2.id
		INNER JOIN {$table_prefix}postmeta m on p1.id = m.post_id AND m.meta_key = '_wp_attached_file'
		WHERE p1.post_type = 'attachment' AND (p1.post_status = 'publish' OR (p1.post_status = 'inherit' AND p2.post_status = 'publish'))"
	),
	'tag'=>array(
		/* all terms that play a role of tag */
		"SELECT DISTINCT {$table_prefix}terms.term_id AS id, {$table_prefix}terms.name AS 'tag:tagName'
		 FROM {$table_prefix}terms
		 LEFT JOIN {$table_prefix}term_taxonomy ON {$table_prefix}terms.term_id = {$table_prefix}term_taxonomy.term_id
		 LEFT JOIN {$table_prefix}term_relationships ON {$table_prefix}term_taxonomy.term_taxonomy_id = {$table_prefix}term_relationships.term_taxonomy_id
		 WHERE {$table_prefix}term_taxonomy.taxonomy = 'post_tag'"
	),
	'category'=>array(
		/* all terms that play a role of category */
		"SELECT DISTINCT {$table_prefix}terms.term_id AS id, {$table_prefix}terms.name AS 'skos:prefLabel', {$table_prefix}term_taxonomy.parent AS 'skos:narrower'
		 FROM {$table_prefix}terms
		 LEFT JOIN {$table_prefix}term_taxonomy ON {$table_prefix}terms.term_id = {$table_prefix}term_taxonomy.term_id
		 LEFT JOIN {$table_prefix}term_relationships ON {$table_prefix}term_taxonomy.term_taxonomy_id = {$table_prefix}term_relationships.term_taxonomy_id
		 WHERE {$table_prefix}term_taxonomy.taxonomy = 'category'"
	),
	'user'=>array(
		/* all users */
		"SELECT id, user_login 'foaf:accountName', SHA1(CONCAT('mailto:', user_email)) 'foaf:mbox_sha1sum', user_url 'foaf:homepage', display_name 'foaf:name'
		 FROM wp_users",
		/* users metadata */
		"SELECT user_id AS id, meta_value 'foaf:firstName' FROM wp_usermeta WHERE meta_key='first_name'",
		"SELECT user_id AS id, meta_value 'foaf:family_name' FROM wp_usermeta WHERE meta_key='last_name'",
		"SELECT user_id AS id, meta_value 'foaf:nick' FROM wp_usermeta WHERE meta_key='nickname'"
	),
	'comment'=>array(
		/* all comments */
		"SELECT comment_ID id, comment_post_id 'sioc:reply_of', comment_author AS 'foaf:name',
		SHA1(CONCAT('mailto:',comment_author_email)) 'foaf:mbox_sha1sum',
		comment_author_url 'foaf:homepage', comment_date AS'dcterms:created',
		comment_content 'sioc:content', comment_karma, comment_type
		FROM {$table_prefix}comments WHERE comment_approved='1'"
	)
);


/* custom fields with keys in the array below will be added to the triples
 there is a speed tradeoff, but some of these might turn out to be useful */
$customFields = array('dcterms:references', 'bibliographicCitation');
foreach ($customFields as $field) {
	$triplify['queries']['post'][] = 
	"SELECT {$table_prefix}posts.id, {$table_prefix}postmeta.meta_value as '{$field}'
	FROM {$table_prefix}posts
	INNER JOIN {$table_prefix}postmeta on {$table_prefix}posts.id = {$table_prefix}postmeta.post_id
	WHERE {$table_prefix}postmeta.meta_key = '{$field}'";
}


/* Some of the columns of the Triplify queries will contain references to other
 * objects rather than literal values. The following configuration array
 * specifies, which columns are references to objects of which type.
 */
$triplify['objectProperties']=array(
	'sioc:has_creator'=>'user',
	'sioc:has_attachment'=>'attachment',
	'tag:taggedWithTag'=>'tag',
	'belongsToCategory'=>'category',
	'skos:narrower'=>'category',
	'sioc:reply_of'=>'post'
);


/* Objects are classified according to their type. However, you can specify
 * a mapping here, if objects of a certain type should be associated with a
 * different class (e.g. classify all users as 'foaf:person'). If you are
 * unsure it is safe to leave this configuration array empty.
 */
$triplify['classMap']=array(
	'user'=>'foaf:Person',
	'post'=>'sioc:Post',
	'attachment'=>'sioc:Item',
	'tag'=>'tag:Tag',
	'category'=>'skos:Concept'
);


/* You can attach license information to your content.
 * A popular license is Creative Commons Attribution, which allows sharing and
 * remixing under the condition of attributing the original author.
 */
$triplify['license']='http://creativecommons.org/licenses/by/3.0/us/';


/* Additional metadata
 * You can add arbitrary metadata. The keys of the following array are
 * properties, the values will be represented as respective property values.
 */
$triplify['metadata']=array(
	'dc:title'=>'',
	'dc:publisher'=>''
);


/* Set this to true in order to register your linked data endpoint with the
 * Triplify registry (http://triplify.org/Registry).
 * Registering is absolutely recommended, since that allows other Web sites
 * (e.g. peer Web applications, search engines and mashups) to easily find your
 * content. Requires PHP ini variable allow_url_fopen set to true.
 * You can also register your data source manually by accessing register.php in
 * the triplify folder, or at: http://triplify.org/Registry
 */
$triplify['register']=true;


/* You can specify for how long generated files should be cached. For smaller
 * Web applications it is save to disable caching by setting this value to zero.
 */
$triplify['TTL']=0;


/* Directory to be used for caching
 */
$triplify['cachedir']='cache/';


/* Linked Data Depth
 *
 * Specify on which URI level to expose the data - possible values are:
 *- Use 0 or ommit to expose all available content on the highest level
 *all content will be exposed when /triplify/ is accessed on your server
 *this configuration is recommended for small to medium websites.
 *- Use 1 to publish only links to the classes on the highest level and all
 *content will be exposed when for example /triplify/user/ is accessed.
 *- Use 2 to publish only links on highest and classes level and all
 *content will be exposed on the instance level, e.g. when /triplify/user/1/
 *is accessed.
 */
$triplify['LinkedDataDepth']='0';


/* Callback Functions
 *
 * Some of the columns of the Triplify queries will contain data, which has to
 * be processed before exposed as RDF (literals). This configuration array maps
 * column names to respective functions, which have to take the data value as a
 * parameter and return it processed.
 */
$triplify['CallbackFunctions']=array(
);
?>