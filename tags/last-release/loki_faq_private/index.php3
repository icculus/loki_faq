<?
include("lib.php3");

print("
<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
<HTML>
<HEAD>
	<!-- Copyright (C) 1999 Loki Entertainment Software -->
	<TITLE>Loki | FAQs</TITLE>
</HEAD>


	<BODY BGCOLOR=\"#ffffff\">
	<!-- BEGIN MAIN BODY -->

	<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#000000\" SIZE=\"-1\" CLASS=\"subhead\">Loki FAQ List
	</FONT></P>
	<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#000000\" SIZE=\"-1\" CLASS=\"normal\">Welcome to A FAQ list! Here, you'll find answers to our most commonly asked questions. 
	</FONT></P>

	<!-- END MAIN BODY -->

	<!-- BEGIN PRODUCT LIST -->
	<UL>");

	$query = do_sql("SELECT product, description FROM products ORDER BY product");

	while($product_list = @mysql_fetch_array($query))
	{
		list($product, $description) = $product_list;
		print("<LI><a href=\"faq.php3?view=index&product=$product\">$description</a></LI>\n");
	}

	/* IF ADMIN... */
	print("<LI><a href=\"maintain.php3?command=add_prod\"><FONT COLOR=\"black\"> Add Product</FONT></A></LI>");

	print("
	
	</UL>
	<!-- END PRODUCT LIST -->


</BODY>
</HTML>");


?>
