<?php

//include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/include/header-tours.php';
//echo $_SERVER['DOCUMENT_ROOT'].'/pages/include/header-tours.php';
require_once "../../include/header-tours.php";
require_once '../../database/connect.php';

$sql = "SELECT * FROM tours";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$tours = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($tours->name[1]);   exit;
?>

<!--Tours Title (+Add button for Admin) ------------------>
<div class=" " id="dining-h1">
    <form action="view-bookings-tours.php" method="POST">
        <button type="submit" name="view" class=" float-left btn btn-primary" id="">
            View Bookings
        </button>
    </form>

    <h1>We have exciting selection of Tours!</h1>
</div>



<!--DYNAMIC CODE to display TOURS, Flexbox ===================-->
<div class="main-flexcontainer">

    <?php foreach($tours as $tour) { ?>
        <div class="single-item-div grey-border">
            <div class="">
                <img src="<?= $tour->image; ?>" alt="Tour image">
                <h2 class="text-center"><?= $tour->name; ?></h2>
                <p><?= $tour->descrip; ?></p>
            </div>

            <!--    Buttons Div -------->
            <div id="buttons-Mngr-div">
                <a href="book-tour.php?tourid=<?= $tour->id; ?>" class="btn badge-success">Book</a>
            </div>
        </div>
    <?php } ?>
</div> <!-- Close Tours-container, End of Dynamic Code Tours  -->


<!-- FORM to BOOK TOUR ===================
<div id="overlay"></div>

<div class="form-popup" id="BookTourForm">
    <form action="" class="form-container">
        <h2>Booking</h2>

        <label for="name"><b>Name</b></label>
        <input type="text" placeholder="Yor Name" name="name" >

        <label for="room"><b>Room #</b></label>
        <input type="text" placeholder="Room #" name="room" >

        <label for="room"><b>Message</b></label> <br>
        <textarea rows="3" placeholder="Your Message" name="message" ></textarea>

        <button type="submit" class="btn" name="bookTour">Submit</button>
        <button type="submit" class="btn cancel" onclick="closeForm()">Close</button>
    </form>
</div>
-->

<?php
require_once "../../include/footer.php"
//include_once $_SERVER['DOCUMENT_ROOT'] . '/pages/include/footer.php';
?>




