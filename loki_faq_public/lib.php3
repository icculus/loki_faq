<?

function dbConnect()
{
	$user = "";
	$pass = "";
	$server = "localhost";
	$connection = mysql_connect($server, $user, $pass);

	return $connection;
}

function dbDisconnect($connection)
{
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
	$db = "faqs";

	$connection = dbConnect();
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

/* Used to grab product name, description, introduction, version#, timestamp */
function getProduct ($product)
{
	/* Connect to the database, and setup our SQL statement */
	$db = "faqs";
	$SQL = "SELECT DISTINCT * FROM products WHERE product = '$product'";

	$connection = dbConnect();
	if (! $connection ) {
		return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
	}

	/* Run the query */
	$query = mysql_db_query($db, $SQL, $connection);
	if (! $query ) {
		return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
	}

	/* Fetch the result */
	$row = @mysql_fetch_array($query);

	return ($row);
	dbDisconnect($connection);
}

/* Used for listing all FAQs */
function getIndex($product)
{
	/* Connect to the database, and setup our SQL statement */
        $db = "faqs";
	$SQL = "SELECT faq_cat, faq_id, faq_title ";
	$SQL .= "FROM $product where product = '$product' ORDER BY faq_id";

        $connection = dbConnect();
        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

        /* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

	return $query;

	dbDisconnect($connection);
}

/* Used for grabbing FAQs By their category */
function getIndexByCat($product, $category)
{
        /* Connect to the database, and setup our SQL statement */
        $db = "faqs";
        $SQL = "SELECT faq_cat, faq_id, faq_title, faq_notes ";
        $SQL .= "FROM $product where product = '$product' AND faq_cat = '$category' ORDER BY faq_id";

        $connection = dbConnect();
        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

        /* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

        return $query;

        dbDisconnect($connection);
}

/* Used to display an individual FAQ */
function getFaq($product, $faq_notes, $faq_id)
{
        /* Connect to the database, and setup our SQL statement */
        $db = "faqs";
        $SQL = "SELECT product, faq_cat, faq_id, faq_title, faq_answer, faq_notes ";
	$SQL .= "FROM $product WHERE product = '$product' AND faq_id = '$faq_id' AND faq_notes = '$faq_notes'";

        $connection = dbConnect();
        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

        /* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

        /* Fetch the result */
        $answer = @mysql_fetch_array($query);

        return ($answer);
        dbDisconnect($connection);
}

function catCheck ($product, $faq_cat)
{
	/* Connect to the database, and setup our SQL statement */
        $db = "faqs";
	$SQL = "SELECT DISTINCT faq_cat from $product where faq_cat = '$faq_cat'";

	$connection = dbConnect();
        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

        /* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

        /* Fetch the result */
        $answer = @mysql_fetch_array($query);

        return ($answer);
        dbDisconnect($connection);
}

function faqCheck ($product, $faq_cat)
{
	/* Connect to the database, and setup our SQL statement */
        $db = "faqs";

	/* This SQL gives us the ID ($faq_notes) of the category in question */
        $SQL = "SELECT DISTINCT faq_notes FROM $product WHERE faq_cat = '$faq_cat'";

        $connection = dbConnect();
        if (! $connection ) {
                return_error_exit("Could not connect to the database:<BR><B>$connection</B>");
        }

	/* Run the query */
        $query = mysql_db_query($db, $SQL, $connection);
        if (! $query ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
        }

        /* Fetch the result */
        $answer = @mysql_fetch_array($query);

	/* Assign $faq_notes from $answer */
	$faq_notes = $answer["faq_notes"];

	/* This SQL2 gives us the next available faq_id within the category (faq_notes) */
	$SQL2 = "SELECT faq_id FROM $product WHERE faq_notes = '$faq_notes' ORDER BY faq_id";
	
	/* Run the query2 */
        $query2 = mysql_db_query($db, $SQL2, $connection);
        if (! $query2 ) {
                return_error_exit("SQL Execution failed while processing:<BR><B>$query2</B>");
        }

	 /* Fetch the new result */
        while($answer2 = @mysql_fetch_array($query2))
	{
		/* this would be the last faq_id of the faq_cat */
		$faq_id = $answer2["faq_id"];
	}

	$faq_id++;
	$next_faq_id = $faq_id;

	return ($next_faq_id);
        dbDisconnect($connection);
}

/* a simple mysql_num_rows counter */
function next_id ($query) {

	$result = do_sql($query);

  	if (! $result )
	{
		return_error_exit("SQL Execution failed while processing:<BR><B>$query</B>");
	}

	$next_id = @mysql_num_rows($result);
	$next_id++;

	return ($next_id);

}

/* Used to check for odd values in strings */
function checkStr($string)
{
        if ( ereg("([!#$%^&*()`~<>,?|;:'\"+=])", $string) ) {
                print "Invalid Charactuer Input ( !#$%^&*()`~<>,?|;:'\" ).";
                print("It appears you have entered characters which are not allowed. ");
                print("Please return and fix them.<br>");
                exit;
        }

}

?>
