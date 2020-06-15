<?php
require_once '../../include/header-open-only.php';
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//UPDATE MANAGER Php ============================
//$position=$image=$name=$descrip='';
$error = '';

if (isset($_POST['updMngr'])){
   $id= $_POST['id'];

    $sql = "SELECT * FROM managers where id = :id";
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    $updManager = $pst->fetch(PDO::FETCH_OBJ);

    $position = $updManager->position;
    $image =  $updManager->image;
    $name = $updManager->name;
    $descrip = $updManager->descrip;
}

if(isset($_POST['updMngrSubmit'])) {
    $id= $_POST['id'];
    $position = $_POST['position'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = $_POST['descrip'];


//    if ( $newposition !== $position  || $newimage !== $image || $newname !== $name || $newdescrip !== $descrip ) {

    $sql = "Update managers set
            position = :position,
            image = :image,
            name = :name,
            descrip = :descrip
            WHERE id = :id ";

    $pst = $dbcon->prepare($sql);

    $pst->bindParam(':position', $position);
    $pst->bindParam(':image', $image);
    $pst->bindParam(':name', $name);
    $pst->bindParam(':descrip', $descrip);
    $pst->bindParam(':id', $id);

    $count = $pst->execute();
        if ($count) {
            header("Location: about-admin.php");
        } else {
            echo "problem updating a record";
        }
    //    }
    //    else{
    //        $error = 'no Fields were updated';
    //    }
} ?>

<!-- FORM to Update Manager ===================-->
<!--<div id="overlay"></div>-->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <h2>Update Manager</h2>
        <input type="hidden" name="id" value="<?= $id; ?>" />

        <label for="position"><b>Position</b></label>
        <input type="text" placeholder="Position" name="position" value="<?= $position; ?>" >

        <label for="image"><b>Image Url</b></label>
        <input type="text" placeholder="Image Url" name="image" value="<?= $image; ?>" >

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Name" name="name" value="<?= $name; ?>">

        <label for="descrip"><b>Description</b></label> <br>
        <textarea rows="3" placeholder="Description" name="descrip"><?= $descrip; ?></textarea>

        <button type="submit" class="btn" name="updMngrSubmit">Submit</button>
        <a class="btn cancel" href="about-admin.php">Cancel</a>
    </form>
</div>

<?php
require_once "../../include/footer.php"
?>
