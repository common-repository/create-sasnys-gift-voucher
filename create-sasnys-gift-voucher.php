<?php
  /**
   * @package create-sasnys-gift-voucher
   */

	/*
  Plugin Name: Create Sasnys Gift Voucher
  Text Domain: create-sasnys-gift-voucher
  Plugin URI: https://seriah.net.au/plugins
  Description: Creates a Gift voucher with a PayPal CONNECTION
  Version: 1.0.0
  Author: Robert Dwight
  Author URI: https://www.seriah.net.au
  License: GPLv2 or later
  Shortcodes: sasnys_GetPrice ,sasnys_MakePage , sasnys_ShowLedger, sasnys_Cancelled
  this version:- print selection database enabled  NO DEBUG READS VERSION 26 10 2019 DEBUG ENABLED
  */
if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) {
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}
if ( ! defined( 'ABSPATH' ) ) {
	die;}

                            
define( 'duebug', false );

define( 'SGVC_plugin_name', plugin_basename( __FILE__ ) );
define( 'SGVC_Plugin_Path', plugin_dir_path( __FILE__ ) . 'bin/admin_templates/' );
define( 'SGVC_thisURL', plugin_dir_url( __FILE__ ) );
define( 'sgvc_this_dir', plugin_dir_path( __FILE__ ) );
define( 'SGVC_Design', plugin_dir_url( __FILE__ ) . 'bin/dsign/' );
define( 'SGVC_BASE_PATH', ABSPATH, true );
define( 'SGVC_AdminFolder', __FILE__ . 'wp-admin/', true );
define( 'SGVC_HomewURL', get_site_url() );
define( 'SGVC_two_days', 172800 );
		$SGVC_cullop      = $rootDir . DIRECTORY_SEPARATOR;
		$SGVC_ContentAddr = rtrim( sgvc_this_dir, chr( 47 ) );
		$SGVC_ContentURL  = rtrim( SGVC_thisURL, chr( 47 ) ) . chr( 47 );
		$SGVC_formarr     = array( '0' );
		$SGVC_javaAddr    = $SGVC_ContentURL . 'bin/dsign/GiftVoucher.js';
		$SGVC_styleAddr   = $SGVC_ContentURL . 'bin/dsign/GiftVoucher.css';
		$SGVC_HomewURL    = SGVC_HomewURL;

// add_action( 'init', array($this, 'load_plugin_textdomain') );

		global $tableIsTo,$tableIs,$contISbody,$pdfISFile;
		$tableIsTo = 'seriahglobevars';
		$tableIs   = 'seriahvouchers';
			require_once sgvc_this_dir . 'bin/dsign/functions.php';

if ( class_exists( 'Bin\admin_templates\\Init' ) ) {
	Bin\admin_templates\Init::register_services();     }


	use Bin\admin_templates\Activate;
	use Bin\admin_templates\Deactivate;

function activation() {
	Activate::activate();
}

function deactivaton() {
	Deactivate::deactivate();
}

	register_activation_hook( __FILE__, 'activation' );
	register_deactivation_hook( __FILE__, 'deactivaton' );


			$SGVC_valuIS = SGVC_site_credentials( $tableIsTo );
			$SGVC_Xy     = array();
$StopNext;
			$busidcode = $SGVC_valuIS[5];

			$SGVC_Xy[0] = '105px';
$SGVC_Xy[1]             = '7px';
$SGVC_Xy[2]             = '580px';
$SGVC_Xy[3]             = '708px';
$SGVC_setWid            = ( $SGVC_Xy[2] - 70 ) . 'px';


add_action( 'plugins_loaded', 'init_textdomain' );

function init_textdomain() {
	load_plugin_textdomain(
		'create-sasnys-gift-voucher',
		false,
		dirname( plugin_basename( __FILE__ ) ) . '/languages/'
	);
}


   /*
	>>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	/*
	 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	 /*
	  >>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	  /*
	   >>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	   /*
		>>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
		/* >>>>>>>>>>>>>>>>>>>>>>>  SGVC_SendToPayPal_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/

function SGVC_SendToPayPal_func( $atts, $content = null ) {
	global $StopNext;
	if ( ( $StopNext == false ) || ( $StopNext == null ) ) {
		 $StopNext = true;
		 global $wpdb,$busidcode,$tableIs;
		 $errSet   = 1062;
		$item_name = 'Gift Card';
		 $errNote  = '';
		$chxed     = 0;

		if ( SGVC_testdb() == true ) {
			   $useVAR = SGVC_get_record_enum( $tableIs );
			if ( $useVAR == false ) {
				$chxed = SGVC_create_new_record( $tableIs );}
			   $newNumb = SGVC_format_cur_record( $tableIs, $useVAR, $item_name );
			   SGVC_chk_redundent( $tableIs, $useVAR );
			   $StopNext = false;
		}
	} else {
		$StopNext = false;
		$errNote  = SGVC_error_note( 1 );}
	if ( $errNote == '' ) {
		if ( $content !== null ) {
			$StopNext = false;
			return ( SGVC_showlots( $newNumb, $busidcode ) );
		}
	} else {
			   $StopNext = false;
				return $errNote;
	}
}
 add_shortcode( 'sasnys_GetPrice', 'SGVC_SendToPayPal_func' );

 /*
  >>>>>>>>>>>>>>>>>>>>>>>  SGVC_Makegiftvoucher_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
  /*
   >>>>>>>>>>>>>>>>>>>>>>>  SGVC_Makegiftvoucher_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
   /*
	>>>>>>>>>>>>>>>>>>>>>>>  SGVC_Makegiftvoucher_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	/*
	 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_Makegiftvoucher_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
	 /* >>>>>>>>>>>>>>>>>>>>>>>  SGVC_Makegiftvoucher_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/

function SGVC_Makegiftvoucher_func( $atts, $content = null ) {

	   global $wpdb,$SGVC_ContentAddr,$SGVC_ContentURL,$SGVC_javaAddr,$SGVC_formarr,$SGVC_valuIS,$SGVC_Xy,$SGVC_styleAddr,$SGVC_setWid,$tableIs,$contISbody,$pdfISFile;

		   $acceptprint = 0;
	$butpad             = '';
	$SGVC_IsUserJob     = 0;
	$voucherdata        = '';
	$goingback          = 0;
	$finisd             = 0;
	$waitabit           = null;
	$custom             = '';
	$voucherhtml        = '';
	$backimg            = 'GiftVoucher2c.png';
	$SGVC_formarr       = array( __( 'A special gift card for someone special', 'create-sasnys-gift-voucher' ), '', '', '0', __( 'recipiants name', 'create-sasnys-gift-voucher' ), __( 'a name to use as the provider of the voucher', 'create-sasnys-gift-voucher' ), '30 December 2020', 'CDA46XFDC', 'robert@seriah.net.au', '1', 'Gift-Card' );
	if ( ! empty( $_GET['custom'] ) ) {
		$SGVC_formarr[7] = sanitize_text_field( $_GET['custom'] );
		$SGVC_IsUserJob++; }
	if ( ! empty( $_POST['custom'] ) ) {
		$SGVC_formarr[7] = sanitize_text_field( $_POST['custom'] );
		$SGVC_IsUserJob++; }

	if ( $SGVC_formarr[7] !== 'CDA46XFDC' ) {
		$SGVC_formarr[7] = trim( html_entity_decode( $SGVC_formarr[7], ENT_QUOTES ) );
		$custom          = SGVC_sasnysnet( 0, $SGVC_formarr[7] );
		$SGVC_formarr[7] = $custom;}

	if ( ! empty( $_POST['SGVC_voucherdata'] ) ) {
					  $vouchDAT    = wp_filter_post_kses( $_POST['SGVC_voucherdata'] );
					  $voucherdata = base64_decode( $vouchDAT );
					   $SGVC_IsUserJob++;
		if ( ( strlen( $voucherdata ) !== strlen( $vouchDAT ) ) && ( strlen( $voucherdata ) < strlen( $vouchDAT ) ) ) {
			$SGVC_formarr     = explode( '~!^', $voucherdata, 11 );
			$SGVC_formarr[11] = $wpdb->dbuser;
			$SGVC_formarr[12] = $wpdb->dbpassword;
			$SGVC_formarr[13] = $wpdb->dbname;
			$SGVC_formarr[14] = $SGVC_valuIS[0];
			$stepin           = explode( '!*!', $SGVC_valuIS[8], 2 );
			$SGVC_formarr[15] = $stepin[0];
			$SGVC_formarr[16] = $SGVC_valuIS[1];
			$SGVC_formarr[17] = $SGVC_valuIS[2];
		}
		if ( ! empty( $_POST['SGVC_voucherhtml'] ) ) {
						$voucherhtml = wp_filter_post_kses( $_POST['SGVC_voucherhtml'] );
						 $SGVC_IsUserJob++;
		}
	} else {

		try {
			if ( SGVC_testdb() ) {
				$codefetch     = array( '0' );
				$codefetch[4]  = '';
				$countWaits    = 0;
				$code_follower = false;
				do {
					if ( ( ( $codefetch[4] == '' ) && ( $countWaits <= 10 ) ) && ( ( $custom != '00000000' ) && ( $custom != '' ) ) ) {
						$sqlSTR = "SELECT * FROM $tableIs WHERE `codehexis` = '$custom';";
						// $sqlSTR           = $wpdb->prepare( $sqlSTR, array($tableIs,$custom) );
						$codefetch        = $wpdb->get_row( $sqlSTR, ARRAY_N );
						$SGVC_formarr[5]  = $codefetch[3];
						$SGVC_formarr[6]  = $codefetch[4];
						$SGVC_formarr[7]  = $codefetch[1];
						$SGVC_formarr[8]  = $codefetch[6];
						$SGVC_formarr[3]  = $codefetch[5];
						$SGVC_formarr[10] = $codefetch[7];
						if ( $SGVC_formarr[6] == null ) {
							sleep( 2 );  }
					}
					$countWaits++;
				} while ( ( ( $countWaits <= 11 ) && ( $codefetch[4] == '' ) ) && ( ( $custom != '00000000' ) && ( $custom != '' ) ) );

			} else {
				return '<center><br /><br /><p><H1>' . esc_html__( 'There has been an error in establishing a connection to the database with this sort of error', 'create-sasnys-gift-voucher' ) . '<br />' . esc_html__( 'please Phone ', 'create-sasnys-gift-voucher' ) . $SGVC_valuIS[2] . '</H1></p></center>';  }
		} catch ( Exception $e ) {
			return '<center><br /><br /><p><H1>' . esc_html__( 'There has been an error in establishing a connection to the database with this sort of error', 'create-sasnys-gift-voucher' ) . '<br />' . esc_html__( 'please Phone ', 'create-sasnys-gift-voucher' ) . $SGVC_valuIS[2] . '</H1></p></center>';
		}
	}
	if ( $SGVC_IsUserJob >= 1 ) {
		if ( ! empty( $_POST['SGVC_backimg'] ) ) {
						$backimg  = sanitize_text_field( $_POST['SGVC_backimg'] );
						 $backimg = SGVC_chkimage( $backimg );
		}

		if ( ! empty( $_POST['SGVC_goingback'] ) ) {
						$goingback = sanitize_text_field( $_POST['SGVC_goingback'] );
			if ( strlen( $goingback ) !== 1 ) {
				$goingback = 1;}
		}
		if ( ! empty( $_POST['vouchertopposis'] ) ) {
						$SGVC_Xy[0] = sanitize_text_field( $_POST['vouchertopposis'] );
			if ( ! ( strlen( $SGVC_Xy[0] ) <= 5 ) ) {
				$SGVC_Xy[0] = '95px';
			}
		}

		$pagehead = "<!DOCTYPE html>
<html>
    <head>
<meta http-equiv='Expires' content='Fri, Jan 01 2015 00:00:00 GMT'>
<meta http-equiv='Pragma' content='no-cache'>
<meta http-equiv='Cache-Control' content='no-cache'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta http-equiv='Lang' content='en'>
<meta name='creation-date' content='09/06/2014'>
<META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'>
<meta http-equiv='Content-Type' content='text/html;charset=UTF-8'>
 <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Gift Card</title>
             
     <style type='text/css'>@font-face {
        font-family:Tangerine;
        src:url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.eot') format('truetype');
        src: local(Tangerine), url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.woff') format('woff'),url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.afm'), url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.ttf') format('truetype');
   
    }
        #moses{font-family:Tangerine !important;text-align: center;}
        #vouchtable{font-family:Tangerine !important;}    
        .mosetes{font-family: Tangerine !important;}
     </style> 
      </head>
     <body >
    <div id='moses' >";

		$pageheadend = '</div></body></html>';

		if ( ! empty( $_POST['SGVC_acceptprint'] ) ) {
			  $acceptprint = sanitize_text_field( $_POST['SGVC_acceptprint'] );
			$pdfISFile     = '';
			$contISbody    = '';
			$sentok        = '';
			$butpad        = '';
			$PageContentIs = htmlentities( rawurlencode( $pagehead ), ENT_QUOTES ) . $voucherhtml . htmlentities( rawurlencode( $pageheadend ), ENT_QUOTES );
			$pdfISFile     = SGVC_CreateClientPdf( $SGVC_styleAddr, $SGVC_ContentAddr, $PageContentIs );

			if ( ( $SGVC_formarr[9] == 2 ) || ( $SGVC_formarr[9] == 3 ) ) {
				$waitabit = SGVC_transfer( SGVC_thisURL, $SGVC_ContentAddr, $pdfISFile, $SGVC_formarr[10] );
				$butpad   = "<input type='button' class = 'bigbutt2' value='" . esc_html__( 'Download Voucher', 'create-sasnys-gift-voucher' ) . "' name='dwnbutt' id='subdwn' onclick='javascript:SGVC_downpage(\"" . $waitabit . "\");'/><br />";}
			if ( ( SGVC_UpdateRecords( $SGVC_formarr ) !== false ) && ( $pdfISFile !== '' ) ) {
				if ( ( $SGVC_formarr[9] == 1 ) || ( $SGVC_formarr[9] == 3 ) ) {

					$contISbody = SGVC_makemailbody( $SGVC_formarr, SGVC_getlongdat( 'now' ) );
					$sentok     = SGVC_SendPHPMailer( $contISbody, $SGVC_ContentAddr, $SGVC_formarr[5], $pdfISFile, $SGVC_formarr[8], $SGVC_valuIS );

					if ( $sentok == '' ) {
						$finisd = 2;
					} else {
						$finisd = 1; }
				} else {
					$finisd = 1;}
			} else {
				$finisd = 2;}
		}

			$acceptprint = 0;
			$insimg      = '';
		if ( $SGVC_valuIS[8] !== esc_html__( 'none selected', 'create-sasnys-gift-voucher' ) ) {
			   $comfile = explode( '!*!', $SGVC_valuIS[8], 2 );
			   $insimg  = "<img src='$comfile[0]';background-repeat:no-repeat;>";
		}
			$pagethanks = '<br /><br /><br /> <center>' . $insimg . "
            <div style='width:600px; height:300px; vertical-align: middle;'>
            <input type='hidden' name='SGVC_goingback' id='SGVC_goingback' value=''>
            <input type='hidden' name='SGVC_acceptprint' id='SGVC_acceptprint' value=''>
            <input type='hidden' name='vouchertoppos' id='vouchertoppos' value=''>
            <h1>" . esc_html__( 'The Gift card processors have finished', 'create-sasnys-gift-voucher' ) . '<br />
            ' . esc_html__( 'Thanking you for your custom click the button to download your voucher or go back to edit your gift card', 'create-sasnys-gift-voucher' ) . '</h1><br />
            <h3>' . esc_html__( 'If you have any problems please contact ', 'create-sasnys-gift-voucher' ) . $SGVC_valuIS[2] . '</h3><br /> 
        ' . $butpad . "
            <input type='button' class='bigbutt2' value='" . esc_html__( 'Go back to editor', 'create-sasnys-gift-voucher' ) . "' name='closebutt' id='subscls' onclick='javascript: SGVC_sendtocancel();'></div></center>";

			$pagerror      = "<br /><br /><br /><center><div style=\"width:402px; height:63px;background-image:url('$comfile[0]');background-repeat:no-repeat;\">
            </div><div style='width:600px; height:300px; vertical-align: middle;'>

            <h1>" . esc_html__( 'The Gift card processors have had an error', 'create-sasnys-gift-voucher' ) . "'<br />
           " . esc_html__( ' please contact ', 'create-sasnys-gift-voucher' ) . $SGVC_valuIS[2] . ' <br />' . esc_html__( 'taking note of the time', 'create-sasnys-gift-voucher' ) . ' <br />' . esc_html__( 'for referance to PayPal', 'create-sasnys-gift-voucher' ) . '</h1><br />
            <h2>' . esc_html__( ' click the button to close ', 'create-sasnys-gift-voucher' ) . "</h2><br /> 
            <input type='button' style='font-size: 25px;background-color:#D3B169;color:white;width:255px;height:84px;' value='" . esc_html__( 'Close Page', 'create-sasnys-gift-voucher' ) . "' name='closebutt' id='subscls' onclick=\"javascript: window.open('','_top','');window.close();\"></center>";
			$pageheadtwo   = "<style type='text/css'>@font-face {
        font-family:Tangerine;
        src:url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.eot') format('truetype');
        src: local(Tangerine), url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.woff') format('woff'),url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.afm'), url('" . $SGVC_ContentURL . "fonts/Tangerine-Bold.ttf') format('truetype');
   
    }
        #moses{font-family:Tangerine !important;text-align: center;}
        #vouchtable{font-family:Tangerine !important;}    
        .mosetes{font-family: Tangerine !important;}
     </style>
            <div id='moses'><form name='makeservoucher' id='makeservoucher' method='post'>";
			$pageSettingst = " <div style=\"position:relative !important;width:1500px; height:708px;top:1px; left:-82px; vertical-align: bottom; border-color: #E8F7F7 !important;\">
             <table width='100%' class='tablemakeIS' >     
                
                <tr>
                    <td width='8'></td>
                    <td colspan='8' width='600' align='center' ><h1><b><font face='Book Antiqua' size='6' color='#800000'>" . esc_html__( 'Gift Certificate design page', 'create-sasnys-gift-voucher' ) . "</font></b></h1></td>
                    <td width='25'>&nbsp;</td>
                </tr>
                <tr>
                    <td width='8'>&nbsp;</td>
                    <td align='center'  width='600' colspan='8' class='heading2'>" . esc_html__( 'You have successfully navigated through to the design page', 'create-sasnys-gift-voucher' ) . "</td>
                    <td  valign='top'>&nbsp;</td>
                    
                </tr>                            
                <tr>
                    <td width='8'>&nbsp;</td>
                    <td rowspan='15' colspan='4' style='width:850px; height:650px;'>";
			// <<<<<<<<<<<<<<<<<<<<<<<<<<<<< INNER TABLE >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

			$setLogoat = '';
		if ( $SGVC_valuIS[8] !== 'none selected' ) {
			$ssplarr   = explode( '!*!', $SGVC_valuIS[8], 2 );
			$setLogoat = "<img border='0' src='$ssplarr[0]' width='$SGVC_setWid' height='75px'>";}
			$pageprint = "<div id='vouchtable' style=\" position: absolute; top:$SGVC_Xy[0];left:$SGVC_Xy[1]; width:$SGVC_Xy[2]; height:$SGVC_Xy[3]; background-color:#FDFBEE; background-image:url('" . $SGVC_ContentURL . 'img/' . $backimg . "');background-repeat:no-repeat;\">
                    <div style='position:absolute; Top:30px;left:35px; width:$SGVC_setWid;height:75px;'>$setLogoat</div>
                    <div style='position:absolute; Top:140px;left:80px; width:415px;height:40px;'><input type='text' id='giftext' style= 'font-family:Tangerine !important;width:100%;height:100%; border-style: none;background-color: transparent;color:black;text-align: center;font-size: 36px !important; font-weight:700;' size='45' disabled  value='" . $SGVC_formarr[0] . "'></div>                          
                    <div style='position:absolute; Top:164px;left:80px; width:415px;height:40px;'><input type='text' id='giftext1' style= 'font-family:Tangerine !important;width:100%;height:100%; border-style: none;background-color: transparent;color:black;text-align: center;font-size: 36px !important;font-weight:700;' size='45' disabled value='" . $SGVC_formarr[1] . "'></div>
                    <div style='position:absolute; Top:188px;left:80px; width:415px;height:40px;'><input type='text' id='giftext2' style= 'font-family:Tangerine !important;width:100%;height:100%; border-style: none;background-color: transparent;color:black;text-align: center;font-size: 36px !important;font-weight:700;' size='45' disabled value='" . $SGVC_formarr[2] . "'></div>
                    <div style='position:absolute; Top:270px;left:120px; width:106px;height:30px;'><input type='text' style=  'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none; background-color: transparent;color:#7F6E29; text-align: center; font-weight:700;font-size: 24px !important;' id='giflab' size='10' disabled value='" . esc_html__( 'Gifted to', 'create-sasnys-gift-voucher' ) . "' ></div> 
                    <div style='position:absolute; Top:230px;left:120px; width:190px;height:34px;'><input type='text' style = 'font-family:Tangerine !important;width:100%;  height:100%; overflow: hidden; border-style: none; background-color: transparent; color:black;text-align: center;font-weight:700;font-size: 30px !important; ' id='vallab' size='13' disabled value='" . esc_html__( 'Value of ', 'create-sasnys-gift-voucher' ) . chr( 36 ) . $SGVC_formarr[3] . "' ></div>
                    <div style='position:absolute; Top:302px;left:85px; width:425px;height:39px;vertical-align: top;'><input type='text' style = 'font-family:Tangerine !important;width:97%;  height:100%; overflow: hidden; border-style: none; background-color: transparent; color:black;text-align: center;font-weight:700;font-size: 36px !important; ' size='55' id='gifto' disabled value='" . $SGVC_formarr[4] . "' ></div>
                    <div style='position:absolute; Top:340px;left:80px; width:200px;height:30px;'><input type='text' style=  'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none; background-color: transparent;color:#7F6E29; text-align: center;font-size: 24px !important;font-weight:700;'  id='fromlab' size='11' disabled value='" . esc_html__( 'Gifted from', 'create-sasnys-gift-voucher' ) . "' ></div> 
                    <div style='position:absolute; Top:380px;left:85px; width:425px;height:32px;'><input type='text' style='font-family:Tangerine !important;width:95%;height:100%; overflow: hidden; border-style: none; background-color: transparent;color:black;text-align: center;font-size:28px !important;font-weight:700; ' id='giftfrom' size='55' disabled value='" . $SGVC_formarr[5] . "' ></div>
                    <div style='position:absolute; Top:422px;left:120px; width:100px;height:32px;'><input type='text' style= 'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none; background-color: transparent;color:#7F6E29; text-align: center;font-size: 30px !important; font-weight:700;'  id='dater' disabled size='13' value='" . esc_html__( 'expiry date', 'create-sasnys-gift-voucher' ) . "' ></div>
                    <div style='position:absolute; Top:422px;left:360px; width:100px;height:32px;'><input type='text' style= 'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none; background-color: transparent;color:#7F6E29; text-align: center;font-size: 30px !important;font-weight:700;'  size='9' id='giftfrom1' disabled value='" . esc_html__( 'code name', 'create-sasnys-gift-voucher' ) . "' ></div>
                    <div style='position:absolute; Top:450px;left:100px; width:202px;height:30px;'><input type='text' style = 'font-family:Tangerine !important;width:100%;  height:100%; overflow: hidden; border-style: none; background-color: transparent; text-align: center;font-size: 20px !important; color:red;font-weight:700;'    id='dateset' disabled size='18' value='" . $SGVC_formarr[6] . "' ></div>        
                    <div style='position:absolute; Top:450px;left:340px; width:120px;height:30px;'><input type='text' style = 'font-family:Tangerine !important;width:95%;  height:100%; overflow: hidden; border-style: none; background-color: transparent; text-align: center;font-size: 20px !important; color:red;font-weight:700;'   id='codeset' disabled size='13' value='" . $SGVC_formarr[7] . "' ></div>
                    <div style='position:absolute; Top:490px;left:120px; width:360px;height:30px;'><input type='text' style= 'font-family:Tangerine !important;width:95%;height:100%; overflow: hidden;border-style: none;background-color: transparent;color:#990033;text-align: center;font-size:22px !important;font-weight:700; ' id='dater1' disabled size='40' value='" . $SGVC_valuIS[0] . "' ></div>
                    <div style='position:absolute; Top:516px;left:145px; width:296px;height:32px;'><input type='text' style='font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none;background-color: transparent;color:#990033;text-align: center;font-size:22px !important;font-weight:700;'  id='dater2' disabled size='30' value='" . $SGVC_valuIS[1] . "' ></div>
                    <div style='position:absolute; Top:548px;left:120px; width:180px;height:30px;'><input type='text' style= 'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none;background-color: transparent;text-align: center; font-size:24px !important;color:red;font-weight:700;'  id='dater3' disabled size='15' value='" . $SGVC_valuIS[2] . "' ></div>
                    <div style='position:absolute; Top:558px;left:280px; width:180px;height:30px;'><input type='text' style= 'font-family:Tangerine !important;width:100%;height:100%; overflow: hidden;border-style: none;background-color: transparent;text-align: right;font-size:24px !important;color:red;font-weight:700;'  id='dater4' disabled size='15' value='" . $SGVC_valuIS[3] . "' ></div>
                    </div>";

			$formmemory = " <div>
                    <input type='hidden' name='SGVC_voucherdata' id='SGVC_voucherdata' value='" . base64_encode( $voucherdata ) . "'>
                    <input type='hidden' name='voucherwebed' id='voucherwebed' value=''>
                    <input type='hidden' name='SGVC_goingback' id='SGVC_goingback' value=''>
                    <input type='hidden' name='SGVC_backimg' id='SGVC_backimg' value='" . $backimg . "'>
                    <input type='hidden' name='vouchertopposis' id='vouchertoppos' value='95px'>
            
            </div>";
			// <<<<<<<<<<<<<<<<<<<<<<< PAGE SETTINGS>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

			$pageSettingend = "</td>
            
            <td   colspan='3' align='right'  class='makebigger'>" . esc_html__( 'The recipients name to put on certificate  ', 'create-sasnys-gift-voucher' ) . "</td>
            <td  valign='top'>
                <input type='text' name='recipname' class='sizemore' size='65' onfocus='this.select()' ID='recipid' onchange=\"javascript:SGVC_updateform('recipid','gifto');\" onclick =\"javascript:SGVC_updateform('recipid','gifto');\" value='" . $SGVC_formarr[4] . "'></td>
            <td  >&nbsp;</td>
        </tr>
        <tr>
            <td  >&nbsp;</td>
            <td >&nbsp;</td>
            <td colspan='2' >&nbsp;</td>
            <td  >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  colspan='2' align='center'  class='makebigger'>" . esc_html__( 'From name', 'create-sasnys-gift-voucher' ) . "</td>
           
            <td  valign='top'>" . esc_html__( 'Preferred name', 'create-sasnys-gift-voucher' ) . "<br>
            <input type='text' class='sizemore' name='fromname' size='65' onfocus='this.select()' ID='fromvid' onchange=\"javascript:SGVC_updateform('fromvid','giftfrom');\" onclick=\"javascript:SGVC_updateform('fromvid','giftfrom');\" value='" . $SGVC_formarr[5] . "'></td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td  >&nbsp;</td>
            <td  colspan='2' align='center'  class='makebigger'>" . esc_html__( 'Gift Card Expiry date', 'create-sasnys-gift-voucher' ) . "</td>
            
            <td  valign='top'>
            <input type='text' class='sizemore' name='vouchndate' id='vouchdate' disabled size='20' value='" . $SGVC_formarr[6] . "'></td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td  >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td colspan='2' align='center'  class='makebigger'>" . esc_html__( 'Value of Gift Card', 'create-sasnys-gift-voucher' ) . "</td>
            
            <td valign='top'><input type='text' class='sizemore' name='vouchnvalue' id='vouchvalue' disabled size='7' value='$" . $SGVC_formarr[3] . "'></td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
         <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  colspan='2' align='center'  class='makebigger'>" . esc_html__( 'Gift Card code number', 'create-sasnys-gift-voucher' ) . "</td>
            
            <td  valign='top'><input type='text' class='sizemore' name='vouchnser' id='vouchnser' disabled size='8' value='" . $SGVC_formarr[7] . "'></td>
            <td >&nbsp;</td>
        </tr>
            <tr>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  colspan='2'align='center'  class='makebigger'>" . esc_html__( 'Your e-mail address', 'create-sasnys-gift-voucher' ) . "</td>
            
            <td  valign='top' class='readimprtant'>
            <input type='text' class='sizemore' name='buyemail' id='buyemail' size='65' title='" . esc_html__( 'Please enter an email address to send attached pdf to', 'create-sasnys-gift-voucher' ) . "' onfocus='this.select()' value='" . $SGVC_formarr[8] . "'></br>
            " . esc_html__( 'The e-mail acct to forward the certificate for printing', 'create-sasnys-gift-voucher' ) . "</td>
            <td ><input type='hidden' name='vouchednames' id='vouchedName' value='" . $SGVC_formarr[10] . "'></td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td  valign='top'></td>
            <td >&nbsp;</td>
        </tr>
        <tr style='vertical-align:bottom;'>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  colspan='2' align='center' class='makebigger'>" . esc_html__( 'Text for Gift Card', 'create-sasnys-gift-voucher' ) . "</td>
           
            <td>
            <textarea name='certtext' class='optionslist' onfocus='this.select()' title='" . esc_html__( 'you can add or change any text in this area', 'create-sasnys-gift-voucher' ) . "'  ID='scriptvid' onchange='javascript:SGVC_updatettoprow();' onclick='javascript:SGVC_updatettoprow();' rows='3' cols='43' wrap='hard'>" . $SGVC_formarr[0] . $SGVC_formarr[1] . $SGVC_formarr[2] . "</textarea></td>
            <td >&nbsp;</td>
        </tr>
        <tr style='vertical-align:top;'>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td >&nbsp;</td>
            <td ><select name='gifttext'  class='optionslist' id='text4gift' size='1' title='" . esc_html__( 'selection of suitable sentenances to choose and or change', 'create-sasnys-gift-voucher' ) . "' onclick='SGVC_insertto()'>
                                    <option value=''>" . esc_html__( 'Example text', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'To the best dad in the world', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'To the best dad in the world', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'To the best mum in the world', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'To the best mum in the world', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'To the best nanna in the world', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'To the best nanna in the world', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'To the best pop in the world', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'To the best pop in the world', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'For a job well done', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'For a job well done', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'Its our anniversary', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'Its our anniversary', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'A special gift card for someone special', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'A special gift card for someone special', 'create-sasnys-gift-voucher' ) . "</option>
                                    <option value='" . esc_html__( 'Just because you deserve it', 'create-sasnys-gift-voucher' ) . "'>" . esc_html__( 'Just because you deserve it', 'create-sasnys-gift-voucher' ) . "</option>
                           </select></td>
            <td >&nbsp;</td>
        </tr>
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td  align='center'>&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td  valign='top'>
            <input type='button' id='butsub' value='" . esc_html__( 'Submit for printing', 'create-sasnys-gift-voucher' ) . "' class='bigbutt' name='sendbutt' id='subprint' onclick=\"javascript:SGVC_sendtopreprint('-80px');\"></td>
            <td  colspan='2' class='readimprtant' ><input type='radio' name='exsport' value='1' " . SGVC_ISCHECK( 1, $SGVC_formarr[9] ) . " id='exsport1'>" . esc_html__( 'Create email with Attachment', 'create-sasnys-gift-voucher' ) . "<input type='radio' name='exsport' id='exsport2'  " . SGVC_ISCHECK( 2, $SGVC_formarr[9] ) . " value='2'>" . esc_html__( 'Download from browser', 'create-sasnys-gift-voucher' ) . "<br /><input type='radio' name='exsport' id='exsport3'  " . SGVC_ISCHECK( 3, $SGVC_formarr[9] ) . " value='3'>" . esc_html__( 'Both', 'create-sasnys-gift-voucher' ) . "</td>
            <td >&nbsp;</td>
        </tr>
        
        <tr>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td >&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td> 
            <td colspan='4' align='left'  class='makebigger' ><img src='" . $SGVC_ContentURL . "img/GiftVoucher1s.png' onclick='javascript:SGVC_chgbck(1);' border='0' width='92' height='112' title='" . esc_html__( 'Select a frame for the gift card', 'create-sasnys-gift-voucher' ) . "' alt='" . $SGVC_ContentURL . "/img/GiftVoucher1s.png (9,002 bytes)'>
            " . esc_html__( 'Select a border', 'create-sasnys-gift-voucher' ) . "
            <img src='" . $SGVC_ContentURL . "img/GiftVoucher2s.png' onclick='javascript:SGVC_chgbck(2);'border='0' width='92' height='112' title='" . esc_html__( 'Select a frame for the gift card', 'create-sasnys-gift-voucher' ) . "' alt='" . $SGVC_ContentURL . "/img/GiftVoucher2s.png (3,362 bytes)'></td>
            <td colspan='1' align='left'><input type='hidden' name='SGVC_voucherhtml' id='SGVC_voucherhtml' value='" . htmlentities( rawurlencode( $pageprint ), ENT_QUOTES ) . "'> </td>
            
        </tr>
    </table>


        </div>";
			$pageheadendtwo = "     
        
       </div><input type='hidden' name='SGVC_acceptprint' id='SGVC_acceptprint' value='" . $acceptprint . "'></form></div>";
			$insertab       = '';
		if ( $SGVC_formarr[9] == 1 ) {
			$insertab = esc_html__( 'Are you ready to print the Gift card to a PDF and mail it to', 'create-sasnys-gift-voucher' ) . '&nbsp;' . $SGVC_formarr[8];}
		if ( $SGVC_formarr[9] == 2 ) {
			$insertab = esc_html__( 'Are you ready to download a PDF file of the Gift Card ?', 'create-sasnys-gift-voucher' );}
		if ( $SGVC_formarr[9] == 3 ) {
			$insertab = esc_html__( 'Are you ready to print the Gift card to a PDF', 'create-sasnys-gift-voucher' ) . '</br>' . esc_html__( 'and mail it to', 'create-sasnys-gift-voucher' ) . '&nbsp;' . $SGVC_formarr[8] . '&nbsp;' . esc_html__( 'as well as downloading a copy?', 'create-sasnys-gift-voucher' );}
			$pagechk    = '<div style="position: relative;width:580px; height:708px; top:20px; "><center>';
			$pagechkend = "<div class='makeclearer' >" . $insertab . "<br /><br /><input type='button' class='bigbutt2' value='" . esc_html__( 'Submit for printing', 'create-sasnys-gift-voucher' ) . "' name='sendbutt' id='subprint' onclick='javascript:SGVC_sendtoprint();'>
            <input type='button' class='bigbutt2' value='" . esc_html__( 'Close Page', 'create-sasnys-gift-voucher' ) . "' name='clsbutt' id='subcls' onclick='javascript:SGVC_closepage();'>
            <input type='button' class='bigbutt2' value='" . esc_html__( 'Modify go back', 'create-sasnys-gift-voucher' ) . "' name='cancbutt' id='subcance' onclick='javascript:SGVC_sendtocancel();'></td>
            <input type='hidden' class='bigbutt2' name='SGVC_voucherhtml' id='SGVC_voucherhtml' value='" . htmlentities( rawurlencode( $pageprint ), ENT_QUOTES ) . "'></div></center></div>";

			ob_start();

		if ( $voucherdata == '' || $goingback == 1 ) {
			 return ( SGVC_enqueue_func() . $pageheadtwo . $pageSettingst . $pageprint . $pageSettingend . $formmemory . $pageheadendtwo );
		} elseif ( $finisd == 0 ) {
			 return ( SGVC_enqueue_func() . $pageheadtwo . $pagechk . $pageprint . $pagechkend . $formmemory . $pageheadendtwo );
		} elseif ( $finisd == 1 ) {
			 return ( SGVC_enqueue_func() . $pageheadtwo . $pagethanks . $pageheadendtwo );
		} else {
			 return ( SGVC_enqueue_func() . $pageheadtwo . $pagerror . $pageheadendtwo );
		}
	}
		ob_end_flush();

}

	  add_shortcode( 'sasnys_MakePage', 'SGVC_Makegiftvoucher_func' );



/*
 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
/*
 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
/*
 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
/*
 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
/*
 >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/
/* >>>>>>>>>>>>>>>>>>>>>>>  SGVC_ShowSpreadSheet_func  <<<<<<<<<<<<<<<<<<<<<<<<<<*/

function SGVC_ShowSpreadSheet_func( $atts, $content = null ) {
	global $wpdb,$SGVC_javaAddr,$SGVC_styleAddr,$tableIs;
	$newcodefetch = array();
	$delarres     = '';
	$redsarres    = '';
	$useWho       = '';
	$iiii         = 0;
	$iii          = -1;
	$ii           = 0;
	$iv           = '';

	if ( get_current_user_id() == 0 ) {
		die;}
	SGVC_Clean_Dbase( $tableIs );

	if ( ! empty( $_POST['SGVC_delarres'] ) ) {
				$delarres = sanitize_text_field( $_POST['SGVC_delarres'] );}

	if ( ! empty( $_POST['SGVC_Del|record'] ) ) {
		$useWho = sanitize_text_field( $_POST['SGVC_Del|record'] );}

	if ( ( $delarres !== '' ) && ( $useWho !== '' ) ) {

		if ( wp_verify_nonce( $useWho, 'SGVC_Del|record' ) ) {
				$isitarray = explode( '!*!', $delarres, 10000 );
				$isitarr   = explode( '!~!', $isitarray[0], 10000 );
				  SGVC_allow_data_modification( 0 );

						  $delLen   = count( $isitarr ) - 1;
						  $isitarra = explode( '!~!', $isitarray[1], 10000 );
						  $delLens  = count( $isitarra ) - 1;
					   $delLen      = SGVC_delete_records( $delLen, $isitarr, $tableIs );
					   SGVC_re_enumerate_records( $tableIs, $delLens, $isitarra );
					   SGVC_allow_data_modification( 1 );

		}
	}
					/* REDEMERER */

	if ( ! empty( $_POST['redsarres'] ) ) {
		$redsarres = sanitize_text_field( $_POST['redsarres'] );
		SGVC_redeem_records( $redsarres, $tableIs );
	}

					SGVC_allow_data_modification( 1 );

					$SGVC_ContentAddr = sgvc_this_dir;
					$SGVC_ContentURL  = SGVC_thisURL;

	if ( SGVC_testdb() == true ) {
			 $sqlSTR = "SELECT COUNT(idenum) FROM $tableIs;";
			 $sqlSTR = $wpdb->prepare( $sqlSTR, null );
			 $useVAR = $wpdb->get_var( $sqlSTR );
		unset( $codefetch );
		$codefetch         = array( '0' => array( '0' ) );
		  $forma           = $useVAR;
		$remRecs           = array();
		$ii                = 1;
		$EnumStatt         = '';
		$EnumIDs           = '';
		$EnumsAll          = '';
		  $colrs           = array( array() );
		   $colrs[0][0]    = 000000;
		   $colrs[0][1]    = FFFFF;
		   $colrs[0][2]    = '';
		   $colrs[1][0]    = CECEE6;
		   $colrs[1][1]    = D3B169;
		   $colrs[1][2]    = 'checked disabled';
		  $ScreenDisplayed = SGVC_add_header_row();

		for ( $i = 1;$i <= $forma;$i++ ) {

			  $sqlSTR        = "SELECT * FROM $tableIs WHERE  `idenum` ='$i';";
			  $sqlSTR        = $wpdb->prepare( $sqlSTR, null );
			$codefetch[ $i ] = $wpdb->get_row( $sqlSTR, 'ARRAY_N' );

			if ( strlen( $codefetch[ $i ][1] ) >= 4 ) {
					  $codefetchs        = $codefetch[ $i ][9];
					 $ScreenDisplayed   .= SGVC_add_formatted_row( $i, $ii, $colrs, $codefetchs, $codefetch );
							 $EnumStatt .= $codefetchs . '!~!';
							 $EnumIDs   .= $codefetch[ $i ][0] . '!~!';
							 $EnumsAll  .= $codefetch[ $i ][0] . '!_!' . $codefetch[ $i ][1] . '!_!' . $codefetch[ $i ][2] . '!_!' . $codefetch[ $i ][3] . '!_!' . $codefetch[ $i ][4] . '!_!' . $codefetch[ $i ][5] . '!~!';
						$ii++;
			} else {
				  $remRecs[ $ii ] = $i;
			}
		}
						$EnumIDs          = rtrim( $EnumIDs, '!~!' );
						$EnumStatt        = rtrim( $EnumStatt, '!~!' );
						$EnumsAll         = rtrim( $EnumsAll, '!~!' );
						$ScreenDisplayed .= SGVC_add_buttons();
						$send_nonce_3     = wp_create_nonce( 'SGVC_Del|record' );

						$ScreenDisplayed .= SGVC_end_form_include_vars( $EnumIDs, $EnumStatt, $EnumsAll, $send_nonce_3 );

						$pagehead    = "<div id='moses'  class='mosesis' style=\" font-family: 'Tangerine' !important; \" >";
						$pageheadend = '</div>';

		if ( $content !== null ) {

			return ( SGVC_enqueue_func() . $pagehead . $ScreenDisplayed . $pageheadend );
		}
	}}

		 add_shortcode( 'sasnys_ShowLedger', 'SGVC_ShowSpreadSheet_func' );

function SGVC_paypal_cancelled() {
	  $cancelletext = esc_html__( 'Sorry to hear that you cancelled. if you had trouble please use our contact page to report to management.', 'create-sasnys-gift-voucher' );
	  return $cancelletext; }

		  add_shortcode( 'sasnys_Cancelled', 'SGVC_paypal_cancelled' );

