<?php	
    function getAllSessionList($status="all"){		
		$sql="SELECT * FROM XDk_dc_sessions  ORDER BY name";
		if($status=="active"){
			$sql="SELECT * FROM XDk_dc_sessions  WHERE status=1 ORDER BY name";
		}
		if($status=="inactive"){
			$sql="SELECT * FROM XDk_dc_sessions  WHERE status=0 ORDER BY name";
		}
		$data=getRow($sql);
		return $data;
	}	
	function getAllSessionByServiceId($service_id){				
	
	    $sql="SELECT * FROM XDk_dc_sessions  WHERE service_id=$service_id AND status=1 ORDER BY id desc";		
		$data=getRow($sql);		
		return $data;	
	}
	function getSessionById($session_id=null){		
	
	    $sql="SELECT * FROM XDk_dc_sessions  WHERE id=$session_id";		$data=getRowByID($sql);		
		return $data;	
	}
	function getSessionDatesBySessionId($session_id=null){
		
		$sql="SELECT * FROM XDk_dc_session_dates  WHERE session_id=$session_id";
		$sessiondates=getRow($sql);
		$data=array();
		foreach($sessiondates as $val){
			$data[]=$val['session_date'];
		}
		return $data;
	}
	function getSessionCoachingDatesTimeBySessionId($session_id=null){
		
		$sql="SELECT * FROM XDk_dc_session_dates  WHERE session_id=$session_id";
		$sessiondates=getRow($sql);
		$data=array();
		foreach($sessiondates as $val){

            $date=$val['session_date'];
			$data[$date][]=$val;

		}
		#pr($data,1); 
		return $data;
	}

	function getSessionCoachingDatesById($id=null){		
		$sql = "SELECT * FROM XDk_dc_session_dates  WHERE id = $id";
		$data = getRowByID($sql);
		return $data;
	}

    function getSessionDatesDataBySessionId($session_id=null){
		
		$sql="SELECT * FROM XDk_dc_session_dates  WHERE session_id=$session_id";
		$sessiondates=getRow($sql);
		$data=array();
		foreach($sessiondates as $val){
			$data[]=$val;
		}
		return $data;
	}	
	function getServices(){		
	  $array=array('195'=>'Fully Bossed Academy','223'=>'Coaching','221'=>'Speaking');
	   return $array;		
	}	
	function getSessionDateTypes(){	
		$array=array(
		'1'=>'Range Date',		  
		'2'=>'Multipal Date'
		);		
		return $array;		
	}
	
	
	function getSessionHtml($session_id){
		
		$booking = getSessionById($session_id);
		$Srvices = getServices();
		$booking_status = $booking['status'] == 1 ? 'Active' : 'Inactive';
		#pr($booking,1);
		$html = '<div style="font-family: Raleway, sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px;background: #f3f3f3">
		<div style="padding: 30px; text-align:left;font-size: 14px;">

		<h5 style="font-size: 18px; line-height: 25px; display: block; margin: 0px 0px 15px 0px; padding: 15px 0px 0px 0px; color: #333;text-transform: uppercase;letter-spacing: 1px;border-top: 1px solid rgba(0,0,0,0.1);">Session Details</h5>
		<p style="line-height: 25px; display: block; margin: 0px 0px 20px 0px; padding: 15px 0px 0px 0px; border-top: 1px solid rgba(0,0,0,0.1);color: #333">		     Session Id: <strong style="color: #000; font-weight: 600;">#' .$booking['id'].'</strong>			<br>
		Created On: <strong style="color: #000; font-weight: 600;">' .dateFormate($booking['created']).'</strong><br>
		Session Status: <strong style="color: #000; font-weight: 600;">'.$booking_status. '</strong><br>Service: <strong style="color: #000; font-weight: 600;">'. $Srvices[$booking['service_id']].'</strong><br>Session Name: <strong style="color: #000; font-weight: 600;">'.$booking['name'].'</strong><br>Session Price: <strong style="color: #000; font-weight: 600;">'.CURRENCYSYMBOL.number_format($booking['price']).'</strong><br>Session Time: <strong style="color: #000; font-weight: 600;">'.ftimeFormate($booking['from_time']).' - '.ftimeFormate($booking['to_time']);

		if ($booking['session_date_type'] == 1)
		{
			$html .= "daily";
		}
		
		 $html .= "</strong>";
		
		if ($booking['session_date_type'] == 2)
		{
			$sessionDates = getSessionDatesBySessionId($session_id);
			$html .= '<br>Session Date:<br> <strong style="color: #000; font-weight: 600;">';
			foreach ($sessionDates as $date)
			{
				$html .= date('F d Y', strtotime($date)). '</br>';
			}
			$html .= '</strong>';
		}
		else
		{
			$html .= '<br>Session Date: <strong style="color: #000; font-weight: 600;">' .date('F d', strtotime($booking['from_date'])).' - '.date('d, Y', strtotime($booking['to_date'])).'</strong>';
		}
		
		$html .= '</p><div style="line-height:25px; display: block; margin: 0px 0px 20px 0px; color: #333;">Session Description:' .$booking['description']. '</div></div></div>';
		return $html;
	}

	function getSessionDetails(){
		
		$session_id=$_POST['id'];
		echo getSessionHtml($session_id);
		exit(); 
	}
?>