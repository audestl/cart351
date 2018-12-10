
<?php
//insert
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
 }
 catch(Exception $e)
 {
    die($e);
 }
//check if there has been something posted to the server to be processed
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
// need to process
$category = $_POST['type'];
$confidence = $_POST['confidence_descr'];
 // $work = $_POST['work'];
 // $animals = $_POST['animals'];
 // $community = $_POST['community'];
 // $environment = $_POST['environment'];
 // $family = $_POST['family'];




 //if ((strcmp($a_descr, " ")!=0) && (strcmp($a_descr, "")!=0))
//{

 $queryInsert = "INSERT INTO tableOfConfidences (confidence_descr,category) VALUES ('$confidence', '$category')";

 $ok1 = $db->exec($queryInsert);
  if (!$ok1)
  {
       die($db->lastErrorMsg());
   }
   //echo("insert successfully");

   $sql_select='SELECT * FROM tableOfConfidences';
   $result = $db->query($sql_select);
   if (!$result) die("Cannot execute query.");
 //  echo $results;

// get a row...
// MAKE AN ARRAY::
$res = array();
$i=0;
while($row = $result->fetchArray(SQLITE3_ASSOC))
{
// note the result from SQL is ALREADy ASSOCIATIVE
$res[$i] = $row;
$i++;
}//end while
// endcode the resulting array as JSON
$myJSONObj = json_encode($res);
echo $myJSONObj;

 exit;
 }//POST

?>
