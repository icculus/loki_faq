<?

function printHead($title)
{
	print("<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">\n");
	print("<HEAD>\n");

	print("<META HTTP-EQUIV=\"Content-Type\" CONTENT=\"text/html; charset=ISO-8859-1\">\n");
	print("<META NAME=\"MSSmartTagsPreventParsing\" CONTENT=\"TRUE\">\n");
	print("<LINK REL=\"stylesheet\" HREF=\"http://icculus.org/~chunky/includes/style.css\" TYPE=\"text/css\">\n");


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

	<P><IMG SRC=\"../images/back.gif\">&nbsp;&nbsp;<A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A> &nbsp;&nbsp;|&nbsp;&nbsp;
	<IMG SRC=\"../images/print.gif\"> &nbsp;&nbsp;<A HREF=\"faq.php3?view=all&product=$product\">$product Full (Printer-Friendly) view</A> &nbsp;&nbsp;|&nbsp;&nbsp; 
	<IMG SRC=\"../images/home.gif\"> &nbsp;&nbsp;<A HREF=\"index.php3\">FAQ Home</A> ");
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
		<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"subhead\">$description FAQ</FONT>
		<FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT>
		<P>$introduction<P>");
	print("<HR>\n");

}

function printFAQ($product,$question,$answer,$faq_id)
{
	$answer = insertMarkup(removeMarkup($answer));
	print("<B>Question</B>:<BR>\n");
	print("<A NAME=faq$faq_id>\n");
	print("<A HREF=\"faq.php3?view=faq&faq_id=$faq_id&product=$product\">$question</A><BR><BR>\n");

	print("<B>Answer</B>:<BR>\n");
	print("$answer\n");
	print("<BR><BR>\n");


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
