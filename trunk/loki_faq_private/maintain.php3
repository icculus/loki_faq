<?
include("../lib.php3");
include("../mysql_lib.php3");
include("../branding.php3");
include("./forms.php3");


/* Propagate variable names into the namespace, if we're not using
      register globals */

if (ini_get('register_globals')!='on')
{
	$administrativenamearray =  array(
		"command",
		"really",
		"direction",
		"cat_id",
		"cat_name",
		"new_cat_name",
		"description",
		"introduction",
		"private",
		"timestamp",
		"product_id",
		"new_cat_id",
		"category",
		"question",
		"answer");

	foreach($administrativenamearray as $name)
	{
		$associativearray[$name]=$_REQUEST[$name];
	}
	extract($associativearray);
}



/* Note:
    This will steadfastly refuse to update stuff unless "really" is set to
    "yes".
     Consider this good or bad, It's just the way it goes */

switch ($command) {

  case 'add_prod':

	if ($really=="yes") {
		if(empty($product) || empty($description) || empty($introduction)) {
			errorPage("Please fill in all the fields");
		} else {
			$private=empty($private)?0:1;
			$product_id = insertProduct($product, $description, $introduction, $private);
			printHead("Product $product added");
			print("You have successfully added a product to the FAQ database. Good for you!

	You may now go ahead and add FAQs to the FAQ database for: $description
	<BR><BR>
	
	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>
	<A HREF=\"index.php3\">FAQ Index</A>");
	printTail();
		}
	} else {
		printHead("Add a product");
		addProductForm();
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
		$prod = getProductById($product_id);
		if ($prod["timestamp"] > $timestamp)
		{
			$new["product"] = $product;
			$new["description"] = $description;
			$new["introduction"] = $introduction;
			printHead("Error");
			modifyProductForm($product_id,$new);
			printTail();
		} else {
			modifyProduct($product_id, $product, $description, $introduction, $private);
			printHead("Product Modified");
			print("You have successfully updated a product to the
			FAQ database. Good for you!<BR><BR>

			<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
			<BR>
			<A HREF=\"index.php3\">FAQ Index</A>");
			printTail();
		}

		
	} else {
		if (!empty($product)) {
			$product_id = getProductId($product);
		} else {
			errorPage("Please specify a product");
		}
		printHead("Modify product $product");
		modifyProductForm($product_id,$new);
		printTail();
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
		addCatForm($product);
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
			printHead("Category $cat_name Removed");
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
			$cat = getCatById($cat_id);
			$new_timestamp = $cat["timestamp"];
			if ($new_timestamp > $timestamp)
			{
				$new["cat_name"]=$new_cat_name;
				printHead("Error");
				modifyCatForm($cat_id,$new);
				printTail();
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
		}
	} else {
		$cat_id=getCatId($product,$cat_name);
		printHead("Modify a Category");
		modifyCatForm($cat_id,$new);
		printTail();

	}


  break;

  case 'add_faq':

	if($really=="yes") {
		$faq_id = insertFAQ($product,$category,$question,$answer,"Chunky");
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

	*You may now go ahead and view this newly added FAQ for: $product
	<BR><BR>
	<BR><BR>

<A HREF=\"./maintain.php3?command=mod_faq&faq_id=$faq_id&product=$product\">I made a mistake. Can I correct it?</A><BR><BR>
	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A>
	<BR>
	<A HREF=\"index.php3\">FAQ Index</A>");
	printTail();
	} else {
		printHead("Add a FAQ");
		addFaqForm($product,$category);
		printTail();
	}

  break;

  case 'rem_faq':
	if($really=="yes") {
		remFAQ($faq_id);
		printHead("FAQ removed");
		print("<H1>FAQ gone</H1>
	<A HREF=\"faq.php3?view=index&product=$product\">$product Index</A><BR>
		<A HREF=\"index.php3\">Back to the index</A>");
		printTail();
	} else {
		printHead("Remove faq");
		$row = getFaq($faq_id);
		$faq_question = $row["faq_question"];
		$faq_answer = $row["faq_answer"];
		$cat_name = getCatName($row["faq_cat"]);
		$product = getProductName($row["faq_prod"]);
		print("<FORM ACTION=\"./maintain.php3\" METHOD=\"post\">
		<H1>Remove a faq</H1>
		<TABLE BORDER=\"0\">
		<TR><TD>Product:</TD><TD>$product</TD></TR>
		<TR><TD>Category:</TD><TD>$cat_name</TD></TR>
		<TR><TD>Question:</TD><TD>$faq_question</TD></TR>
		<TR><TD>Answer:</TD><TD>$faq_answer</TD></TR>
		</TABLE>
		
		<INPUT TYPE=hidden NAME=really VALUE=yes>
		<INPUT TYPE=hidden NAME=command VALUE=rem_faq>
		<INPUT TYPE=hidden NAME=product VALUE=$product>
		<INPUT TYPE=hidden NAME=faq_id VALUE=$faq_id>
		<BR><BR>
		If you REALLY REALLY REALLY wanna delete this FAQ, hit Yes, otherwise hit back in your browser<BR>
		<INPUT TYPE=submit VALUE=\"     Yes     \"><BR>
		");
		printTail();
	}

  break;

  case 'mod_faq':

	if($really=="yes") {
		$faq = getFaq($faq_id);
		$new_timestamp = $faq["timestamp"];
		if ($new_timestamp > $timestamp)
		{
			printHead("Modify FAQ");
			$new["faq_question"] = $question;
			$new["faq_answer"] = $answer;
			$new["faq_cat"] = $new_cat_id;
			modifyFaqForm($faq_id,$new);
			printTail();
		} else {
			modifyFAQ($faq_id,$answer,$question,$new_cat_id);
			printHead("FAQ Modified");
		$answer = insertMarkup(removeMarkup($answer));
		print("<H1>The FAQ NOW reads:</H1>
			<TABLE BORDER=\"0\">
			<TR><TD><B>Question:</B></TD><TD>$question</TD></TR>
			<TR><TD VALIGN=\"top\"><B>Answer:</B></TD><TD>$answer</TD></TR>
			</TABLE>
<A HREF=\"./maintain.php3?command=mod_faq&faq_id=$faq_id&product=$product\">I made a mistake. Can I correct it?</A><BR><BR>
	<A HREF=\"faq.php3?view=index&product=$product\">
		$product Index</A><BR>");
		}
	} else {
		printHead("Modify FAQ");
		modifyFaqForm($faq_id,$new);
		printTail();
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
