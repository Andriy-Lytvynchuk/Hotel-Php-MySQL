<?php
require_once "../../include/header-open-only.php";
require_once '../../database/connect.php';

//get client name
$sql1 = "SELECT name FROM clients WHERE id = :id";
$pst = $dbcon->prepare($sql1);
$pst->bindParam(':id', $tempUserId);
$pst->execute();
$client = $pst->fetch(PDO::FETCH_COLUMN);

//get bookings for current client
$sql2 = "SELECT * FROM bookings WHERE client_id = :client_id";
$pst = $dbcon->prepare($sql2);
$pst->bindParam(':client_id', $tempUserId);
$pst->execute();
$bookings = $pst->fetchAll(PDO::FETCH_OBJ);

?>
<br>
<h1>Hello <?php echo ($client ? $client.'!' : 'Guest!') ?> </h1>

<div class= "center">
    <h2>Please view your bookings below</h2>
    <table class= "center">
        <thead>
        <tr>
            <th>Date and Time</th>
            <th>Booking type</th>
            <th>Your comment</th>
        </tr>
        </thead>
        <tbody>

        <?php foreach($bookings as $booking) { ?>
            <tr>
                <td><?php echo $booking->start_date; ?></td>
                <td><?php echo $booking->item_type; ?></td>
                <td><?php echo $booking->comment; ?></td>
            </tr>

    <?php } ?>
        </tbody>
    </table>
    <br>
    <a href="dining.php" >Back to Restaurants</a>
</div> <!-- Close Rests-container, End of Dynamic Code Rests  -->


