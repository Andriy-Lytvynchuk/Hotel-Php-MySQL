<?php
require_once '../../include/header-open-only.php';
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//Update Tour Php ==========================
//$image = $name = $descrip = $price = "";

if(isset($_POST['updateRest'])){
    $id= $_POST['id'];

    $sql = "SELECT * FROM restaurants where id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    $rest = $pst->fetch(PDO::FETCH_OBJ);
//    echo '<pre>';
//    print_r($rest);
//    exit;

    $image = $rest->image;
    $name =  $rest->name;
    $descrip = $rest->descrip;
}

if(isset($_POST['updateRestSubmit'])){
    $id = $_POST['tid'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = $_POST['descrip'];

   $sql = "Update restaurants
        set image = :image,
            name = :name,
            descrip = :descrip
        WHERE id = :id ";

    $pst =   $dbcon->prepare($sql);

    $pst->bindParam(':image', $image);
    $pst->bindParam(':name', $name);
    $pst->bindParam(':descrip', $descrip);
    $pst->bindParam(':id', $id);

    $count = $pst->execute();
    if($count){
        header("Location: dining-admin.php");
    } else {
        echo "problem updating a Restaurant";
    }
}
//echo var_dump($_POST['tid']);
//echo var_dump($_POST['id']);
?>


    <!--    Form to Update  Restaurants -->

<div class="d-flex justify-content-center" id="UpdRestForm">
    <form action="" method="post" class="form-container">
        <input type="hidden" name="tid" value="<?= $id; ?>" />

            <label for="name">Restaurant name :</label>
            <input type="text" class="form-control" id="name" name="name"
                   value="<?= $name; ?>" placeholder="Restaurant name">
            <span style="color: red"></span>

            <label for="image">Image url :</label>
            <input type="text" class="form-control" name="image" id="image" value="<?= $image; ?>"
                   placeholder="Image url">
            <span style="color: red"></span>


            <label for="descrip">Tour description :</label>
            <textarea rows="3" name="descrip" value="" class="form-control"
                      id="descrip" placeholder="Enter tour description"><?= $descrip; ?></textarea>
            <span style="color: red"></span>

        <button type="submit" name="updateRestSubmit"
                class="btn" id="">
            Update Restaurant
        </button>
        <a class="btn cancel" href="dining-admin.php">Cancel</a>
    </form>
</div>


