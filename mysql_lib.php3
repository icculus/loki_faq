<?

/* Global Variables */


$user="faqs";
$pass = "faqs";
/* $server="" Uses socket */
$server = "";
$db = "faqs";
/* If you're below 3.23.23, we use a different algorithm for searching */
$mysql_major = "3";
$mysql_minor = "23";
$mysql_patch = "53";

/* Persistent connection */
$connection;

/* Warning on the database philosophy used here:
     Nothing is munged before it goes into the database. Everything is
       kept virgin until it comes to be rendered. Consider that a bad or
       a good thing, I'm doing that by design because I like to keep ALL
       data then lose irrelevant bits later. */


function dbConnect()
{
	global $user, $pass, $server,$connection;
	$connection = mysql_pconnect($server, $user, $pass);
}

function dbDisconnect($connection)
{
	global $connection;
	mysql_close($connection);
}

function return_error_exit($err_msg)
{
	$errno = mysql_errno();
	$error = mysql_error();
	print("<HTML><HEAD><TITLE>Error</TITLE></HEAD><BODY>");
	print("<BR><P><H3>$err_msg</H3></P>");
	print("<BR><P>Error: ($errno) $error</P><BR></BODY></HTML>");
	exit();

}

/* Used to run any SQL query */
function do_sql ($SQL)
{
	global $db,$connection;

	/* If PHP is doing anything extremely cool with persistent
	connections... */
	if (! $connection ) { dbConnect(); };

        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

        /* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

	return($query);
}


function insertProduct($product_name, $description, $introduction, $private)
{
	$SQL = "INSERT INTO products (product, description, introduction, private)";
	$SQL .= " VALUES ('$product_name','$description','$introduction','$private');";
	$query = do_sql($SQL);
	$product_id = mysql_insert_id();
	return($product_id);
}

function getProductId($product_name)
{
	$SQL = "SELECT product_id FROM products WHERE product='$product_name' AND deleted='0';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result["product_id"]);
}

function insertCategory($product,$category_name)
{
	$prod_id = getProductId($product);
	$SQL = "INSERT INTO categories (product_id,cat_name)";
	$SQL .= " VALUES ('$prod_id','$category_name');";
	$query = do_sql($SQL);

	$cat_id = mysql_insert_id();

	$SQL = "UPDATE categories SET cat_order='$cat_id' where cat_id='$cat_id';";
	$query = do_sql($SQL);
}

function getCatId($product,$category)
{
	$prod_id = getProductId($product);
	$SQL = "SELECT cat_id FROM categories WHERE product_id='$prod_id' AND cat_name='$category' AND deleted='0';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result["cat_id"]);
}

function insertFAQ($product,$category,$question,$answer,$added_by)
{
	$prod_id = getProductId($product);
	$cat_id = getCatId($product,$category);

	$SQL = "INSERT INTO faqs (faq_cat, faq_prod, faq_question, faq_answer, added_by)";
	$SQL .= " VALUES ('$cat_id', '$prod_id', '$question', '$answer', '$added_by');";
	$query = do_sql($SQL);
	
	$faq_id = mysql_insert_id();

	$SQL = "UPDATE faqs SET faq_order='$faq_id' where faq_id='$faq_id';";
	$query = do_sql($SQL);
	return($faq_id);
}

function getCatById($cat_id)
{
	$SQL = "SELECT * FROM categories WHERE cat_id='$cat_id';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result);
}

function getProductById($prod_id)
{
	$SQL = "SELECT * FROM products WHERE product_id='$prod_id';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result);
}

/* Used for getting into on one product */
function getProduct($product)
{
	$SQL = "SELECT * FROM products WHERE product='$product';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result);
}

function getDeletedFaqs($product_id)
{
	$SQL = "SELECT * FROM faqs WHERE deleted='1' AND faq_prod='$product_id';";
	$query = do_sql($SQL);
	return($query);
}

function getDeletedCategories($product_id)
{
	$SQL = "SELECT * FROM categories WHERE deleted='1' AND product_id='$product_id';";
	$query = do_sql($SQL);
	return($query);
}

function getDeletedProducts()
{
	$SQL = "SELECT * FROM products WHERE deleted='1';";
	$query = do_sql($SQL);
	return($query);
}

/* Used for listing all products */
function getProducts()
{
	$SQL = "SELECT * FROM products WHERE deleted='0' ORDER BY product_id;";
	$query = do_sql($SQL);
	return($query);
}

function getCategory($cat_id)
{
	$SQL = "SELECT * FROM categories WHERE cat_id='$cat_id' AND deleted='0';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result);
}

/* Used for listing all categories on a product */
function getCategories($product)
{
	$prod_id = getProductId($product);
	$SQL = "SELECT * FROM categories WHERE product_id='$prod_id' AND deleted='0' ORDER BY cat_order;";
	$query = do_sql($SQL);
	return($query);
}

/* Used for listing all FAQs */
function getIndex($product)
{
	$prod_id = getProductId($product);
	$SQL = "SELECT * FROM faqs WHERE faq_prod='$prod_id' AND deleted='0' ORDER BY faq_order;";
	$query = do_sql($SQL);
	return($query);
}

/* Used for grabbing FAQs By their category */
function getIndexByCat($product, $category)
{
	$prod_id = getProductId($product);
	$cat_id = getCatId($product,$category);
	$SQL = "SELECT * FROM faqs WHERE faq_prod='$prod_id' AND faq_cat='$cat_id' AND deleted='0' ORDER BY faq_order;";
	$query = do_sql($SQL);
	return($query);
}

/* Used to display an individual FAQ */
function getFaq($faq_id)
{
	$SQL = "SELECT * FROM faqs WHERE faq_id='$faq_id';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result);
}

function getProductName($product_id)
{
	$SQL = "SELECT product FROM products WHERE product_id='$product_id';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result["product"]);
}

function getCatName($cat_id)
{
	$SQL = "SELECT cat_name FROM categories WHERE cat_id='$cat_id';";
	$query = do_sql($SQL);
	$result = @mysql_fetch_array($query);
	return($result["cat_name"]);
}

function reallyRemProd($product_id)
{
	$SQL = "SELECT deleted FROM products WHERE product_id='$product_id';";
	$query = do_sql($SQL);
	$prod = @mysql_fetch_array($query);
	if($prod["deleted"] == "0") {
		errorPage("Please delete this product before attempting to permanantly remove it!");
	}
	$SQL = "DELETE FROM faqs WHERE faq_prod='$product_id';";
	do_sql($SQL);
	$SQL = "DELETE FROM categories WHERE product_id='$product_id';";
	do_sql($SQL);
	$SQL = "DELETE FROM products WHERE product_id='$product_id';";
	do_sql($SQL);
}

function reallyRemCat($cat_id)
{
	$SQL = "SELECT deleted FROM categories WHERE cat_id='$cat_id';";
	$query = do_sql($SQL);
	$cat = @mysql_fetch_array($query);
	if($cat["deleted"] == "0") {
		errorPage("Please delete this category before attempting to permanantly remove it!");
	}
	$SQL = "DELETE FROM faqs WHERE faq_cat='$cat_id';";
	do_sql($SQL);
	$SQL = "DELETE FROM categories WHERE cat_id='$cat_id';";
	do_sql($SQL);
}

function reallyRemFaq($faq_id)
{
	$SQL = "SELECT deleted FROM faqs WHERE faq_id='$faq_id';";
	$query = do_sql($SQL);
	$faq = @mysql_fetch_array($query);
	if($faq["deleted"] == "0") {
		errorPage("Please delete this FAQ before attempting to permanantly remove it!");
	}
	$SQL = "DELETE FROM faqs WHERE deleted='1' AND faq_id='$faq_id';";
	do_sql($SQL);
}

function undeleteProd($prod_id)
{
	$SQL = "UPDATE products SET deleted='0' WHERE product_id='$prod_id';";
	do_sql($SQL);
}

function undeleteCat($cat_id)
{
	$SQL = "UPDATE categories SET deleted='0' WHERE cat_id='$cat_id';";
	do_sql($SQL);
}

function undeleteFaq($faq_id)
{
	$SQL = "UPDATE faqs SET deleted='0' WHERE faq_id='$faq_id';";
	do_sql($SQL);
}

function remProd($product)
{
	$SQL = "UPDATE products SET deleted='1' WHERE product='$product';";
	do_sql($SQL);
}

function remCat($product,$cat_name)
{
	$cat_id = getCatId($product,$cat_name);
	$SQL = "UPDATE categories SET deleted='1' WHERE cat_id='$cat_id';";
	do_sql($SQL);
}

function remFAQ($faq_id)
{
	$SQL = "UPDATE faqs SET deleted='1' WHERE faq_id='$faq_id';";
	do_sql($SQL);
}

function modifyCat($cat_id,$new_cat_name)
{
	$SQL = "UPDATE categories SET cat_name='$new_cat_name' WHERE cat_id='$cat_id';";
	do_sql($SQL);
}

function modifyFAQ($faq_id,$new_answer,$new_question,$new_cat_id)
{
	$SQL = "UPDATE faqs SET faq_answer='$new_answer',faq_question='$new_question',faq_cat='$new_cat_id' WHERE faq_id='$faq_id';";
	do_sql($SQL);
}

function modifyProduct($product_id,$new_name,$new_description,$new_introduction,$new_private)
{
	$SQL = "UPDATE products SET product='$new_name',description='$new_description',introduction='$new_introduction',private='$new_private' WHERE product_id='$product_id';";
	do_sql($SQL);
}

function swapFAQs($faq_id1, $faq_id2)
{
	$faq1 = getFaq($faq_id1);
	$faq2 = getFaq($faq_id2);
	$faq1_order = $faq1["faq_order"];
	$faq2_order = $faq2["faq_order"];
	$SQL = "UPDATE faqs SET faq_order='$faq1_order' WHERE faq_id='$faq_id2';";
	do_sql($SQL);

	$SQL = "UPDATE faqs SET faq_order='$faq2_order' WHERE faq_id='$faq_id1';";
	do_sql($SQL);
}

function swapCats($cat_id1, $cat_id2)
{
	$cat1 = getCategory($cat_id1);
	$cat2 = getCategory($cat_id2);
	$cat1_order = $cat1["cat_order"];
	$cat2_order = $cat2["cat_order"];

	$SQL = "UPDATE categories SET cat_order='$cat1_order' WHERE cat_id='$cat_id2';";
	do_sql($SQL);

	$SQL = "UPDATE categories SET cat_order='$cat2_order' WHERE cat_id='$cat_id1';";
	do_sql($SQL);
}

function moveCatUp($cat_id)
{
	$cat = getCategory($cat_id);
	$cat_order = $cat["cat_order"];

	$SQL = "SELECT cat_id FROM categories WHERE cat_order<'$cat_order' ORDER BY cat_order DESC LIMIT 1;";
	$query = do_sql($SQL);
	if(mysql_num_rows($query) < 1) { return; }
	$result = @mysql_fetch_array($query);
	swapCats($cat_id,$result["cat_id"]);
}

function moveCatDown($cat_id)
{
	$cat = getCategory($cat_id);
	$cat_order = $cat["cat_order"];

	$SQL = "SELECT cat_id FROM categories WHERE cat_order>'$cat_order' ORDER BY cat_order ASC LIMIT 1;";
	$query = do_sql($SQL);
	if(mysql_num_rows($query) < 1) { return; }
	$result = @mysql_fetch_array($query);
	swapCats($cat_id,$result["cat_id"]);
}

function moveFAQUp($faq_id,$cat_id)
{
	$faq = getFaq($faq_id);
	$faq_order = $faq["faq_order"];

	$SQL = "SELECT faq_id FROM faqs WHERE faq_order<'$faq_order' AND faq_cat='$cat_id' ORDER BY faq_order DESC LIMIT 1;";
	$query = do_sql($SQL);
	if(mysql_num_rows($query) < 1) { return; }
	$result = @mysql_fetch_array($query);
	swapFAQs($faq_id,$result["faq_id"]);
}

function moveFAQDown($faq_id,$cat_id)
{
	$faq = getFaq($faq_id);
	$faq_order = $faq["faq_order"];

	$SQL = "SELECT faq_id FROM faqs WHERE faq_order>'$faq_order' AND faq_cat='$cat_id' ORDER BY faq_order ASC LIMIT 1;";
	$query = do_sql($SQL);
	if(mysql_num_rows($query) < 1) { return; }
	$result = @mysql_fetch_array($query);
	swapFAQs($faq_id,$result["faq_id"]);
}

?>
