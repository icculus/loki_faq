<?
include("lib.php3");

if(empty($product) || empty($description) || empty($introduction) || empty($version) || empty($timestamp)
)
{
        print("You haven't filled in all of the fields. They are all required. Go back and do so.");
        exit();
}
else
{

	$UPDATE_PROD0 = "UPDATE products SET product = '$product' WHERE product = '$product'";
	do_sql($UPDATE_PROD0);

	$UPDATE_PROD1 = "UPDATE products SET description = '$description' WHERE product = '$product'";
	do_sql($UPDATE_PROD1);

	$UPDATE_PROD2 = "UPDATE products SET introduction = '$introduction' WHERE product = '$product'";
	do_sql($UPDATE_PROD2);

	$UPDATE_PROD3 = "UPDATE products SET version = '$version' WHERE product = '$product'";
	do_sql($UPDATE_PROD3);

	$UPDATE_PROD4 = "UPDATE products SET timestamp = '$timestamp' WHERE product = '$product'";
	do_sql($UPDATE_PROD4);

	$UPDATE_PROD5 = "UPDATE products SET category = '$category' WHERE product = '$product'";
	do_sql($UPDATE_PROD5);

	$UPDATE_PROD6 = "UPDATE products SET private = '$private' WHERE product = '$product'";
	do_sql($UPDATE_PROD6);


	print("You have successfully updated a product to the FAQ database. Good for you!
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

        Timestamp: $timestamp
        <BR><BR>

	Category: $category
        <BR><BR>

	Visibility Setting: $private
	<BR><BR>
	<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
        <BR>
        <A HREF=\"index.php3\">FAQ Index</A>");
}

?>
