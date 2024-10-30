function SGVC_updateform(cfrom,cto){
	document.getElementById( cto ).value = document.getElementById( cfrom ).value;
}
function SGVC_updatettoprow(){
	isdatas = document.getElementById( 'scriptvid' ).value + " ";
	var iv  = 0; var ii = 0; var i = 0; var porte = new Array( '','','' );
	for (ii = 0;ii <= 2;ii++ ) {
		if (isdatas.charCodeAt( i + 45 ) == 32) {
			porte[ii] = isdatas.substring( i, (i + 45) );
			i         = i + 45;
		} else {
			for (iv = i + 44;iv > 0;iv = iv - 1 ) {
				if (isdatas.charCodeAt( iv ) == 32) {
						 porte[ii] = isdatas.substring( i, iv );
					   i           = iv;iv = 0;
				}}}}

	document.getElementById( 'giftext' ).value  = porte[0];
	document.getElementById( 'giftext1' ).value = porte[1];
	document.getElementById( 'giftext2' ).value = porte[2];
}

function SGVC_insertto(){
	document.getElementById( 'scriptvid' ).innerHTML = document.getElementById( 'text4gift' ).value;
	document.getElementById( 'scriptvid' ).value     = document.getElementById( 'text4gift' ).value;
}

function SGVC_sendtopreprint(formposis){

	document.getElementById( 'moses' ).style.cssText = "cursor:wait!important; font-family: 'Charm', cursive !important; ";
	isdatas = document.getElementById( 'scriptvid' ).value + " ";
	var iv  = 0; var ii = 0; var i = 0; var porte = new Array( '','','' ); var exsport = 1;
	for (ii = 0;ii <= 2;ii++ ) {
		if (isdatas.charCodeAt( i + 45 ) == 32) {
			porte[ii] = isdatas.substring( i, (i + 45) );
			i         = i + 45;
		} else {
			for (iv = i + 44;iv > 0;iv = iv - 1 ) {
				if (isdatas.charCodeAt( iv ) == 32) {
						 porte[ii] = isdatas.substring( i, iv );
					   i           = iv;iv = 0;
				}

			}}}
	if (document.getElementById( 'exsport1' ).checked) {
		exsport = 1;}
	if (document.getElementById( 'exsport2' ).checked) {
		exsport = 2;}
	if (document.getElementById( 'exsport3' ).checked) {
		exsport = 3;}
	isdata = porte[0] + '~!^' + porte[1] + '~!^' + porte[2] + '~!^' + SGVC_ljtrim( document.getElementById( 'vouchvalue' ).value,'$' ) + '~!^' + document.getElementById( 'recipid' ).value + '~!^' + document.getElementById( 'fromvid' ).value + '~!^' + document.getElementById( 'vouchdate' ).value + '~!^' + document.getElementById( 'vouchnser' ).value + '~!^' + document.getElementById( 'buyemail' ).value + '~!^' + exsport + '~!^' + document.getElementById( 'vouchedName' ).value;
	  document.getElementById( 'SGVC_voucherdata' ).value = SGVC_base64_eencoder( isdata );
	  document.getElementById( 'vouchertoppos' ).value    = formposis;
	   document.forms['makeservoucher'].submit();
}

function SGVC_sendtoprint(){

	document.getElementById( 'moses' ).style.cssText    = "cursor:wait!important; font-family: 'Charm', cursive !important; ";
	document.getElementById( 'SGVC_acceptprint' ).value = 1;
	document.getElementById( 'SGVC_goingback' ).value   = 0;
	document.getElementById( 'vouchertoppos' ).value    = '-80px';
	 document.forms['makeservoucher'].submit();

}


function SGVC_chgbck(moder){
	var borderfile = '';
	switch (moder) {
		case 0:
			borderfile = 'GiftVoucher2c.png';
		   break;
		case 1:
			borderfile = 'GiftVoucher1c.png';
		   break;     /*
		case 2:    for additional border images
			borderfile='GiftVoucher2c.png';
		break;
		case 3:
			borderfile='GiftVoucher1c.png';
		break;
		case 4:
			borderfile='GiftVoucher2c.png';
		break;
		case 5:
			borderfile='GiftVoucher1c.png';
		break;
		case 6:
			borderfile='GiftVoucher2c.png';
		break;
		case 7:
			borderfile='GiftVoucher1c.png';
		break;                              */
	}
	document.getElementById( 'SGVC_backimg' ).value   = borderfile;
	document.getElementById( 'SGVC_goingback' ).value = 1;
	document.getElementById( 'moses' ).style.cssText  = "cursor:wait!important; font-family:Tangerine !important; ";
	SGVC_sendtopreprint( "95px" );
}

function SGVC_sendtocancel(){
	document.getElementById( 'SGVC_goingback' ).value   = 1;
	document.getElementById( 'SGVC_acceptprint' ).value = 0;
	document.getElementById( 'moses' ).style.cssText    = "cursor:wait!important; font-family:Tangerine !important; ";
	document.getElementById( 'vouchertoppos' ).value    = '95px';
	 document.forms['makeservoucher'].submit();
}
function SGVC_downpage(whatisit){
	  window.open( whatisit );
}
function SGVC_saveinputs(elertstringIs,noneselected){
	var testnum = document.getElementById( 'voucher_life' ).value;
	try {
		if ((testnum * 1) == testnum) {
			testnum = testnum;} else {
					 alert( elertstringIs );return;}

	} catch (err) {
		testnum = 1;
	}

	var tmeScales  = Array( "months","days","years","no expiry" );
	 var setExpeye = tmeScales[document.getElementById( 'timecapsule' ).selectedIndex] + "!@!" + testnum;
	 var testhis   = SGVC_ljtrim( document.getElementById( 'sasnys_custom_images' ).value );
	if (( testhis == noneselected) || ( testhis == "")) {
		document.getElementById( 'idlogofilenm' ).value = noneselected}
	document.getElementById( 'datData' ).value = SGVC_DocTrue( document.getElementById( 'Gift_Voucher_Shop' ).value ) + '!~!' + SGVC_DocTrue( document.getElementById( 'Shop_Address' ).value ) + '!~!' + SGVC_DocTrue( document.getElementById( 'Shop_Ph_Number' ).value ) + '!~!' + SGVC_DocTrue( document.getElementById( 'Booking_Notice' ).value ) + '!~!' + setExpeye + '!~!' + document.getElementById( 'PayPal_Login' ).value + '!~!' + document.getElementById( 'PayPal_Email' ).value + '!~! not needed !~!' + SGVC_DocTrue( document.getElementById( 'idlogofilenm' ).value ) + '!~!' + "A" + '!~!' + "B" + '!~!' + "C" + '!~!' + SGVC_DocTrue( document.getElementById( 'serSMTPSecure' ).value ) + '!~!' + SGVC_DocTrue( document.getElementById( 'serhosting' ).value ) + '!~!' + SGVC_DocTrue( document.getElementById( 'serusername' ).value ) + '!~!' + document.getElementById( 'seremlpassword' ).value + '!~!' + SGVC_DocTrue( document.getElementById( 'seremlport' ).value );
	document.forms['makesettingsto'].submit();
}

function SGVC_DocTrue(doctex){
	var psch = "[^ -;@-~]";
	if ( doctex.search( psch ) == -1 ) {
		return doctex;
	}
	return "illegal text";
}
function SGVC_base64_eencoder(data) {
	  var b64                                 = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789+/=';
	  var o1, o2, o3, h1, h2, h3, h4, bits, i = 0,
		ac                                    = 0,
		enc                                   = '',
		tmp_arr                               = [];

	if ( ! data) {
		return data;
	}

	do { // pack three octets into four hexets
		o1 = data.charCodeAt( i++ );
		o2 = data.charCodeAt( i++ );
		o3 = data.charCodeAt( i++ );

		bits = o1 << 16 | o2 << 8 | o3;

		h1            = bits >> 18 & 0x3f;
		h2            = bits >> 12 & 0x3f;
		h3            = bits >> 6 & 0x3f;
		h4            = bits & 0x3f;
		tmp_arr[ac++] = b64.charAt( h1 ) + b64.charAt( h2 ) + b64.charAt( h3 ) + b64.charAt( h4 );
	} while (i < data.length);

	  enc = tmp_arr.join( '' );

	  var r = data.length % 3;

	  return (r ? enc.slice( 0, r - 3 ) : enc) + '==='.slice( r || 3 );
}

function SGVC_ljtrim(str, charlist) {
	charlist = ! charlist ? ' \\s\u00A0' : (charlist + '')
	.replace( /([\[\]\(\)\.\?\/\*\{\}\+\$\^\:])/g, '$1' );
	var re   = new RegExp( '^[' + charlist + ']+', 'g' );
	return (str + '').replace( re, '' );
}

function SGVC_closepage(){

	if (document.getElementById( 'SGVC_acceptprint' ).value != '') {
		alert( SGVC_transa.h2nd_string );
	} else {

		window.open( '','_top','' );
		window.close();

	}}

function SGVC_tickall(mode){
	try {
		var chexd       = document.getElementById( 'id' + mode + 'all' ).checked;
		var EnumsRecs   = document.getElementById( 'acceptEnum' ).value;
		var  EnumsParts = EnumsRecs.split( '~!~',3 );
		var  EnumsID    = EnumsParts[0].split( '!~!',10000 );
		var  EnumsStat  = EnumsParts[1].split( '!~!',10000 );
		var  EnumsAll   = EnumsParts[2].split( '!~!',10000 );
		// alert(EnumsDel.length);
		for (var i = 0;i <= EnumsID.length - 1;i++) {
			if (((EnumsStat[i] == 0) || (mode == 1)) || ((EnumsStat[i] == 0) && (mode == 2))) {
				  document.getElementById( 'id' + mode + EnumsID[i] ).checked = chexd;
			}
		}
		SGVC_setmodes( mode,'id' + mode + 'all' )
	} catch (err) {
		alert( SGVC_transa.h5th_string + err.description + " \n" );
		err = 0;
	}}


function SGVC_chkdoall(){

	try {
		var titleis = document.getElementById( 'selectrunid' ).value;
		if (titleis == SGVC_transa.h6th_string) {
			 var EnumsRecs     = document.getElementById( 'acceptEnum' ).value;
			 var  EnumsParts   = EnumsRecs.split( '~!~',3 );
			 var  EnumIDs      = EnumsParts[0].split( '!~!',10000 );
			 var  EnumStatt    = EnumsParts[1].split( '!~!',10000 );
			 var selectednodes = new Array(); var notselectednodes = new Array();var prints = '';var dels = '';var redem = '';  var ii = 0;var iii = 0;
			 var erts = 0;var ivi = 0;
			 var curmodez = document.getElementById( 'modzs' ).value;
			 var twopart  = curmodez.split( "!~!",2 );
			if (twopart[0] !== '') {
				mode = twopart[0];  ii = 1; iii = 0;
				for (i = 0;i < EnumIDs.length;i++) {
					if ((((EnumStatt[i] == 0) || (mode == 1)) || ((EnumStatt[i] == 0) && (mode == 2))) || (mode == 0)) {
						if (document.getElementById( 'id' + mode + EnumIDs[i] ).checked == true) {
							selectednodes[ii] = i + 1;
							document.getElementById( 'id0' + EnumIDs[i] ).style.display = "none";
							document.getElementById( 'id1' + EnumIDs[i] ).style.display = "none";
							document.getElementById( 'id2' + EnumIDs[i] ).style.display = "none";} else {

							notselectednodes[iii] = EnumIDs[i];iii++;}
							ii++;
					}
				}
				if (mode == 0) {
					if (ii >= 1) {
						ii = 0;
						ii = notselectednodes.length - 1;

						for (i = ii;i >= 0;i--) {
							if (document.getElementById( 'sasjobtable' ).rows.length >= i + 3) {
								document.getElementById( 'sasjobtable' ).deleteRow( notselectednodes[i] ); }
							document.getElementById( 'sasjobtable' ).refresh;
						}
						mode       = 3;
						var timeID = setTimeout( "SGVC_windowprint(SGVC_transa.h7th_string)", 100 );
					}
				} else if (mode == 1) {
					if (ii >= 1) {
						ii = 0;
						ii = notselectednodes.length - 1;

						for (i = ii;i >= 0;i--) {
							if (document.getElementById( 'sasjobtable' ).rows.length >= i + 3) {
								document.getElementById( 'sasjobtable' ).deleteRow( notselectednodes[i] ); }
							document.getElementById( 'sasjobtable' ).refresh;   }

						dels = selectednodes.join( "!~!" );
						if (iii >= 1) {
							dels = dels + '!*!' + notselectednodes.join( "!~!" );}
						selectednodes = null;ii = 0;selectednodes = new Array();
						notselectednodes                          = null;iii = 0;notselectednodes = new Array();
						document.getElementById( 'SGVC_IDdelarres' ).value                        = dels;

						mode       = 3;
						var timeID = setTimeout( "SGVC_windowprint(SGVC_transa.h8th_string)", 100 );
					}

				} else if (mode == 2) {
					if (ii >= 1) {
						ii = 0;
						ii = EnumIDs.length - 1;

						for (i = ii;i >= 0;i--) {
							if (typeof selectednodes[i] == 'undefined') {
								document.getElementById( 'sasjobtable' ).deleteRow( i + 1 );

							} }
						var reds = selectednodes.join( "!~!" );
						if (iii >= 1) {
							reds = reds + '!*!' + notselectednodes.join( "!~!" );}
						selectednodes = null;ii = 0;selectednodes = new Array();
						notselectednodes                          = null;iii = 0;notselectednodes = new Array();
						document.getElementById( 'idredsarres' ).value                            = reds;

						mode       = 3;
						var timeID = setTimeout( "SGVC_windowprint(SGVC_transa.h9th_string)", 100 );     'Redeem'
					} }}
		} else {
			if (titleis == SGVC_transa.h7th_string) {
				document.getElementById( "selectruncan" ).style.display = "none"; window.print(); document.forms['idclientdata'].submit();
			} else {
				if (titleis == SGVC_transa.h8th_string) {
					   document.forms['idclientdata'].submit();

				} else {
					if (titleis == SGVC_transa.h9th_string) {
						   document.forms['idclientdata'].submit();
					}
				}
			}
		}} catch (err) {
		alert( SGVC_transa.h5th_string + ' ' + err.description + " " + i + " " + typeof selectednodes[i] + " \n" );
		err = 0;
		}}



function SGVC_wordwrap(str, columbs, str_break)  {
	var cSp0 = "";var cSp1 = " "; ctvEnum = 0; // columbs =21;
	var ctv                               = stripserslashes( str ).split( cSp1 );
	ctvEnum                               = ctv.length;
	if (ctvEnum == 1) {
		return SGVC_wordwraper( str, columbs, str_break );
	} else {
		for (var ds = 0;ds < ctvEnum;ds++) {
			if (ctv[ds].length > columbs) {
				ctv[ds] = SGVC_wordwraper( ctv[ds], columbs, cSp1 );
			}
		} }
		return ctv.join( cSp1 );
}

function SGVC_wordwraper(str, columbs, str_break) {
	var words = Array();var ctv = Array();  var endy = str_break + "\n"
	var newstr                                       = str;var izSTR = 0;izEND = 0;var endS = 0;endE = 0; var senum = 0; var cSp0 = "";var cSp1 = " ";
	var elseIs = RegExp( "[^0-9a-zA-Z]", "g" );
	ctv[0]     = cSp0;

	try {

		senum   = str.length;
		words   = str.split( cSp0,10000 );
		var cut = senum >= columbs;
		if ( ! cut) {
			return str;}
		endE  = Math.floor( columbs * 0.60 );
		endS  = 0;
		izSTR = 0; izEND = columbs;
		for (var iz = 0;iz < senum;iz++) {
			 izSTR = iz;
			if (cut) {
				 ctv[iz] = str.substring( izSTR,izEND ) + endy;
				if (izEND >= senum) {
					return ctv.join( cSp0 );}
				chkStr = endE + iz; chkEnd = columbs + iz;

				for (var iiz = chkEnd;iiz >= chkStr;iiz = iiz - 1) {
					if (elseIs.exec( words[iiz] )) {
						   ctv[iz] = str.substring( izSTR,iiz ) + endy;
						   cut     = (senum - iiz) > columbs; izEND = iiz;iiz = chkStr - 1;
					}

				}  iz = izEND - 1;izEND = izEND + columbs;
				if (izEND > senum) {
					izEND = senum;}
			} else {
				ctv[iz] = str.substring( izSTR,senum ) + endy;iz = senum;
			}
		}
		return ctv.join( cSp0 );

	} catch (err) {
		 alert( SGVC_transa.h4th_string + str + "  " + columbs + "  " + str_break + "\n sys Error > " + err.description + " \n" );
	}
}



function SGVC_wordwrap( str ) {

	brk   = '<br/>n';
	width = 22;
	cut   = false;

	if ( ! str) {
		return str; }

	var regex = '.{1,' + width + '}(\s|$)' + (cut ? '|.{' + width + '}|.+$' : '|\S+?(\s|$)');

	return str.match( RegExp( regex, 'g' ) ).join( brk );

}
function SGVC_windowprint(mode){
	var css = "@media print{ table { page-break-after:avoid } tr { page-break-before:auto; page-break-after:auto }td { page-break-inside:avoid; page-break-after:avoid } .page-break    { display:inline-table } .no-print, .no-print *{display: none !important;} }",
	head    = document.head || document.getElementsByTagName( 'head' )[0],
	style   = document.createElement( 'style' );

	style.type  = 'text/css';
	style.media = 'print';

	if (style.styleSheet) {
		style.styleSheet.cssText = css;
	} else {
		style.appendChild( document.createTextNode( css ) );
	}

	head.appendChild( style );

	document.getElementById( 'selectrunid' ).value          = mode;
	document.getElementById( 'selectruncan' ).style.cssText = "color:#486FAD; background-color:#D3B169;border-style:double; width: 95px; height: 40px; font-size: 26px;font-family: 'Charm', cursive !important; display: inline !important; .no-print, .no-print *{display: none !important}";

}

function SGVC_setmodes(modezs,chkIS){

	var chkISwas  = document.getElementById( chkIS ).checked;
	var not_stoop = SGVC_checkmodes( chkIS );
	var curmodez  = document.getElementById( 'modzs' ).value;
	var twopart   = curmodez.split( "!~!",2 );

	if (chkISwas) {
		twopart[1] = twopart[1] + 1;
		curmodez   = modezs + "!~!" + twopart[1];
	} else {
		if (twopart[1] >= 2) {
			   twopart[1] = twopart[1] - 1;
				curmodez  = modezs + "!~!" + twopart[1];
		} else {
			curmodez = '';
		}}
	document.getElementById( 'modzs' ).value = curmodez;
}

function SGVC_checkmodes(chkIS){
	var cols    = chkIS.substr( 0,3 );
	var tableIS = document.getElementById( "sasjobtable" );
	var rowsIS  = tableIS.getElementsByTagName( "tr" )
	for (var i = 1;i <= rowsIS.length - 2;i++) {
		if (cols == "id0") {
			document.getElementById( "id1" + i ).checked = false;

			if (document.getElementById( "id2" + i ).disabled == false) {
				document.getElementById( "id2" + i ).checked = false;}
		} else if (cols == "id1") {
			document.getElementById( "id0" + i ).checked = false;

			if (document.getElementById( "id2" + i ).disabled == false) {
				document.getElementById( "id2" + i ).checked = false; }
		} else if (cols == "id2") {
			document.getElementById( "id1" + i ).checked = false;
			document.getElementById( "id0" + i ).checked = false;
		}}
	if (cols == "id0") {
		document.getElementById( "id1all" ).checked = false;
		document.getElementById( "id2all" ).checked = false;
	} else if (cols == "id1") {
		 document.getElementById( "id0all" ).checked = false;
		 document.getElementById( "id2all" ).checked = false;
	} else if (cols == "id2") {
		  document.getElementById( "id1all" ).checked = false;
		  document.getElementById( "id0all" ).checked = false;
	};
	   return; }

function SGVC_cancelall(){
	document.getElementById( 'SGVC_IDdelarres' ).value = '';
	document.getElementById( 'idredsarres' ).value     = '';
	document.getElementById( 'modzs' ).value           = '';
	document.forms['idclientdata'].submit();

}

function SGVC_calkall(){
	document.getElementById( 'amounted' ).value = SGVC_chkval(); document.getElementById( 'itemid' ).value = 'Gift-Card';

}

function SGVC_chkval(){
	var sentval = document.getElementById( 'calcval' ).value;
	sentval     = SGVC_ljtrim( sentval,'$' );
	if (sentval.length >= 1) {
		var SGVC_chkvals = new Array();
		var isVal        = 0.0;
		SGVC_chkvals     = sentval.split( '.' );
		 isval           = SGVC_chkvals[0] + '.00';
	}
			return isval;
}

 var media_uploader = null;

function SGVC_open_media_uploader_image()
	{
		media_uploader = wp.media(
			{
				frame:    "post",
				state:    "insert",
				multiple: false
			}
		);

		media_uploader.on(
			"insert",
			function(){
							var json = media_uploader.state().get( "selection" ).first().toJSON();

							var image_url     = json.url;
							var image_caption = json.caption;
							var image_title   = json.title;
							var carryon       = '';
				if (image_caption !== '') {
					carryon = image_caption;} else {
							carryon = image_title;}
								var findcapt = image_url.split( '/' );
								findcapt     = findcapt.reverse();
					if (carryon == '') {
						carryon = findcapt[0];}
								document.getElementById( 'idlogofilenm' ).value         = image_url + "!*!" + carryon.toUpperCase();
								document.getElementById( 'sasnys_custom_images' ).value = carryon.toUpperCase();

			}
		);

		 media_uploader.open();
}


function SGVC_setscales(setscalesIS){
	var tmeScales = Array();
	tmeScales[0]  = Array( "months","days","years","no expiry" );
	tmeScales[1]  = Array( "30.4375","1","365.25","0" );
	var setVal    = document.getElementById( 'idholdval' ).value;
	var newVal    = document.getElementById( 'timecapsule' ).selectedIndex;
	var shaval    = 0.0,endval = '0';

	for (var i = 0;i <= 3;i++) {
		if (setscalesIS == tmeScales[0][i]) {
			shaval = tmeScales[1][i] * setVal;}
	}
	for (var i = 0;i <= 3;i++) {
		if (i <= 2) {
			if ( tmeScales[0][newVal] == tmeScales[0][i]) {
				endval = (shaval / tmeScales[1][i]).valueOf();}
		}
	}
	document.getElementById( 'voucher_life' ).value = endval;

}
