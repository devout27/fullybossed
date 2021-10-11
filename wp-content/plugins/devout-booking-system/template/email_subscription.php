<?php 
$url=home_url()."/wp-admin/admin.php?page=session";
if(isset($_GET['action']) && $_GET['action']=='delete' && isset($_GET['id']) && !empty($_GET['id'])){	
	$id=$_GET['id'];
	$success=deleteRow('XDk_dc_subscribe_emails',array('id'=>$id));
}

include(ABSPATH .'wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/top-header.php');
$title='Email Subscription';
$lists=getEmailSubscriptionList();
#pr($lists);
?>
<div class="container">
	<div class="row">
	    <div class="col-sm-6">  
		  <h2><?php echo $title;?></h2>
		</div>
	</div>
    <div class="row" style="margin-top:30px;">
	    <div class="col-sm-12">  
			<table class="table" id="myTable">
				<thead>
				  <tr>
					<td  style="display:none">	   
					</td>
					<th>Name</th>
					<th>Email</th>
					<th>Created On</th>
					<th>Action</th>
				  </tr>
				</thead>
			 <tbody>
			<?php 
				if($lists){
					
					foreach($lists as $list){
						
					?>
						<tr>
							<td  style="display:none">
							   <?php 
							   echo $list['id'];
							   ?>
							</td>
						    <td>
							<?php 
							   echo !empty($list['name']) ? $list['name']:'NA';
							 ?>
							</td>
							<td>
							<?php 
							   echo $list['email'];
							 ?>
							</td>
										
									
							<td>
							<?php  	echo dateFormate($list['created']);	?>				
							</td>						
							<td>
								
								<a href="<?php echo home_url('/')?>wp-admin/admin.php?page=email-subscription&action=delete&id=<?php echo $list['id']?>" onclick="return confirm('Are you sure you want to delete this subscription history?');">
								<button type="button" class="btn btn-danger"> <i class="fas fa-trash-alt"></i></button>
								</a>
							</td>
						</tr>
					<?php 
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
</script>
