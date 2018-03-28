<?

function create_refreshdirect_shortcode($atts, $content = null) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'l' => 'http://memes.rafco.in',
			't' => '0',
			'q' => 'nsfw=0&snsfw=0',
			'a' => 'true',
		),
		$atts,
		'refreshDirect'
	);
	// Attributes in var
	$l = $atts['l'];
	
	if($l == '/invoice'){
	
	$finalurl = ("//$_SERVER[HTTP_HOST]");
	//$_SESSION['rdLink'] = $finalurl ;

	$l = $finalurl;
	}
	if($l == '/post'){
	global $wp;
	 
	// get current url with query string.
	$current_url =  home_url( $wp->request ); 
	// get the position where '/page.. ' text start.
	$pos = strpos($current_url , '');

	// remove string from the specific postion
	$finalurl = ($current_url);
	$_SESSION['rdLink'] = $finalurl ;

	$l = $finalurl;
	}
	
	
	$t = $atts['t'];
	$q = $atts['q'];
	if($q == '/sim'){
	if(!empty($_REQUEST['x_s'])){
	$gqa = $_REQUEST['x_s'];
	$gq1 = $_REQUEST['x_p'];
	$gq2 = $_REQUEST['ln'];
	$gp3 = $_REQUEST['pic'];
	$gqs = "x_s=$gqa&x_p=$gq1&ln=$gp2&pic=$gp3";
	//$_SESSION['rdLink'] = $finalurl ;
	$q = $gqs;
	}
	}else{
	$q = '';
	}
	if($q == '/fb'){
	if(!empty($_REQUEST['ofbid'])){
	$gqa = $_REQUEST['ofbid'];
	$gq1 = $_REQUEST['fn'];
	$gq2 = $_REQUEST['ln'];
	$gp3 = $_REQUEST['pic'];
	$gqs = "ofbid=$gqa&fn=$gq1&ln=$gp2&pic=$gp3";
	//$_SESSION['rdLink'] = $finalurl ;
	$q = $gqs;
	}
	}else{
	$q = '';
	}
	if($q == '/get'){
	if(!empty($_REQUEST['invoice_id'])){
	$gq = $_REQUEST['invoice_id'];
	$gq = "invoice_id=$gq";
	//$_SESSION['rdLink'] = $finalurl ;
	$q = $gq;
	}else{
	$q = '';
	}
	}
	$a = $atts['a'];
	
	if($a == 'true'){
	
	
	if ( is_user_logged_in() ) {
	//$go = '<meta http-equiv="refresh" content="'. $t .'; url='. $l .'?'. $q .'">';
	 //   echo $go ;
	} else {
	$ll = wp_login_url( get_permalink() );
	$go = '<meta http-equiv="refresh" content="'. $t .'; url='. $ll .'?'. $q .'">';
	    echo $go ;
	}
	
	
	
	}else{
	
	$go = '<meta http-equiv="refresh" content="'. $t .'; url='. $l .'?'. $q .'">';
	echo $go ;
	}
}
add_shortcode( 'refreshDirect', 'create_refreshdirect_shortcode' );














?>
