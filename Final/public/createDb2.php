<?php

class MyDB extends SQLite3
   {
      function __construct()
      {
         $this->open('../db/goodDeed.db');
      }
   }

try
{
   $db = new MyDB();
   echo ("Opened or created graffiti gallery data base successfully<br \>");
   $theQuery = 'CREATE TABLE listDeed (deedID INTEGER PRIMARY KEY NOT NULL, deed_descr TEXT)';
 $ok = $db ->exec($theQuery);  // this will return a boolean
	// make sure the query executed
	if (!$ok)
	die($db->lastErrorMsg());
	// if everything executed error less we will arrive at this statement
	echo "Table artCollection created successfully<br \>";
}
catch(Exception $e)
{
   die($e);
}
?>
