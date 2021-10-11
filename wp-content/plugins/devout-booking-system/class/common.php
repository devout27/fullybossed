<?php
define('CURRENCYSYMBOL', '£');
define('CURRENCY', 'USD');
define('STRIPE_PUBLIC_KEY', 'pk_test_n7sq3wA0sNS5ZmsG15sed66m005biWueYq');
define('STRIPE_SECRET_KEY', 'sk_test_QazpuitBbcSz7wL89nFnmQi200cK6J8azj');
define('HST_PERCENT', '13');

define('FULLY_BOSSED_ACADEMY_SERVICE_ID', '195');
define('COACHING_SESSION_ID', '2');
define('COACHING_SERVICE_ID', '223');

define('SPEEKING_SESSION_ID', '3');
define('SPEEKING_SERVICE_ID', '221');
define('ADMIN_EMAIL', 'devouttest@gmail.com');
define('ZOOM_LINK_PASSWORD', 'devout');
function insertRow($table, $data)
{
    global $wpdb;
    $success = $wpdb->insert($table, $data);
    #echo $wpdb->last_query;
    if ($success)
    {

        return $wpdb->insert_id;
    }
    else
    {
        return 0;
    }

}
function updateRow($table, $data, $where)
{
    global $wpdb;
    $success = $wpdb->update($table, $data, $where);
    if ($success)
    {

        return $data['id'];
    }
    else
    {
        return 0;
    }
}
function deleteRow($table, $where)
{
    global $wpdb;
    return $wpdb->delete($table, $where);
}
function CountRow($sql)
{
    global $wpdb;
    $wpdb->get_results($sql, ARRAY_A);
    return $wpdb->num_rows;
}

function getRow($sql, $start = null, $limit = null)
{
    global $wpdb;
    if (!empty($limit))
    {

        $sql = $sql . " LIMIT " . $start . "," . $limit;
    }
    $myrows = $wpdb->get_results($sql, ARRAY_A);
    return $myrows;
}
function getRowByID($sql)
{
    global $wpdb;
    return $wpdb->get_row($sql, ARRAY_A);

}

function save($table, $data)
{

    if (!empty($data['id']))
    {

        $where['id'] = $data['id'];
        $data['updated'] = date('Y-m-d H:i:s');
        return updateRow($table, $data, $where);

    }
    else
    {

        $data['created'] = date('Y-m-d H:i:s');
        $data['updated'] = date('Y-m-d H:i:s');
        return insertRow($table, $data);
    }

}

function dateFormate($date, $time=true){
	
    $newDate = '';
    if ($date != '' && $date != '0000-00-00 00:00:00' && $date != '0000-00-00')
    {
        if ($time == false)
        {
            $newDate = date('d M Y', strtotime($date));
        }
        else
        {
            $newDate = date('d M Y H:i:s', strtotime($date));
        }
    }
	return  $newDate;
 
}

function dateFormateNew($date){
        $newDate = '';
        if ($date != '' && $date != '0000-00-00' && $date != '0000-00-00')
        {
            $newDate = date('F d Y', strtotime($date));
        }
	return $newDate;	
} 
function ftimeFormate($time)
{
    $timeNew = '';
    $timeNew = date('h:i A', strtotime($time));
    return $timeNew;
}
function pr($array, $fl = 0)
{

    echo "<pre>";
    print_r($array);
    echo "</pre>";
    if ($fl)
    {
        die('Stop Debug');
    }
}
?>
