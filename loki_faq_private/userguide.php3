<?php
include("../branding.php3");

printHead("Administrative User Guide for Loki_Faq");

?>

<H1>Administrator User Guide</H1>

<UL>
 <LI><A HREF="#general">General Editing Policies</A></LI>
 <LI><A HREF="#addingitems">Adding items</A>
 <UL>
  <LI><A HREF="#addprod">Adding A Product</A></LI>
  <LI><A HREF="#addcat">Adding A Category</A></LI>
  <LI><A HREF="#addfaq">Adding A FAQ</A></LI>
 </UL>
 </LI>
 <LI><A HREF="#modifyingitems">Modifying Items</A>
 <UL>
  <LI><A HREF="#modprod">Modifying A Product</A></LI>
  <LI><A HREF="#modcat">Modifying A Category</A></LI>
  <LI><A HREF="#modfaq">Modifying A FAQ</A></LI>
 </UL>
 </LI>
 <LI><A HREF="#removingitems">Removing Items</A>
 <UL>
  <LI><A HREF="#remgeneral">General Removing Information</A></LI>
  <LI><A HREF="#reallyrem">REALLY Removing Things</A></LI>
  <LI><A HREF="#undelete">Undeleting Things</A></LI>
 </UL>
 </LI>
 <LI><A HREF="#moving">Moving items around</A></LI>
</UL>

<H2><A NAME="general">General Editing Policies</H2>

<P>When editing/adding anything in this FAQ engine, several notes should
be adhered to:</P>
<OL>
<LI>To make something appear as, for example, a list of commands like
<PRE>
mount /mnt/cdrom
cd /mnt/cdrom
sh setup.sh
</PRE>
please surround the commands with [CODE] at the start and [/CODE] at
the end.</LI>
<LI>To make a link appear, like:
  <A HREF="http://icculus.org/~chunky/">Chunky's Home Page</A>,
 please use: [LINK=http://icculus.org/~chunky/] Chunky's Home Page [/LINK]
</LI>
</OL>

<H2><A NAME="addingitems">Adding items</H2>

<H3><A NAME="addprod">Adding A Product</H3>
<P>Adding a product can only be done from the <A
HREF="./">top-level administrative menu.</A></P>
<P>When adding a product, there are several fields to fill in:</P>
<UL>
 <LI>Product Reference Name:<BR>
     This is a single word used to refer to the product, eg, "BrightInstall"
 </LI>
 <LI>Product Description:<BR>
     This is a one-line piece of text that is used to describe the
     product; "The Codehost, Inc Installer", for example.
 </LI>
 <LI>Product Introduction:<BR>
     A slightly longer description of the product.
 </LI>
 <LI>Private:<BR>
     This Checkbox should be ticked if you want the product and everything
     about it to only be available from the administrative interface,
     and not the public one.
 </LI>
</UL>

<H3><A NAME="addcat">Adding A Category</H3>
<P>To add a category to the database, there is just one field: The name
of the category</P>
<P>The button to add a catgory is only available at the bottom of the
header in any given product screen</P>

<H3><A NAME="addfaq">Adding A FAQ</H3>
<P>Adding a FAQ requires you to click "add faq to this category" under a
specific category. The category an FAQ is in can be changed at a later
date, but when you're first adding it, you do not get a choice once
you've clicked "Add faq to this category".</P>

<H2><A NAME="modifyingitems">Modifying Items</H2>

<H3><A NAME="modprod">Modifying A Product</H3>
<P>To modify a product you need to click on the "modify" button in the
<A HREF="./">top-level administrative menu</A> next to the product you're
planning on modifying.</P>

<H3><A NAME="modcat">Modifying A Category</H3>
<P>There is no way to move a category between products. To modify a
category, simply put the new name into the field</P>

<H3><A NAME="modfaq">Modifying A FAQ</H3>
<P>When modifying an FAQ, you only have the ability to change the
question, answer, and category of an FAQ. There is no way to move a
category between products. This is deliberate.</P>



<H2><A NAME="removingitems">Removing Items</H2>
<P>To remove anything in this system, click the "remove" button next
to it.</P>
<P>It is not actually removed from the system; just from where it appears
in normal usage.</P>

<H3><A NAME="reallyrem">REALLY Removing Things</H3>
<P>To <I>really</I> remove an item from the system, go into the
<A HREF="./delete.php3">"deleted" menu</A> accessable from the <A
HREF="./">top-level administrative menu</A>, and click "really remove"
next to the item you wish to delete</P>

<H3><A NAME="undelete">Undeleting Things</H3>

<P>To undelete any item, go into the <A HREF="./delete.php3">"deleted"
menu</A> accessable from the <A HREF="./">top-level administrative
menu</A>, and click "undelete" next to the item you wish yo undelete</P>

<H2><A NAME="moving">Moving items around</H2>

<P>Moving items around is fairly simple. To move anything up or down a
list, simply click "move up" or "move down" next to the item you wish
to move up or down.</P>

<P>It is not possible to move something above the top of the list it's
currently in, or below the bottom.</P>

<P>To move a FAQ between categories, click on "modify" next to the FAQ
and it will provide you with a drop-down box on the modification screen,
allowing you to choose a category [from all those on the current product]
to add it to</P>

<?php
printTail();
?>
