<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link rel="stylesheet" href="//cdn.datatables.net/1.10.21/css/jquery.dataTables.min.css">
<div style="margin-top: 50px;">
<link rel="stylesheet" href="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/css/BsMultiSelect.css'?>">
<link rel="stylesheet" href="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/template/assets/css/admin-booking.css'?>">
<script src="https://kit.fontawesome.com/b0b6dafee6.js" crossorigin="anonymous"></script>
<div class="c-area" style="margin-top: 50px;">
<style>
.loader {
	position: fixed;
	background: rgba(255, 255, 255, 0.6);
	top: 0px;
	right: 0px;
	left: 0px;
	bottom: 0px;
	z-index: 99999;
	width: 100%;
	height: 100vh;
	display: none;
}
.loader div {
	width: 100%;
	height: 100vh;
	display: flex;
	justify-content: center;
	align-items: center;
}
.loader div img {
	height: 80px;
	width: 80px;
}
a,button{
  text-decoration: none !important;;
}
.error{	color: red !important;    font-size: 14px;}

.c-area .container {
	max-width: 100% !important;
}
.c-area .table {
	width: 100% !important;
	border-collapse: collapse !important;
}
.c-area .table td, .c-area .table th {
	font-size: 14px !important;
	color: #000;
	border: 1px solid rgba(0,0,0,0.1);
	border-collapse: collapse !important;
	padding: 10px 15px 10px 15px;
}
.c-area .table th {
	background-color: #f3f3f3 !important;
}
</style>
<div id="loder-img" class="loader">
	<div>
		<img src="<?php echo home_url().'/wp-content/plugins/'.PLUGIN_DIR_NAME.'/loader.gif' ?>" width="80">
	</div>
</div>