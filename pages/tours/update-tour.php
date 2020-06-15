<?php
require_once '../../include/header-open-only.php';
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//Update Tour Php ==========================
//$image = $name = $descrip = $price = "";

if(isset($_POST['updateTour'])){
    $id= $_POST['id'];

    $sql = "SELECT * FROM tours where id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    $tour = $pst->fetch(PDO::FETCH_OBJ);
//    echo '<pre>';
//    print_r($tour);
//    exit;

    $image = $tour->image;
    $name =  $tour->name;
    $descrip = $tour->descrip;
    $price = $tour->price;
}

if(isset($_POST['updateTourSubmit'])){
    $id = $_POST['tid'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = $_POST['descrip'];
    $price = $_POST['price'];

   $sql = "Update tours
        set image = :image,
            name = :name,
            descrip = :descrip,
            price = :price
        WHERE id = :id ";

    $pst =   $dbcon->prepare($sql);

    $pst->bindParam(':image', $image);
    $pst->bindParam(':name', $name);
    $pst->bindParam(':descrip', $descrip);
    $pst->bindParam(':price', $price);
    $pst->bindParam(':id', $id);

    $count = $pst->execute();
    if($count){
        header("Location: tours-admin.php");
    } else {
        echo "problem updating a tour";
    }
}
//echo var_dump($_POST['tid']);
//echo var_dump($_POST['id']);
?>


    <!--    Form to Update  Tour -->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <input type="hidden" name="tid" value="<?= $id; ?>" />

            <label for="name">Tour name :</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?= $name; ?>" placeholder="Enter Tour name">
            <span style="color: red"></span>

            <label for="image">Image url :</label>
            <input type="text" class="form-control" name="image" id="image" value="<?= $image; ?>"
                   placeholder="Enter image url">
            <span style="color: red"></span>


            <label for="descrip">Tour description :</label>
            <textarea rows="3" name="descrip" value="" class="form-control"
                      id="descrip" placeholder="Enter tour description"><?= $descrip; ?></textarea>
            <span style="color: red"></span>

            <label for="price">Tour price :</label>
            <input type="text" name="price" value="<?= $price; ?>" class="form-control"
                   id="price" placeholder="Enter tour price">
            <span style="color: red"></span>

        <button type="submit" name="updateTourSubmit"
                class="btn" id="">
            Update Tour
        </button>
        <a class="btn cancel" href="tours-admin.php">Cancel</a>
    </form>
</div>


