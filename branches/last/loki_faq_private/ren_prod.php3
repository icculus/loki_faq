<?
include("lib.php3");

// ALTER TABLE $old_name RENAME $new_name

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


        print("<FORM ACTION=\"renamed_prod.php3\" METHOD=\"post\">

	Current Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
        <INPUT TYPE=hidden NAME=product VALUE=$product>
	<BR>
	<B>$product</B>

        <BR><BR>

        <B>New</B> Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
        <INPUT TYPE=text NAME=product_newname SIZE=15>
 
	<BR><BR>

        <INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>

        <BR><BR>

        <INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>

        ");
}

?>
