<?
include("lib.php3");

if(empty($product) || empty($old_faq_cat) || empty($new_faq_cat))
{
        print("You haven't filled in all of the fields. They are all required. Go back and do so.");
        exit();
}
else
{
	$UPDATE_CAT0 = "UPDATE $product SET faq_cat = '$new_faq_cat' WHERE faq_cat = '$old_faq_cat'";
	do_sql($UPDATE_CAT0);

	print("You have successfully updated a product category to the FAQ database. Good for you!
        <BR><BR>

        Old Product Category Name: $old_faq_cat
        <BR><BR>

	New Product Category Name: $new_faq_cat
	<BR><BR>

	<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
        <BR>
        <A HREF=\"index.php3\">FAQ Index</A>");
}

?>
