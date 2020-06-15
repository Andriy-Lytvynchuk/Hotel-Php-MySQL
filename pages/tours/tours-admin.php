<?php
//include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/include/header-tours.php';
//echo $_SERVER['DOCUMENT_ROOT'].'/pages/include/header-tours.php';
require_once "../../include/header-tours-admin.php";
require_once '../../database/connect.php';
session_start();
if ($_SESSION["username"]==null) {
    header("location:../../index.php");
}

//Display Managers from DB =======================
$sql = "SELECT * FROM tours";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$tours = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($tours->name[1]);   exit;

//Delete Tour record: ---------------------
if (isset($_POST['deleteTour'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM tours WHERE id = :id";

//<!--prepare, bind, execute-->
    $pst = $dbcon->prepare($sql);
    $pst->bindParam(':id', $id);
    $pst->execute();
    header("Location: tours-admin.php");
}
?>
<!--TOURS Title + Add button ------------------------>
        <div class=" " id="">
            <a href="add-tour.php" id="btn_addTour" class="btn btn-success float-left" >Add Tour</a>
            <h1>Tour the world your way!</h1>
        </div>

<!--  Dynamic Code to Display Tours ------ -->
        <div class="main-flexcontainer">

            <?php foreach($tours as $tour) { ?>
            <div class="single-item-div grey-border">
                <div class="">
                    <img src="<?= $tour->image; ?>" alt="Tour image">
                    <h2 class="text-center"><?= $tour->name; ?></h2>
                    <p><?= $tour->descrip; ?></p>
                </div>

                <!--    Buttons Div-->
                <div id="buttons-Mngr-div">
                    <form action="update-tour.php" method="POST">
                        <input type="hidden" name="id" value="<?= $tour->id; ?>"/>
                        <button type="submit" name="updateTour" class="btn btn-warning" id="updTour"
                        > Edit
                        </button>
                    </form>

                    <form action="" method="POST">
                        <input type="hidden" name="id" value="<?= $tour->id; ?>"/>
                        <button type="submit" name="deleteTour"
                                class="btn btn-danger " id="deleteTour" onclick="return confirm('Delete record from Database? Action can not be undone')" >
                            Delete
                        </button>
                    </form>
                </div>
            </div>
            <?php } ?>
        </div> <!-- Close Tours-container, End of Dynamic Code Tours  -->



<!-- popup FORM ===================

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
//include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/include/footer.php';
?>




