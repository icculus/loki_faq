<?
include("lib.php3");

if(empty($product))
{
	print("You are missing required fields. Go back and select them.");
        exit();
}
else
{
	$timestamp = date("YmdHis");

	$row = getProduct($product);

        $product = $row["product"];
        $description = $row["description"];
        $introduction = $row["introduction"];
        $version = $row["version"];
        $category = $row["category"];
        $private = $row["private"];


        print("<FORM ACTION=\"modded_prod.php3\" METHOD=\"post\">

        Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
	<B><A HREF=\"ren_prod.php3?product=$product\">$product</A></B>
	<INPUT TYPE=hidden NAME=product VALUE=$product>
	<BR>
	*Note* If you would like to change this reference name, click on it.

        <BR><BR>

        Product Description: (Ex.: Sid Meiers Alpha Centauri)<BR>
        <INPUT TYPE=text NAME=description VALUE=\"$description\" SIZE=45>

        <BR><BR>

        Product FAQ Introduction:<BR>
        <TEXTAREA NAME=introduction ROWS=15 COLS=55 WRAP=virtual>$introduction</TEXTAREA>

        <BR><BR>

        FAQ Version: (Ex.: v1.2, v0.1)<BR>
        <INPUT TYPE=text NAME=version VALUE=\"$version\" SIZE=5>

	<BR><BR>

	FAQ Category: (Ex: product, open-source, general)<BR>
	<INPUT TYPE=text NAME=category VALUE=\"$category\" SIZE=24>

	<BR><BR>

	FAQ visibility: (Ex.: 0 => visible, 1 => invisible)
	<INPUT TYPE=text NAME=private VALUE=\"$private\" SIZE=3>
 
	<BR><BR>

        <INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>

        <BR><BR>

        <INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>

        ");
}

?>
