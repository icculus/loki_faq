<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

printHead("Search the FAQS");

if(!empty($q))
{
	if(!empty($product))
	{
		$product_id = getProductId($product);
		$SQL_CAT_PRODUCT="AND product_id='$product_id' ";
		$SQL_FAQ_PRODUCT="AND faq_prod='$product_id' ";
		print("<P><FONT CLASS=\"SearchHeadings\">Searching just in product $product</FONT></P>");
	}

	/* Nothing too complicated, but a helluva improvement on nothing */
	$search = ereg_replace('[[:digit:]]',' ',$q);
	if(! eregi("ss ",$search)) { $search = ereg_replace('s ',' ',$search); }
	if(! eregi("ss$",$search)) { $search = ereg_replace('s$','',$search); }
	$search = trim($search);

	if( ($mysql_major>3) || ($mysql_minor>23) ||
		($mysql_major==3 && $mysql_minor==23 && $mysql_patch>=23) &&
		(strlen($search)>3))
	{

		$search = ereg_replace('^','*',$search);
		$search = ereg_replace(' +','* *',$search);
		$search = ereg_replace('$','*',$search);

		$SQL_CAT = "SELECT *,MATCH(cat_name)
				AGAINST('$search') as score
			FROM categories WHERE
			MATCH(cat_name) AGAINST('$search')
			$SQL_CAT_PRODUCT;";

		$SQL_FAQ = "SELECT *,MATCH(faq_question,faq_answer)
				AGAINST('$search') as score
			FROM faqs WHERE
			MATCH(faq_question,faq_answer) AGAINST('$search')
			$SQL_FAQ_PRODUCT;";
	} else {
		$search = ereg_replace(' +','.*',$search);
		$search = sql_regcase($search);

		$SQL_CAT="SELECT * FROM categories WHERE
			cat_name RLIKE '$search'
			$SQL_CAT_PRODUCT;";

		$SQL_FAQ="SELECT * FROM faqs WHERE
			(faq_question RLIKE '$search'
			OR faq_answer RLIKE '$search')
			$SQL_FAQ_PRODUCT;";
	}

/*	print("SQL_FAQ = <PRE>$SQL_FAQ</PRE><BR><BR>");
	print("SQL_CAT = <PRE>$SQL_CAT</PRE><BR><BR>"); */

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
				$score = number_format($row["score"],1);
				$cat_id = $row["cat_id"];
				$cat_name = $row["cat_name"];
				$product_id = $row["product_id"];
				$category = getCatName($cat_id);
				$product = getProductName($product_id);
				print("<LI>\n");
				if($score>0) {
					print("ChunkyRank: $score,<BR>");
				}
				print("
		Product Name: $product,<BR>
		Category: <A HREF=\"./faq.php3?view=category&product=$product&faq_cat=$category\">$category</A><BR>
		</LI>");
			}
			print("</UL>");
		}
		if($faq_numrows > 0)
		{
			print("<P><FONT CLASS=\"SearchHeadings\">FAQs found matching query:</FONT></P>");
			print("<UL>");
			while($row = @mysql_fetch_array($faq_query))
			{
				$score = number_format($row["score"],1);
				$product_id = $row["faq_prod"];
				$faq_id = $row["faq_id"];
				$faq_cat = $row["faq_cat"];
				$faq_question = $row["faq_question"];
				$product = getProductName($product_id);
				$category = getCatName($faq_cat);
				print("<LI>\n");
				if($score>0) {
					print("ChunkyRank: $score,<BR>");
				}
				print("Product: $product, Category: $category,<BR>
		FAQ Question: <A HREF=\"./faq.php3?view=faq&product=$product&faq_id=$faq_id\">$faq_question</A><BR>
		</LI>");
			}
			print("</UL>");
		}
	}
	
}

$q = characterMarkup($q);
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
