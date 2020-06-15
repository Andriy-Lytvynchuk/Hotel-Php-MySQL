<?php
require_once "../../include/header-open-only.php";
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//UPDATE Tour Php ============================
$noName = $noDescrip = '';

//check to see if form is submitted
if(isset($_POST['addRest'])){
//get the data form the form
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = trim($_POST['descrip']);

    if ($name !=='' && $descrip !=='') {

            $sql = "INSERT INTO restaurants (image, name, descrip) values (:image, :name, :descrip)";

            $pdostm = $dbcon->prepare($sql);

            $pdostm->bindParam(':image', $image);
            $pdostm->bindParam(':name', $name);
            $pdostm->bindParam(':descrip', $descrip);

            $numRowsAffected = $pdostm->execute();

            if($numRowsAffected){
               header("Location: dining-admin.php");
            } else {
                echo 'problem inserting';
            }
    }else{
        if ($name =='') {
            $noName = 'Please fill the Name field';
        }
        if ($descrip == '') {
            $noDescrip = 'Please fill the Description field';
        }

    }
}
?>
<!-- FORM to Add Restaurant  ===================-->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <h2>Add Restaurant</h2>

            <label for="name">Restaurant name*:</label>
            <input type="text" class="form-control" id="name" name="name"
        value = "<?php if(isset($name)){echo $name;} ?>" placeholder="Restaurant name">

            <label for="image">Image url :</label>
            <input type="text" class="form-control" name="image" id="image" value = "<?php if(isset($image)){echo $image;} ?>"
                   placeholder="Image url">

            <label for="descrip">Restaurant description*:</label>
            <textarea rows="3" name="descrip"
                      id="descrip" placeholder="Restaurant description">
               <?php if(isset($descrip)){echo $descrip;} ?>
            </textarea>

        <span class="error"> <?php echo $noName .'<br />'. $noDescrip ?> </span>

        <button type="submit" name="addRest" class="btn btn-primary " id="">Add Restaurant
        </button>
        <a class="btn cancel" href="dining-admin.php">Cancel</a>
    </form>
</div>
