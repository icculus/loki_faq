-- MySQL dump 8.22
--
-- Host: localhost    Database: faqs_newschema
---------------------------------------------------------
-- Server version	3.23.52-log

--
-- Table structure for table 'categories'
--

CREATE TABLE categories (
  product_id int(11) default NULL,
  cat_name mediumtext,
  cat_id int(11) NOT NULL auto_increment,
  deleted tinyint(4) default '0',
  cat_order int(11) default NULL,
  PRIMARY KEY  (cat_id)
) TYPE=MyISAM;

--
-- Dumping data for table 'categories'
--


INSERT INTO categories VALUES (13,'Sound',19,0,19);
INSERT INTO categories VALUES (13,'Requirements',18,0,18);
INSERT INTO categories VALUES (13,'Introduction',17,0,17);
INSERT INTO categories VALUES (9,'Food',10,0,10);
INSERT INTO categories VALUES (9,'People',11,0,11);
INSERT INTO categories VALUES (9,'Language',12,0,12);
INSERT INTO categories VALUES (9,'Daily Life',13,0,13);
INSERT INTO categories VALUES (9,'Culture',14,0,14);
INSERT INTO categories VALUES (13,'Display',20,0,20);
INSERT INTO categories VALUES (13,'Fish',21,0,21);
INSERT INTO categories VALUES (9,'Geography',22,0,22);

--
-- Table structure for table 'faqs'
--

CREATE TABLE faqs (
  faq_id int(11) NOT NULL auto_increment,
  faq_cat int(11) NOT NULL default '0',
  faq_prod int(11) NOT NULL default '0',
  faq_question varchar(150) NOT NULL default '',
  faq_answer text,
  added_by varchar(10) default NULL,
  deleted tinyint(4) default '0',
  faq_order int(11) default NULL,
  PRIMARY KEY  (faq_id),
  UNIQUE KEY faq_question (faq_question),
  UNIQUE KEY faq_question_2 (faq_question)
) TYPE=MyISAM;

--
-- Dumping data for table 'faqs'
--


INSERT INTO faqs VALUES (25,14,9,'Why is french humor so sickingly unfunny ?','The French are apparently missing the gene for sarcastic and second-degree humor. Instead, they seem to have a different, unique gene that triggers random laugther upon visually comical and/or gross situations.\r\n','Chunky',0,25);
INSERT INTO faqs VALUES (34,19,13,'I got a sound card, why doesn\'t it work now?','Did you install a driver for it? Check out the following URL...','Chunky',0,34);
INSERT INTO faqs VALUES (12,10,9,'What the fuck is up with stinky cheese?','Tastiness of cheese is directly proportional to the stinkiness according to the French Ministry of Cheeses.\r\n','Chunky',0,12);
INSERT INTO faqs VALUES (13,10,9,'Do these people really eat frogs ?','Yes, they do. Yummy. If only it had more meat than bones...\r\n','Chunky',0,13);
INSERT INTO faqs VALUES (14,11,9,'Do French women shave their armpits ?','Yes, except for those who encountered Chunky.\r\n','Chunky',0,14);
INSERT INTO faqs VALUES (15,10,9,'.... and snails ?? Dude!!!','Yes, with plenty of garlic.\r\n','Chunky',0,15);
INSERT INTO faqs VALUES (16,11,9,'Why are these people so rude ?','Fuck you, you fucking no-good stinking American motherfucker. Who are you to criticize us, uh ? I piss on you!\r\n\r\n','Chunky',0,16);
INSERT INTO faqs VALUES (17,12,9,'Can\'t they speak English like everybody else ?','Nope.\r\n\r\nBecause we know better than everybody else, ass-clown!\r\n','Chunky',0,17);
INSERT INTO faqs VALUES (18,11,9,'Why are these people always on strike ? Don\'t they have real jobs?','Happiness is for sissies.\r\n\r\nThe French can only reach true bliss by complaining and whining about everything possible all the time, and then debate it to no end, while maximizing the amount of annoyance it can cause to others.\r\n\r\nComplaining is a way of life over there. You will get criticized for being successful for your lack of solidarity with the majority of losers.\r\n','Chunky',0,18);
INSERT INTO faqs VALUES (19,13,9,'I hear the streets over there are littered with dog crap!','Mostly because the people on charge of picking up dog shit are constantly on strike.\r\n\r\nMaybe also because, in true French tradition, nobody gives a crap about the others and prefer to let their god shit under everybody else\'s path.\r\n\r\nFinally, maybe French dogs are just being assimilated in French culture?\r\n','Chunky',0,19);
INSERT INTO faqs VALUES (20,13,9,'Somebody\'s broken in my car / I am being raped / etc... Where the fuck are the police?','Probably on strike again, or being beaten up by teenage shoplifters, or just taking a day-long nap as usual.\r\n','Chunky',0,20);
INSERT INTO faqs VALUES (21,13,9,'I need ten copies of my birtth certificate just to buy a car ! What the fuck is up with that?','Remember, the word \"bureaucracy\" has French roots. We invented it, and are damn proud of being complete assholes about the ridiculous amounts of useless paperwork we will ask you. And no, there\'s no way we\'re going to help you or even give you a smile.\r\n','Chunky',0,21);
INSERT INTO faqs VALUES (22,12,9,'What kind of fucking gay language has \"yes\" sounding like \"wee\" ?','That\'s French for you!\r\n','Chunky',0,22);
INSERT INTO faqs VALUES (24,14,9,'Why does French music suck so much ?','The French seem to have a talent in producing puke-inducing pop and folk crap. Scientists are still trying to determine the cause of this strange behavior pattern, which so far seems to be related to some kind of supranatural force.\r\n','Chunky',0,24);
INSERT INTO faqs VALUES (33,19,13,'Do I need a sound card to use ESD?','Yes, tonto.','Chunky',0,33);
INSERT INTO faqs VALUES (31,18,13,'What hardware do I need to use this?','Computer with a well-known 3D card.','Chunky',0,31);
INSERT INTO faqs VALUES (32,18,13,'This is a moving test','Hahaha...','Chunky',0,32);
INSERT INTO faqs VALUES (29,17,13,'How to use this FAQ?','Click!','Chunky',0,29);
INSERT INTO faqs VALUES (30,17,13,'Authors','Rafael Barrero <rafael@codehost.com>\r\nChunky Kibbles <chunky@icculus.org>','Chunky',0,30);
INSERT INTO faqs VALUES (35,20,13,'I start linux, I login, but I can\'t get a GUI going. Help!','startx','Chunky',0,35);
INSERT INTO faqs VALUES (36,19,13,'Test Question with \"plan\" to succeed','Test \"with\" other \"things\"','Chunky',0,36);
INSERT INTO faqs VALUES (37,21,13,'Where are the fish that supposedly come with my game?','There was a horrible accident.','Chunky',0,37);
INSERT INTO faqs VALUES (38,14,9,'Is surrendering part of the national culture or what ?','Yes.\r\n\r\nOne of the most productive industries in France is the manufacturing of white flags, which accounts for about 20% of the brut national product.\r\n\r\nOf course the French are the first to complain about the fact that they never win... but will never actually get to actually do something about it (surrendering is just easier). Why can\'t other nations surrender a bit for a change ?\r\n\r\n','Chunky',0,38);
INSERT INTO faqs VALUES (39,22,9,'What parts of France are worth visiting ?','Let me give you a quick introduction to basic French geography.\r\n\r\nThis country has essentially two different areas :\r\n\r\n- Paris\r\n- the rest of the country\r\n\r\n\r\nThe Paris general area accounts for more than 10% of the whole country\'s population. Oddly enough, it seems that all the rudest, most frenetic and gay people are living there too. They truly think they are better than the rest of their countrymen (let alone foreigners!). However this is the only place in France where things actually happen.\r\n\r\nThe rest of the country is essentially dull, outright boring, and sometimes dangerous. People can be more agreeable, and so is the weather (as opposed to Paris, especially in the South), but chances are you will get bored to death.\r\n\r\n','Chunky',0,39);

--
-- Table structure for table 'products'
--

CREATE TABLE products (
  product varchar(25) NOT NULL default '',
  description mediumtext NOT NULL,
  introduction mediumtext NOT NULL,
  version tinytext,
  timestamp datetime default NULL,
  private tinyint(4) default '0',
  product_id int(11) NOT NULL auto_increment,
  deleted tinyint(4) default '0',
  PRIMARY KEY  (product_id),
  UNIQUE KEY product (product)
) TYPE=MyISAM;

--
-- Dumping data for table 'products'
--


INSERT INTO products VALUES ('France','The Country Of France','This is a country full of frog-eating people in Central Europe.\r\n','v3.3','2002-10-30 12:51:18',0,9,0);
INSERT INTO products VALUES ('SAMPLE','SAMPLE: The Return','This is a sample product to test this software','v1.0','2002-10-31 08:46:33',0,13,0);

