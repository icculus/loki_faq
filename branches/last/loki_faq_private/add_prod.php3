<?
include("lib.php3");

if(empty($product) || empty($description) || empty($introduction) || empty($version) || empty($timestamp) || empty($category))
{
	print("You haven't filled in all of the fields. They are all required. Go back and do so.");
	exit();
}
else
{

	if(!($private == "0" || $private == "1")){echo "setting to private automatically"; $private = "1";}

	$INSERT_QUERY = "INSERT INTO products";
	$INSERT_QUERY .= "(product, description, introduction, version, timestamp, category, private) ";
	$INSERT_QUERY .= "VALUES('$product', '$description', '$introduction', '$version', '$timestamp', '$category', '$private')";

	do_sql($INSERT_QUERY);

	$TABLE_QUERY = "CREATE TABLE $product";
	$TABLE_QUERY .= "(product tinytext NOT NULL, ";
	$TABLE_QUERY .= "faq_id int(4) DEFAULT 0 NOT NULL, ";
	$TABLE_QUERY .= "faq_cat tinytext NOT NULL, ";
	$TABLE_QUERY .= "faq_title text NOT NULL, ";
	$TABLE_QUERY .= "faq_answer blob NOT NULL, ";
	$TABLE_QUERY .= "faq_notes int(4))";

	do_sql($TABLE_QUERY);


	print("You have successfully added a product to the FAQ database. Good for you!
	<BR><BR>

	Product Reference Name: $product
	<BR><BR>

	Product Description: $description
	<BR><BR>

	Product FAQ Introduction:<BR>
	$introduction
	<BR><BR>

	Product Version: $version
	<BR><BR>

	Product Category: $category
	<BR><BR>

	Product visibility setting (0 => visible, 1 => invisible): $private
	<BR><BR>

	Timestamp: $timestamp
	<BR><BR>
	<BR><BR>

	*You may now go ahead and add FAQs to the FAQ database for: $description
	<BR><BR>
	<BR><BR>
	
	<A HREF=\"index.php3\">FAQ Index</A>");
}

?>
