<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");

/* Note:
    This will steadfastly refuse to update stuff unless "really" is set to
    "yes".
     Consider this good or bad, It's just the way it goes */

switch ($command) {

  case 'add_prod':

	if ($really=="yes") {
		if(empty($product) || empty($description) || empty($introduction) || empty($version)) {
			errorPage("Please fill in all the fields");
		} else {
			$timestamp = date("YmdHis");
			$private=empty($private)?0:1;
			insertProduct($product, $description, $introduction, $version, $timestamp, $private);
			printHead("Product $product added");
			print("You have successfully added a product to the FAQ database. Good for you!
	<BR><BR>

	Product Reference Name: $product
	<BR><BR>

	Product Description: $description
	<BR><BR>

	Product FAQ Introduction:<BR>
	$introduction
	<BR><BR>

	Product Version: $version
	<BR><BR>

	Product Category: $category
	<BR><BR> ");

	if ($private) {
	print("Product is invisible to the general public!");
	}
	print("
	<BR><BR>

	Timestamp: $timestamp
	<BR><BR>
	<BR><BR>

	*You may now go ahead and add FAQs to the FAQ database for: $description
	<BR><BR>
	<BR><BR>
	
	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
	<A HREF=\"index.php3\">FAQ Index</A>");
	printTail();
		}
	} else {
		printHead("Add a product");
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">

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
	
		Set the checkbox to make the product NOT visible to the public<BR>
		<INPUT TYPE=checkbox NAME=private>

		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=add_prod>

		<BR><BR>

		<INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>
	
	");
		printTail();
	}


  break;

  case 'rem_prod':

	if($really=="yes") {
		remProd($product);
		printHead("Product removed");
		print("<H1>Product $product gone</H1>");
		print("<A HREF=\"index.php3\">Back to the index</A>");
		printTail();
	} else {
		printHead("Remove product");
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
		<H1>Product Name:  $product</H1><BR>
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=rem_prod>
		<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
		<BR><BR>
		If you REALLY REALLY REALLY wanna do this, hit Yes<BR>
		<INPUT TYPE=submit VALUE=\"     Yes     \"><BR>
		Otherwise, try going back <A HREF=\"./\">To the index</A><BR>
	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
		");
		printTail();
	}

  break;

  case 'mod_prod':

	if ($really=="yes") {
		$timestamp = date("YmdHis");
		modifyProduct($product_id, $product, $description, $introduction, $version, $timestamp, $private);
		printHead("Product Modified");
		print("You have successfully updated a product to the
		FAQ database. Good for you!
		<BR><BR>

		Product Reference Name: $product
		<BR><BR>

		Product Description: $description
		<BR><BR>

		Product FAQ Introduction:<BR>
		$introduction
		<BR><BR>

		Product Version: $version
		<BR><BR>

		Timestamp: $timestamp
		<BR><BR>

		Category: $category
		<BR><BR>

		Visibility Setting: $private
		<BR><BR>
		<BR><BR>

		<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
		<BR>
		<A HREF=\"index.php3\">FAQ Index</A>");
		printTail();

		
	} else {
		if (!empty($product)) {
			$row = getProduct($product);
			$product = $row["product"];
			$product_id = $row["product_id"];
			$description = $row["description"];
			$introduction = $row["introduction"];
			$version = $row["version"];
			$private = $row["private"];

			$product = ereg_replace("\"","&quot;",$product);
			$description = ereg_replace("\"","&quot;",$description);
			$version = ereg_replace("\"","&quot;",$version);

		} else {
			errorPage("Please specify a product");
		}
	printHead("Modify product $product");
	print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">

	Product Reference Name: (Ex.: SMAC, SoF, SC3K)<BR>
	<INPUT TYPE=text NAME=product VALUE=\"$product\" SIZE=\"15\">

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

	FAQ visibility: (Ex.: 0 => visible, 1 => invisible)
	<INPUT TYPE=text NAME=private VALUE=\"$private\" SIZE=3>
 
	<BR><BR>

	<INPUT TYPE=hidden NAME=really VALUE=yes>
	<INPUT TYPE=hidden NAME=product_id VALUE=$product_id>
	<INPUT TYPE=hidden NAME=command VALUE=mod_prod>

	<BR><BR>

	<INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>
	</FORM>
	");
	}
		

  break;


  case 'add_cat':

	if ($really=="yes") {
		if(empty($category)) {
			errorPage("Please fill in all the fields");
		} else {
			insertCategory($product, $category);
			printHead("Category $category added");
			print("You have successfully added category $category to Product $product. Good for you.
	<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>
	<A HREF=\"index.php3\">FAQ Index</A>");
	printTail();
		}
	} else {
		printHead("Add a category");
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
		<H1>Add a category to Product:  $product</H1><BR>
		
		<INPUT TYPE=text NAME=category SIZE=20>
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=add_cat>
		<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
		<BR><BR>
	<INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>
		</FORM> ");
		printTail();
	}

  break;

  
  case 'rem_cat':

	if($really=="yes") {
		if (empty($cat_name)) {
			errorPage("Please fill in the fields");
		} else {
			/*$cat_name=getCatName($cat_id); */
			remCat($product,$cat_name);
			print("You have successfully removed the following
			category and its FAQs:
			<U><I>$product: $cat_name</U></I> from the FAQ database.
			<BR><BR>
		
			You are now either a hero, or truly screwed. Good Luck!
			<BR><BR>
			<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>
			<A HREF=\"index.php3\">FAQ Index</A>");
			printTail();
		}
	} else {
		
		printHead("Remove Category");
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
		<H1>Category: $cat_name</H1>
		<H2>Product Name:  $product</H2><BR>
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=rem_cat>
		<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
		<INPUT TYPE=hidden NAME=cat_name VALUE=\"$cat_name\">
		<BR><BR>
		If you REALLY REALLY REALLY wanna do this, hit Yes<BR>
		<INPUT TYPE=submit VALUE=\"     Yes     \"><BR>
		Otherwise, try going back <A HREF=\"./\">To the index</A>
		");
		printTail();
	}


  break;

  case 'mod_cat':

	if($really=="yes") {
		if (empty($new_cat_name) || empty($cat_id)) {
			errorPage("Please fill in the fields");
		} else {
			modifyCat($cat_id,$new_cat_name);
			printHead("Success");
			print("You have successfully updated a product
			category to the FAQ database. Good for you!
	<BR><BR>

	Old Product Category Name: $old_cat_name
	<BR><BR>

	New Product Category Name: $new_cat_name
	<BR><BR>

	<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>
	<A HREF=\"index.php3\">FAQ Index</A>");
			printTail();
		}
	} else {
		$cat_id=getCatId($product,$cat_name);
		$cat_name = ereg_replace("\"","&quot;",$cat_name);
		printHead("Update / Modify Category Form");
	print("Update / Modify Category Form");

	print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">

	<B>Old</B> Product Category Name: <B>$cat_name</B><BR><BR>
	<INPUT TYPE=hidden NAME=old_cat_name VALUE=\"$cat_name\">

	<B>New</B> Product Category Name: (Ex.: Installation, Introduction, Disp
lay)<BR>
	<INPUT TYPE=text NAME=new_cat_name SIZE=25>

	<INPUT TYPE=hidden NAME=cat_id VALUE=\"$cat_id\">
	<INPUT TYPE=hidden NAME=really VALUE=yes>
	<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
	<INPUT TYPE=hidden NAME=command VALUE=mod_cat>

	<BR><BR>

	<INPUT TYPE=submit VALUE=Update>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>

	");
		printTail();

	}


  break;

  case 'add_faq':

	if($really=="yes") {
		insertFAQ($product,$category,$question,$answer,"Chunky");
		printHead("FAQ Inserted");
		print("You have successfully added a FAQ to the database. Good for you!
	<BR><BR>

	Product Reference Name: $product
	<BR><BR>

	FAQ Category: $category
	<BR><BR>

	FAQ Question (FAQ): $question
	<BR><BR>

	FAQ Answer:<BR>
	$answer
	<BR><BR>
	<BR><BR>

	*You may now go ahead and view this newly added FAQ for: $product
	<BR><BR>
	<BR><BR>

	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
	<BR>
	<A HREF=\"index.php3\">FAQ Index</A>");
	printTail();
	} else {
		printHead("Add a FAQ");
		print("<H1>Adding to product $product</H1>");
		print("<H2>Adding to category $category</H2>");
		print("<FORM ACTION=\"maintain.php3\" METHOD=\"post\">\n");
		print("
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=add_faq>
		<INPUT TYPE=hidden NAME=product VALUE=\"$product\">
		<INPUT TYPE=hidden NAME=category VALUE=\"$category\">
		");
		print("Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
	<INPUT TYPE=text NAME=question SIZE=65>

	<BR><BR>

	FAQ Answer:<BR>
	<TEXTAREA name=answer rows=20 cols=75 wrap=virtual></TEXTAREA>
		<BR><BR>
	<INPUT TYPE=submit VALUE=Add>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset V
ALUE=Clear>");

	}

  break;

  case 'rem_faq':

	if($really=="yes") {
		remFAQ($faq_id);
		printHead("FAQ removed");
		print("<H1>FAQ gone<H1>");
	print("<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>");
		print("<A HREF=\"index.php3\">Back to the index</A>");
		printTail();
	} else {
		printHead("Remove faq");
		$row = getFaq($faq_id);
		$faq_question = $row["faq_question"];
		$faq_answer = $row["faq_answer"];
		$cat_name = getCatName($row["faq_cat"]);
		$product = getProductName($row["faq_prod"]);
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
		<H1>Product:  $product</H1><BR>
		<H2>Category:  $cat_name</H2>
		<H3>Question: $faq_question</H3>
		<P>Answer: $faq_answer</P>
		
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=rem_faq>
		<INPUT TYPE=hidden NAME=product VALUE=$product>
		<INPUT TYPE=hidden NAME=faq_id VALUE=$faq_id>
		<BR><BR>
		If you REALLY REALLY REALLY wanna delete this FAQ, hit Yes<BR>
		<INPUT TYPE=submit VALUE=\"     Yes     \"><BR>
		Otherwise, try going back <A HREF=\"./\">To the index</A>
		");
		printTail();
	}

  break;

  case 'mod_faq':

	if($really=="yes") {
		modifyFAQ($faq_id,$answer,$question,$new_cat_id);
		printHead("FAQ Modified");
		$answer = insertMarkup(removeMarkup($answer));
		print("<H1>The FAQ NOW reads:</H1>");
		print("<H3>Question: $question</H3>");
		print("<P>Answer: $answer</P><BR><BR>");
	print("<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>");
		print("<A HREF=\"index.php3\">Back to the index</A>");
	} else {
		printHead("Modify FAQ");
		$faq = getFaq($faq_id);
		$current_cat = $faq["faq_cat"];
		$current_question = $faq["faq_question"];
		$current_answer = $faq["faq_answer"];

		$allcats = getCategories($product);
		print ("<H2>Current product: $product</H2>");
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">");
		print ("<BR>New Category: <SELECT NAME=new_cat_id>");
		while ($category = @mysql_fetch_array($allcats)) {
			$cat_id = $category["cat_id"];
			$cat_name = $category["cat_name"];
			if ($cat_id == $current_cat) {
				print("<OPTION SELECTED VALUE=$cat_id>$cat_name");
			} else {
				print("<OPTION VALUE=$cat_id>$cat_name");
			}
		}
		print("</SELECT><BB><BR><BR>\n");
		print("<INPUT TYPE=hidden NAME=really VALUE=yes>
			<INPUT TYPE=hidden NAME=command VALUE=mod_faq>
			<INPUT TYPE=hidden NAME=product VALUE=$product>
			<INPUT TYPE=hidden NAME=faq_id VALUE=$faq_id>");

		$current_question=ereg_replace("\"","&quot;",$current_question);
		print("Question: (Ex.: Why doesn't my Linux game work in Windows??)<BR>
	<INPUT TYPE=text NAME=question VALUE=\"$current_question\" SIZE=65>

	<BR><BR>

	FAQ Answer:<BR>
	<TEXTAREA name=answer rows=20 cols=75 wrap=virtual>$current_answer</TEXTAREA>
		<BR><BR>
	<INPUT TYPE=submit VALUE=Modify>&nbsp;&nbsp;&nbsp;&nbsp;<INPUT TYPE=reset VALUE=Clear>");  
	}

  break;

  case 'move_cat':
	if($really=="yes") {
		switch ($direction) {
			case 'up':
				moveCatUp($cat_id);
			break;
			case 'down':
				moveCatDown($cat_id);
			break;
		}
		$HTTP_REFERER = getenv("HTTP_REFERER");
		print("<HTML><HEAD>
		<META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
		</HEAD><BODY><A HREF=\"$HTTP_REFERER\">Continue</A>
		</BODY></HTML>");
	} else {
		lost();
	}
  break;

  case 'move_faq':
	if($really=="yes") {
		switch ($direction) {
			case 'up':
				$cat_id=getCatId($product,$category);
				moveFAQUp($faq_id,$cat_id);
			break;
			case 'down':
				$cat_id=getCatId($product,$category);
				moveFAQDown($faq_id,$cat_id);
			break;
		}
		$HTTP_REFERER = getenv("HTTP_REFERER");
		print("<HTML><HEAD>
		<META HTTP-EQUIV=\"REFRESH\" CONTENT = \"0; URL=$HTTP_REFERER\">
		</HEAD><BODY><A HREF=\"$HTTP_REFERER\">Continue</A>
		</BODY></HTML>");
	} else {
		lost();
	}
  break;

  default:

	/* Start HTML */
	lost();

}
?>
