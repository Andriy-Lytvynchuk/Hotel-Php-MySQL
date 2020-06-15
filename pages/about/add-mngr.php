<?php
require_once "../../include/header-open-only.php";
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//UPDATE MANAGER Php ============================
//$position=$image=$name=$descrip='';
$noName = $noPosition = '';

if (isset($_POST['addMngr'])){

    $position = $_POST['position'];
    $image = $_POST['image'];
    $name = $_POST['name'];
    $descrip = $_POST['descrip'];

    if ($position !=='' && $name !=='') {

        $sql = "INSERT INTO managers (position, image, name, descrip ) values (:position, :image, :name, :descrip)";

        $pdostm = $dbcon->prepare($sql);

        $pdostm->bindParam(':position', $position);
        $pdostm->bindParam(':image', $image);
        $pdostm->bindParam(':name', $name);
        $pdostm->bindParam(':descrip', $descrip);

        $numRowsAffected = $pdostm->execute();

        if ($numRowsAffected) {
            header("Location: about-admin.php");
        } else {
            echo 'problem inserting';
        }
    }
    else {
        if ($position =='') {
            $noPosition = 'Please fill the Position field';
        }
        if ($name =='') {
            $noName = 'Please fill the Name field';
        }
//        header("Location: add-mngr.php");
    }
} ?>

<!-- FORM to Update Manager ===================-->
<!--<div id="overlay"></div>-->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <h2>Add Manager</h2>

        <label for="position"><b>Position*</b></label>
        <input type="text" placeholder="Position" name="position" value = "<?php if(isset($position)){echo $position;} ?>" >

        <label for="image"><b>Image Url</b></label>
        <input type="text" placeholder="Image Url" name="image" value = "<?php if(isset($image)){echo $image;} ?>" >

        <label for="name"><b>Name*</b></label>
        <input type="text" placeholder="Name" name="name" value = "<?php if(isset($name)){echo $name;} ?>">

        <label for="descrip"><b>Description</b></label> <br>
        <textarea rows="3" placeholder="Description" name="descrip"><?php if(isset($descrip)){echo $descrip;} ?></textarea>

        <span class="error"> <?php echo $noPosition .'<br />'. $noName?> </span>

        <button type="submit" class="btn" name="addMngr">Submit</button>
        <a class="btn cancel" href="about-admin.php">Cancel</a>
    </form>
</div>

<?php
require_once "../../include/footer.php"
?>
