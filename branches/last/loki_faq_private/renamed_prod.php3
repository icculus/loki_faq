<?
include("lib.php3");

if( empty($product) || empty($product_newname) )
{
        print("You haven't filled in all of the fields. They are all required. Go back and do so.");
        exit();
}
else
{

	$UPDATE_PROD0 = "UPDATE products SET product = '$product_newname' WHERE product = '$product'";
	do_sql($UPDATE_PROD0);

	$UPDATE_PROD1 = "UPDATE $product SET product = '$product_newname' WHERE product = '$product'";
	do_sql($UPDATE_PROD1);

	$UPDATE_PROD2 = "ALTER TABLE $product RENAME $product_newname";
	do_sql($UPDATE_PROD2);


	print("You have successfully modified a product reference name in the FAQ database. Good for you!
        <BR><BR>

        New Product Reference Name: <B>$product_newname</B>
        <BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product_newname\">$product_newname Index</A>
        <BR>
        <A HREF=\"index.php3\">FAQ Index</A>");
}

?>
