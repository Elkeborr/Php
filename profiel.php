
  <h3>Profiel</h3>
      
 
      <div class="row">
	   <?php
	        $output_dir = "img/";
		$allowedExts = array("jpg", "jpeg", "gif", "png","JPG");
		$extension = @end(explode(".", $_FILES["myfile"]["name"]));
		    if(isset($_POST['upload']))
		    {

                if ((($_FILES["myfile"]["type"] == "image/gif")
				    || ($_FILES["myfile"]["type"] == "image/jpeg")
				    || ($_FILES["myfile"]["type"] == "image/JPG")
				    || ($_FILES["myfile"]["type"] == "image/png")
				    || ($_FILES["myfile"]["type"] == "image/pjpeg"))
				    && ($_FILES["myfile"]["size"] < 504800)
				    && in_array($extension, $allowedExts)) 
			    {
				      if ($_FILES["myfile"]["error"] > 0)
					    {
					    echo "Return Code: " . $_FILES["myfile"]["error"] . "<br>";
					    }
				    if (file_exists($output_dir. $_FILES["myfile"]["name"]))
				      {
				      unlink($output_dir. $_FILES["myfile"]["name"]);
				      }	
					    else
					    {
					    $pic=$_FILES["myfile"]["name"];
					    $conv=explode(".",$pic);
					    $ext=$conv['1'];	
						    
					    //move the uploaded file to uploads folder;
				          move_uploaded_file($_FILES["myfile"]["tmp_name"],$output_dir.$user.".".$ext);
					    
					    $pics=$output_dir.$user.".".$ext;
					  
					      
					    $url=$user.".".$ext;
					    
					    
					    $update="update database set u_imgurl='$url' where u_user='$user'";
					    
					    if($sp->query($update)){
						   echo '<div data-alert class="alert-box success radius">';
						      echo  '<b>Success !</b>  Image Updated' ;
						      echo  '<a href="#" class="close">&times;</a>';
						    echo '</div>';
						   header('refresh:3;url=dashboard.php'); 
					    }
					    else{
						    echo '<div data-alert class="alert-box alert radius">';
						      echo  '<b>Error !</b> ' .$sp->error ;
						      echo  '<a href="#" class="close">&times;</a>';
						    echo '</div>';
					    }
					    
					    
					    
					    }
					    
			    }	
			    else{
			    
			       echo '<div data-alert class="alert-box warning radius">';
			        echo  '<b>Warning !</b>  File not Uploaded, Check image' ;
			        echo  '<a href="#" class="close">&times;</a>';
				echo '</div>';
		 
			    }

		    }	    
	         ?>

		<img src="img/<?php echo $info->u_imgurl; ?>" width="64" height="64" alt="User Image"/>
		
		    <form action="" method="post" enctype="multipart/form-data">
		      <div class="large-12 columns">
			<span style="color:red;">Maximun Image Size 100KB</span><br/><br/>
			<input type="file" name="myfile"  required/>
			

			<button type="submit" name="upload" class="tiny button radius success">Upload</button>
		    </form>

 
