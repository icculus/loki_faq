<?

/* Global Variables */


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
	$input_text = preg_replace("/\[CODE\](.*)\[\/CODE\]/","<PRE>$1</PRE>\n",$input_text);
	return($input_text);
}

function characterMarkup($input_text)
{
	$input_text = ereg_replace("\"","&quot;",$input_text);
	return($input_text);
}

?>
