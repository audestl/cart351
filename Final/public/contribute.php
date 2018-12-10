<!DOCTYPE html>
<html>
<head>
<title> </title>
<!-- get JQUERY -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="css/contribute_give_style.css">

</head>
<body>
    <div class="subtil"><a href="demo.php" style="text-decoration:none; color:  #E6A67F;">BACK</a></div>
    <br>
  <div class= "formContainer">
  <form id = "insertConfidence" action="" method="" enctype ="multipart/form-data">

  <!-- <p id="paragraph">Offer to read to or play games with someone living in a nursing or retirement home. Donate blood.Conserve energy. Turn off the lights if you’re the last person to leave a room. Swallow your pride and apologize for something you’ve done – whether big or small. Take food to a new neighbour.Take part in a literacy program, to help children or adults learn to read. Donate school supplies to children from underprivileged homes.</p> -->
  <h3>Describe your act of kindness in max 250 words. How did it make you feel?</h3>
  <p ><label></label><textarea type = "text" rows="5" cols="350" name = "confidence_descr" required></textarea></p>
<p>Choose the category that fits best your act of kindness.</p>
  <div>
    <input type="radio" id="work_radio" name="type" value="work">
    <label style="color:#E6A67F;" for="work">Work</label>
  </div>
  <div>
    <input type="radio" id="family_radio" name="type" value="family">
    <label for="family">Family & Friends</label>
  </div>
  <div>
    <input type="radio" id="community_radio" name="type" value="community">
    <label for="community">Community</label>
  </div>
  <div>
    <input type="radio" id="environment_radio" name="type" value="environment">
    <label for="environment">Environment</label>
  </div>
  <div>
    <input type="radio" id="animals_radio" name="type" value="animals">
    <label for="animals">Animals</label>
  </div>

    <p class = "sub"><input type = "submit" name = "submit" value = "Share it!" id =buttonS /></p>

</form>
</div>

<!-- Where people can add good deeds to the list -->
<div id="result"></div>


<script>


$(document).ready (function(){


//   // insert
   $("#insertConfidence").submit(function(event) {
     event.preventDefault();
     console.log("button clicked");


     let form = $('#insertConfidence')[0];
     let data = new FormData(form);

//insert by sending
     $.ajax({
            type: "POST",
            enctype: 'multipart/form-data',
            url: "insertConfidenceinDB.php",
            data:data,
            processData: false,//prevents from converting into a query string
            contentType: false,
            cache: false,
            timeout: 600000,
            success: function (response) {
              console.log("going");
            //reponse is a STRING (not a JavaScript object -> so we need to convert)
            console.log(response);
            //use the JSON .parse function to convert the JSON string into a Javascript object
             //let parsedJSON = JSON.parse(response);
             //console.log(parsedJSON);
            //displayResponse(parsedJSON);
           },
           error:function(){
          console.log("error occurred");

        }
      });
     });
  });
</script>
</body>
</html>
