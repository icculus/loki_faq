<?
include("lib.php3");

if(empty($product) || empty($faq_cat) || empty($faq_title) || empty($faq_answer))
{
	 print("You haven't filled in all of the fields. They are all required. Go back and do so.");
        exit();
}
else
{
	/* find out if the faq_cat already exists */
	$cat_check = catCheck($product, $faq_cat);
	if ($cat_check)
	{
		$get_cat_sql = do_sql("SELECT DISTINCT faq_notes FROM $product where faq_cat = '$faq_cat'");
		$cat_id = @mysql_fetch_array($get_cat_sql);
		$cat_num = $cat_id["faq_notes"];
		$next_faq_id = faqCheck($product, $faq_cat);

		$INSERT_QUERY = "INSERT INTO $product";
		$INSERT_QUERY .= "(product, faq_id, faq_cat, faq_title, faq_answer, faq_notes) ";
		$INSERT_QUERY .= "VALUES('$product', '$next_faq_id', '$faq_cat', '$faq_title', '$faq_answer', '$cat_num')";
	}
	else {
		$next_cat_id = next_id("SELECT DISTINCT faq_notes FROM $product ORDER BY faq_notes");
		$next_faq_id = faqCheck($product, $faq_cat);

		$INSERT_QUERY = "INSERT INTO $product";
		$INSERT_QUERY .= "(product, faq_id, faq_cat, faq_title, faq_answer, faq_notes) ";
		$INSERT_QUERY .= "VALUES('$product', '$next_faq_id', '$faq_cat', '$faq_title', '$faq_answer', '$next_cat_id')";
	}

	do_sql($INSERT_QUERY);

	 print("You have successfully added a FAQ to the database. Good for you!
        <BR><BR>

        Product Reference Name: $product
        <BR><BR>

        FAQ Category & Id: $faq_cat.$next_faq_id
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
