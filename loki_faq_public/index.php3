<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

printHead("Product Index");

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
	print("</LI>\n");
}

print("</UL>");

printTail()
	
?>
