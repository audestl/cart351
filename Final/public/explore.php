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

   if($_SERVER['REQUEST_METHOD'] == 'POST')
   {


         $sql_select='SELECT * FROM tableOfConfidences';
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
  <title> Explore</title>
 <script src="https://code.jquery.com/jquery-1.10.2.js"></script>
 <script>
   window.onload=function(){
     let myvar ="";
      $.ajax({
             type: "POST",
             enctype: 'text/plain',
             url: "explore.php",
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
             myvar=parsedJSON;
             for( var i = 0; i < parsedJSON.length; i++ ) {
               createAndDrawCircle(parsedJSON[i]);
             }
            },
            error:function(){
           console.log("error occurred");
         }
    });


  var canvas = document.querySelector('canvas');
  var context = canvas.getContext('2d');

  canvas.addEventListener('click',function(event){

    //console.log(event.clientX);
    for(let  i =0; i<circles.length;i++){
      var test = isIntersecting(event, circles[i]);
      if(test===true){
         let currentObject = circles[i];

             $(paragraph).text(currentObject.confidence);

             break;


}


    }
  })

/*****CHECK COLLISON ***/

function isIntersecting(event, circle) {
  return Math.sqrt((event.clientX-circle.x)**2 + (event.clientY - circle.y)**2) < circle.radius;
 }
  //****************************** RESIZING**********
  initialize();

  function initialize() {

    window.addEventListener('resize', resizeCanvas, false);

    // Draw canvas border for the first time.
    resizeCanvas();
  }

  function resizeCanvas() {
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

  }


    //******************************OBJECT**********

  var dpr = window.devicePixelRatio;


  context.lineWidth = 1;

  var circles = [];
  var minRadius = 10;
  var maxRadius = 120;
  var totalCircles = 5;
  var createCircleAttempts = 2000;
  var newCircle;
  var colour=["#E6A67F","#D4C536","#533D52","#DF7D56", "#995E58"];

  function createAndDrawCircle(confidence_object) {

//console.log(confidence_object.category);
    var circleSafeToDraw = false;
  //  console.log(confidence_object);
    for(var tries = 0; tries < createCircleAttempts; tries++) {
      newCircle = {
        x: Math.floor(Math.random() * window.innerWidth),
        y: Math.floor(Math.random() * window.innerHeight),
        radius: minRadius,
        confidence:confidence_object.confidence_descr

      }

      if(doesCircleHaveACollision(newCircle)) {
        continue;
      } else {
        circleSafeToDraw = true;
        break;
      }
    }

    if(!circleSafeToDraw) {
      return;
    }

    for(var radiusSize = minRadius; radiusSize < maxRadius; radiusSize++) {
      newCircle.radius = radiusSize;
      if(doesCircleHaveACollision(newCircle)){
        newCircle.radius--;
        break;
      }
    }

    circles.push(newCircle);
    context.beginPath();
    context.arc(newCircle.x, newCircle.y, newCircle.radius, 0, 2*Math.PI);

// ****************TO CHANGE THE COLOR OF THE CIRCLE ACCORDING TO THE DATABASE*****
// if work == work
    if(confidence_object.category==="work")
    {
      context.fillStyle=colour[0];
    }
    else if(confidence_object.category==="environment"){
      context.fillStyle=colour[1];
    }
    else if(confidence_object.category==="family"){
      context.fillStyle=colour[2];
    }
    else if(confidence_object.category==="community"){
      context.fillStyle=colour[3];
    }

    else if(confidence_object.category==="animals"){
      context.fillStyle=colour[4];
    }
//else if animals == animals
//   context.fillStyle=colour[1];
//
// //else if family.sqrt('family')
//   context.fillStyle=colour[2];
//
//   //else if $environment.sqrt('environment')
//   context.fillStyle=colour[3];
//
//   // else if $community.sqrt('community')
//     context.fillStyle=colour[4];
// ********************************************************************************

    context.fill();
    context.stroke();
  }

  function doesCircleHaveACollision(circle) {
    for(var i = 0; i < circles.length; i++) {
      var otherCircle = circles[i];
      var a = circle.radius + otherCircle.radius;
      var x = circle.x - otherCircle.x;
      var y = circle.y - otherCircle.y;

      if (a >= Math.sqrt((x*x) + (y*y))) {
        return true;
      }
    }

    if(circle.x + circle.radius >= window.innerWidth ||
       circle.x - circle.radius <= 0) {
      return true;
    }

    if(circle.y + circle.radius >= window.innerHeight ||
        circle.y - circle.radius <= 0) {
      return true;
    }

    return false;
  }
}//window on load
  </script>
</head>
<body>
  <div>
      <div class="subtil"><a href="demo.php" style="text-decoration:none; font-family:monospace;">BACK</a></div>
      <div id="paragraph" style="background:#D4C536; padding-top: 16px; padding-bottom: 16px;font-family:monospace;"></div>

    </div>
 <canvas id = "canvas" style="background:#302745"></canvas>
</body>
</html>
