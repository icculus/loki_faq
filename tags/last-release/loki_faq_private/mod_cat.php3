<?
include("lib.php3");

if(empty($product) || empty($faq_cat))
{
	print("You are missing required fields. Go back and select them.");
        exit();
}
else
{
	print("Update / Modify Category Form");

        print("<FORM ACTION=\"modded_cat.php3\" METHOD=\"post\">

	<B>Old</B> Product Category Name: <B>$faq_cat</B><BR><BR>
        <INPUT TYPE=hidden NAME=old_faq_cat VALUE=\"$faq_cat\">

        <B>New</B> Product Category Name: (Ex.: Installation, Introduction, Display)<BR>
        <INPUT TYPE=text NAME=new_faq_cat SIZE=25>

        <INPUT TYPE=hidden NAME=product VALUE=\"$product\">

        <BR><BR>

        <INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>

        ");
}

?>
