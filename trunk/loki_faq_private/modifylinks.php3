<?php

function productModifyRemove($product)
{
        print ("<FONT CLASS=\"Modify\">
        [
        <A HREF=\"./maintain.php3?command=mod_prod&product=$product\">Modify</A>
        | <A HREF=\"./maintain.php3?command=rem_prod&product=$product\">Remove</A>
        ]
                </FONT>");
}

function catModifyRemove($product,$cat_name)
{
	print ("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=mod_cat&cat_name=$cat_name&product=$product\">Modify</A>
	| <A HREF=\"./maintain.php3?command=rem_cat&cat_name=$cat_name&product=$product\">Remove</A>
	]
		</FONT>");
}

function catMoveUpDown($product,$cat_name)
{
	$cat_id = getCatId($product,$cat_name);
	print("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=move_cat&direction=up&really=yes&cat_id=$cat_id\">Move Up</A>
	| <A HREF=\"./maintain.php3?command=move_cat&direction=down&really=yes&cat_id=$cat_id\">Move Down</A>
	]
		</FONT>");
}

function faqModifyRemove($faq_id,$product,$cat_name)
{
	print ("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=mod_faq&faq_id=$faq_id&product=$product\">Modify</A>
	| <A HREF=\"./maintain.php3?command=rem_faq&faq_id=$faq_id&product=$product\">Remove</A>
	]
		</FONT>");
}

function faqMoveUpDown($faq_id,$product,$cat_name)
{
	print("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=move_faq&direction=up&really=yes&faq_id=$faq_id&category=$cat_name&product=$product\">Move Up</A>
	| <A HREF=\"./maintain.php3?command=move_faq&direction=down&really=yes&faq_id=$faq_id&category=$cat_name&product=$product\">Move Down</A>
	]
		</FONT>");
}

function catAdd($product)
{
	print ("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=add_cat&product=$product\">Add Category to this Product</A>
	]
		</FONT>");
}

function faqAdd($product,$cat_name)
{
	print ("<FONT CLASS=\"Modify\">
	[
	<A HREF=\"./maintain.php3?command=add_faq&product=$product&category=$cat_name\">Add FAQ to this Category</A>
	]
		</FONT>");
}

?>
