<?
include("lib.php3");

print("
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
<HTML>
<BODY>
		<FORM METHOD=\"post\" ACTION=\"http://www.lokigames.com/cgi-bin/htsearch\">
	
<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"normal\">
	Search the FAQs:</FONT></P>

			<INPUT TYPE=\"hidden\" NAME=\"config\" VALUE=\"htdig\">
			<INPUT TYPE=\"hidden\" NAME=\"format\" VALUE=\"FAQ\">
			<INPUT TYPE=\"hidden\" NAME=\"restrict\" VALUE=\"faqs.lokigames.com/\">
			<INPUT TYPE=\"hidden\" NAME=\"exclude\" VALUE=\"\">

			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=\"text\" SIZE=\"20\" NAME=\"words\" VALUE=\"\"> &nbsp;
			<INPUT TYPE=\"image\" VALUE=\"Go\" SRC=\"http://www.lokigames.com/home/_img/headlines/go.gif\" BORDER=0>
		</FORM>	



	<!-- BEGIN PRODUCT LIST -->
	");

	/*
	$query = do_sql("SELECT product, description FROM products WHERE private = '0' ORDER BY product");

	while($product_list = @mysql_fetch_array($query))
	{
		list($product, $description) = $product_list;
		print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
	}
	*/


	$query1 = do_sql("SELECT product, description FROM products WHERE private = '0' AND category = 'general' ORDER BY product");
	$num_rows = @mysql_num_rows($query1);

	print("General FAQs:<BR><BR><UL>");

	if ($num_rows < 1)
        {
        	print("There are currently no entries for this category.");
        }

        while($product_list = @mysql_fetch_array($query1))
        {
              	list($product, $description) = $product_list;
        	print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
        }
        print("</UL>");

	$query2 = do_sql("SELECT product, description FROM products WHERE private = '0' AND category = 'tools' ORDER BY product");
	$num_rows = @mysql_num_rows($query2);

	print("Tools and Utilities:<BR><BR><UL>");

	if ($num_rows < 1)
        {
        	print("There are currently no entries for this category.");
        }

        while($product_list = @mysql_fetch_array($query2))
        {
                list($product, $description) = $product_list;
                print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
        }
	print("</UL>");

	$query3 = do_sql("SELECT product, description FROM products WHERE private = '0' AND category = 'product' ORDER BY product");
	$num_rows = @mysql_num_rows($query3);

	print("Products:<BR><BR><UL>");

	if ($num_rows < 1)
        {
        	print("There are currently no entries for this category.");
        }

	while($product_list = @mysql_fetch_array($query3))
        {
                list($product, $description) = $product_list;
                print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
        }
	print("</UL>");

	$query4 = do_sql("SELECT product, description FROM products WHERE private = '0' AND category = 'open-source' ORDER BY product");
	$num_rows = @mysql_num_rows($query4);

	print("Open Source Projects:<BR><BR><UL>");

	if ($num_rows < 1)
        {
        	print("There are currently no entries for this category.");
        }

        while($product_list = @mysql_fetch_array($query4))
        {
                list($product, $description) = $product_list;
                print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
        }
	print("</UL>");

	print("<BR><BR>");

	print("
	
</BODY>
</HTML>");


?>
