<?
include("lib.php3");

switch ($view) {

  case 'index':

if (! $product ) {
	print("You have not selected a product. Please return and do so.");
	exit();
}
else {
	$row = getProduct($product);

	$product = $row["product"];
	$description = $row["description"];
	$introduction = $row["introduction"];
	$version = $row["version"];
	$timestamp = $row["timestamp"];

	/* Get product Index (questions, categories, faq_id's) */
	$row = getIndex($product);

	/* Grab all Categories */
	$query0 = do_sql("SELECT DISTINCT faq_cat, faq_notes FROM $product ORDER BY faq_notes");

	/* Grab # of rows in product table, for counting and error checking */
	$query1 = do_sql("SELECT faq_id FROM $product");
	$num_rows = @mysql_num_rows($query1);

	$htdig = str_replace("\"", "'", strip_tags($introduction));

	/* Start HTML */
	print("
	<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
<HTML>
<BODY>

	<P><IMG SRC=\"images/back.gif\">&nbsp;&nbsp;<A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A> &nbsp;&nbsp;|&nbsp;&nbsp;
	<IMG SRC=\"images/print.gif\"> &nbsp;&nbsp;<A HREF=\"faq.php3?view=all&product=$product\">$product Full (Printer-Friendly) view</A> &nbsp;&nbsp;|&nbsp;&nbsp; 
	<IMG SRC=\"images/home.gif\"> &nbsp;&nbsp;<A HREF=\"index.php3\">FAQ Home</A>
	
<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"subhead\">$description FAQ</FONT>

	<FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT>
	<P>
	$introduction
	<P>");

	if($num_rows < 1)
	{
		print("** There are currently zero FAQs for this particular product. Please try again, later.**");
	}
	else
	{
		/* List Categories and questions in outline format */
		while($all_cats = @mysql_fetch_array($query0))
		{
			$faq_cat = $all_cats["faq_cat"];
			$faq_cat_num = $all_cats["faq_notes"];

			/* Print Category number and name */
			print("<H2>$faq_cat_num. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2><UL>");

			$catIndex = getIndexByCat($product, $faq_cat);

			while($list_all = @mysql_fetch_array($catIndex))
			{
				/* grab question specific data */
				list($faq_cat, $faq_id, $faq_title, $faq_notes) = $list_all;

				/* print Question */
                		print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_notes.$faq_id $faq_title</A>");
			}

 	              	print("</UL>");
		}
	/* Done Listing Cats and questions */
	}

	print("
	<!-- END MAIN BODY -->


</BODY>
</HTML>
");
	/* End HTML */
}

  break;

  case 'faq':

        $row = getProduct($product);

        $product = $row["product"];
        $description = $row["description"];
        $introduction = $row["introduction"];
        $version = $row["version"];
        $timestamp = $row["timestamp"];

	$answer = getFaq($product, $faq_notes, $faq_id);

	$faq_id = $answer["faq_id"];
	$faq_cat = $answer["faq_cat"];
	$faq_title = $answer["faq_title"];
	$faq_answer = $answer["faq_answer"];
	$faq_notes = $answer["faq_notes"];

	$htdig = str_replace("\"", "'", strip_tags($faq_answer));

	/* Start HTML */
        print("
			<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
		<HTML>
		<BODY>
		
			<!-- BEGIN MAIN BODY -->
		
			<P><IMG SRC=\"images/back.gif\">&nbsp;&nbsp;<A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A> &nbsp;&nbsp;|&nbsp;&nbsp;
			<IMG SRC=\"images/print.gif\"> &nbsp;&nbsp;<A HREF=\"faq.php3?view=all&product=$product\">$product Full (Printer-Friendly) view</A> &nbsp;&nbsp;|&nbsp;&nbsp; 
			<IMG SRC=\"images/home.gif\"> &nbsp;&nbsp;<A HREF=\"index.php3\">FAQ Home</A>
			
		<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"subhead\">$description FAQ</FONT>
		
			<FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT>
			<P>
			$introduction
	<P>");

        print("<H2>$faq_notes. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2><UL>");

        print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_notes.$faq_id $faq_title</A>");

	print("</UL>");

	print("<B>Answer</B>:<br>");
	print("$faq_answer");

	print("<!-- END MAIN BODY -->
			
			</BODY>
		</HTML>");
        /* End HTML */

  break;

  case 'category':

        $row = getProduct($product);

        $product = $row["product"];
        $description = $row["description"];
        $introduction = $row["introduction"];
        $version = $row["version"];
        $timestamp = $row["timestamp"];

	/* $htdig = str_replace("\"", "'", strip_tags($introduction)); */

        /* Start HTML */
	print("
					<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
				<HTML>
				<BODY>

				
					<!-- BEGIN MAIN BODY -->
				
					<P><IMG SRC=\"images/back.gif\">&nbsp;&nbsp;<A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A> &nbsp;&nbsp;|&nbsp;&nbsp;
					<IMG SRC=\"images/print.gif\"> &nbsp;&nbsp;<A HREF=\"faq.php3?view=all&product=$product\">$product Full (Printer-Friendly) view</A> &nbsp;&nbsp;|&nbsp;&nbsp; 
					<IMG SRC=\"images/home.gif\"> &nbsp;&nbsp;<A HREF=\"index.php3\">FAQ Home</A>
					
				<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"subhead\">$description FAQ</FONT>
				
					<FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT>
					<P>
					$introduction
	<P>");

	$row = getIndexByCat($product, $faq_cat);
	$catRow = getIndexByCat($product, $faq_cat);

	/* Fetch the array first and early to have $faq_cat_num */
	$category = @mysql_fetch_array($catRow);
	$faq_cat_num = $category["faq_notes"];

        print("<H2>$faq_cat_num. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2><UL>");

        /* Use to list all questions */
        while($result = @mysql_fetch_array($row))
        {

                list($faq_cat, $faq_id, $faq_title, $faq_notes) = $result;

                print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\"><B>$faq_cat:</B> $faq_notes.$faq_id $faq_title</A><BR>");


		$answer = getFaq($product, $faq_notes, $faq_id);
                $faq_answer = $answer["faq_answer"];


        }
	print("</UL>");


	print("<BR><BR><HR><BR><BR>");

        $query2 = do_sql("SELECT DISTINCT faq_cat, faq_notes from $product WHERE faq_notes = '$faq_notes' ORDER BY faq_notes");

        while($longList = @mysql_fetch_array($query2))
        {

                list($faq_cat, $faq_notes) = $longList;

                $row = getIndexByCat($product, $faq_cat);
                $catRow = getIndexByCat($product, $faq_cat);

                /* Fetch the array first and early to have $faq_cat_num */
                $category = @mysql_fetch_array($catRow);
                $faq_cat_num = $category["faq_notes"];

                print("<H2>$faq_cat_num. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2><UL>");

                /* Use to list all questions */
                while($result = @mysql_fetch_array($row))
                {

                        list($faq_cat, $faq_id, $faq_title, $faq_notes) = $result;
                        $answer = getFaq($product, $faq_notes, $faq_id);

                        $faq_answer = $answer["faq_answer"];

                        print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_notes.$faq_id $faq_title</A><BR><BR><UL>$faq_answer</UL><BR>");
                }

        print("</UL>");

        }

        print("<BR><BR>");







	print("<!-- END MAIN BODY -->
			
			
			</BODY>
		</HTML>");
        /* End HTML */

  break;

  case 'all':

	$row = getProduct($product);

	$product = $row["product"];
	$description = $row["description"];
	$introduction = $row["introduction"];
	$version = $row["version"];
	$timestamp = $row["timestamp"];

	/* Get product Index (questions, categories, faq_id's) */
	$row = getIndex($product);

	/* Grab all Categories */
	$query0 = do_sql("SELECT DISTINCT faq_cat, faq_notes FROM $product ORDER BY faq_notes");

	/* Grab # of rows in product table, for counting and error checking */
	$query1 = do_sql("SELECT faq_id FROM $product");
	$num_rows = @mysql_num_rows($query1);

	/* Start HTML */
	print("
		<HTML>


		<HEAD>
		<TITLE>$product FAQ (Printer-friendly)</TITLE>
		</HEAD>
		<BODY BGCOLOR=\"white\">	
				<!-- BEGIN MAIN BODY -->
			
				<P><A HREF=\"faq.php3?view=index&product=$product\">$product FAQ Index</A> &nbsp;&nbsp;|&nbsp;&nbsp;
				&nbsp;&nbsp;<A HREF=\"faq.php3?view=index&product=$product\">$product Full (Regular) view</A> &nbsp;&nbsp;|&nbsp;&nbsp; 
				&nbsp;&nbsp;<A HREF=\"index.php3\">FAQ Home</A>
				
			<P><B><FONT FACE=\"Arial, Helvetica, sans-serif\" SIZE=\"+3\" CLASS=\"subhead\">$description FAQ</FONT></B>
			
				<FONT CLASS=\"small\"><BR>Last Updated on: $timestamp</FONT>
				<P>
				$introduction
	<P>");

	if($num_rows < 1)
	{
		print("** There are currently zero FAQs for this particular product. Please try again, later.**");
	}
	else
	{
		/* List Categories and questions in outline format */
		while($all_cats = @mysql_fetch_array($query0))
		{
			$faq_cat = $all_cats["faq_cat"];
			$faq_cat_num = $all_cats["faq_notes"];

			/* Print Category number and name */
			//print("<H2>$faq_cat_num. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2>");
			/* following line is a target link */
			print("<H2>$faq_cat_num. <A HREF=\"#$faq_cat\">$faq_cat</A></H2>");

			$catIndex = getIndexByCat($product, $faq_cat);

			while($list_all = @mysql_fetch_array($catIndex))
			{
				/* grab question specific data */
				list($faq_cat, $faq_id, $faq_title, $faq_notes) = $list_all;

				/* print Question */
                		//print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_notes.$faq_id $faq_title</A>");
				/* following line is a target link */
                		print("<LI><A HREF=\"#$faq_notes$faq_id\">$faq_notes.$faq_id $faq_title</A>");
			}

 	              	print("</UL>");
		}
	/* Done Listing Cats and questions */
	}

	print("<BR><BR><HR><BR><BR>");

	$query2 = do_sql("SELECT DISTINCT faq_cat, faq_notes from $product ORDER BY faq_notes");

	while($longList = @mysql_fetch_array($query2))
	{

		list($faq_cat, $faq_notes) = $longList;

		$row = getIndexByCat($product, $faq_cat);
        	$catRow = getIndexByCat($product, $faq_cat);

	        /* Fetch the array first and early to have $faq_cat_num */
        	$category = @mysql_fetch_array($catRow);
        	$faq_cat_num = $category["faq_notes"];

        	//print("<H2>$faq_cat_num. <A HREF=\"faq.php3?view=category&product=$product&faq_cat=$faq_cat\">$faq_cat</A></H2><UL>");
		/* following line is a target link */
        	print("<H2>$faq_cat_num. <A NAME=\"$faq_cat\">$faq_cat</A></H2><UL>");

        	/* Use to list all questions */
        	while($result = @mysql_fetch_array($row))
        	{

                	list($faq_cat, $faq_id, $faq_title, $faq_notes) = $result;
                	$answer = getFaq($product, $faq_notes, $faq_id);

	                $faq_answer = $answer["faq_answer"];

                	//print("<LI><A HREF=\"faq.php3?view=faq&product=$product&faq_notes=$faq_notes&faq_id=$faq_id\">$faq_notes.$faq_id $faq_title</A><BR><BR><UL>$faq_answer</UL><BR>");
			/* following line is a target link */
                	print("<LI><A NAME=\"$faq_notes$faq_id\">$faq_notes.$faq_id $faq_title</A><BR><BR><UL>$faq_answer</UL><BR>");
        	}

        print("</UL>");

	}

print("<!-- END MAIN BODY -->
		
			</BODY>
		</HTML>");
	/* End HTML */


  break;

  default:

	//include("index.php3"); produces errors because of a function call
	/* Start HTML */
        print("
					<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.0//EN\" \"http://www.w3.org/TR/REC-html40/strict.dtd\">
				<HTML>

				<BODY>

				
					<!-- BEGIN MAIN BODY -->
					
				<P><FONT FACE=\"Arial, Helvetica, sans-serif\" COLOR=\"#CCCCCC\" SIZE=\"-1\" CLASS=\"subhead\">Lost?</FONT>

				<P>Lost? Maybe you should try the <A HREF=\"index.php3\">FAQ Index</A>.
	");
        /* End HTML */
        print("<!-- END MAIN BODY -->
		
		
		</BODY>
		</HTML>");



}

?>
