<?php
require_once "../../include/header-about-admin.php";
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//Display Managers from DB =======================
$sql = "SELECT * FROM managers";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$managers = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($managers->name[1]);   exit;

//Delete Manager record: ---------------------
if (isset($_POST['deleteMngr'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM managers WHERE id = :id";

//<!--prepare, bind, execute-->
      $pst = $dbcon->prepare($sql);
        $pst->bindParam(':id', $id);
        $pst->execute();
        header("Location: about-admin.php");
    }
?>

<!--Bootstr Page Container-->
<div class="container">
    <h1>Don't miss vacation of your life at our exclusive resort! </h1>

        <div class="row">
        <!--Bootstr 1st main Block, SERVICES =========================-->
        <div class="col-sm-12 col-md-6 col-lg-4 block">
            <h2>Services</h2>
            <p>We provide everything to make your vacation enjoyable.
                Tours, private transportation, event booking, fine dining and more.</p><hr>
        </div>

        <!--Bootstr 2nd main Block, About =====================-->
            <div class="col-sm-12 col-md-6 col-lg-4 block">
                <h2>About Us</h2>
                <p>We will make your vacation unforgettable experience by delivering high standard of service and offering variety of activities to choose from.</p><hr>
            </div>

        <!--Bootstr 3d main Block, Contact =========================-->
            <div class="col-sm-12 col-md-6 col-lg-4 block">
                <h2>Contacts</h2>
               <p> Address: Hawaii, Phone:*</p>
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3716.282639271737!2d-158.12795568255615!3d21.339343999999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x7c0062bc24707ee5%3A0x77690b995c68673e!2sFour%20Seasons%20Resort%20Oahu%20at%20Ko%20Olina!5e0!3m2!1sen!2sca!4v1586213277170!5m2!1sen!2sca" width="200" height="100" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
            </div>
    </div> <!--Close Row-->
</div>   <!-- Close Botsr container, -->


<!--MANAGERS BLOCK-============================== -->
<div class=" " id="">
    <a href="add-mngr.php" id="btn_addMngr" class="btn btn-success float-left" >Add Manager</a>
    <h1>Meet our Managers</h1>
</div>


<!--    <div class="d-flex justify-content-between" id="mangrs-top-div">
        <h2>Our Managers</h2>
        <a href="add-mngr.php" id="btn_addMngr" class="btn btn-success">Add Manager</a>
    </div>
-->
    <!--      <button id="mng-btn">Meet our Managers <span>&#8964;</span> </button> -->
            <!--   <section id="mgrs-section">-->
    <!--   Add Manager button -->

<!--  Dynamic Code to Display Managers -->
    <div class="managers-container">

        <?php foreach($managers as $manager) { ?>
        <div class="single-mngr-div grey-border">
            <div class="">
                <h2><?= $manager->position; ?></h2>
                <img src="<?= $manager->image; ?>" alt="manager icon">
                <p> <b> <?= $manager->name; ?></b> <?= $manager->descrip; ?></p>
            </div>

         <!--    Buttons Div-->
            <div id="buttons-Mngr-div">
                <form action="upd-mngr.php" method="POST">
                    <input type="hidden" name="id" value="<?= $manager->id; ?>"/>
                    <button type="submit" name="updMngr" class="btn btn-warning" id="updMngr"
                    > Edit
                    </button>
                </form>

                <form action="" method="POST">
                    <input type="hidden" name="id" value="<?= $manager->id; ?>"/>
                    <button type="submit" name="deleteMngr"
                            class="btn btn-danger " id="deleteMngr" onclick="return confirm('Delete record from Database? Action can not be undone')" >
                        Delete
                    </button>
                </form>
            </div>
        </div>
<?php } ?>
 </div> <!-- Close managers-container, End of Dynamic Code Managers  -->

            <!--    </section>-->
<!--    </div>-->


<!-- pop-up FORM to Update Manager ===================
<div id="overlay"></div>

<div class="form-popup" id="UpdMngrForm">
    <form action="" method="post" class="form-container">
        <h2>Update Manager</h2>
        <input type="hidden" name="id" value="<?/*= $id; */?>" />

        <label for="position"><b>Position</b></label>
        <input type="text" placeholder="Position" name="position" value="<?/*= $position; */?>" >

        <label for="image"><b>Image</b></label>
        <input type="text" placeholder="Image Url" name="image" value="<?/*= $image; */?>" >

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Name" name="name" value="<?/*= $name; */?>">

        <label for="descrip"><b>Description</b></label> <br>
        <textarea rows="3" placeholder="Description" name="descrip" value="<?/*= $descrip; */?>"></textarea>

        <button type="submit" class="btn" name="updMngrSubmit">Submit</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
-->
<?php
require_once "../../include/footer.php"
?>
