<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

printHead("Category Index");

print("
<H1>Categories that're publicly avaliable in the current database:</H1>
<UL>
");

$query = getProducts();

while($product_list = @mysql_fetch_array($query))
{
	$product = $product_list["product"];
	$description = $product_list["description"];
	print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
}

print("</UL>");

printTail()
	
?>
