<?
include("lib.php3");

if(empty($product) || empty($faq_cat) || empty($faq_id))
{
	print("You have not selected a product to administer or you're missing an ID. Please go back and fix it.");
	exit();
}
else
{

	$REMOVE_FAQ = "DELETE FROM $product WHERE product = '$product' AND faq_cat = '$faq_cat' AND faq_id = '$faq_id'";

	do_sql($REMOVE_FAQ);

	print("You have successfully removed FAQ: <U><I>$product: $faq_cat. Faq#: $faq_id</U></I> from the FAQ database.
	<BR><BR>

	You are now either a hero, or truly screwed. Good Luck!
	<BR><BR>
	<BR><BR>

	<A HREF=\"index.php3\">FAQ Index</A>");
}

?>
