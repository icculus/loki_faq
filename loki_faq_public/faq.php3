<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");
include("./modifylinks.php3");

function indexProduct($product)
{

	$categories = getCategories($product);

	print("<BR><BR>\n");
	/* List Categories and questions in outline format */
	while($all_cats = @mysql_fetch_array($categories))
	{
		$cat_name = $all_cats["cat_name"];

		/* Print Category number and name */
		print("<FONT CLASS=\"CategoryName\"><A HREF=\"faq.php3?view=category&product=$product&faq_cat=$cat_name\">$cat_name</A></FONT>");

		catModifyRemove($product,$cat_name);
		print("&nbsp;&nbsp;");
		catMoveUpDown($product,$cat_name);
		print("<BR>\n");
		faqAdd($product,$cat_name);
		print("<BR>\n");

		$catIndex = getIndexByCat($product, $cat_name);

		print("<OL>\n");
		while($list_all = @mysql_fetch_array($catIndex))
		{
			/* grab question specific data */
			$faq_question = $list_all["faq_question"];
			$faq_answer = $list_all["faq_answer"];
			$faq_id = $list_all["faq_id"];

			/* print Question */
	       		print("<LI><FONT CLASS=\"FAQQuestion\"><A HREF=\"faq.php3?view=faq&product=$product&faq_id=$faq_id\">$faq_question</A></FONT>\n");
			faqModifyRemove($faq_id, $product,$cat_name);
			print("&nbsp;&nbsp;");
			faqMoveUpDown($faq_id, $product,$cat_name);
			print("</LI>\n\n");
		}

		print("\n</OL>\n");
	}
}




switch ($view) {

  case 'index':

	/* Start HTML */
	printHead($product);
	printLinkHead($product);
	
	printProductHead($product);
	catAdd($product);

	indexProduct($product);
	printTail();
	/* End HTML */

  break;

  case 'faq':

	$row = getProduct($product);

	/* $product = $row["product"]; */
	$description = $row["description"];
	$introduction = $row["introduction"];
	$timestamp = $row["timestamp"];

	$answer = getFaq($faq_id);

	$faq_id = $answer["faq_id"];
	$faq_cat = getCatName($answer["faq_cat"]);
	$faq_question = $answer["faq_question"];
	$faq_answer = $answer["faq_answer"];


	/* Start HTML */
	printHead("FAQ: $product");
	printLinkHead($product);
	printProductHead($product);
	print("<FONT CLASS=\"CategoryName\"><A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></FONT><BR><BR>\n");
	printFAQ($product,$faq_question,$faq_answer,$faq_id);
	print("<BR>");
	faqModifyRemove($faq_id,$product,$faq_cat);
	printTail();
	/* End HTML */

  break;

  case 'category':

	$row = getProduct($product);

	$product = $row["product"];
	$description = $row["description"];
	$introduction = $row["introduction"];
	$timestamp = $row["timestamp"];

	printHead("Category: $product");
	printLinkHead($product);
	printProductHead($product);
	catAdd($product);
	print("<BR><BR>");

	$catRow = getIndexByCat($product, $faq_cat);

	print("<FONT CLASS=\"CategoryName\"><A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></FONT><BR>\n");
	print("<OL>");

	/* Use to list all questions */
	while($answer = @mysql_fetch_array($catRow))
	{

		$faq_id = $answer["faq_id"];
		$faq_cat = getCatName($answer["faq_cat"]);
		$faq_question = $answer["faq_question"];
		$faq_answer = $answer["faq_answer"];
	

		print("<LI><FONT CLASS=\"FQAQuestion\"><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_question</A></FONT><BR>\n");
		faqModifyRemove($faq_id,$product,$faq_cat);
		print("&nbsp;&nbsp;");
		faqMoveUpDown($faq_id, $product,$cat_name);
		print("</LI>\n\n");

	}
	print("</OL>\n");


	print("<BR><BR><HR><BR><BR>\n");

	$catRow = getIndexByCat($product, $faq_cat);

	print("<OL>");

	/* Use to list all questions */
	while($answer = @mysql_fetch_array($catRow))
	{

		$faq_id = $answer["faq_id"];
		$faq_cat = getCatName($answer["faq_cat"]);
		$faq_question = $answer["faq_question"];
		$faq_answer = $answer["faq_answer"];
	
		print("<LI>");
		printFAQ($product,$faq_question,$faq_answer,$faq_id);
		print("<BR>\n");
		faqModifyRemove($faq_id,$product,$faq_cat);
		print("&nbsp;&nbsp;");
		faqMoveUpDown($faq_id, $product,$cat_name);
		print("<BR><BR>\n");
		print("</LI>");

	}
	print("</OL>");

	printTail();
	/* End HTML */

  break;

  case 'all':

	/* Start HTML */
	printHead($product);
	printLinkHead($product);
	
	printProductHead($product);
	catAdd($product);

	indexProduct($product);
	print("<BR><BR><HR><BR><BR>\n");

	$categories = getCategories($product);

	/* List Categories and questions in outline format */
	while($all_cats = @mysql_fetch_array($categories))
	{
		$cat_name = $all_cats["cat_name"];

		/* Print Category number and name */
		print("<FONT CLASS=\"CategoryName\"><A HREF=\"faq.php3?view=category&product=$product&faq_cat=$cat_name\">$cat_name</A></FONT>\n");
		catModifyRemove($product,$cat_name);
		print("&nbsp;&nbsp;");
		catMoveUpDown($product,$cat_name);
		print("<OL>\n");

		$catIndex = getIndexByCat($product, $cat_name);

		while($list_all = @mysql_fetch_array($catIndex))
		{
			/* grab question specific data */
			$faq_question = $list_all["faq_question"];
			$faq_answer = $list_all["faq_answer"];
			$faq_id = $list_all["faq_id"];
			print("\n<LI>\n");

			printFAQ($product,$faq_question,$faq_answer,$faq_id);
			print("<BR>\n");
			faqModifyRemove($faq_id,$product,$faq_cat);
			print("&nbsp;&nbsp;");
			faqMoveUpDown($faq_id, $product,$cat_name);
			print("<BR><BR>\n");
			print("\n</LI>\n");
		}

		print("</OL>\n");
		print("<HR>");
	}

	printTail();
	/* End HTML */

  break;

  
  default:

	lost();


}

?>
