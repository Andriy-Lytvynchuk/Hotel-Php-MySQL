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
if(isset($_POST['addTour'])){
//get the data form the form
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = trim($_POST['descrip']);
    $price = $_POST['price'];

    if ($name !=='' && $descrip !=='') {


        $sql = "INSERT INTO tours (image, name, descrip, price ) values (:image, :name, :descrip, :price)";

        $pdostm = $dbcon->prepare($sql);

        $pdostm->bindParam(':image', $image);
        $pdostm->bindParam(':name', $name);
        $pdostm->bindParam(':descrip', $descrip);
        $pdostm->bindParam(':price', $price);

        $numRowsAffected = $pdostm->execute();

        if ($numRowsAffected) {
            header("Location: tours-admin.php");
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
<!-- FORM to Add Tours ===================-->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <h2>Add Tour</h2>


            <label for="image">Image url :</label>
            <input type="text" class="form-control" name="image" id="image" value = "<?php if(isset($image)){echo $image;} ?>"
                   placeholder="Enter image url">

            <label for="name">Tour name* :</label>
            <input type="text" class="form-control" id="name" name="name"
                   value = "<?php if(isset($name)){echo $name;} ?>"  placeholder="Enter tour name">

            <label for="descrip">Tour description* :</label>
            <textarea rows="3" name="descrip"   class="form-control"
                      id="descrip" placeholder="Enter tour description"><?php if(isset($descrip)){echo $descrip;} ?></textarea>

            <label for="price">Price :</label>
            <input type="text" name="price" value = "<?php if(isset($price)){echo $price;} ?>" class="form-control"
                   id="price" placeholder="Enter tour price">
        <span class="error"> <?php echo $noName .'<br />'. $noDescrip ?> </span>

        <button type="submit" name="addTour" class="btn btn-primary " id="">Add Tour
        </button>
        <a class="btn cancel" href="tours-admin.php">Cancel</a>
    </form>
</div>
