<?php
$url=home_url()."/wp-admin/admin.php?page=session";
if(isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id']) && !empty($_GET['id'])){
	$id=$_GET['id'];
	$success=deleteRow('XDk_dc_sessions',array('id'=>$id));
	if($success){
		deleteRow('XDk_dc_session_dates',array('session_id'=>$id));
	        /*echo '<script>
			    location.assign("'.$url.'");
			</script>';*/
	}
}
if(isset($_GET['action']) && $_GET['action']=='active-inactive' && isset($_GET['id']) && !empty($_GET['id']) && in_array($_GET['status'],array(0,1))){

	$id=$_GET['id'];
	$status=$_GET['status'];
	$postData['updated']=date('Y-m-d H:i:s');
	$postData['status']=$status;
	$success=updateRow('XDk_dc_sessions',$postData,array('id'=>$id));
	if($success){

	    /*echo '<script>
		    location.assign("'.$url.'");
		</script>';*/
	}
}
include(ABSPATH .'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/top-header.php');
$title='Manage Sessions';
$StatusTypes=array(1=>'Active',0=>'Inactive');
$Services=getServices();
$SessionDateTypes=getSessionDateTypes();
$lists=getAllSessionList();
?>
<div class="container">
	<div class="fb-booking-tab-btns">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link"  href="https://fullybossed.com/wp-admin/admin.php?page=bookings-fully-bossed-academy">Booking History</a>
				<a class="nav-item nav-link active" href="https://fullybossed.com/wp-admin/admin.php?page=session">Manage Sessions</a>
			</div>
		</nav>
	</div>
	<div class="row">
	    <div class="col-sm-6">
		  <h2><?php echo $title;?></h2>
		</div>
		<div class="col-sm-6" style="
    text-align: right;">
          <a href="<?php echo home_url('/')?>wp-admin/admin.php?page=add-edit-session">
		  <button class="btn btn-info">
		    Add New Session
		  </button>
		  </a>
		</div>
	</div>
    <div class="row" style="margin-top:30px;">
	    <div class="col-sm-12">
			<table class="table" id="myTable">
				<thead>
				  <tr>
					<td  style="display:none">
					</td>
					<th>Session Name</th>
					<th>Service</th>
					<th>Regular Price</th>
					<th>Sale Price</th>
					<th>From Time</th>
					<th>To Time</th>
					<th>Status</th>
					<th>Created On</th>
					<th>Action</th>
				  </tr>
				</thead>
			 <tbody>
			<?php
				if($lists){

					foreach($lists as $list){
						if($list['id'] != COACHING_SESSION_ID && $list['id'] != SPEEKING_SESSION_ID){
					?>
						<tr>
							<td  style="display:none">
							   <?php
							   echo $list['id'];
							   ?>
							</td>
							<td>
							<?php
							   echo $list['name'];
							 ?>
							</td>
							<td>
							<?php
							   echo $Services[$list['service_id']];
							 ?>
							</td>
							<td>
							<?php
							   echo CURRENCYSYMBOL.number_format($list['regular_price'],2);
							 ?>
							</td>
							<td>
							<?php
							   echo CURRENCYSYMBOL.number_format($list['price'],2);
							 ?>
							</td>
							<td>
							<?php echo date('H:i',strtotime($list['from_time']));	?>
							</td>
							<td>
							<?php echo date('H:i',strtotime($list['to_time']));?></td>
							<td>
							<a href="<?php echo home_url('/')?>wp-admin/admin.php?page=session&id=<?php echo $list['id']?>&status=<?php echo $list['status']==1 ? '0':'1'?>&action=active-inactive" class="btn <?php echo $list['status']=='1' ? 'btn-success':'btn-danger'?>">
							<?php  	echo $StatusTypes[$list['status']];						?>	</a>
							</td>
							<td>
							<?php  	echo dateFormate($list['created']);	?>
							</td>

							<td>
								<a href="<?php echo home_url('/')?>wp-admin/admin.php?page=add-edit-session&id=<?php echo $list['id']?>">
								<button type="button" class="btn btn-info"><i class="fas fa-edit"></i></button>
								</a>
								<a href="javascript:void(0)"  onclick="view('<?php echo $list['id']?>')">
								<button type="button" class="btn btn-info"><i class="fas fa-eye"></i></button>
								</a>

								<a href="<?php echo home_url('/')?>wp-admin/admin.php?page=session&action=delete&id=<?php echo $list['id']?>" onclick="return confirm('Are you sure you want to delete this session?');">
								<button type="button" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></button>
								</a>
							</td>
						</tr>
					<?php
					 }
				   }
				  }else{?>
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
        <h5 class="modal-title" id="exampleModalLongTitle">Session Details</h5>
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
		var url ='<?php echo get_home_url();?>/wp-admin/admin-ajax.php';
	    $.ajax({
			type: "POST",
			url: url,
            data: {'action':'session_details','id':id},
			success: function(result){
            $("#exampleModalCenter .modal-body").html(result);

        }});

	}
}
</script>
