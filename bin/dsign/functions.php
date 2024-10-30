<?php
  /**
   * @package create-sasnys-gift-voucher
   */
			$tableIsTo = 'seriahglobevars';
			$tableIs   = 'seriahvouchers';

function SGVC_testdb() {
	  global $wpdb,$tableIs,$tableIsTo;

	  $sqlSTR = "SHOW TABLES LIKE '$tableIs';";
	  $sqlSTR = $wpdb->prepare( $sqlSTR, null );
	  $chxedV = $wpdb->get_var( $sqlSTR );
	if ( $chxedV !== $tableIs ) {
		$chxed = $wpdb->query(
			"
         CREATE TABLE $tableIs (
              `idenum` int(11) NOT NULL,
              `codehexis` tinytext NOT NULL,
              `inreceiver` tinytext NOT NULL,
              `giver` tinytext NOT NULL,
              `enum6m` tinytext NOT NULL,
              `valueprice` tinytext NOT NULL,
              `emaddr` tinytext NOT NULL,
              `item_name` tinytext NOT NULL,
              `postdata` mediumtext NOT NULL,
              `recstate` int(11) NOT NULL,
              `codewho` tinytext NOT NULL,
              `lifetime` tinytext NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1; "
		);

		if ( $chxed == true ) {
			$chxed = $wpdb->query(
				"INSERT INTO $tableIs (`idenum`, `codehexis`, `inreceiver`, `giver`, `enum6m`, `valueprice`, `emaddr`, `item_name`, `postdata`, `recstate`,`codewho`,`lifetime`) VALUES
            (1, 'ABCDEFA', '', '', '', '', '', '', '', 0,'','');"
			);}

		if ( $chxed == true ) {
			$chxed = $wpdb->query(
				"ALTER TABLE $tableIs
                ADD PRIMARY KEY (`idenum`) USING BTREE;"
			);}

		if ( $chxed == true ) {
			$wpdb->query( 'COMMIT;' );}
	}
	$sqlSTR   = "SHOW TABLES LIKE '$tableIsTo';";
	$sqlSTR   = $wpdb->prepare( $sqlSTR, null );
	  $chxedS = $wpdb->get_var( $sqlSTR );
	if ( $chxedS !== 'seriahglobevars' ) {
		$chxed = $wpdb->query(
			"
         CREATE TABLE $tableIsTo ( 
              `Gift_Voucher_Shop` tinytext NOT NULL,
              `Shop_Address` tinytext NOT NULL,
              `Shop_Ph_Number` tinytext NOT NULL,
              `Booking_Notice` tinytext NOT NULL,
              `voucher_life` tinytext NOT NULL,
              `PayPal_Login` tinytext NOT NULL,
              `PayPal_Email` tinytext NOT NULL,
              `PayPal_Password` tinytext NOT NULL,
              `Company_Logo` tinytext NOT NULL,
              `wordpress_Password` tinytext NOT NULL,
              `wordpress_User` tinytext NOT NULL,
              `wordpress_Name` tinytext NOT NULL,
              `SMTPSecure` tinytext NOT NULL,
              `Host` tinytext NOT NULL,
              `Username` tinytext NOT NULL,
              `Password` tinytext NOT NULL,
              `Port` int(11) NOT NULL,
              `noticemail` tinytext NOT NULL,
              `timezone`  tinytext NOT NULL,
              `codehexis` int(11) NOT NULL
            ) ENGINE=InnoDB DEFAULT CHARSET=latin1; "
		);
		if ( $chxed == true ) {
			$chxed = $wpdb->query(
				"ALTER TABLE $tableIs
                ADD PRIMARY KEY (`codehexis`) USING BTREE;"
			);}

		if ( $chxed == true ) {
			$wpdb->query( 'COMMIT;' );}

		if ( $chxed == true ) {
			 $sqlSTR = "INSERT INTO $tableIsTo (`Gift_Voucher_Shop`, `Shop_Address`, `Shop_Ph_Number`, `Booking_Notice`,`voucher_life`, `PayPal_Login`,`PayPal_Email`, `PayPal_Password`,`Company_Logo`,`wordpress_Password`,`wordpress_User`,`wordpress_Name`,`SMTPSecure`,  `Host`, `Username`,  `Password`,  `Port`,`noticemail`,`timezone`, `codehexis`) VALUES
            ( '', '', '', '','', '','', '','" . esc_html__( 'none selected', 'create-sasnys-gift-voucher' ) . "','','','','','','','','465','','','1');";
			 $sqlSTR = $wpdb->prepare( $sqlSTR, null );
			$chxed   = $wpdb->query( $sqlSTR );}
		if ( $chxed !== 0 ) {
			$sqlSTR = "SHOW TABLES LIKE $tableIsTo;";
			$sqlSTR = $wpdb->prepare( $sqlSTR, null );
			$chxedS = $wpdb->get_var( $sqlSTR );
		}
	}
	if ( ( $chxedV == $tableIs ) && ( $chxedS == $tableIsTo ) ) {
		return true;
	} else {
		return false;}

}

function SGVC_chkValidHTM( $submitn ) {
	$TestNotIs = array( 'script', 'php' );
	$TellTale  = 0;
	$submitn   = str_replace( $TestNotIs, ' ', $submitn, $TellTale );
	if ( $TellTale == 0 ) {
		return $submitn;}
	return '';
}

	use Dompdf\Dompdf;
function SGVC_CreateClientPdf( $SGVC_styleAddr, $SGVC_ContentAddr, $contents ) {

	try {
		require $SGVC_ContentAddr . '/bin/vendor/autoload.php';
			$clientSheet = new Dompdf();
			$clientSheet->setBasePath( $SGVC_styleAddr );
			$submission = rawurldecode( html_entity_decode( $contents, ENT_QUOTES ) );
			$submission = apply_filters( 'pdf_html_to_dompdf', $submission );
			$clientSheet->loadHtml( $submission, true );
			$clientSheet->set_option( 'defaultPaperSize', 'A4' );
			$clientSheet->set_option( 'defaultFont', 'Tangerine-Bold.ttf' );
			$clientSheet->set_option( 'isRemoteEnabled', true );
			$clientSheet->set_option( 'setIsHtml5ParserEnabled', true );
			$clientSheet->set_option( 'defaultMediaType', 'all' );
			$clientSheet->set_option( 'isFontSubsettingEnabled', true );
			$clientSheet->set_option( 'isJavascriptEnabled', true );

		$clientSheet->render();
		return $clientSheet->output();
	} catch ( Exception $e ) {
		SGVC_htmldump( 'SGVC_CreateClientPdf Caught exception: ' . $e->getMessage(), 123 );

		 return '';
	}
}


function SGVC_transfer( $SGVC_thisURL1, $SGVC_ContentAddr, $blogarr, $filedName ) {
	global $wp_filesystem;
	 $SGVC_thisURL = rtrim( $SGVC_thisURL1, chr( 47 ) );

	   $filedName  = sanitize_file_name( $filedName );
		 $wordPath = $SGVC_thisURL . '/temp/' . $filedName;
		$transpath = $SGVC_ContentAddr . '/temp/';
	$curfile       = $transpath . $filedName;

	/*   $curfile  = sanitize_file_name( $curfile );       ERROR error*/
	if ( $wp_filesystem->is_dir( $transpath ) ) {
		if ( $wp_filesystem->exists( $curfile ) ) {
			$wp_filesystem->delete( $curfile );
		}
	} else {
		$wp_filesystem->mkdir( $transpath, 0777 );}

	$ret = $wp_filesystem->put_contents( $curfile, $blogarr );

	return $wordPath;
}

function SGVC_SetUpIPN( $curfile, $newfile, $SGVC_valuIS, $tmeScales, $noticemail ) {
		 global $wp_filesystem,$tmezon;

	   $tmezon = get_option( 'timezone_string' );
	if ( $tmezon == '' ) {
		$tmezon = date_default_timezone_get(); }
	$replWordsM   = 0;
	$blogarr      = '';
	$seriahvalids = $SGVC_valuIS['voucher_life'];
	$custo        = explode( '!@!', $seriahvalids, 2 );
	for ( $i = 0;$i < 4;$i++ ) {
		if ( $tmeScales[0][ $i ] == $custo[0] ) {
			$daysIN = $custo[1] * $tmeScales[1][ $i ];
			$i      = 4;}
	}

	$seriahvalids    = 'P' . ceil( $daysIN ) . 'D';
	$FindThisword    = array( 'seriahreceml', 'seriahppalid', 'seriahcurzone', 'seriahnotifyeml', 'serlocalseriah', 'seruserseriah', 'serpassseriah', 'serdbaseseriah', 'seriahvalids' );
	$ReplaceWithword = array( $SGVC_valuIS['PayPal_Email'], $SGVC_valuIS['PayPal_Login'], $tmezon, $noticemail, 'localhost', $SGVC_valuIS['wordpress_User'], $SGVC_valuIS['wordpress_Password'], $SGVC_valuIS['wordpress_Name'], $seriahvalids );
	$contents        = $wp_filesystem->get_contents( $curfile );
	$blogarr         = str_replace( $FindThisword, $ReplaceWithword, $contents, $replWordsM );
	$ret             = $wp_filesystem->put_contents( $newfile, $blogarr );
}

function SGVC_sendhead( $curfile ) {
	global $wp_filesystem;
	ob_start();
	$curfilIs = base64_decode( $curfile );
	if ( $wp_filesystem->exists( $curfilIs ) ) {
			header( 'Content-Description: File Transfer' );
			header( 'Content-type: application/pdf' );
			header( 'Content-Type: application/octet-stream; name=Gift-Voucher.pdf' );
			header( 'Content-Disposition: attachment; filename=Gift-Voucher.pdf' );
			header( 'Accept-Ranges: bytes' );
			header( 'Pragma: no-cache' );
			header( 'Expires: 0' );
			header( 'Cache-Control: must-revalidate, post-check=0, pre-check=0' );
			header( 'Content-SGVC_transfer-encoding: binary' );
			header( 'Content-Length: ' . $wp_filesystem->size( $curfilIs ) );
			ob_clean();
		   flush();

		return $wp_filesystem->get_contents( $curfilIs );   }
}


function SGVC_makemailbody( $SGVC_formarr, $todayis ) {
	$insimg = '';
	if ( $SGVC_formarr[15] != __( 'none selected', 'create-sasnys-gift-voucher' ) ) {
		$insimg = "<img border='0' src='" . $SGVC_formarr[15] . "' width='402' height='63'>";}
	return "<html>

                          
<head>
<meta http-equiv='Expires' content='Fri, Jan 01 2015 00:00:00 GMT'>
<meta http-equiv='Pragma' content='no-cache'>
<meta http-equiv='Cache-Control' content='no-cache'>
<meta http-equiv='Content-Type' content='text/html; charset=utf-8'>
<meta http-equiv='Lang' content='en'>
<meta name='creation-date' content='09/06/2014'>
<META NAME='ROBOTS' CONTENT='NOINDEX, NOFOLLOW'>
 <meta name='viewport' content='width=device-width, initial-scale=1'>
  <title>Gift Card</title>
</head>
<body>
    
     <p>
    " . $insimg . "
    </p>
    <p>
    <b><font size='4'>" . $SGVC_formarr[5] . ' ' . esc_html__( 'please find attached your Gift Voucher for ', 'create-sasnys-gift-voucher' ) . $SGVC_formarr[4] . "</font></b></p>
    <p>
    <b><font size='4'>" . esc_html__( 'The taxable value of this donation is $', 'create-sasnys-gift-voucher' ) . $SGVC_formarr[3] . "</font></b></p>
    <p>
    <b><font size='4'>" . esc_html__( 'Payment made', 'create-sasnys-gift-voucher' ) . $todayis . "</font></b></p>
    <p>
    <b><font size='4'>" . esc_html__( 'please use this e-mail body as your receipt.', 'create-sasnys-gift-voucher' ) . "</font></b></p>
    <p>
    <b><font size='4'>" . esc_html__( 'Thanking you', 'create-sasnys-gift-voucher' ) . " </font><font size='5' color='#BF754E'><br>
    </font><font size='5' color='#FFFFFF'>
    <span style='background-color: #BF754E'>" . $SGVC_formarr[14] . " </span></font></b>
    </p>
<p>
    <font color='#BF754E' size='4'><strong style='font-style: italic'>" . $SGVC_formarr[16] . "</strong></font></p>
<p>
    <font color='#BF754E' size='4'><strong style='font-style: italic'>" . $SGVC_formarr[17] . '</strong></font></p>
    
     </body>
</html>';

}

function SGVC_SendPHPMailer( $contISbody, $SGVC_ContentAddr, $clientsName, $attachment, $toaddress, $SGVC_valuIS ) {
	global $phpmailer;

	try {
		$InvRec    = 'Gift-Voucher';
		$contained = '';

		if ( ( strlen( $toaddress ) > c3 ) and ( ( strpos( $toaddress, '@' ) !== false ) and ( strpos( $toaddress, '.' ) !== false ) ) ) {

			if ( ! ( $phpmailer instanceof PHPMailer ) ) {
						   require_once ABSPATH . WPINC . '/class-phpmailer.php';
						   require_once ABSPATH . WPINC . '/class-smtp.php';
			}
			$phpmailer = new PHPMailer();
			$phpmailer->IsSMTP();
			$phpmailer->Mailer     = 'smtp';
			$phpmailer->SMTPAuth   = 'true';
			$phpmailer->SMTPSecure = $SGVC_valuIS[12];           // 'tls';
			$phpmailer->Host       = $SGVC_valuIS[13];       // "ssl://smtp.gmail.com";
			$phpmailer->Username   = $SGVC_valuIS[14];
			$phpmailer->Password   = $SGVC_valuIS[15];
			$phpmailer->Port       = $SGVC_valuIS[16];         // '465';
			$phpmailer->From       = $SGVC_valuIS[14];
			$phpmailer->FromName   = $SGVC_valuIS[0];
			$phpmailer->AddReplyTo( $SGVC_valuIS[14], $SGVC_valuIS[0] );
			$phpmailer->Sender = $SGVC_valuIS[14];
			$phpmailer->AddAddress( $toaddress, $clientsName );
			$phpmailer->SetFrom( $SGVC_valuIS[14], $SGVC_valuIS[0] . ' Support' );

			$phpmailer->isHTML( true );
			$phpmailer->Subject = $InvRec . ' from ' . $SGVC_valuIS[0];
			$phpmailer->AltBody = __( 'To view the message, please use an HTML compatible email viewer!', 'create-sasnys-gift-voucher' );
			$phpmailer->MsgHTML( $contISbody );
			$phpmailer->addStringAttachment( $attachment, 'printable ' . $InvRec . '.pdf' );
			$sendgood = $phpmailer->Send();
			if ( ! $sendgood ) {
				SGVC_htmldump( ' Mail Error  FAILED Send SGVC_valuIS[12] ' . $SGVC_valuIS[12] . ' 13 ' . $SGVC_valuIS[13] . ' 14 ' . $SGVC_valuIS[14] . ' 15 ' . $SGVC_valuIS[15] . ' 16 ' . $SGVC_valuIS[16], 123 );
				  return '';
			} else {

				  return 'Message sent!';
			}
		} else {
			return '';}
	} catch ( Exception $e ) {
		 SGVC_htmldump( ' Mail Error SGVC_valuIS[12] ' . $SGVC_valuIS[12] . ' 13 ' . $SGVC_valuIS[13] . ' 14 ' . $SGVC_valuIS[14] . ' 15 ' . $SGVC_valuIS[15] . ' 16 ' . $SGVC_valuIS[16] . PHP_EOL . 'Error Caught exception: ' . $e->getMessage(), 123 );

		  return '';
	}

}

function SGVC_getlongdat( $shrt ) {
	$date = date_create( $shrt, timezone_open( 'Australia/Brisbane' ) );
	return date_format( $date, 'D, j F Y' );
}


function SGVC_expirvoucher() {
	$datetoday = date_create( 'now', timezone_open( 'Australia/Brisbane' ) );
	$addDis    = 'P182D';
	$difDay    = new DateInterval( $addDis );
	$date      = date_add( $datetoday, $difDay );
	return date_format( $date, 'D, j F Y' );
}



function SGVC_UpdateRecords( $SGVC_formarr ) {
	global $tableIs,$wpdb;
	  $sqlSTR = "SELECT * FROM $tableIs WHERE codehexis='$SGVC_formarr[7]';";
	 $sqlSTR  = $wpdb->prepare( $sqlSTR, null );

	  $newcodefetch               = $wpdb->get_row( $sqlSTR, 'ARRAY_A' );
	  $curRec                     = $newcodefetch;
	  $newcodefetch['inreceiver'] = "$SGVC_formarr[4]";
	$newcodefetch['giver']        = "$SGVC_formarr[5]";
	$newcodefetch['enum6m']       = "$SGVC_formarr[6]";
	  $newcodefetch['valueprice'] = "$SGVC_formarr[3]";
	$newcodefetch['emaddr']       = "$SGVC_formarr[8]";
	  $iv                         = $wpdb->update( $tableIs, $newcodefetch, $curRec );

	   return $iv;
}

function SGVC_closepage() {
	global $pdfISFile,$contISbody,$sentok,$SGVC_formarr,$acceptprint;
	if ( ( $SGVC_formarr[9] == 3 ) || ( $SGVC_formarr[9] == 1 ) ) {
		if ( ( $pdfISFile == '' ) || ( $contISbody == '' ) || ( $sentok == '' ) ) {
			return "<script type='text/javascript'>\n
            alert('" . esc_html__( 'There is still processors on going Sorry halting page close if you really want to close prossesors please close the browser', 'create-sasnys-gift-voucher' ) . "') ;\n
           
            </script>";
		}
	} elseif ( $SGVC_formarr[9] == 2 ) {

		if ( $pdfISFile == '' ) {
			return "<script type='text/javascript'>\n
            alert('" . esc_html__( 'There is still processors on going Sorry halted page close if you really want to close prossesors please close the browser', 'create-sasnys-gift-voucher' ) . "' );\n
           
            </script>";
		}
	}
		   $acceptprint = '';
	return "<script type='text/javascript'>\n
            document.getElementById('SGVC_acceptprint').value=''; \n
            window.open('','_top','');\n
            window.close();\n
            </script>";
}
function SGVC_htmldump( $variable, $height = '9em' ) {
	global $wp_filesystem;
	$ABSURL = $_SERVER['DOCUMENT_ROOT'];
	$ABSURL = rtrim( $ABSURL, chr( 47 ) ) . chr( 47 );
	if ( $height == 123 ) {
			$filename = $ABSURL . 'Error_log.txt';
		 $contents    = $wp_filesystem->get_contents( $filename );
		 $contents   .= $variable . PHP_EOL;
		 $ret         = $wp_filesystem->put_contents( $filename, $contents );
	} elseif ( $height == 321 ) {
					   $curfile = $ABSURL . 'giftcard.html';
					   $ret     = $wp_filesystem->put_contents( $curfile, $variable . PHP_EOL );

	} else {

		echo "<pre style=\" border: 2px dotted #D3B169; height: {$height}; overflow: auto; margin: 0.5em;\">";
		 print_r( $variable );
		echo "</pre>\n";
	}
}



function SGVC_ISCHECK( $mode, $SGVC_formarr9 ) {

	if ( $mode == $SGVC_formarr9 ) {
		return 'checked';}
}

function SGVC_mangle_code( $datx, $mode, $curcodes ) {

	try {
		if ( intval( $curcodes[0] ) >= 2 ) {
			$ic    = '';
			$ci    = 0;
			$cic   = '';
			$datxi = '';

			$cic   = SGVC_SortCript( urldecode( $datx ), 1, $curcodes );
			$datxi = explode( chr( 32 ), $cic, 90000 );

			$iv  = count( $datxi );
			$cic = '';

			for ( $i = 0;$i < $iv;$i++ ) {

					$ic   = $datxi[ $i ];
					$ic   = base_convert( $ic, intval( $curcodes[0] ), 10 );
					$cic .= chr( $ic );

			}
			return $cic;}
	} catch ( Exception $e ) {
		   var_dump( "\n" . 'Caught SGVC_mangle_code: ' . $e->getMessage() . "\n" );
		   var_dump( '$curcodes' . $curcodes );
	}}
function SGVC_SortCript( $dats, $mode, $curcodes ) {

	$dasy = array();

	$st = 0;
	$sy = 0;
	$ga;
	$gat   = '';
	$datsu = '';
	$inc   = 2;
	$uiv   = 0;
	$accum = '';

	$datsu = $dats;

	$dasy = explode( ' ', $datsu, 90000 );
	$inc  = 1;
	$uiv  = count( $dasy );
	for ( $uii = 0;$uii < $uiv;$uii++ ) {
		if ( stripos( $dasy[ $uii ], '~!~' ) > 0 ) {
			$gots   = explode( '~!~', $dasy[ $uii ], 2 );
			$ij     = ( base_convert( $gots[0], intval( $curcodes[1] ), 10 ) - intval( $curcodes[3] ) );
			$ji     = ( base_convert( $gots[1], intval( $curcodes[2] ), 10 ) - intval( $curcodes[3] ) );
			$accum .= chr( $ij / 2 );

			if ( ( $ji / $ij ) > 0 ) {
				$accum .= chr( ( $ji / $ij ) / 2 );}
		}
	}
	   return $accum;
}
function SGVC_chkimage( $imgIS ) {
			$isnow = array( '.', 'png', 'giftvoucher' );
	$isstil        = array( '.', 'png', 'giftvoucher' );
	$enumerate     = 0;
		 str_replace( $isnow, $isstil, strtolower( $imgIS ), $enumerate );
	if ( ( $enumerate == 3 ) && ( strlen( $imgIS ) < 18 ) ) {
		return $imgIS;
	} else {
		return 'GiftVoucher2c.png';}
}

function SGVC_sasnysnet( $dt, $valud ) {
	$isnot     = array( '.', ' ', '-', '_', '@' );
	$isnow     = array( '', '', '', '', '' );
	$enumerate = 0;
	str_replace( $isnot, $isnow, $valud, $enumerate );
	if ( $enumerate == 0 ) {
		if ( $dt ) {
			return strtoupper( base_convert( $valud, 16, 33 ) );
		} else {
			return strtoupper( base_convert( $valud, 33, 16 ) );
		}
	} else {
		return '00000000';}

}
function SGVC_enqueue_func() {
	wp_register_script( 'giftvoucher', SGVC_Design . 'GiftVoucher.js' );
	wp_register_style( 'giftvoucher', SGVC_Design . 'GiftVoucher.css' );
	 wp_enqueue_style( 'giftvoucher', SGVC_Design . 'GiftVoucher.css' );
	 wp_enqueue_script( 'giftvoucher', SGVC_Design . 'GiftVoucher.js' );
	 wp_enqueue_media();
}

function SGVC_enqueue_media_uploader() {
		   wp_enqueue_media();
			add_action( 'admin_enqueue_scripts', 'SGVC_enqueue_media_uploader' );
}

function SGVC_ChkWho( $useVAR ) {
	global $wpdb,$tableIs;
	$sqlSTR = "SELECT `codewho` FROM $tableIs WHERE  `codehexis` = '$useVAR';";
	$sqlSTR = $wpdb->prepare( $sqlSTR, null );
	$useWho = $wpdb->get_var( $sqlSTR );

	if ( wp_verify_nonce( $useWho, 'SGVC_Pay|Pal' ) ) {
		return true;}
	return 0;
}

function SGVC_Clean_Dbase( $tableIs ) {
	global $wpdb;
	$Reenum       = array();
	$newcodefetch = array();
	$idVAR        = 0;
	   $sqlSTR    = 'SET forign_key_checks = 0;';
	   $sqlSTR    = $wpdb->prepare( $sqlSTR, null );
			   $wpdb->get_var( $sqlSTR );
	   $sqlSTR         = "SELECT COUNT(idenum) FROM $tableIs;";
	   $sqlSTR         = $wpdb->prepare( $sqlSTR, null );
			   $useVAR = $wpdb->get_var( $sqlSTR );
	for ( $i = 1;$i <= $useVAR;$i++ ) {
		$sqlSTR = "SELECT * FROM $tableIs WHERE  `idenum` = $i;";
		$sqlSTR = $wpdb->prepare( $sqlSTR, null );
		$whoIs  = $wpdb->get_row( $sqlSTR, 'ARRAY_N' );
		if ( ( strlen( $whoIs[8] ) < 20 ) && ( $whoIs[10] == 1 ) ) {
			$iv = $wpdb->delete( $tableIs, array( 'idenum' => $i ) );
		} else {
			$Reenum[ $idVAR ] = $i;
			$idVAR++;}
	}
	if ( $useVAR != $idVAR ) {
		for ( $i = $idVAR - 1;$i >= 0;$i-- ) {
				$sqlSTR                 = "SELECT * FROM $tableIs WHERE  `idenum` = $Reenum[$i];";
				$sqlSTR                 = $wpdb->prepare( $sqlSTR, null );
			 $newcodefetch              = $wpdb->get_row( $sqlSTR, 'ARRAY_A' );
				$newcodefetch['idenum'] = ( $i + 1 );
				$curRec                 = array( 'idenum' => "$Reenum[$i]" );
			 $iv                        = $wpdb->update( $tableIs, $newcodefetch, $curRec );

		}
	}
	  unset( $newcodefetch );
	unset( $curRec );
	unset( $Reenum );
}
function SGVC_site_credentials( $tableIsTo ) {
	   global $wpdb;
		   $sqlSTR = "SELECT * FROM $tableIsTo WHERE codehexis = '1';";

		   $sqlSTR = $wpdb->prepare( $sqlSTR, null );
	return $wpdb->get_row( $sqlSTR, ARRAY_N );
}
function SGVC_create_new_record( $tableIs ) {
	global $wpdb;
	$sqlSTR = "INSERT INTO $tableIs (`idenum`, `codehexis`, `inreceiver`, `giver`, `enum6m`, `valueprice`, `emaddr`, `item_name`, `postdata`, `recstate`,`codewho`,`lifetime`) VALUES
                    (1, 'ABCDEFA', '', '', '', '', '', '', '', 0,'','');";
	$sqlSTR = $wpdb->prepare( $sqlSTR, null );
	return $wpdb->query( $sqlSTR );
}
function SGVC_format_cur_record( $tableIs, $useVAR, $item_name ) {
	  global $wpdb,$lifetime;
	 $sqlSTR             = "SELECT `codehexis` FROM $tableIs WHERE  `idenum` = '$useVAR';";
	 $sqlSTR             = $wpdb->prepare( $sqlSTR, null );
		   $useHEX       = $wpdb->get_var( $sqlSTR );
		   $newNumb      = preg_replace( '/[^0-9A-Fa-f]/', '', $useHEX );
		   $newNumbs     = strtoupper( dechex( hexdec( $newNumb ) + 1 ) );
		   $newNumb      = SGVC_sasnysnet( 1, $newNumbs );
		   $newNumb      = htmlentities( $newNumb, ENT_QUOTES );
		   $lifetime     = explode( ' ', microtime() );
		   $lifetimeIS   = $lifetime[1] + SGVC_two_days;
		   $nextID       = preg_replace( '/[^0-9]/', '', $useVAR );
		   $forma        = abs( $nextID ) + 1;
	$NoValueSet          = '';
	$zerroVal            = 0;
		   $send_nonce_2 = wp_create_nonce( 'SGVC_Pay|Pal' );

		   $sqlSTR  = "INSERT INTO $tableIs (idenum,codehexis,inreceiver,giver,enum6m,valueprice,emaddr,item_name,postdata,recstate,codewho,lifetime) VALUES ('$forma','$newNumbs','$NoValueSet','$NoValueSet' ,'$NoValueSet', '$NoValueSet', '$NoValueSet', '$item_name', '$NoValueSet','$zerroVal','$send_nonce_2',$lifetimeIS)";
	$sqlSTR         = $wpdb->prepare( $sqlSTR, null );
		   $TestVAR = $wpdb->query( $sqlSTR );
	return $newNumb;
}
function SGVC_chk_redundent( $tableIs, $useVAR ) {
	global $wpdb,$lifetime;
	for ( $i = $useVAR;$i >= 1;$i-- ) {
		$sqlSTR = "SELECT `lifetime` FROM $tableIs WHERE  `idenum` = '$i';";
		$sqlSTR = $wpdb->prepare( $sqlSTR, null );
		$usewho = $wpdb->get_var( $sqlSTR );
		if ( $lifetime[1] > (int) $usewho ) {
						$sqlSTR                              = "SELECT * FROM $tableIs WHERE  `idenum` = $i;";
						$sqlSTR                              = $wpdb->prepare( $sqlSTR, null );
							$newcodefetch                    = $wpdb->get_row( $sqlSTR, 'ARRAY_A' );
								$curRec                      = $newcodefetch;
									$newcodefetch['codewho'] = 1;
			$iv = $wpdb->update( $tableIs, $newcodefetch, $curRec );

		}
	}
}
function SGVC_error_note( $errcode ) {

		 return '<h3>' . esc_html__( 'The database is not accessable,', 'create-sasnys-gift-voucher' ) . '<br />' . esc_html__( ' try later or get in contact with service@sasnys.net.au', 'create-sasnys-gift-voucher' ) . '</h3>';

}
function SGVC_get_record_enum( $tableIs ) {
		global $wpdb;
	   $sqlSTR = "SELECT COUNT(idenum) FROM $tableIs;";
	   $sqlSTR = $wpdb->prepare( $sqlSTR, null );
	   return $wpdb->get_var( $sqlSTR );
}
function SGVC_re_enumerate_records( $tableIs, $delLens, $isitarra ) {
	global $wpdb;
	for ( $i = 0;$i <= $delLens;$i++ ) {

		  $sqlSTR       = "SELECT * FROM $tableIs WHERE  `idenum` = $isitarra[$i];";
		  $sqlSTR       = $wpdb->prepare( $sqlSTR, null );
		  $newcodefetch = $wpdb->get_row( $sqlSTR, 'ARRAY_A' );

		  $newcodefetch['idenum'] = ( $i + 1 );
		  $curRec                 = array( 'idenum' => "$isitarra[$i]" );
		  $iv                     = $wpdb->update( $tableIs, $newcodefetch, $curRec );
	}
}
function SGVC_allow_data_modification( $yesno ) {
	global $wpdb;
	$sqlSTR = "SET forign_key_checks = $yesno;";
	$sqlSTR = $wpdb->prepare( $sqlSTR, null );
	$wpdb->query( $sqlSTR );
}
function SGVC_delete_records( $delLen, $isitarr, $tableIs ) {
	global $wpdb;
	$delLena = $delLen;
	for ( $i = $delLen;$i >= 0;$i-- ) {
		if ( $isitarr[ $i ] !== '' ) {
			$iv = $wpdb->delete( $tableIs, array( 'idenum' => $isitarr[ $i ] ) );
			$delLena--;
		}
	}return $delLena;
}
function SGVC_redeem_records( $redsarres, $tableIs ) {
	global $wpdb;
	   $isitarray = explode( '!*!', $redsarres, 10000 );
	   $isitarr   = explode( '!~!', $isitarray[0], 10000 );
	   SGVC_allow_data_modification( 0 );
	   $delLen   = count( $isitarr ) - 1;
	   $isitarra = explode( '!~!', $isitarray[1], 10000 );
	   $delLens  = count( $isitarra ) - 1;
	for ( $i = 0;$i <= $delLen;$i++ ) {
		if ( $isitarr[ $i ] !== '' ) {
				$sqlSTR               = "SELECT * FROM $tableIs WHERE  `idenum` = $isitarr[$i];";
				$sqlSTR               = $wpdb->prepare( $sqlSTR, null );
				$newcodefetch         = $wpdb->get_row( $sqlSTR, 'ARRAY_A' );
			$newcodefetch['recstate'] = 1;
			$curRec                   = array( 'idenum' => "$isitarr[$i]" );
			$iv                       = $wpdb->update( $tableIs, $newcodefetch, $curRec );
		}
	}
}
function SGVC_showlots( $newNumb, $busidcode ) {

	  $fullval = SGVC_HomewURL . '/makevoucher?custom=' . $newNumb;
	  $fullcan = SGVC_HomewURL . '/cancelled';
	$PageIs    = "<form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'><p>
                <input type='hidden' name='business' value='$busidcode' />
                <input type='hidden' name='cmd' value='_xclick'>
                <input type='hidden' name='item_name' id= 'itemid' value='Gift-Card'>
                <input type='hidden' name='amount' id = 'amounted' value='10.0'>
                <input type='hidden' name='currency_code' value='AUD'>
                <input type='hidden' name='add' value='1'>
                <input type='hidden' name='return' value='$fullval' />
                <input type='hidden' name='cancel_return' value='$fullcan' />
                <input type='hidden' name='custom' id='idcustum' value='$newNumb'>
        <table style='border-spacing:0px;border-style: hidden; margin:0 0 0 0 !important;padding:0 0 0 0 !important;'>
        <tr>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td style='color:white;border-style: hidden;'><h3 style='color:white;'>Enter value </h3></td>
        </tr>
        <tr>
            <td>
                <h3 style='color:#f7f6f0;font-style: normal;border-style: hidden; font-weight: 800;' >$ <input type='text' name='calkval' id='calcval' onchange='javascript:SGVC_calkall();' maxlength='4' size='4'></h3>
            </td>
        </tr>
        <tr>
        <td style='border-style: hidden;'>
                    <input type='image' name='submit' border='0'
                     src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif'
                     alt='Buy Now'>
            <img alt='' border='0' width='1' height='1'
             src='https://www.paypalobjects.com/en_US/i/btn/pixel.gif' >
        </td>
        </tr>
        
        </table>
        </form>";
	return $PageIs;}

function SGVC_add_header_row() {
	return "<form name='idclientdata' id='clientdata' method='post'>
                        <div align='left'>
                        <table  id='sasjobtable'> 
         <tr style='font-weight: bolder;font-size: x-large; ' >
            <td width='80px'>" . esc_html__( 'Print', 'create-sasnys-gift-voucher' ) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><input type='checkbox' onchange='javascript:SGVC_tickall(0);' name='C0all' id='id0all'>ALL</td>
            <td width='90px'>" . esc_html__( 'Delete', 'create-sasnys-gift-voucher' ) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br /><input type='checkbox' onchange='javascript:SGVC_tickall(1);' name='C1all' id='id1all'>ALL</td>
            <td width='80px'>" . esc_html__( 'Redeemed', 'create-sasnys-gift-voucher' ) . "<br /><input type='checkbox' onchange='javascript:SGVC_tickall(2);' name='C2all' id='id2all' >ALL</td>            
            <td width='10px'>ID</td>
            <td width='90px'>" . esc_html__( 'ID code', 'create-sasnys-gift-voucher' ) . "</td>
            <td width='130px'>" . esc_html__( 'Gift Reciever', 'create-sasnys-gift-voucher' ) . "</td>
            <td width='150px'>" . esc_html__( 'Payed by', 'create-sasnys-gift-voucher' ) . "</td>
            <td width='250px'>" . esc_html__( 'Expires on', 'create-sasnys-gift-voucher' ) . "</td>
            <td width='40px'>" . esc_html__( 'Card Value', 'create-sasnys-gift-voucher' ) . '</td>
        </tr>';
}
function SGVC_add_formatted_row( $i, $ii, $colrs, $codefetchs, $codefetch ) {
	return "<tr style ='background-color: #" . $colrs[ $codefetchs ][0] . ';  color: #' . $colrs[ $codefetchs ][1] . ";  font-family: sans-serif;font-size: large; !important;' > 
            <td><input type='checkbox' onchange=\"javascript:SGVC_setmodes('0','id0$ii')\" name='C0$ii' id='id0$ii'></td>
            <td><input type='checkbox' onchange=\"javascript:SGVC_setmodes('1','id1$ii')\" name='C1$ii' id='id1$ii'></td>
            <td><input type='checkbox' onchange=\"javascript:SGVC_setmodes('2','id2$ii')\" name='C2$ii' id='id2$ii' " . $colrs[ $codefetchs ][2] . ' ></td>
            <td>' . (string) $codefetch[ $i ][0] . '</td>
            <td>' . (string) $codefetch[ $i ][1] . '</td>
            <td>' . (string) $codefetch[ $i ][2] . '</td>
            <td>' . (string) $codefetch[ $i ][3] . '</td>
            <td>' . (string) $codefetch[ $i ][4] . '</td>
            <td>' . (string) $codefetch[ $i ][5] . '</td>
           
        </tr>';
}
function SGVC_add_buttons() {
	return "<tr align='left'><td colspan='8'><input type='button' onclick='javascript:SGVC_chkdoall();' name='selectrun' class='no-print' id='selectrunid' value='" . esc_html__( 'Process', 'create-sasnys-gift-voucher' ) . "' align='left' size='28' maxlength='90'   title='" . esc_html__( 'Click to proceed with selection', 'create-sasnys-gift-voucher' ) . "' style='color:#486FAD; background-color:#D3B169;border-style:double; width: 95px; height: 40px; font-size: 26px;font-family: Tangerine !important;'>&nbsp;<input type='button' style='color:#486FAD; background-color:#D3B169;border-style:double; width: 95px; height: 40px; font-size: 26px; display= inline !important;font-family: Tangerine !important;' onclick='javascript:SGVC_cancelall();' name='selectrun' class='no-print' id='selectruncan' value='" . esc_html__( 'Cancel', 'create-sasnys-gift-voucher' ) . "' align='left' size='28' maxlength='90'   title='" . esc_html__( 'Click to cancel', 'create-sasnys-gift-voucher' ) . "' ></td></tr>";
}
function SGVC_end_form_include_vars( $EnumIDs, $EnumStatt, $EnumsAll, $send_nonce_3 ) {
	return "</table><input type='hidden' name='acceptEnum' id='acceptEnum' value='" . $EnumIDs . '~!~' . $EnumStatt . '~!~' . $EnumsAll . "'><input type='hidden' name='SGVC_Del|record' id='SGVC_IDel|record' value=$send_nonce_3><input type='hidden' name='SGVC_delarres' id='SGVC_IDdelarres' value=''><input type='hidden' name='redsarres' id='idredsarres' value=''><input type='hidden' name='modzs' id='modzs' value=''></div></form>";
}
function SGVC_include_nonce() {
	 $send_nonce = wp_create_nonce( 'crtsasgiftmakeset' );
	return "<h1 style='strong'>" . esc_html__( 'Create Voucher Settings', 'create-sasnys-gift-voucher' ) . "</h1> <br /> <br />
           <form name='makesettingsto' id='makesettingsfrom' method='post'>
           <input type='hidden' name ='crtsasgiftmakeset' value=$send_nonce>";
}
	add_action( 'wp_enqueue_scripts', 'SGVC_TranslateJavaFuncts' );
function SGVC_TranslateJavaFuncts( $hook ) {
	wp_enqueue_script( 'giftvoucher', SGVC_Design . 'GiftVoucher.js' );
	wp_localize_script(
		'giftvoucher',
		'SGVC_transa',
		array(
			'h2nd_string' => esc_html__( 'please wait unless you feel there is an error then close the browser', 'create-sasnys-gift-voucher' ),
			'h4th_string' => esc_html__( 'SGVC_wordwraper  str, columbs, str_break, code', 'create-sasnys-gift-voucher' ),
			'h5th_string' => esc_html__( 'There has been an error in accessing the data, Please contact Sasnys service please with this error', 'create-sasnys-gift-voucher' ),
			'h6th_string' => esc_html__( 'Process', 'create-sasnys-gift-voucher' ),
			'h7th_string' => esc_html__( 'Print', 'create-sasnys-gift-voucher' ),
			'h8th_string' => esc_html__( 'Delete', 'create-sasnys-gift-voucher' ),
			'h9th_string' => esc_html__( 'Redeem', 'create-sasnys-gift-voucher' ),
		)
	);

}

