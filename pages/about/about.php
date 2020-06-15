<?php
require_once "../../include/header-about.php";
require_once '../../database/connect.php';

//Display Managers from DB =======================
$sql = "SELECT * FROM managers";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$managers = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($managers->name[1]);   exit;

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


<!--MANAGERS BLOCK-================== Meet our Managers  <span id="arrow">&#8964;</span>-->

   <button id="mng-btn" >Meet our Managers</button>
    <section id="mgrs-section">

<!--  Dynamic Code to Display Managers -->
    <div class="managers-container">

        <?php foreach($managers as $manager) { ?>
        <div class="single-mngr-div grey-border">
            <div class="">
                <h2><?= $manager->position; ?></h2>
                <img src="<?= $manager->image; ?>" alt="manager icon">
                <p> <b> <?= $manager->name; ?></b> <?= $manager->descrip; ?></p>
            </div>

        </div>
<?php } ?>
 </div> <!-- Close managers-container, End of Dynamic Code Managers  -->
    </section>
<?php
require_once "../../include/footer.php"
?>
