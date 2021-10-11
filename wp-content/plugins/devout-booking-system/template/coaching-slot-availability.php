<?php
include ABSPATH . 'wp-content/plugins/' . PLUGIN_DIR_NAME . '/template/top-header.php';
$StatusTypes = array(1 => 'Active', 0 => 'Inactive');
$Services = getServices();
$id = COACHING_SESSION_ID;
$postData = $sessionDates = array();
$error_msg = $success_msg = '';
$title = 'Manage Coaching Sessions';
if (!empty($id)) {

    $title = 'Manage Coaching Sessions';
    $postData = getSessionById($id);
    $sessionDates = getSessionDatesDataBySessionId($id);
	//pr($sessionDates,1);
}
if (isset($_POST['submit'])) {
    $postData['id'] = $id;
    $postData['service_id'] = $_POST['service_id'];
    $postData['name'] = $_POST['name'];
    $postData['description'] = $_POST['description'];
    $postData['price'] = '0.00';
	$postData['regular_price'] = '0.00';
    $postData['session_date_type'] = $_POST['session_date_type'];
    $session_dates = $_POST['session_date'];
	$from_times    = $_POST['from_time'];
	$to_times      = $_POST['to_time'];
	$prices        = $_POST['price'];
    $topics        = $_POST['topic'];
    if (empty($postData['service_id'])) {
		$error_msg = 'Please fill all required fields';
    } else {
	    $table = 'XDk_dc_sessions';
        $msg = 'Add';
		if (!empty($postData['id'])) {
			$postData['updated'] = date('Y-m-d H:i:s');
			$insert_id = updateRow($table, $postData, array('id' => $id));
			$msg = 'Save';
		}
		if ($insert_id > 0) {
			deleteRow('XDk_dc_session_dates', array('session_id' => $insert_id));
			$datesNew = array();
			$addSectionDate=false;
			$sessionDates=array();
			foreach ($session_dates as $key => $date) {
				$saveSessionDate = array();
				$from_time = $from_times[$key];
				$to_time = $to_times[$key];
				$price = $prices[$key];
                $topic = $topics[$key];
				if(!empty($date) && !empty($from_time) && !empty($to_time) &&  !empty($price)){
					$saveSessionDate['session_id'] = $insert_id;
					$saveSessionDate['session_date'] = $date;
					$saveSessionDate['from_time'] = $from_time;
					$saveSessionDate['to_time'] = $to_time;
					$saveSessionDate['price'] = $price;
                    $saveSessionDate['topic'] = $topic;
					$saveSessionDate['service_id'] = $postData['service_id'];
					insertRow('XDk_dc_session_dates', $saveSessionDate);
					$sessionDates[] = $saveSessionDate;
					$addSectionDate = true;
				}
			}
			if($addSectionDate){
			  $success_msg = 'Coaching Slot Set Availability ' . $msg . ' Successfully';
			}else{
				$error_msg = 'All fields are mandatory';
			}
		} else {
                $error_msg = 'Coaching Slot Set Availability ' . $msg . ' Unsuccessfully';
		}
    }
}

$price = isset($postData['price']) ? $postData['price'] : '';
?><script src="https://cdn.ckeditor.com/4.6.2/standard-all/ckeditor.js?v=4.6.2"></script>
<div class="container">

    <div class="fb-booking-tab-btns">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-coaching">Booking History</a>
				<a class="nav-item nav-link active" href="https://fullybossed.com/wp-admin/admin.php?page=coaching-slot-availability">Manage Sessions</a>
                <a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=fb-booking-discounts">Booking Discounts</a>
			</div>
		</nav>
	</div>

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
			   <input type="hidden" name="service_id" value="<?php echo COACHING_SERVICE_ID?>">
			    <input type="hidden" name="name" value="">
				<input type="hidden" name="description" value="">
				<input type="hidden" class="form-control" placeholder="session_date_type" id="session_date_type" name="session_date_type" value="2"  onkeypress="javascript:return isNumber(event)">

                <div class="row" id="MultipalDate">
                    <div class="form-group col-sm-12">
                        <label for="pwd">Slot Availability Date & Time*</label>
						<div class="row" style="margin-bottom: 20px; border-bottom: inset;">
						 <div class="col-sm-2"><b>Date</b></div>
						 <div class="col-sm-2"><b>From Time</b></div>
						 <div class="col-sm-2"><b>To Time</b></div>
						 <div class="col-sm-2"><b> Price (<?php echo CURRENCYSYMBOL?>) / hour</b></div>
                         <div class="col-sm-2"><b> Zoom Meeting Topic </b></div>
						 <div class="col-sm-2"><b>Action</b></div>
						</div>

                        <div class="all-email-div row">
                            <?php
						if(!empty($sessionDates)){

                            $last=count($sessionDates);
                            $last=$last-1;
						    foreach($sessionDates as $key=> $date){
                                $from_time_str = date('H:i',strtotime($date['from_time']));
                                $to_time_str = date('H:i',strtotime($date['to_time']));
                                //print_r($timeData);

								$displayplusnbtn='none';
								$displayminusbtn='';

								if($last==0){

									$displayplusnbtn='';
									$displayminusbtn='none';

								}else if($last==$key){

									$displayplusnbtn='';
									$displayminusbtn='';

								}
                                $min = '00:00';
                                $max = '24:00';
						?>
                            <div class="email-div col-sm-12" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-sm-2">

											<input type="date" class="form-control" placeholder="session date"
                                            id="date<?php echo $key?>" name="session_date[]" value="<?php echo $date['session_date']?>"
                                            required>

                                    </div>
									<div class="col-sm-2">
											<input type="text" class="form-control time_picker" placeholder="From Time"
                                            id="from_time<?php echo $key?>" name="from_time[]" value="<?php echo $from_time_str; ?>"
                                            required min="<?php echo $min; ?>" max="<?php echo $max; ?>">

                                    </div>
									<div class="col-sm-2">
											<input type="text" class="form-control time_picker" placeholder="To Time"
                                            id="to_time<?php echo $key?>" name="to_time[]" value="<?php echo $to_time_str; ?>"
                                            required min="<?php echo $min; ?>" max="<?php echo $max; ?>">

                                    </div>

									<div class="col-sm-2">
											<input type="text" class="form-control" placeholder="Price" id="price<?php echo $key?>" name="price[]" value="<?php echo $date['price']?>" required onkeypress="javascript:return isNumber(event)">
                                    </div>

                                    <div class="col-sm-2">
											<input type="text" class="form-control" placeholder="Topic" id="topic<?php echo $key?>" name="topic[]" value="<?php echo $date['topic']?>" required>
                                    </div>

                                    <div class="add-new-btn col-sm-2">

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
                            <div class="email-div col-sm-12" style="margin-bottom: 20px;">
                                <div class="row">
                                    <div class="col-sm-2">
											<input type="date" class="form-control" placeholder="session date"
                                            id="session_date" name="session_date[]" value="<?php echo date('Y-m-d')?>"
                                            required>

                                    </div>
									<div class="col-sm-2">
							            <input type="text" class="form-control time_picker" placeholder="From Time"
                                        id="from_time" name="from_time[]" value="" required min="<?php echo $min; ?>" max="<?php echo $max; ?>">

                                    </div>
									<div class="col-sm-2">
											<input type="text" class="form-control time_picker" placeholder="To Time"
                                            id="to_time" name="to_time[]" value="" required min="<?php echo $min; ?>" max="<?php echo $max; ?>">

                                    </div>
                                    <div class="col-sm-2">
											<input type="text" class="form-control" placeholder="Price" id="price" name="price[]"
                                            value="" required onkeypress="javascript:return isNumber(event)">

                                    </div>
                                    <div class="add-new-btn col-sm-2">

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
<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/validation.js'?>">
</script>

<script src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/js/jquery-timepicker.js'?>">
</script>

<script>
$('#supplierAdd').validate({
    rules: {
        service_id: {
            required: true,
        },
        price: {
            required: true,
        }
    },
    messages: {
        service_id: {
            required: 'Select Service',
        },
        price: {
            required: 'Please Enter Price',
        }
    },
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
    //newEntry.find('input').val(crdate);
    newEntry.find('input').val('');
    var timestamp = new Date().getUTCMilliseconds();
    newEntry.find('input').attr('id', timestamp);

    newEntry.find('.tdtn-remove').show();
    controlForm.find('.tdtn-remove').show();
    controlForm.find('.tdtn-add').hide();
    newEntry.find('.tdtn-add').show();
    if($('.time_picker').length > 0) {
        $('.time_picker').hunterTimePicker();
		}

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

function showLoader() {
    $("#loder-img").show();
}
</script>
