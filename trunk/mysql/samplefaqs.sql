# MySQL dump 8.16
#
# Host: localhost    Database: testfaqs
#--------------------------------------------------------
# Server version	3.23.46-log

#
# Table structure for table 'SAMPLE'
#

CREATE TABLE SAMPLE (
  product tinytext NOT NULL,
  faq_id int(4) NOT NULL default '0',
  faq_cat tinytext NOT NULL,
  faq_title text NOT NULL,
  faq_answer blob NOT NULL,
  faq_notes int(4) default NULL
) TYPE=MyISAM;

#
# Dumping data for table 'SAMPLE'
#

INSERT INTO SAMPLE VALUES ('SAMPLE',1,'Introduction','How to use this FAQ?','Click!',1);
INSERT INTO SAMPLE VALUES ('SAMPLE',2,'Introduction','Authors','Rafael Barrero (raistlin@lokigames.com)',1);
INSERT INTO SAMPLE VALUES ('SAMPLE',1,'Requirements','What hardware do I need to use this?','Computer with a well-known 3D card.',2);
INSERT INTO SAMPLE VALUES ('SAMPLE',1,'Display','I start linux, I login, but I can\'t get a GUI going. Help!','startx',3);
INSERT INTO SAMPLE VALUES ('SAMPLE',1,'Sound','Do I need a sound card to use ESD?','Yes, tonto.',4);
INSERT INTO SAMPLE VALUES ('SAMPLE',2,'Sound','I got a sound card, why doesn\'t it work now?','Did you install a driver for it? Check out the following URL...',4);
INSERT INTO SAMPLE VALUES ('SAMPLE',2,'Requirements','This is a moving test','Hahaha... ',2);
INSERT INTO SAMPLE VALUES ('SAMPLE',4,'Sound','Test Question with \"plan\" to succeed','Test \"with\" other \"things\".',4);
INSERT INTO SAMPLE VALUES ('SAMPLE',1,'Fish','Where are the fish that supposedly come with my game?','There was a horrible accident.',5);

#
# Table structure for table 'products'
#

CREATE TABLE products (
  product tinytext NOT NULL,
  description mediumtext NOT NULL,
  introduction text NOT NULL,
  version varchar(5) NOT NULL default '',
  timestamp datetime default NULL,
  category text NOT NULL,
  private tinyint(4) NOT NULL default '0'
) TYPE=MyISAM;

#
# Dumping data for table 'products'
#

INSERT INTO products VALUES ('SAMPLE','SAMPLE: The Return','This is a sample product to test this software.','v1.0','2001-02-21 12:19:58','TEST',1);

