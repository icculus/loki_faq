<?php

function modifyProductForm($product_id,$new)
{
	$prod = getProductById($product_id);
	$timestamp = $prod["timestamp"];
	$product_id = $prod["product_id"];
	if(!empty($new["product"]))
	{
		print("<H1>Someone else modified this while you were working on it!</H1>\n");   
		print("<H2>Their version is in <FONT COLOR=\"red\">red</FONT></H2>\n");
		print("<P>Please make suitable corrections then re-submit</P>\n");
		$red_product = $prod["product"];
		$show_product = characterMarkup($new["product"]);
		$red_description = $prod["description"];
		$show_description = characterMarkup($new["description"]);
		$red_introduction = $prod["introduction"];
		$show_introduction = $new["introduction"];
	} else {
		$show_product = characterMarkup($prod["product"]);
		$show_description = characterMarkup($prod["description"]);
		$show_introduction = $prod["introduction"];
	}

	print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
	Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
	<FONT COLOR=\"red\">$red_product</FONT><BR>
	<INPUT TYPE=text NAME=product VALUE=\"$show_product\" SIZE=\"15\">

	<BR><BR>

	Product Description: (Ex.: Sid Meiers Alpha Centauri)<BR>
	<FONT COLOR=\"red\">$red_description</FONT><BR>
	<INPUT TYPE=text NAME=description VALUE=\"$show_description\" SIZE=45>

	<BR><BR>

	Product FAQ Introduction:<BR>
	<FONT COLOR=\"red\">$red_introduction</FONT><BR>
	<TEXTAREA NAME=introduction ROWS=15 COLS=55 WRAP=virtual>$show_introduction</TEXTAREA>

	<BR><BR>

	<INPUT TYPE=hidden NAME=really VALUE=yes>
	<INPUT TYPE=hidden NAME=product_id VALUE=$product_id>
	<INPUT TYPE=hidden NAME=command VALUE=mod_prod>
	<INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>

	<INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>
	</FORM>");
}


function modifyCatForm($cat_id,$new)
{
	$cat = getCategory($cat_id);
	$product = getProductName($cat["product_id"]);
	$timestamp = $cat["timestamp"];
	if(!empty($new["cat_name"]))
	{
		$red_name = characterMarkup($cat["cat_name"]);
		$show_cat_name = characterMarkup($new["cat_name"]);
		print("<H1>Someone else modified this while you were working on it!</H1>\n");   
		print("<H2>Their version is in <FONT COLOR=\"red\">red</FONT></H2>\n");
		print("<P>Please make suitable corrections then re-submit</P>\n");
	} else {
		$show_cat_name = characterMarkup($cat["cat_name"]);
	}
	
	print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">

	Product Category Name: (Ex.: Installation, Introduction, Display)<BR>
	<FONT COLOR=\"red\">$red_name</FONT><BR>
	<INPUT TYPE=text NAME=new_cat_name value=\"$show_cat_name\" SIZE=25>

	<INPUT TYPE=hidden NAME=cat_id VALUE=\"$cat_id\">
	<INPUT TYPE=hidden NAME=really VALUE=yes>
	<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
	<INPUT TYPE=hidden NAME=command VALUE=mod_cat>
	<INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>

	<BR><BR>

	<INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");
}

function modifyFaqForm($faq_id,$new)
{
	$faq = getFaq($faq_id);
	$timestamp = $faq["timestamp"];
	if(!empty($new["faq_question"]))
	{
		print("<H1>Someone else modified this while you were working on it!</H1>\n");   
		print("<H2>Their version is in <FONT COLOR=\"red\">red</FONT></H2>\n");
		print("<P>Please make suitable corrections then re-submit</P>\n");
		$show_cat = $new["faq_cat"];
		$red_cat_name = getCatName($faq["faq_cat"]);
		$red_question = insertMarkup(removeMarkup($faq["faq_question"]));
		$show_question = $new["faq_question"];
		$red_answer = $faq["faq_answer"];
		$show_answer = $new["faq_answer"];
	} else {
		$show_cat = $faq["faq_cat"];
		$show_question = $faq["faq_question"];
		$show_answer = $faq["faq_answer"];
		$show_question=characterMarkup($faq["faq_question"]);
	}
	$product_row = getProductById($faq["faq_prod"]);
	$product = $product_row["product"];
	$product_id = $product_row["product_id"];
	

	$allcats = getCategories($product);
	print ("<H2>Current product: $product</H2>");
	print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">");
	print ("<BR>New Category:<BR>
		<FONT COLOR=\"red\">$red_cat_name</FONT><BR>
		<SELECT NAME=new_cat_id>");
	while ($category = @mysql_fetch_array($allcats)) {
		$cat_id = $category["cat_id"];
		$cat_name = $category["cat_name"];
		if ($cat_id == $show_cat) {
			print("<OPTION SELECTED VALUE=$cat_id>$cat_name");
		} else {
			print("<OPTION VALUE=$cat_id>$cat_name");
		}
	}
	print("</SELECT><BB><BR><BR>\n");
	print("<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=mod_faq>
		<INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>
		<INPUT TYPE=hidden NAME=product VALUE=$product>
		<INPUT TYPE=hidden NAME=faq_id VALUE=$faq_id>");

	print("Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
		<FONT COLOR=\"red\">$red_question</FONT><BR>
	<INPUT TYPE=text NAME=question VALUE=\"$show_question\" SIZE=65>

	<BR><BR>

	FAQ Answer:<BR>
		<FONT COLOR=\"red\">$red_answer</FONT><BR>
	<TEXTAREA name=answer rows=20 cols=75 wrap=virtual>$show_answer</TEXTAREA>
	<BR><BR>
	<INPUT TYPE=submit VALUE=Modify>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");

}
?>
