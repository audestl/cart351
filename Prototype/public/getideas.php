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

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {


         $sql_select='SELECT * FROM listDeed';
         // $count = 'SELECT COUNT(*) FROM tableOfConfidences';
         $result = $db->query($sql_select);
         // $result2 = $db->query($count);
         if (!$result) die("Cannot execute query.");
            // if (!$result2) die("Cannot execute query.");


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
   // encode count of columns
   // $myJSONObj = json_encode($result2);
   // echo $myJSONObj;
    exit;
   }//POST
   // $myJSONObj = json_encode($result2);
   // echo $myJSONObj;
}
catch(Exception $e)
{
   die($e);
}

?>

<!DOCTYPE html>
<html>
<head>
<title>Get ideas</title>
<!-- get JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/demostyle.css">
</head>
<body>
  <script>
   window.onload=function(){

     let myvar ="";
      $.ajax({
             type: "POST",
             enctype: 'text/plain',
             url: "getideas.php",
             data: "",
             processData: false,//prevents from converting into a query string
             contentType: false,
             cache: false,
             timeout: 600000,
             success: function (response) {
             console.log(response);
             //use the JSON .parse function to convert the JSON string into a Javascript object
             let parsedJSON = JSON.parse(response);
             console.log(parsedJSON);
          //   myvar=parsedJSON;
             displayDeed(parsedJSON);

            },
            error:function(){
           console.log("error occurred");
         }
    });
    function displayDeed(theResult){
      // theResult is AN ARRAY of objects ...
      let para="";
      for(let i=0; i< theResult.length; i++)
      {
      // get the next object
      let currentObject = theResult[i];
      para = $('<p>');

      // go through each property in the current object ....
      for (deed_descr in currentObject) {


          $(para).text(currentObject[deed_descr]+" |");


      }

      $(para).appendTo("#paragraph");
    }
    }
    // function displayDeed(myvar){
    //
    //   for( var i = 0; i < myvar.length; i++ ) {
    //      $(paragraph).text(myvar[i].deed_descr);
    //   }
    // }
  }
  </script>
<div class="subtil"><a href="demo.php" style="text-decoration:none; color: #E6A67F;">BACK</a></div>


  <div id="deed_text">
    <br><br><br><br><br><br><br>
    <p id="paragraph">
    <p>  Volunteer for an hour at an organization of your choice.  | </p>
    <p> Allow a fellow driver to merge into your lane.    |</p>
    <p>   Write a thank-you note to someone who won’t expect it.    |</p>
    <p>   Find unneeded items in your house and donate them to a charitable organization.   |</p>
    <p>   Plant a tree.   |</p>
    <p>   Think of something you do well, and use your talent to benefit others - for example performing magic tricks at a children’s hospital or playing music at a nursing home.  | </p>
    <p>   Teach an elderly person to use a computer to surf the Internet or write e-mails.    |</p>
    <p>   Collect stuffed animals or toys from family members, friends, and neighbours and donate them to an organization that helps children.    |</p>
    <p>   Find a piece of winter clothing that you haven’t worn all season, and donate it to a charity.   |</p>
<br><br><br><br><br><br><br>
    </p>
<p id="result"></p>


  </div>

</body>


</html>
