<?php
    $discount_rules = get_option( 'discount_rules');
    $plugin_dir_url = plugin_dir_url(__DIR__);
    $sorting_img = $plugin_dir_url.'sorting.png';
    $fb_bd_hours_input = array_column($discount_rules, 'fb_bd_hours_input');
    $count_arr = count($discount_rules);
    $max_hours = intval($discount_rules[$count_arr-1]['fb_bd_hours_input']);
    $slot_hours = 14;
    $found_key = array_search($slot_hours, $fb_bd_hours_input);
    if ($found_key !== false) {
        $discount = $discount_rules[$found_key]['fb_bd_discount_input'];
    } elseif($slot_hours >= $max_hours) {
        $discount = $discount_rules[$count_arr-1]['fb_bd_discount_input'];
    } else {
        $discount = 0;
    }
	
    // print_r($found_key);
    // print_r($discount_rules);
    // if (in_array($slot_hours, $fb_bd_hours_input)) {
    //     echo 'match found';
    // }

    // foreach($discount_rules as $value) {
    //     if (in_array($slot_hours, intval($value['fb_bd_hours_input']))) {
    //         print_r($value);
    //     }
    // }

?>
<style>
    .fb-booking-tab-btns {
	    margin: 0 0 20px 0;
    }
    .fb-booking-tab-btns .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        color: #000 !important;
        border-color: #dee2e6 #dee2e6 #fff;
    }
    .fb-booking-tab-btns .wp-person a:focus .gravatar, a:focus, a:focus .media-icon img {
        color: #000!important;
        box-shadow: none !important;
        outline: 1px solid transparent;
    }
    .fb-booking-tab-btns .nav-link {
        display: block;
        padding: .5rem 2rem !important;
    }
    .fb-booking-tab-btns ul li a {
        color: #000 !important;
    }
    .nav-item {
        color: #000 !important;
    }
</style>
<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
<div class="wrap">
    <h1 class="wp-heading-inline">Booking Discount Rules</h1>

    <div class="alert_section"></div>

        <div class="fb-booking-tab-btns">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-coaching">Booking History</a>
				<a class="nav-item nav-link " href="https://fullybossed.com/wp-admin/admin.php?page=coaching-slot-availability">Manage Sessions</a>
                <a class="nav-item nav-link active" href="https://fullybossed.com/wp-admin/admin.php?page=fb-booking-discounts">Booking Discounts</a>
			</div>
		</nav>
	</div>

    <table id="fb_bd_table" class="table fb_bd_table wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th>Hours</th>
                    <th>Status</th>
                    <th>Discount Value</th>
                    <th>Sorting</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody id="fb_bd_tbody">
                <tr>
                    <td> <input type="text" min="1" max="999" class="fb_bd_hours_input"> <i> hours </i> </td>
                    <td>
                        <select class="fb_bd_select">
                            <option class="fb_bd_enable" value="enable"> Enable </option>
                            <option class="fb_bd_disable" value="disable"> Disable </option>
                        </select>
                    </td>
                    <td> <input type="number" min="1" max="999" class="fb_bd_discount_input"> <i> % </i> </td>
                    <td> <img src="<?php echo $sorting_img; ?>" class="sorting_images"> </td>
                    <td> <button name="add_fb_bd_remove" id="add_fb_bd_remove" class="button button-primary button-large remove_fb_bd_row"> Remove </button></td>
                </tr>

        </tbody>
            <tfoot>
            <td>  </td>
            <td>  </td>
            <td>  </td>
            <td>  </td>
                <td>
                    <div class="fb_bd_add_row_sec">
                        <button name="add_fb_bd_row" id="add_fb_bd_row" class="button button-primary button-large add_fb_bd_row"> Add+ </button>
                        <button name="save_fb_bd_row" id="save_fb_bd_row" class="button button-primary button-large save_fb_bd_row"> Save </button>
                    </div>
                </td>
            </tfoot>

    </table>
</div>