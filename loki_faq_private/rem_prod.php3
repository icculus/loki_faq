<?
include("lib.php3");

if(empty($product))
{
	print("You have not selected a product to administer. Please go back and do so.");
	exit();
}
else
{

	$REMOVE_PRODUCT = "DELETE FROM products WHERE product = '$product'";
	$REMOVE_TABLE = "DROP TABLE $product";

	do_sql($REMOVE_PRODUCT);
	do_sql($REMOVE_TABLE);

	print("You have successfully removed <U><I>$product</U></I> from the FAQ database.
	<BR><BR>

	You are now either a hero, or truly screwed. Good Luck!
	<BR><BR>
	<BR><BR>

	<A HREF=\"index.php3\">FAQ Index</A>");
}

?>
