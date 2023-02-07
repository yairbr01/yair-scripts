<?php
// This is a shortcode that checks whether the current day is Friday / Saturday / Holiday Eve / Holiday.
// If it is a Friday / holiday eve = checks if sunset has passed = if so shows a popup.
// If it is a Saturday / holiday = checks if the tzeit has passed = if no shows a popup
// According to time zone "Asia/Jerusalem"
// You can change the time of tzeit
// Times and holidays data is taken from the Hebcal.com API

function popup_shabat() {
    
	$popup_id = '2687';
	
	$show_popup = false;
	
	date_default_timezone_set('Asia/Jerusalem');
	$date = date( 'Y-m-d' );
	$time = date( 'H:i:s' );
	$day = date('w', strtotime($date));
		
	$hebcal_date = file_get_contents( "https://www.hebcal.com/converter?cfg=json&date=$date&g2h=1&strict=1" );
	$hebcal_time = file_get_contents( "https://www.hebcal.com/zmanim?cfg=json&geonameid=281184&date=$date" );
	
	$hebcal_date_obj = json_decode($hebcal_date);
	$events = $hebcal_date_obj->events;
	$hebrew_year =  $hebcal_date_obj->hy;
	
	$hebcal_time_obj = json_decode($hebcal_time);
	$times = $hebcal_time_obj->times;
	$times_array = json_decode(json_encode ( $times ) , true);
	
	$sunset = date('H:i:s', strtotime( $times_array['sunset'] ));
	$tzeit = date('H:i:s', strtotime( $times_array['tzeit42min'] ));
		
	$holidays = array( "Rosh Hashana $hebrew_year", 'Rosh Hashana II', 'Yom Kippur', 'Sukkot I', 'Shmini Atzeret', 'Pesach I', 'Pesach VII', 'Shavuot I' );
	$erev_holidays = array( 'Erev Rosh Hashana', 'Erev Yom Kippur', 'Erev Sukkot', 'Sukkot VII (Hoshana Raba)', 'Erev Pesach', "Pesach VI (CH''M)", 'Erev Shavuot' );
	
	foreach ( $events as $event ) {
		if ( in_array($event, $holidays ) ) {
			if ( $time < $tzeit ) {
				$show_popup = true;
			}
		} elseif ( in_array($event, $erev_holidays ) ) {
			if ( $time > $sunset ) {
				$show_popup = true;
			}
		}	
	}

	if ( $day == '5' ) {
        	if ( $time > $sunset ) {
            		$show_popup = true;
        	}
	} elseif ( $day == '6' ) {
        	if ( $time < $tzeit ) {
            		$show_popup = true;
        	}	
    	}
	
	if ( $show_popup ) {
		return '<script type="text/javascript"> function popup_shabat_func() { elementorProFrontend.modules.popup.showPopup( { id: ' . $popup_id . ' } ); } window.onload = popup_shabat_func;</script>';
	}
}
add_shortcode( 'show_popup_shabat', 'popup_shabat' );

?>
