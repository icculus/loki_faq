<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

printHead("Product Index");

function productModify($product)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./maintain.php3?command=mod_prod&product=$product\">Modify</A>
	<!-- | <A HREF=\"./maintain.php3?command=add_prod&product=$product\">Add</A>-->
	| <A HREF=\"./maintain.php3?command=rem_prod&product=$product\">Remove</A>
	]
		</FONT>");
}


print("
<H1>Products that're publicly avaliable in the current database:</H1>
<UL>
");

$query = getProducts();

while($product_list = @mysql_fetch_array($query))
{
	$product = insertMarkup(removeMarkup($product_list["product"]));
	$description = insertMarkup(removeMarkup($product_list["description"]));
	print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a>");
	productModify($product_list["product"]);
	print("</LI>\n");
}

print("<LI><A HREF=\"maintain.php3?command=add_prod\">Add a Product</A></LI>\n");

print("</UL>");

printTail()
	
?>
