<?
include("lib.php3");

        /* Start HTML */
        print("
        <BODY BGCOLOR=\"#ffffff\">
        <A HREF=\"index.php3\">$product FAQ Index</A>

        <P>
	<TABLE COLS=\"1\" BORDER=\"0\" CELLSPACING=\"4\" CELLPADDING=\"5\">
	<TR>
	  <TD COLSPAN=\"2\" WIDTH=\"100%\" BGCOLOR=\"#99CCFF\" ALIGN=\"CENTER\">
          <B><FONT COLOR=\"#000000\" SIZE=\"+1\">FAQList Administration Tool</FONT></B>
	  </TD>
	<TR>
	<TD>
          <P>
	  <HR>
          <EM>Here you will able to Add, Delete and Modify FAQs and Products for the FAQs</EM>
          <HR>
          <P>
	</TD>
	</TR>
	</TR>

	<TR>
	  <TD COLSPAN=\"2\" WIDTH=\"100%\" BGCOLOR=\"#FFF0D0\">
	  <B><FONT COLOR=\"#000000\">I. Product Tools</FONT></B>
	  </TD>
	<TR>
	<TD>
	  <UL>
	  <P>
	  <LI><A HREF=\"maintain.php3?command=add_prod\">Add Product</A></LI>
	  <LI><A HREF=\"maintain.php3?command=rem_prod\">Remove Product</A></LI>
	  <LI><A HREF=\"maintain.php3?command=mod_prod\">Modify Product</A></LI>
	  </UL>
	</TD>
	</TR>
	</TR>

	<TR>
	  <TD COLSPAN=\"2\" WIDTH=\"100%\" BGCOLOR=\"#FFF0D0\">
	  <B><FONT COLOR=\"#000000\">II. FAQ Tools</FONT></B>
	  </TD>
	<P>
	<TR>
	<TD>
	  <UL>
	  <LI><A HREF=\"maintain.php3?command=add_faq\">Add FAQ</A></LI>
	  <LI><A HREF=\"maintain.php3?command=rem_faq\">Remove FAQ</A></LI>
	  <LI><A HREF=\"maintain.php3?command=mod_faq\">Modify FAQ</A></LI>
	  </UL>
	</TD>
	</TR>
	</TR>

	</TABLE>

");
        /* End HTML */
?>

