<?

function printHead($title)
{
	print("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n");
	print("<HTML>");
	print("<HEAD>\n");

	print("<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=ISO-8859-1\">\n");
	print("<META NAME=\"MSSmartTagsPreventParsing\" CONTENT=\"TRUE\">\n");
	print("<LINK REL=\"stylesheet\" HREF=\"/loki_faq/style.css\" TYPE=\"text/css\">\n");


	print("<TITLE>$title</TITLE>\n");
	print("</HEAD>\n");
	print("<BODY>\n");
}

function printTail()
{
	print("</BODY>\n");
	print("</HTML>\n");
}

function printLinkHead($product)
{
	print("
	<TABLE BORDER=0>
	<TR>
	<TD VALIGN=\"top\">
	<IMG SRC=\"../images/back.gif\" ALT=\"\"> <A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A>&nbsp;|&nbsp;
	<IMG SRC=\"../images/print.gif\" ALT=\"\"> <A HREF=\"faq.php3?view=all&product=$product\">$product Full (Printer-Friendly) view</A>&nbsp;|&nbsp;
	<IMG SRC=\"../images/home.gif\" ALT=\"\"> <A HREF=\"index.php3\">FAQ Home</A>&nbsp;|&nbsp;Search </TD>

	<TD><FORM METHOD=\"post\" ACTION=\"./index_search.php3\"><INPUT TYPE=\"text\" SIZE=\"20\" NAME=\"q\" VALUE=\"$q\"><INPUT TYPE=\"hidden\" NAME=\"product\" VALUE=\"$product\"></FORM></TD></TR></TABLE>");
}

function printProductHead($product)
{
	$row = getProduct($product);
	$description = $row["description"];
	$introduction = $row["introduction"];
	$version = $row["version"];
	$timestamp = $row["timestamp"];

	$description = insertMarkup(removeMarkup($description));
	$introduction = insertMarkup(removeMarkup($introduction));

	print("
		<P CLASS=\"ProductDescription\">$description FAQ</FONT>
		<!-- <FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT> -->
		<P CLASS=\"ProductIntroduction\">$introduction</FONT>");
	print("<HR>\n");

}

function printFAQ($product,$question,$answer,$faq_id)
{
	$answer = trim($answer);
	$answer = insertMarkup(removeMarkup($answer));
	print("<FONT CLASS=\"QA\">Question</FONT>:<BR>\n");
	print("<A NAME=faq$faq_id>\n");
	print("<FONT CLASS=\"FAQQuestion\"><A HREF=\"faq.php3?view=faq&faq_id=$faq_id&product=$product\">$question</A></FONT>\n");
	print("<BR><BR>\n");

	print("<FONT CLASS=\"QA\">Answer</FONT>:<BR>\n");
	print("<FONT CLASS=\"FAQAnswer\">$answer</FONT>\n");
}

function lost()
{
	printHead("Couldn't find what you were looking for?");
	print("<H1>Couldn't find what you're looking for?</H1>");
	print("Try the <A HREF=\"./\">index</A>");
	printTail();
}

function errorPage($error_mesg)
{
	printHead("Error");
	print("<H1>Error: $error_mesg</H1>");
	print("Try going back to the <A HREF=\"./\">index</A>");
	printTail();
}
?>
