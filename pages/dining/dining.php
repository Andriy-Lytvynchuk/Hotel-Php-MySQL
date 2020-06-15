<?php
require_once "../../include/header-dining.php";
require_once '../../database/connect.php';


//Display Restaurants from DB =======================
$sql = "SELECT * FROM restaurants";

//prepare and execute the query;
$pdostm = $dbcon->prepare($sql);
$pdostm->execute();

//fetch all records
$rests = $pdostm->fetchAll(PDO::FETCH_OBJ);
//var_dump($rests->name[1]);   exit;
?>

<!--Restaurants Title (+Add button for Admin) ------------------>
<div class=" " id="dining-h1">
    <form action="view-bookings-rest.php" method="POST">
        <button type="submit" name="view" class=" float-left btn btn-primary" id="">
            View Bookings
        </button>
    </form>

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

        <!--    Buttons Div -------->
        <div id="buttons-Mngr-div">
            <a href="book-rest.php?restid=<?= $rest->id; ?>" class="btn badge-success">Book</a>
    </div>
    </div>
    <?php } ?>
</div> <!-- Close Rests-container, End of Dynamic Code Rests  -->


<?php
include_once "../../include/footer.php"
?>




