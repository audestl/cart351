<?php

class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('../db/confidence.db');
      }
   }

try
{
   $db = new MyDB();
   echo ("Opened or created graffiti gallery data base successfully<br \>");
   $theQuery = 'CREATE TABLE tableOfConfidences (confidenceID INTEGER PRIMARY KEY NOT NULL, confidence_descr TEXT, joy TEXT, pride TEXT, serenity TEXT, contentment TEXT, gratitude TEXT, amusement TEXT, satisfaction TEXT, surprise TEXT, kindness TEXT, confidence TEXT )';
 $ok = $db ->exec($theQuery);  // this will return a boolean
	// make sure the query executed
	if (!$ok) die($db->lastErrorMsg())
	// if everything executed error less we will arrive at this statement
	echo "Table of confidences created successfully<br \>";
}
catch(Exception $e)
{
   die($e);
}
?>
