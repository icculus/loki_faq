<?
include("lib.php3");

if(empty($product) || empty($faq_cat))
{
	print("You have not selected a product to administer or you're missing a category. Please go back and fix it.");
	exit();
}
else
{

	$REMOVE_FAQ = "DELETE FROM $product WHERE product = '$product' AND faq_cat = '$faq_cat'";

	do_sql($REMOVE_FAQ);

	print("You have successfully removed the following category and its FAQs: 
	<U><I>$product: $faq_cat</U></I> from the FAQ database.
	<BR><BR>

	You are now either a hero, or truly screwed. Good Luck!
	<BR><BR>
	<BR><BR>

	<A HREF=\"index.php3\">FAQ Index</A>");
}

?>
