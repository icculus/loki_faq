<?php

function catModifyRemove($product,$cat_name)
{
	$cat_id = getCatId($product,$cat_name);
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./maintain.php3?command=mod_cat&cat_name=$cat_name&product=$product\">Modify</A>
	| <A HREF=\"./maintain.php3?command=rem_cat&cat_name=$cat_name&product=$product\">Remove</A>
	]
	&nbsp;&nbsp;&nbsp;
	[
	<A HREF=\"./maintain.php3?command=move_cat&direction=up&really=yes&cat_id=$cat_id\">Move Up</A>
	| <A HREF=\"./maintain.php3?command=move_cat&direction=down&really=yes&cat_id=$cat_id\">Move Down</A>
	]
		</FONT>");
	print("<BR>");
}

function faqModifyRemove($faq_id,$product,$cat_name)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./maintain.php3?command=mod_faq&faq_id=$faq_id&product=$product\">Modify</A>
	| <A HREF=\"./maintain.php3?command=rem_faq&faq_id=$faq_id&product=$product\">Remove</A>
	]
	&nbsp;&nbsp;&nbsp;
	[
	<A HREF=\"./maintain.php3?command=move_faq&direction=up&really=yes&faq_id=$faq_id&category=$cat_name&product=$product\">Move Up</A>
	| <A HREF=\"./maintain.php3?command=move_faq&direction=down&really=yes&faq_id=$faq_id&category=$cat_name&product=$product\">Move Down</A>
	]
		</FONT>");
	print("<BR>");
}

function catAdd($product)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./maintain.php3?command=add_cat&product=$product\">Add Category</A>
	]
		</FONT>");
}

function faqAdd($product,$cat_name)
{
	print ("<FONT SIZE=\"1\">
	[
	<A HREF=\"./maintain.php3?command=add_faq&product=$product&category=$cat_name\">Add FAQ</A>
	]
		</FONT>");
}

?>
