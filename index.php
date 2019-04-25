<?php 

  //Connectie klasses
include_once("bootstrap.php");

// Controleren of we al ingelogd zijn, functie van gemaakt
User::checkLogin();


/*$conn = new PDO("mysql:host=localhost;dbname=project_php", "root", "root", null);
$statement = $conn->prepare("SELECT* FROM images_with_fields");
$statement->execute();
$collection = $statement->fetchAll();
*/
  $posts = Post::getAll();
 
  if(!empty($posts)){
    $show = true;
  }else{
    $error = true;
  }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="css/style.css">
    <title>Homepage</title>
</head>
<body>

<?php include_once("nav.inc.php"); ?>

<div class="upload">

  <form enctype="multipart/form-data" action="upload.php" method="POST" class="form"> 
    <input type="file" name="image" capture="camera" required><br>
    <br><textarea name="description" cols="40" rows="4" placeholder="Description" required></textarea><br>
    <input type="submit" value="upload" name="upload" class="input">  
  </form>      
</div>

<!-------AFBEELDINGEN SHOWEN------->
<?php if (isset($error)): ?>
    <div class="form__error">
			<p> No followers yet, what a bummer! Search for them and share nature with them! </p>
		</div>
	<?php endif; ?>

  <?php if (isset($show)): ?>

<div class="collection">
  
    <?php foreach($posts as $p): ?>
        <a href="detail.php?id=<?php echo $p['id']; ?>" class="collection__item" style="background-image:url(<?php echo $p['image']; ?>)"></a>
        <p><?php echo $p['image_text']; ?></p>
    <?php endforeach; ?> 
  <?php endif; ?>
</div>

<h1 class="load-more">Load More</h1>
            <input type="hidden" id="row" value="0">
            <input type="hidden" id="all" value="<?php echo $allcount; ?>">


</body>
</html>



<script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
<script>
$(document).ready(function(){

// Load more data
$('.load-more').click(function(){
    var row = Number($('#row').val());
    var allcount = Number($('#all').val());
    var rowperpage = 3;
    row = row + rowperpage;

    if(row <= allcount){
        $("#row").val(row);

        $.ajax({
            url: 'getData.php',
            type: 'post',
            data: {row:row},
            beforeSend:function(){
                $(".load-more").text("Loading...");
            },
            success: function(response){

                // Setting little delay while displaying new content
                setTimeout(function() {
                    // appending posts after last post with class="post"
                    $(".post:last").after(response).show().fadeIn("slow");

                    var rowno = row + rowperpage;

                    // checking row value is greater than allcount or not
                    if(rowno > allcount){

                        // Change the text and background
                        $('.load-more').text("Hide");
                        $('.load-more').css("background","darkorchid");
                    }else{
                        $(".load-more").text("Load more");
                    }
                }, 2000);

            }
        });
    }else{
        $('.load-more').text("Loading...");

        // Setting little delay while removing contents
        setTimeout(function() {

            // When row is greater than allcount then remove all class='post' element after 3 element
            $('.post:nth-child(3)').nextAll('.post').remove();

            // Reset the value of row
            $("#row").val(0);

            // Change the text and background
            $('.load-more').text("Load more");
            $('.load-more').css("background","#15a9ce");
            
        }, 2000);


    }

});

});


</script>