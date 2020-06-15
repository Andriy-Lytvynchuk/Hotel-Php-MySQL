<?php
require_once "../../include/header-open-only.php";
require_once '../../database/connect.php';

//Insert Booking into DB ============================
$noDate = $noTime = '';

if(isset($_GET['restid'])) {
    $restid = $_GET['restid'];
}

//check to see if form is submitted
if(isset($_POST['submit'])) {
    //get the data form the form
    $item_type = 'restaurant';
    $date = $_POST['date'];
    $comment = trim($_POST['comment']);

    if ($date !=='') {

        $sql = "INSERT INTO bookings (start_date, client_id, item_type, item_id, comment) 
        values (:start_date, :client_id, :item_type, :item_id, :comment)";

        $pdostm = $dbcon->prepare($sql);

        $pdostm->bindParam(':start_date', $date);
        $pdostm->bindParam(':client_id', $tempUserId);
        $pdostm->bindParam(':item_type', $item_type);
        $pdostm->bindParam(':item_id', $restid);
        $pdostm->bindParam(':comment', $comment);

        $numRowsAffected = $pdostm->execute();

        if($numRowsAffected){
            header("Location: success-book-rest.php");
        } else {
            echo 'problem inserting';
        }
    }else {
      if ($date =='') {
            $noDate = 'Please select the date';
        }
    }
}
?>
<!-- FORM to Add Restaurant Booking  ===================-->

<div class="d-flex justify-content-center" id="UpdMngrForm">
    <form action="" method="post" class="form-container">

        <h2>Book Restaurant</h2>

        <input type="hidden" name="restid" value="<?= $restid; ?>"/>

        <label for="date">Date and Time*</label>
        <input type="datetime-local" class="form-control" name="date" id="date" value = "<?php if(isset($date)){echo $date;} ?>"
               placeholder="">

        <label for="comment">Your comment:</label>
        <textarea rows="3" name="comment"
                  id="comment" placeholder="Your comment">
               <?php if(isset($comment)){echo $comment;} ?>
            </textarea>

        <span class="error"> <?php echo $noDate ?> </span>

        <button type="submit" name="submit" class="btn btn-primary " id="">Book Restaurant
        </button>
        <a class="btn cancel" href="dining.php">Cancel</a>
    </form>
</div>

<?php
include_once "include/footer-close-only.php";
?>