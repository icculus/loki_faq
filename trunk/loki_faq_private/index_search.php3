<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

printHead("Search the FAQS");

if(!empty($q))
{
	/* Nothing too complicated, but a helluva improvement on nothing */
	if(!empty($product))
	{
		$product_id = getProductId($product);
		$SQL_CAT_PRODUCT="AND product_id='$product_id' ";
		$SQL_FAQ_PRODUCT="AND faq_prod='$product_id' ";
		print("<P><FONT CLASS=\"SearchHeadings\">Searching just in product $product</FONT></P>");
	}
	$search = ereg_replace('[[:digit:]]',' ',$q);
	$search = ereg_replace('s ',' ',$search);
	$search = ereg_replace('s$','',$search);
	$search = ereg_replace(' +','.*',$search);
	$search = sql_regcase(trim($search));
	$SQL_CAT="SELECT * FROM categories WHERE
		cat_name RLIKE '$search'
		$SQL_CAT_PRODUCT;";
	$SQL_FAQ="SELECT * FROM faqs WHERE
		(faq_question RLIKE '$search' OR faq_answer RLIKE '$search')
		$SQL_FAQ_PRODUCT;";

	$cat_query = do_sql($SQL_CAT);
	$faq_query = do_sql($SQL_FAQ);
	$cat_numrows = @mysql_num_rows($cat_query);
	$faq_numrows = @mysql_num_rows($faq_query);
	if($cat_numrows < 1 && $faq_numrows < 1)
	{
		print("<P><FONT CLASS=\"SearchHeadings\">No results found for \"$q\"</FONT></P>");
	} else {
		if($cat_numrows > 0)
		{
			print("<P><FONT CLASS=\"SearchHeadings\">Categories found matching query:</FONT></B>\n");
			print("<UL>");
			while($row = @mysql_fetch_array($cat_query))
			{
				$cat_id = $row["cat_id"];
				$cat_name = $row["cat_name"];
				$product_id = $row["product_id"];
				$category = getCatName($cat_id);
				$product = getProductName($product_id);
				print("
		<LI>Product Name: $product,
		Category: <A HREF=\"./faq.php3?view=category&product=$product&faq_cat=$category\">$category</A></LI>");
			}
			print("</UL>");
		}
		if($faq_numrows > 0)
		{
			print("<P><FONT CLASS=\"SearchHeadings\">FAQs found matching query:</FONT></P>");
			print("<UL>");
			while($row = @mysql_fetch_array($faq_query))
			{
				$product_id = $row["faq_prod"];
				$faq_id = $row["faq_id"];
				$faq_cat = $row["faq_cat"];
				$faq_question = $row["faq_question"];
				$product = getProductName($product_id);
				$category = getCatName($faq_cat);
				print("
		<LI>Product: $product, Category: $category,<BR>
		FAQ Question: <A HREF=\"./faq.php3?view=faq&product=$product&faq_id=$faq_id\">$faq_question</A></LI>");
			}
			print("</UL>");
		}
	}
	
}
print("
	<FORM METHOD=\"post\" ACTION=\"./index_search.php3\">
	<P>Search ALL the FAQs:</P>
	<INPUT TYPE=\"text\" SIZE=\"20\" NAME=\"q\" VALUE=\"$q\"> &nbsp;
	<INPUT TYPE=\"submit\" VALUE=\"Find!\">
		</FORM>	
	<P>To search through just one product, do the search from within
	that product</P>
	");

	printTail();

?>
