<?php
require_once('class.php');
$obj = new Database;
$obj->saveRecord($_REQUEST);
?>

<html>
<title>Reservation</title>
<head> 
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>

  


    <!-- header -->
    <header>
    <div class="row">
        <div class='col-sm-12' style="text-align: center;">
          <h3 >Train  Reservation </h3>
          <?php  if(count($obj->availableSeat())>0) { ?>
          <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-info">Book Seat</button>
          <?php } else { ?>
          <button type="button" class="btn btn-danger">Seat Not Available</button>
          <?php } ?>
        </div>
    </div>
    </header>

    <div class="container">
      <br/>
      <?php if($obj->success=='success') { ?>
        <script type="text/javascript">
          $(document).ready(function(){
                setTimeout(function(){
                  var pageURL = $(location).attr("href");
                  window.location.href = pageURL;
                }, 3000);
          });
        </script>
      <div class="row">
        <div class='col-sm-12'>
          <div class="alert alert-success">
            <strong>Success!</strong> Seat booked successfully.
          </div>        
        </div>
      </div>
    <?php } else { 
        echo mysqli_error($obj->con); 
    } ?>




    <br/>

    <div class="row">
      <?php for($i=1;$i<=$obj->totalSeat;$i+=1) { 
            if(in_array($i,$obj->select('coach'))) { ?>
          <div class="col-custom-five booked"> <?=$i?> </div>
            <?php } else { ?>
        <div class="col-custom-five bearth available" data-seat="<?=$i?>"> <?=$i?> </div>
          <?php } 
      } ?>
    </div>
  </div>
</body>



<!-- Reservation  Modal -->
<div class="modal" id="myModal">
  <div class="modal-dialog">
    <div class="modal-content">
      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Available Seat : <?php echo count($obj->availableSeat()) ?></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <!-- Modal body -->
      <div class="modal-body">
        <form action="" method="post">
          <div class="form-group">
            <label for="usr">Select no of seats:</label>
            <select class="form-control selectSeat" name="seat" required="">
              <option value="">Select Seat</option>
            <?php for($i=1;$i<=7;$i+=1) { ?>
              <option value="<?=$i?>"><?=$i?></option>
            <?php } ?>
            </select>
          </div>
          <div class="bindDynamicPersion"></div>
        </form> 
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<script src='js/custom.js'></script>

</html>