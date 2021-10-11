<?php
include ABSPATH . 'wp-content/plugins/' . PLUGIN_DIR_NAME . '/template/top-header.php';
$StatusTypes = array(1 => 'Active', 0 => 'Inactive');
$Services = getServices();
$id = isset($_GET['id']) ? $_GET['id'] : '';
$postData = $sessionDates = array();
$error_msg = $success_msg = '';
$title = 'Add New Session';
$SessionDateTypes=array();
if (!empty($id)) {
	
    $title = 'Edit Session';
    $postData = getSessionById($id);
    $sessionDates = getSessionDatesBySessionId($id);
	$SessionDateTypes = getSessionDateTypes();
	if(in_array($postData['service_id'],array(223,221))){
		unset($SessionDateTypes[1]);
	}
}
if (isset($_POST['submit'])) {

    $id = $postData['id'] = $_POST['id'];
    $postData['service_id'] = $_POST['service_id'];
    $postData['name'] = $_POST['name'];
    $postData['description'] = $_POST['description'];
    $postData['price'] = $_POST['price'];
	$postData['regular_price'] = $_POST['regular_price'];
    $postData['from_time'] = $_POST['from_time'];
    $postData['to_time'] = $_POST['to_time'];
    $postData['from_date'] = $_POST['from_date'];
    $postData['to_date'] = $_POST['to_date'];
    $postData['session_date_type'] = $_POST['session_date_type'];
    $sessionDates = $_POST['session_date'];
    if (empty($postData['service_id']) || empty($postData['name']) || empty($postData['price']) || empty($postData['from_time']) || empty($postData['to_time'])) {$error_msg = 'Please fill all required fields';
    } else { 
	
	    $table = 'XDk_dc_sessions';
        $msg = 'Add';
		if ($_POST['session_date_type'] == 2) {
			$postData['from_date'] = '0000-00-00';
            $postData['to_date'] = '0000-00-00';
			} else { $sessionDates = array();
			}if (!empty($postData['id'])) {
				$postData['updated'] = date('Y-m-d H:i:s');
            $insert_id = updateRow($table, $postData, array('id' => $id));
            $msg = 'Save';} 
			else { 
			$postData['created'] = $postData['updated'] = date('Y-m-d H:i:s');
            $insert_id = insertRow($table, $postData);}if ($insert_id > 0) {deleteRow('XDk_dc_session_dates', array('session_id' => $insert_id));
            $datesNew = array();
			foreach ($sessionDates as $date) {
				$saveSessionDate = array();
				$saveSessionDate['session_id'] = $insert_id;
				$saveSessionDate['session_date'] = $date;
				$saveSessionDate['service_id'] = $postData['service_id'];
				if (!in_array($date,    $datesNew) && !empty($date)) {
				    $datesNew[] = $date;
			 	    insertRow('XDk_dc_session_dates', $saveSessionDate);
				}
			}
            $sessionDates = $datesNew;
            $success_msg = 'Session ' . $msg . ' Successfully';} else { $error_msg = 'Session ' . $msg . ' Unsuccessfully';}
    }
}
$id = isset($postData['id']) ? $postData['id'] : '';
$service_id = isset($postData['service_id']) ? $postData['service_id'] : '';
$name = isset($postData['name']) ? $postData['name'] : '';
$price = isset($postData['price']) ? $postData['price'] : '';
$regular_price = isset($postData['regular_price']) ? $postData['regular_price'] : '';
$description = isset($postData['description']) ? $postData['description'] : '';
$from_time = isset($postData['from_time']) ? $postData['from_time'] : '';
$to_time = isset($postData['to_time']) ? $postData['to_time'] : '';
$from_date = isset($postData['from_date']) ? $postData['from_date'] : date('Y-m-d');
$to_date = isset($postData['to_date']) ? $postData['to_date'] : date('Y-m-d');
$session_date_type = isset($postData['session_date_type']) ? $postData['session_date_type'] : '';
?><script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js?v=4.6.2"></script>
<div class="container">
    <div class="row">
        <div class="col-sm-12">
            <h2><?php echo $title;?></h2>
        </div>
    </div>
    <?php 
	if($success_msg){?>
    <div class="alert alert-success" role="alert">
        <?php echo $success_msg;?>
    </div>
    <?php }?>
    <?php 
	if($error_msg){?>
    <div class="alert alert-danger" role="alert">
        <?php echo $error_msg;?>
    </div>
    <?php
	}?>
    <div class="row" style="margin-top:30px;">
        <div class="col-sm-12">
            <form method="post" id="supplierAdd">
                <div class="row">
                    <div class="form-group col-sm-6"> <label for="pwd">Service*</label>
					<select class="form-control"
                            name="service_id" id="service_id" style="width:100%" onchange="SetDateType($(this).val())">
                            <option value=""> Select Service </option>
                            <?php 
							foreach($Services as $key=>$val){
                                    $selected='';	
                                    if($service_id==$key){
                                        
                                        $selected='selected="selected"';								
                                    }
                                    if($key ==FULLY_BOSSED_ACADEMY_SERVICE_ID){
                                    ?>
                                <option value="<?php echo $key?>" <?php echo $selected?>> <?php echo $val?> </option>
                                <?php 
                                    }													
							    }
							?>
                        </select> </div>
                    <div class="form-group col-sm-6">
                        <label for="email">Session Name*</label>
                        <input type="hidden" class="form-control" placeholder="id" name="id" value="<?php echo $id?>">
                        <input type="text" class="form-control" placeholder="Session Name" id="name"
                            value="<?php echo $name?>" name="name" required>
                    </div>
				</div>	
				<div class="row">
                    <div class="form-group col-sm-12"> <label for="pwd">Description</label> <textarea name="editor1"
                            rows="4" cols="50" id="editor1"><?php echo $description;?></textarea> <input type="hidden"
                            value="" name="description" id="description"> </div>
                </div>
                <div class="row">
                    <div class="form-group col-sm-6"> 
                    	<label>Time*</label>
                    	<div class="row">
	                    	<div class="col-md-6" style="display: flex;align-items: center;flex-wrap: wrap;">
		                    	<label for="pwd" style="margin: 0px 0px 0px 0px;width: 50px;">From</label> 
		                    	<input type="time" class="form-control" placeholder="From Time" id="from_time" name="from_time" value="<?php echo $from_time ?>" required style="width: calc(100% - 50px);"> 
		                    </div>
		                    <div class="col-md-6" style="display: flex;align-items: center;flex-wrap: wrap;"> 
		                    	<label for="pwd" style="margin: 0px 0px 0px 0px;width: 50px;">To</label> 
		                    	<input type="time"
		                            class="form-control" placeholder="To Time" id="to_time" name="to_time"
		                            value="<?php echo $to_time ?>" required style="width: calc(100% - 50px);"> 
		                    </div>
		                </div>
	                </div>
					<div class="form-group col-sm-3">
                        <label for="pwd">Regular Price* :</label>
                        <input type="text" class="form-control" placeholder="Regular Price" id="regular_price" name="regular_price"
                            value="<?php echo $regular_price ?>"  onkeypress="javascript:return isNumber(event)">
                    </div>
					
                    <div class="form-group col-sm-3">
                        <label for="pwd">Sale Price* :</label>
                        <input type="text" class="form-control" placeholder="Price" id="price" name="price"
                            value="<?php echo $price ?>" required onkeypress="javascript:return isNumber(event)">
                    </div>
					
                    <div class="form-group col-sm-6"> <label for="pwd">Session Date Type*</label> 
					   <select class="form-control" name="session_date_type" id="session_date_type" required>
					        <option value="">Select Session Date Type</option>  
                            <?php 							
							foreach($SessionDateTypes as $key=>$val){								
								$selected='';								
								if($session_date_type==$key){
								   $selected='selected="selected"';								
								}							
								?>
								<option value="<?php echo $key?>" 
								<?php echo $selected?>> 
								<?php echo $val?>
								</option>
                            <?php 													
							}							
							?> 
						</select> 
							</div>
                </div>
                <div class="row" id="RangeDate" style="display:<?php echo $session_date_type ==1 ? '':'none'?>">
                    <div class="form-group col-sm-7"> 
                    	<label for="pwd">Date*</label> 
                    	<div class="row">
	                    	<div class="col-md-6" style="display: flex;align-items: center;flex-wrap: wrap;">
		                    	<label for="pwd" style="margin: 0px 0px 0px 0px;width: 35px;width: 50px;">From</label>
                				<!--<input type="date" class="form-control" placeholder="From Time" id="from_date" name="from_date" value="<?php echo $from_date ?>" required min="<?php echo date('Y-m-d')?>" style="width: calc(100% - 50px);">-->
								<input type="date" class="form-control" placeholder="From Time" id="from_date" name="from_date" value="<?php echo $from_date ?>" required style="width: calc(100% - 50px);">
                			</div>
                    		<div class="col-md-6" style="display: flex;align-items: center;flex-wrap: wrap;"> 
		                    	<label for="pwd" style="margin: 0px 0px 0px 0px;width: 35px;width: 50px;">To</label> 
                     			<!--<input type="date" class="form-control" placeholder="To Time" id="to_time" name="to_date" value="<?php echo $to_date ?>" min="<?php echo date('Y-m-d')?>" required style="width: calc(100% - 50px);">-->
								
								<input type="date" class="form-control" placeholder="To Time" id="to_time" name="to_date" value="<?php echo $to_date ?>"  required style="width: calc(100% - 50px);"> 
                     		</div>
                     	</div>
                     </div>
                </div>
                <div class="row" id="MultipalDate" style="display:<?php echo $session_date_type==2 ? '':'none'?>">
                    <div class="form-group col-sm-12">
                        <label for="pwd">Session Dates*</label>
                        <div class="all-email-div row">
                            <?php 
						if(!empty($sessionDates)){
                            $last=count($sessionDates);
                            $last=$last-1;							
						    foreach($sessionDates as $key=>$date){
								
								$displayplusnbtn='none';
								$displayminusbtn='';
								
								if($last==0){
									
									$displayplusnbtn=''; 
									$displayminusbtn='none';

								}else if($last==$key){

									$displayplusnbtn=''; 
									$displayminusbtn='';

								}
						?>
                            <div class="email-div col-sm-4" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-sm-9">
                                          <!--<input type="date" class="form-control" placeholder="session date"
                                            id="date<?php echo $key?>" name="session_date[]" value="<?php echo $date?>"
                                            required min="<?php echo date('Y-m-d')?>">-->
											
											<input type="date" class="form-control" placeholder="session date"
                                            id="date<?php echo $key?>" name="session_date[]" value="<?php echo $date?>"
                                            required">
											
                                    </div>
                                    <div class="add-new-btn col-sm-3">

                                        <button class="btn-danger tdtn-remove" type="button"
                                            style="display:<?php echo $displayminusbtn;?>">-</button>
                                        <button class="btn-success tdtn-add" type="button"
                                            style="display:<?php echo $displayplusnbtn;?>">
                                            +
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <?php  
							}
						}else{ ?>
                            <div class="email-div col-sm-4" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-sm-9">
                                          <!--<input type="date" class="form-control" placeholder="session date"
                                            id="session_date" name="session_date[]" value="<?php echo date('Y-m-d')?>"
                                            required min="<?php echo date('Y-m-d')?>">-->
											<input type="date" class="form-control" placeholder="session date"
                                            id="session_date" name="session_date[]" value="<?php echo date('Y-m-d')?>"
                                            required>
											
                                    </div>
                                    <div class="add-new-btn col-sm-3">

                                        <button class="btn-danger tdtn-remove" type="button"
                                            style="display:none">-</button>
                                        <button class="btn-success tdtn-add" type="button">
                                            +
                                        </button>

                                    </div>
                                </div>
                            </div>
                            <?php 
						}?>
                        </div>
                    </div>
                </div>
                <div class="text-rigth" style="text-align-last:right;">
                    <a href="<?php echo home_url()?>/wp-admin/admin.php?page=session">
                        <button type="button" class="btn btn-primary">Back</button>
                    </a>
                    <button type="submit" class="btn btn-primary" name="submit" id="add-supplier-btn">Submit</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle"><?php echo $title?> Details</h5>
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
<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>">
</script>
<script>
CKEDITOR.replace('editor1', {
    height: 300,
    allowedContent: true,
    filebrowserUploadMethod: 'form',
    extraAllowedContent: 'p(*)[*]{*};div(*)[*]{*};li(*)[*]{*};ul(*)[*]{*}'
});
CKEDITOR.dtd.$removeEmpty.i = 0;
CKEDITOR.disableAutoInline = true;
$('#supplierAdd').validate({
    rules: {
        service_id: {
            required: true,
        },
        name: {
            required: true,
        },
        price: {
            required: true,
        },
        from_time: {
            required: true,
        },
        to_time: {
            required: true,
        },
		session_date_type:{
			
			required: true
		}
    },
    messages: {
        service_id: {
            required: 'Select Service',
        },
        name: {
            required: 'Please Enter Session Name',
        },
        price: {
            required: 'Please Enter Session Price',
        },
        from_time: {
            required: 'Please Enter Session From Time',
        },
        to_time: {
            required: 'Please Enter Session To Time',
        },
		session_date_type: {
            required: 'Please select Session Date Type',
        }
    },
});
$('#add-supplier-btn').click(function() {
    if ($('#supplierAdd').valid()) {
        var html = CKEDITOR.instances.editor1.getData();
        $("#description").val(html);
        showLoader();
    }
});

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;

    return true;
}
$(document).on('click', '.tdtn-add', function(e) {
	
	var crdate='<?php echo date("Y-m-d")?>';
    e.preventDefault();
    var controlForm = $('.all-email-div:first'),
    currentEntry = $(this).parents('.email-div:first'),
    newEntry = $(currentEntry.clone()).appendTo(controlForm);
    newEntry.find('input').val(crdate);
    var timestamp = new Date().getUTCMilliseconds();
    newEntry.find('input').attr('id', timestamp);

    newEntry.find('.tdtn-remove').show();
    controlForm.find('.tdtn-remove').show();
    controlForm.find('.tdtn-add').hide();
    newEntry.find('.tdtn-add').show();

}).on('click', '.tdtn-remove', function(e) {
    $(this).parents('.email-div:first').remove();
    e.preventDefault();

    var numItems = $('.all-email-div .email-div').length;

    var controlForm = $('.all-email-div .email-div').last();

    if (numItems == 1) {

        controlForm.find('.tdtn-remove').hide();
        controlForm.find('.tdtn-add').show();
    } else {
        controlForm.find('.tdtn-remove').show();
        controlForm.find('.tdtn-add').show();
    }
    return false;
});
$(document).on('change', '#session_date_type', function(e) {
    session_date_type = $(this).val();
    if (session_date_type == 2) {
        $("#MultipalDate").show();
        $("#RangeDate").hide();
    } else if (session_date_type == 1)  {
        $("#MultipalDate").hide();
        $("#RangeDate").show();
    }else{
		$("#MultipalDate").hide();
        $("#RangeDate").hide();
	}
});

function SetDateType(service_id){
	
	var htmldata='<option value="">Select Session Date Type</option>';
	if(service_id=='195'){
		
		htmldata +='<option value="1">Range Date</option>';
		htmldata +='<option value="2">Multipal Date</option>';
		
	}else if(service_id=='223' || service_id=='221'){
		
		htmldata +='<option value="2">Multipal Date</option>';
	}
	$("#session_date_type").html(htmldata);
	
	$("#MultipalDate").hide();
	$("#RangeDate").hide();
}
function showLoader() {
    $("#loder-img").show();
}

<?php if(!empty($success_msg)){
?>
setTimeout(function() {
    location.assign("<?php echo home_url()?>/wp-admin/admin.php?page=session");
}, 3000);
<?php }?>
</script>