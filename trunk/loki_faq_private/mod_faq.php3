<?
include("lib.php3");

if(empty($product) || empty($faq_cat) || empty($faq_id))
{
        print("You have not selected a product to administer or you're missing an ID. Please go back and fix it.");
        exit();
}
else
{
	print("Update / Modify FAQ Form");

        print("<FORM ACTION=\"modded_faq.php3\" METHOD=\"post\">\n");

	$query = "SELECT faq_id, faq_cat, faq_title, faq_answer FROM $product WHERE faq_id = '$faq_id' AND faq_cat = '$faq_cat'";
	$getFAQ = do_sql($query);
	$faq_info = @mysql_fetch_array($getFAQ);	

	$faq_id = $faq_info["faq_id"];
	$faq_cat = $faq_info["faq_cat"];
	$faq_title = $faq_info["faq_title"];
	$faq_answer = $faq_info["faq_answer"];

        print("

        <BR><BR>
        Category: (Ex.: Install, Networking, Display, Sound, Input, et al)<BR>
        <INPUT TYPE=text NAME=new_faq_cat VALUE=\"$faq_cat\" SIZE=15>* No Spaces please

        <BR><BR>

        Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
	<TEXTAREA name=faq_title rows=1 cols=70>$faq_title</TEXTAREA>

        <BR><BR>

        FAQ Answer:<BR>
        <TEXTAREA name=faq_answer rows=20 cols=75 wrap=virtual>$faq_answer</TEXTAREA>

        <BR><BR>
	<INPUT TYPE=hidden NAME=product VALUE=\"$product\" SIZE=15>
	<INPUT TYPE=hidden NAME=faq_id VALUE=\"$faq_id\" SIZE=15>
	<INPUT TYPE=hidden NAME=faq_cat VALUE=\"$faq_cat\" SIZE=15>
        <INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");
}

?>
