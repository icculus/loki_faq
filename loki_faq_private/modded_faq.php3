<?
include("lib.php3");

if(empty($product) || empty($faq_id) || empty($faq_cat) || empty($faq_title) || empty($faq_answer))
{
        print("You haven't filled in all of the fields. They are all required. Go back and do so.");
	echo "product is $product faq_id is $faq_id faq_cat is $faq_cat faq_title is $faq_title faq_answer is $faq_answer";

        exit();
}
else
{
	$UPDATE_FAQ0 = "UPDATE $product SET faq_cat = '$new_faq_cat' WHERE faq_id = '$faq_id' AND faq_cat = '$faq_cat'";
	do_sql($UPDATE_FAQ0);

	$UPDATE_FAQ1 = "UPDATE $product SET faq_title = '$faq_title' WHERE faq_id = '$faq_id' AND faq_cat = '$faq_cat'";
	do_sql($UPDATE_FAQ1);

	$UPDATE_FAQ2 = "UPDATE $product SET faq_answer = '$faq_answer' WHERE faq_id = '$faq_id' AND faq_cat = '$faq_cat'";
	do_sql($UPDATE_FAQ2);

         print("You have successfully modified FAQ: $product: $faq_id in the database.
        <BR><BR>

        Product Reference Name: $product
        <BR><BR>

        FAQ Category: $faq_cat
        <BR><BR>

        FAQ Title (FAQ): $faq_title
        <BR><BR>

        FAQ Answer:<BR>
        $faq_answer
        <BR><BR>
        <BR><BR>

        *You may now go ahead and view this newly added FAQ for: $product
        <BR><BR>
        <BR><BR>

        <A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
        <BR>
        <A HREF=\"index.php3\">FAQ Index</A>");
}

?>
