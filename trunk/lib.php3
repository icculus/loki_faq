<?

/* Propagate variable names into the namespace, if we're not using
      register globals */

if (ini_get('register_globals')!='on')
{
	$namearray =  array(
		"product",
		"faq_id",
		"product_id",
		"view",
		"faq_cat",
		"q");

	foreach($namearray as $name)
	{
		$associativearray[$name]=$_REQUEST[$name];
	}
	extract($associativearray);
}


function removeMarkup($input_text)
{
	$input_text = ereg_replace("&","&amp;",$input_text);
	$input_text = ereg_replace("<","&lt;",$input_text);
	$input_text = ereg_replace(">","&gt;",$input_text);
	return($input_text);
}

function insertMarkup($input_text)
{
	$input_text = ereg_replace("\r\n","<BR>",$input_text);
	$input_text = ereg_replace("\r","<BR>",$input_text);
	$input_text = ereg_replace("\n","<BR>",$input_text);
	$input_text = preg_replace("/\[CODE\](.*)\[\/CODE\]/msi","<PRE>$1</PRE>\n",$input_text);
	$input_text = preg_replace("/\[LINK=(.*)\](.*)\[\/LINK\]/","<A HREF=\"$1\">$2</A>\n",$input_text);
	return($input_text);
}

function characterMarkup($input_text)
{
	$input_text = ereg_replace("\"","&quot;",$input_text);
	return($input_text);
}

?>
