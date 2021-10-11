<?php
$url = home_url() . "/wp-admin/admin.php?page=bookings-speaking";
if (isset($_GET['action']) && $_GET['action'] == 'delete' && isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $success = deleteRow('XDk_dc_bookings', array('id' => $id));
    if ($success) {
        deleteRow('XDk_dc_session_booking_dates', array('booking_id' => $id));
        /*echo '<script>                   location.assign("'.$url.'");                </script>';*/
    }
}
include ABSPATH . 'wp-content/plugins/' . PLUGIN_DIR_NAME . '/template/top-header.php';
$title = 'Booking History';
$StatusTypes = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Confirmed</button>', 3 => '<button class="btn btn-danger">Canceled</button>');
$paymentStatus = array(1 => '<button class="btn btn-warning">Pending</button>', 2 => '<button class="btn btn-success">Success</button>', 3 => '<button class="btn btn-danger">Failed</button>');
$lists = getBookingSpeakingListByServiceId(SPEEKING_SERVICE_ID);
?>
<div class="container">

	<div class="fb-booking-tab-btns">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link active" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-speaking">Booking History</a>
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-speaking-request">Request Speaking</a>
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=fb-hourly-prices">Speaking Hourly Prices</a>
			</div>
		</nav>
	</div>

    <div class="row" style="margin-top:30px;">
	    <div class="col-sm-12">
			<table class="table" id="myTable">
				<thead>
				  <tr>
					<td  style="display:none">
					</td>
					<th>Booking Id</th>
					<th>Service</th>
					<th>Customer Name</th>
					<th>Booking Date</th>
					<th>Amount</th>
					<th>Location Type</th>

					<!--<th>Session</th>
					<!--<th>Booking Status</th>
					<th>Payment Status</th>
					<th>Transaction Id</th>-->

					<th>Action</th>
				  </tr>
				</thead>
			 <tbody>
			<?php
if ($lists) {

    foreach ($lists as $list) {
        ?>
					<tr>
					   <td  style="display:none">
						   <?php
echo $list['id'];
        ?>
						</td>                        <td>						   <?php echo '#' . $list['id']; ?>						</td>
						<td>
						<?php
echo $list['service_name'];
        ?>
						</td>

						<td>
						<?php
echo $list['name'];
        ?>
						</td>
						<td>
						<?php
echo dateFormate($list['created'],false);
        ?>
						</td>
						<td>						<?php	echo CURRENCYSYMBOL . number_format($list['total']); ?>						</td>
 <td>
						<?php
echo $list['location'];
        ?>
						</td>
						<!--<td>						<?php echo $StatusTypes[$list['status']]; ?>
						</td>						<td>
						<?php echo $paymentStatus[$list['payment_status']]; ?>	</td>
												<td>						<?php echo $list['transaction_id']; ?>						</td>-->

						<!--<td>
						<?php
echo !empty($list['session_name']) ? $list['session_name'] : 'NA';
        ?>
						</td>-->
						<td>
							<a href="javascript:void(0)"  onclick="view('<?php echo $list['id'] ?>')">
							<button type="button" class="btn btn-info"><i class="fas fa-eye"></i></button>
							</a>
							<a href="<?php echo home_url('/') ?>wp-admin/admin.php?page=bookings-speaking&action=delete&id=<?php echo $list['id'] ?>" onclick="return confirm('Are you sure you want to delete this booking?');">
							<button type="button" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
							</a>
						</td>
					</tr>
					<?php
}
} else {?>
					<tr>
					<td colspan="8" class="text-center">List Empty</td>
					</tr>
				  <?php
}?>
				</tbody>
			  </table>
		    </div>
    </div>
 </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Booking Details</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <h6 class="text-center">Loding please wait...</h6>
      </div>
    </div>
  </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready( function () {
    $('#myTable').DataTable({
	   "order": [[ 0, "desc" ]]
    });
});

function view(id){
	if(id !=''){

	    $('#exampleModalCenter').modal('show');
		var url ='<?php echo get_home_url(); ?>/wp-admin/admin-ajax.php';
	    $.ajax({
			type: "POST",
			url: url,
            data: {'action':'booking_details','id':id},
			success: function(result){
            $("#exampleModalCenter .modal-body").html(result);

        }});

	}
}
</script>
