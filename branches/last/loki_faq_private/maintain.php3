<?
include("lib.php3");

switch ($command) {

  case 'add_prod':

	$timestamp = date("YmdHis");

	print("<FORM ACTION=\"add_prod.php3\" METHOD=\"post\">

	Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
	<INPUT TYPE=text NAME=product SIZE=15>* Don't mess up please

	<BR><BR>

	Product Description: (Ex.: Sid Meiers Alpha Centauri)<BR>
	<INPUT TYPE=text NAME=description SIZE=45>

	<BR><BR>

	Product FAQ Introduction:<BR>
	<TEXTAREA name=introduction rows=15 cols=55 wrap=virtual></TEXTAREA>

	<BR><BR>

	FAQ Version: (Ex.: v1.2, v0.1)<BR>
	<INPUT TYPE=text NAME=version SIZE=5>

	<BR><BR>

	Category for this entry: (Ex.:product, open-source, general)<BR>
	<INPUT TYPE=text NAME=category SIZE=20>

	<BR><BR>

	Set Visible/Invisible (Ex.: 0 => visible, 1 => invisible) IF blank, this will default to invisible<BR>
	<INPUT TYPE=text NAME=private SIZE=2>

	<INPUT TYPE=hidden NAME=timestamp VALUE=$timestamp>

	<BR><BR>

	<INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>
	
	");

  break;

  case 'rem_prod':

	$query = do_sql("SELECT product, description FROM products ORDER BY timestamp");

	print("<HTML><HEAD>
	
	<script language=\"javascript1.2\">
	<!--
	function confirmRemoval(productName) {
		if (confirm(\"Are you sure you want to completely remove this product from the database?\"))
		{
//			document.forms[productName].submit();
			return(true);
		}
		return(false);
	}
	//-->
	</script></HEAD><BODY>");

	print("Select which product you would like to remove:<BR><BR>\n");
	print("**********ONLY CLICK REMOVE IF YOU ARE SURE OF WHAT YOU ARE DOING!!!!**********<BR><BR>\n");

        while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;

		print("<FORM NAME=\"remove_$product\" ACTION=\"rem_prod.php3\" METHOD=\"post\" onSubmit=\"return confirmRemoval('remove_$product')\"> \n");

                print("<LI><A HREF=\"faq.php3?view=index&product=$product\">$description</A> ->\n");

		print("<INPUT TYPE=hidden NAME=product VALUE=$product>\n");

		print("<INPUT TYPE=submit VALUE=Remove></FORM>\n");

		print("</LI></BR>\n
		</BODY></HTML>\n");
        }

  break;

  case 'mod_prod':

        $query = do_sql("SELECT product, description FROM products ORDER BY timestamp");

        print("Select which product you would like to modify:<BR><BR>");

        while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;
                print("<LI><A HREF=\"mod_prod.php3?product=$product\">$description</A></LI></BR>");
        }

  break;

  case 'add_faq':


	print("Please select a product for which you would like to add an FAQ:<BR><BR>");

	print("<FORM ACTION=\"add_faq.php3\" METHOD=\"post\">\n");

	print("<SELECT NAME=product>\n");



	$query = do_sql("SELECT product, description FROM products ORDER BY product");

	print("<OPTION SELECTED VALUE=$product>$product");

        while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;
		print("<OPTION VALUE=$product>$description");

        }
	print("</SELECT>");


	/*
	$zooloo = do_sql("SELECT DISTINCT faq_cat from $product");

	print("<BR><BR>");
	print("<SELECT NAME=faq_cat>\n");

	{
		$faq_cat = $cat_list["faq_cat"];
		print("<OPTION VALUE=$faq_cat>$faq_cat");
	}
	print("</SELECT>");
	*/


	print("

	<BR><BR>
	Category: (Ex.: Install, Networking, Display, Sound, Input, et al)<BR>
        <INPUT TYPE=text NAME=faq_cat VALUE=$faq_cat SIZE=15>* No Spaces please

        <BR><BR>

        Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
        <INPUT TYPE=text NAME=faq_title SIZE=65>

        <BR><BR>

        FAQ Answer:<BR>
        <TEXTAREA name=faq_answer rows=20 cols=75 wrap=virtual></TEXTAREA>

        <BR><BR>

	<INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");

  break;

  case 'add_cat_faq':

	print("Here you can add a new Category and a new FAQ at the same time:<BR><BR>");

        print("<FORM ACTION=\"add_faq.php3\" METHOD=\"post\">\n");

        print("<SELECT NAME=product>\n");



        $query = do_sql("SELECT product, description FROM products ORDER BY product");

        print("<OPTION SELECTED VALUE=$product>$product");

        while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;
                print("<OPTION VALUE=$product>$description");

        }
        print("</SELECT>");


        /*
        $zooloo = do_sql("SELECT DISTINCT faq_cat from $product");

        print("<BR><BR>");
        print("<SELECT NAME=faq_cat>\n");

        {
                $faq_cat = $cat_list["faq_cat"];
                print("<OPTION VALUE=$faq_cat>$faq_cat");
        }
        print("</SELECT>");
        */


        print("

        <BR><BR>
        Category: (Ex.: Install, Networking, Display, Sound, Input, et al)<BR>
        <INPUT TYPE=text NAME=faq_cat SIZE=15>* No Spaces please

        <BR><BR>

        Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
        <INPUT TYPE=text NAME=faq_title SIZE=65>

        <BR><BR>

        FAQ Answer:<BR>
	<TEXTAREA name=faq_answer rows=20 cols=75 wrap=virtual></TEXTAREA>

        <BR><BR>

        <INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");

  break;

  case 'rem_faq':

	print("Please select a product and a FAQ ID to remove and individual FAQ:<BR><BR>");

        print("<FORM ACTION=\"rem_faq.php3\" METHOD=\"post\">\n");

        print("<SELECT NAME=product>\n");

        $query = do_sql("SELECT product, description FROM products ORDER BY product");

	print("<OPTION SELECTED VALUE=$product>$product");

        /*
	while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;
                print("<OPTION VALUE=$product>$description");

        }
	*/
        print("</SELECT>");

//        <INPUT TYPE=text NAME=faq_cat VALUE=$faq_cat SIZE=15> FAQ Id: (Ex.: 4)<BR>
//        <INPUT TYPE=text NAME=faq_id VALUE=$faq_id SIZE=5> FAQ Id: (Ex.: 4)<BR>

	print("
	<BR><BR>
	<B>Category:</B> $faq_cat
	<BR>
	<B>Faq Id:</B> $faq_id
	
	<BR><BR>");


	$query = "SELECT faq_id, faq_cat, faq_title, faq_answer FROM $product WHERE faq_id = '$faq_id' AND faq_cat = '$faq_cat'";
        $getFAQ = do_sql($query);
        $faq_info = @mysql_fetch_array($getFAQ);


        $faq_id = $faq_info["faq_id"];
        $faq_cat = $faq_info["faq_cat"];
        $faq_title = $faq_info["faq_title"];
        $faq_answer = $faq_info["faq_answer"];

	print("<B>FAQ Title:</B> $faq_title
	<BR>
	<B>Answer</B>:
	$faq_answer
	<BR><BR>

	Are you SURE you want to remove this FAQ?!?!?<BR>

	<INPUT TYPE=hidden NAME=faq_cat VALUE=$faq_cat>
	<INPUT TYPE=hidden NAME=faq_id VALUE=$faq_id>
        <INPUT TYPE=submit VALUE=Remove>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");

  break;

  case 'rem_cat':

	print("Here you will be able to remove a Category and it's respective FAQs:<BR><BR>");

        print("<FORM ACTION=\"rem_cat.php3\" METHOD=\"post\">\n");

        print("<SELECT NAME=product>\n");

        $query = do_sql("SELECT product, description FROM products ORDER BY product");

	print("<OPTION SELECTED VALUE=$product>$product");

        print("</SELECT>");

	print("
	<BR><BR>
	<B>Product:</B> $product
	<BR>
	<B>Category:</B> $faq_cat
	<BR>
	
	<BR><BR>

	Are you SURE you want to remove this ENTIRE category from $product?!?!?<BR>

	<INPUT TYPE=hidden NAME=faq_cat VALUE=$faq_cat>
        <INPUT TYPE=submit VALUE=Remove>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");

  break;

  case 'mod_faq':

	print("<FORM ACTION=\"mod_faq.php3\" METHOD=\"post\">\n");

        print("<SELECT NAME=product>\n");



        $query = do_sql("SELECT product, description FROM products ORDER BY product");

        while($product_list = @mysql_fetch_array($query))
        {
                list($product, $description) = $product_list;
                print("<OPTION VALUE=$product>$description");

        }
        print("</SELECT>");

        print("
        <BR><BR>
        <INPUT TYPE=text NAME=faq_cat SIZE=15> FAQ Category Id: (Ex.: Introduction)<BR>
        <INPUT TYPE=text NAME=faq_id SIZE=5> FAQ Id: (Ex.: 4)<BR>

        <BR><BR>

        <INPUT TYPE=submit VALUE=Modify>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");


  break;

  case 'move_cat_down':

	moveCatDown($product, $faq_cat);
	$HTTP_REFERER = getenv("HTTP_REFERER");

	print("<HTML><HEAD>
	<META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
	</HEAD><A HREF=\"$HTTP_REFERER\">Continue</A></HTML>");

  break;

  case 'move_cat_up':

        moveCatUp($product, $faq_cat);
        $HTTP_REFERER = getenv("HTTP_REFERER");

        print("<HTML><HEAD>
        <META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
        </HEAD><A HREF=\"$HTTP_REFERER\">Continue</A></HTML>");
            
  break;

  case 'move_faq_up':

        moveFaqUp($product, $faq_cat, $faq_id);
        $HTTP_REFERER = getenv("HTTP_REFERER");

        print("<HTML><HEAD>
        <META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
        </HEAD><A HREF=\"$HTTP_REFERER\">Continue</A></HTML>");

  break;

  case 'move_faq_down':

        moveFaqDown($product, $faq_cat, $faq_id);
        $HTTP_REFERER = getenv("HTTP_REFERER");

        print("<HTML><HEAD>
        <META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
        </HEAD><A HREF=\"$HTTP_REFERER\">Continue</A></HTML>");

  break;

  default:

	/* Start HTML */
        print("
        <BODY BGCOLOR=\"#ffffff\">
        <BR>
        Lost? Get the <A HREF=\"index.php3\"><B>FAQ Home</B></A> for instructions.   
        <P>
        /* End HTML */
	");

}
?>
