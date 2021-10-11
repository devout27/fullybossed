<?php
    $plugin_dir_url = plugin_dir_url(__DIR__);
    $postData = getSessionById(SPEEKING_SESSION_ID);
    if(isset($_POST['fb_speaking_hourly_price_submit']) && $_POST['fb_speaking_hourly_price_submit'] == '1') {
        $hourly_price = isset($_POST['fb_speaking_hourly_price']) ? $_POST['fb_speaking_hourly_price'] : 0;
        /*update_option('fb_speaking_hourly_price', $hourly_price);*/
        $postData['price'] =  $hourly_price;
        $table = 'XDk_dc_sessions';
        $insert_id = updateRow($table, $postData, array('id' => SPEEKING_SESSION_ID));
    }
    //$hourly_price = get_option( 'fb_speaking_hourly_price', 0);
    $hourly_price= $postData['price'];
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
    <h1 class="wp-heading-inline">Manage Speaking Hourly Prices</h1>

    <div class="alert_section"></div>

    <div class="fb-booking-tab-btns">
		<nav>
			<div class="nav nav-tabs" id="nav-tab" role="tablist">
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-speaking">Booking History</a>
				<a class="nav-item nav-link" href="https://fullybossed.com/wp-admin/admin.php?page=bookings-speaking-request">Request Speaking</a>
				<a class="nav-item nav-link active" href="https://fullybossed.com/wp-admin/admin.php?page=fb-hourly-prices">Speaking Hourly Prices</a>
			</div>
		</nav>
	</div>

    <table id="fb_speaking_hourly_prices_table" class="table fb_bd_table wp-list-table widefat fixed striped table-view-list posts">
            <thead>
                <tr>
                    <th>Hourly Price</th>
                </tr>
            </thead>
            <tbody id="fb_bd_tbody">
                <form method="post" action="">
                    <tr>
                        <td> <i> Per hour / <?php echo CURRENCYSYMBOL?></i> <input type="number" min="1" max="999" name="fb_speaking_hourly_price" class="fb_speaking_hourly_price" value="<?php echo $hourly_price; ?>"> </td>
                        <td>
                            <button type="submit" name="fb_speaking_hourly_price_submit" id="fb_speaking_hourly_price_submit" class="button button-primary button-large fb_speaking_hourly_price_submit" value="1"> Update </button>
                        </td>
                    </tr>
                </form>
        </tbody>
    </table>
</div>
<!--  -->
