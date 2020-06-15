<?php
require_once "../../include/header-dining-admin.php";
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//Display Restaurants from DB =======================
$sql = "SELECT * FROM restaurants";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$rests = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($rests->name[1]);   exit;

//Delete Tour record: ---------------------
if (isset($_POST['deleteRest'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM restaurants WHERE id = :id";

//<!--prepare, bind, execute-->
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    header("Location: dining-admin.php");
}
?>

<!--Restaurants Title + Add button ------------------>
<div class=" " id="">
    <a href="add-rest.php" id="btn_addTour" class="btn btn-success float-left" >Add Restaurant</a>
    <h1>Our splendid Restaurants have everything for your enjoyment!</h1>
</div>


<!--  Dynamic Code to Display Restaurants ------ -->
<div class="main-flexcontainer">

    <?php foreach($rests as $rest) { ?>
    <div class="single-item-div grey-border">
        <div class="">
            <img src="<?= $rest->image; ?>" alt="Restaurant image">
            <h2 class="text-center"><?= $rest->name; ?></h2>
            <p><?= $rest->descrip; ?></p>
        </div>

        <!--    Buttons Div-->
        <div id="buttons-Mngr-div">
            <form action="update-rest.php" method="POST">
                <input type="hidden" name="id" value="<?= $rest->id; ?>"/>
                <button type="submit" name="updateRest" class="btn btn-warning" id="updTour"
                > Edit
                </button>
            </form>

            <form action="" method="POST">
                <input type="hidden" name="id" value="<?= $rest->id; ?>"/>
                <button type="submit" name="deleteRest"
                        class="btn btn-danger " id="deleteRest" onclick="return confirm('Delete record from Database? Action can not be undone')" >
                    Delete
                </button>
            </form>
        </div>
    </div>
    <?php } ?>
</div> <!-- Close Rests-container, End of Dynamic Code Rests  -->




<!-- popup FORM ===================
<div id="overlay"></div>

<div class="form-popup" id="myForm">
    <form action="#" class="form-container">
        <h2>Booking</h2>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Yor Name" name="name" required>

        <label for="room"><b>Room #</b></label>
        <input type="text" placeholder="Room #" name="room" required>

        <label for="room"><b>Message</b></label> <br>
        <textarea rows="3" placeholder="Your Message" name="message" required></textarea>

        <button type="submit" class="btn" name="submit">Submit</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
-->

<?php
include_once "../../include/footer.php"
?>




