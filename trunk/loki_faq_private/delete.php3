<?php
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

function faqUndeleteRemove($faq_id)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./delete.php3?action=delete_faq&really=yes&faq_id=$faq_id\">Really Delete</A>
	| <A HREF=\"./delete.php3?action=undelete_faq&really=yes&faq_id=$faq_id\">UnDelete</A>
	]</FONT>");
}

function catUndeleteRemove($cat_id)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./delete.php3?action=delete_cat&really=yes&cat_id=$cat_id\">Really Delete</A>
	| <A HREF=\"./delete.php3?action=undelete_cat&really=yes&cat_id=$cat_id\">UnDelete</A>
	]</FONT>");
}

function productUndeleteRemove($prod_id)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./delete.php3?action=delete_prod&really=yes&product_id=$prod_id\">Really Delete</A>
	| <A HREF=\"./delete.php3?action=undelete_prod&really=yes&product_id=$prod_id\">UnDelete</A>
	]</FONT>");
}

if ($really==yes) {
switch($action) {
  case delete_prod;
	reallyRemProd($product_id);
  break;

  case undelete_prod;
	undeleteProd($product_id);
  break;

  case delete_cat;
	reallyRemCat($cat_id);
  break;

  case undelete_cat;
	undeleteCat($cat_id);
  break;

  case delete_faq;
	reallyRemFaq($faq_id);
  break;

  case undelete_faq;
	undeleteFaq($faq_id);
  break;
}
}

printHead("Delete Screen");

print("<H1>Here you can undelete stuff</H1>\n");
print("<H2>This page has NO sanity checking.</H2>\n");
print("<P>By design, if you hit a button here, <B>THAT ACTION HAPPENS</B></P>\n");
print("<P>There is <B>NO</B> \"Are you sure?\" button.</P>\n<BR><BR>");

$query = getDeletedProducts();
if (@mysql_num_rows($query)) {

print("<H2>Delete Products</H2>
	<UL>");
while ($row = @mysql_fetch_array($query))
{
	$product = $row["product"];
	$product_id = $row["product_id"];
	$description = $row["description"];
	print("<LI>\n");
	print("Product Name: $product<BR>\n");
	print("Product Description: $description<BR>\n");
	productUndeleteRemove($product_id);
	print("</LI>\n");
}
print("</UL>");
}


print("<H2>Categories</H2>
	<UL>");
$query = getProducts();
while ($row = @mysql_fetch_array($query))
{
	$product = $row["product"];
	print("<LI><H3>Product $product</H3>
		<UL>\n");
	
	$query1 = getDeletedCategories($row["product_id"]);
	while ($row = @mysql_fetch_array($query1))
	{
		$cat_id = $row["cat_id"];
		$cat_name = $row["cat_name"];
		print("<LI>\n");
		print("Category Name: $cat_name<BR>\n");
		catUndeleteRemove($cat_id);
		print("</LI>\n");
	}
	print("</UL>");
	print("</LI>\n");
}
print("</UL>");


$query = getProducts();

print("<H2>FAQS</H2>
	<UL>");
while ($row = @mysql_fetch_array($query))
{
	$product = $row["product"];
	print("<LI><H3>Product $product</H3>
		<UL>\n");
	$query1 = getDeletedFaqs($row["product_id"]);
	while ($row = @mysql_fetch_array($query1))
	{
		$faq_id = $row["faq_id"];
		$faq_cat = getCatName($row["faq_cat"]);
		$faq_question = insertMarkup(removeMarkup($row["faq_question"]));
		$faq_answer = insertMarkup(removeMarkup($row["faq_answer"]));
		print("<LI>\n");
		print("Faq Category: $faq_cat<BR>\n");
		print("Faq Question: $faq_question<BR>\n");
		print("Faq Answer: $faq_answer<BR>\n");
		faqUndeleteRemove($faq_id);
		print("</LI>\n");
	}
	print("</UL>");
	print("</LI>\n");
}
print("</UL>");



printTail();
?>
