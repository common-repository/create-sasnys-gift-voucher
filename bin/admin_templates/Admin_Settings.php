<?php
  /**
  * @package create-sasnys-gift-voucher
  */

     $SGVC_valuIS=array();  $datData='';  $fulllogo=''; $IdLogo=''; $ssplarr=array();
      global $wpdb,$current_user,$tableIs; 
       $tmeScales=array();
       $tmeScales[0] = array("months","days","years","no expiry");
       $tmeScales[1] = array("30.4375","1","365.25","0");
     if(get_current_user_id()==0){die;}
     
   if(SGVC_testdb()==true){    
       if (! empty( $_POST['makevouchsettings'] ) ) {  
             $datData = wp_filter_post_kses($_POST['makevouchsettings']) ;
             if( wp_verify_nonce(wp_filter_post_kses($_REQUEST['crtsasgiftmakeset'])  ,'crtsasgiftmakeset')){
                        $SGVC_valuIS =explode('!~!',$datData,22);
                        $SGVC_valuIS[11] ='1';
                        }}
        $tableIsTo= "seriahglobevars"; 
       if($datData!==''){ 
          
           $noticemail = $current_user->user_email;
           $tmezon = get_option('timezone_string');
         if($tmezon==''){
             $tmezon=date_default_timezone_get() ; }
             
           $valueNew=array('Gift_Voucher_Shop'=>$SGVC_valuIS[0],
                           'Shop_Address'=>$SGVC_valuIS[1],
                           'Shop_Ph_Number'=>$SGVC_valuIS[2],
                           'Booking_Notice'=>$SGVC_valuIS[3],
                           'voucher_life'=>$SGVC_valuIS[4],
                           'PayPal_Login'=>$SGVC_valuIS[5],
                           'PayPal_Email'=>$SGVC_valuIS[6],
                           'PayPal_Password'=>$SGVC_valuIS[7],
                           'Company_Logo'=>$SGVC_valuIS[8],
                           'wordpress_Password'=>$wpdb->dbpassword,
                           'wordpress_User'=>$wpdb->dbuser,
                           'wordpress_Name'=>$wpdb->dbname,
                           'SMTPSecure'=>$SGVC_valuIS[12],
                           'Host'=>$SGVC_valuIS[13],
                           'Username'=>$SGVC_valuIS[14],
                           'Password'=>$SGVC_valuIS[15],
                           'Port'=>$SGVC_valuIS[16],
                           'noticemail'=>$noticemail,     
                           'timezone'=>$tmezon,
                           'codehexis'=>'1');
                           
                $curRec =array("codehexis" => "1");   
                $iv=$wpdb->update($tableIsTo,$valueNew,$curRec);   
                $curfile =SGVC_Plugin_Path."ppal_ipn.txt"; 
                $newfile =SGVC_BASE_PATH."sasnys_pp_ipn.php";
            SGVC_SetUpIPN($curfile,$newfile,$valueNew,$tmeScales,$noticemail);           
       }else{
                                 
                             
         $sqlSTR="SELECT * FROM $tableIsTo WHERE codehexis = '1';";
           $sqlSTR = $wpdb->prepare($sqlSTR,$tableIsTo);
         
         $SGVC_valuIS = $wpdb->get_row($sqlSTR,ARRAY_N);       
       } 
          if($SGVC_valuIS[8]!==esc_html__('none selected','create-sasnys-gift-voucher')){
              $ssplarr=explode("!*!",$SGVC_valuIS[8],2);
              $fulllogo = $SGVC_valuIS[8];  
              $IdLogo = $ssplarr[1];
          }else{
                  $fulllogo = esc_html__('none selected','create-sasnys-gift-voucher'); 
                   $IdLogo = esc_html__('none selected','create-sasnys-gift-voucher');
              }}
   
  
 
   function SGVC_openSettings_funct($tableIs,$SGVC_valuIS,$fulllogo,$IdLogo,$datdata,$tmeScales) {  
      $tranytext = esc_html__( 'Voucher Valid period has to be a number','create-sasnys-gift-voucher');
      $noneselect =  esc_html__( 'none selected','create-sasnys-gift-voucher');
      $numaARR =explode("!@!",$SGVC_valuIS[4],2); 
      global $SGVC_HomewURL,$SGVC_ContentURL,$tableIs;
      if(count($numaARR)==1){ $numaARR[0]='months'; $numaARR[1]='6';  }
      $choiceScale="<select size='1' id='timecapsule' onchange=\"javascript:SGVC_setscales('$numaARR[0]')\" >"; $cusChoice='' ;

     for($ig=0;$ig <=3;$ig++){
       if ($numaARR[0]==$tmeScales[0][$ig]){
           $cusChoice=" selected ";
       }   
     $choiceScale.= "<option value='". $tmeScales[1][$ig]."'$cusChoice>".$tmeScales[0][$ig]."</option>";
     $cusChoice='' ;
     }   
   $choiceScale.=  "</select>";  
   
   $retMSGis = SGVC_include_nonce();
                    
   $retMSGis.="<table border='0' width='1540' cellpadding='2' height='379'>
   
    <tr  class='sndcol'>
        <td>&nbsp;</td>
        <td valign='top'>".esc_html__('Wordpress Short codes','create-sasnys-gift-voucher')."</td>
        <td valign='top'>".esc_html__('Page suggested format design','create-sasnys-gift-voucher')."</td>
        <td valign='top'>".esc_html__('Description of processors','create-sasnys-gift-voucher')."</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td valign='top' class='fstcol' >[sasnys_GetPrice]</td>
        <td valign='top'>".esc_html__('Create a Sales orientated page with a small section to hold a table of three rows and one column the actual size of the insert is shown here. Background colour is transparent and the text is white','create-sasnys-gift-voucher')."<table style='border-style: hidden; margin: 0px !important; padding: 0px !important; border-spacing: 0px;'>
            <tr>
                <td style='border-style: hidden; color: white; background-color:grey'>
                <h3 style='color: white;'>".esc_html__('Enter value ','create-sasnys-gift-voucher')."</h3>
                </td>
            </tr>
            <tr>
                <td>
                <h3 style='border-style: hidden; color: white; font-style: normal; font-weight: 800; background-color:grey'>
                $<input name='calkval' id='calcval' type='text' size='8' maxlength='4'></h3>
                </td>
            </tr>
            <tr>
                <td style='border-style: hidden; background-color:grey'>         
                <input name='submit' type='image' alt='Buy Now' src='https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif' border='0'>
                 
                </td>
            </tr>
        </table>
        </td>
        <td>".esc_html__('Creates a link to the wordpress database and then automatically creates a database table called','create-sasnys-gift-voucher'). '&quot;'.$tableIs.'&quot; ,'.esc_html__(' The button sends the user to the PayPal site for payment processors.','create-sasnys-gift-voucher')."</td>
        <td height='182'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td valign='top'  class='fstcol'>[sasnys_MakePage]</td>
        <td valign='top'>".esc_html__('The page for display needs to be blank with the created page using all page area.','create-sasnys-gift-voucher')."</td>
        <td valign='top'>".esc_html__('Allows the user to create and personalise the Gift Card Certificate wich is opened to the user on successful PayPal payment. The user is offered a choice of printing the Gift Certificate or e-mailing a printable copy to a designated e-mail account or both.','create-sasnys-gift-voucher')."<br>
        ".esc_html__('This applications installing agent will need to set PayPals successful returning page to this run setting with the address of the makevoucher page','create-sasnys-gift-voucher')." <p id='greening' >".$SGVC_HomewURL."/makevoucher</p></td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td valign='top' class='fstcol'>[sasnys_ShowLedger]</td>
        <td valign='top'>".esc_html__('the page will need to be nearly full screen size. There is a table created that will span full width with nine columns and rows to match stored data.','create-sasnys-gift-voucher')."</td>
        <td valign='top'>".esc_html__('Displays all usable data in the ','create-sasnys-gift-voucher').'&quot;'.$tableIs.'&quot;'.esc_html__(' database table the page allows printing of selected records, deletion of selected record, or marking selected records of honoured redeemed gifts.','create-sasnys-gift-voucher')."</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td width='39'>&nbsp;</td>
        <td width='209' valign='top'  class='fstcol'>".esc_html__('Auto Created','create-sasnys-gift-voucher')."</td>
        <td width='497' valign='top'>".esc_html__('This page remains invisible to the user and is only used for verification interaction between PayPal and this application.','create-sasnys-gift-voucher')."<br />".esc_html__(' Once you fill in the information in this pages','create-sasnys-gift-voucher')." &quot;".esc_html__('Personalised settings','create-sasnys-gift-voucher')."&quot; ".esc_html__('and press the','create-sasnys-gift-voucher')." &quot;". esc_html__('Save Changes','create-sasnys-gift-voucher')."&quot; ".esc_html__('button a page is created called','create-sasnys-gift-voucher')." &quot;sasnys-pp-ipn.php&quot;".esc_html__('that communicates with PayPals website','create-sasnys-gift-voucher')."</td>
        <td width='452' valign='top'>".esc_html__('The installation will require the setting up of a sellers management account with PayPal as well as setting the run setting with the address of ','create-sasnys-gift-voucher').' &quot;sasnys-pp-ipn.php&quot; '.esc_html__('copy','create-sasnys-gift-voucher').' &quot;statement two&quot; '.esc_html__('as instructed in','create-sasnys-gift-voucher')." &quot;".esc_html__('Personalised settings','create-sasnys-gift-voucher')."&quot;<p id='pinkinging'>".$SGVC_HomewURL."/sasnys_pp_ipn.php </p></td>
        <td width='297' height='25'>&nbsp;</td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td height='25'>&nbsp;</td>
    </tr>
        <tr>
        <td>&nbsp;</td>
        <td valign='top' class='fstcol'>[sasnys_Cancelled]</td>
        <td valign='top'>".esc_html__('The page named','create-sasnys-gift-voucher')." &quot;cancelled&quot; ".esc_html__('can be of your own design the text on it should reflect your concerns about why the user cancelled the PayPal payment and your remedies to address there concerns. The text from the short code is').' &quot;'.esc_html__(' Sorry to hear that you cancelled if you had trouble please use our contact page to report to management','create-sasnys-gift-voucher')."&quot; <br />
        ".esc_html__('you do not need the [sasnys_Cancelled] short code just the page name','create-sasnys-gift-voucher')." &quot;cancelled&quot; ".esc_html__('as is in lower Case.','create-sasnys-gift-voucher')." </td>
        <td valign='top'>".esc_html__('The page is a simple landing page to get the PayPal user back to your site. This is automatically recognised with PayPal via this application','create-sasnys-gift-voucher')."</td>
        <td height='25'>&nbsp;</td>
    </tr>
    <tr><td colspan=5><p class='shadowd' >".esc_html__('Personalised settings','create-sasnys-gift-voucher')."</p></td></tr>
    
    <tr title='".esc_html__('The place name for the gift voucher redemer EXAMPLE Kingston House Restaurant','create-sasnys-gift-voucher')."'>
        <td  align='right' colspan=2 height='25'>".esc_html__('Gift Voucher Shop','create-sasnys-gift-voucher')."</td>
        <td > <input type='text' style=  'width:100%;' id='Gift_Voucher_Shop' value='$SGVC_valuIS[0]'></td>
        <td  colspan=2>&nbsp;</td>
    </tr>
     <tr title=' ".esc_html__('The shop front address for redemtion of voucher EXAMPLE 11 Channon Street Gympie QLD','create-sasnys-gift-voucher')."'>
        <td  align='right' colspan=2 height='25'>".esc_html__('Shop Address','create-sasnys-gift-voucher')."</td>
        <td >  <input type='text' style=  'width:100%;' id='Shop_Address' value='$SGVC_valuIS[1]'></td>
        <td  colspan=2> &nbsp;</td>
    </tr>
    <tr  title='".esc_html__('A contact phone for assistance EXAMPLE PH:01 2345 6789','create-sasnys-gift-voucher')."'>
       <td  align='right' colspan=2 height='25'>".esc_html__('Shop Phone Number','create-sasnys-gift-voucher')."</td>
       <td> <input type='text' style=  'width:50%;' id='Shop_Ph_Number' value='$SGVC_valuIS[2]'></td>
       <td  colspan=2>&nbsp;</td>
    </tr>
    <tr title='".esc_html__('A notice for the benificary EXAMPLE Please pre-book','create-sasnys-gift-voucher')."'>
         <td  align='right' colspan=2 height='25'>".esc_html__('Notification','create-sasnys-gift-voucher')."</td>  
        <td> <input type='text' style=  'width:45%;' id='Booking_Notice' value='$SGVC_valuIS[3]'></td>
        <td  colspan=2>&nbsp;</td>
    </tr>
        <tr title='".esc_html__('EXAMPLE 6 months 0.5 years 182.6 days all equal the same time period','create-sasnys-gift-voucher')."'>
         <td  align='right' colspan=2 height='25'>".esc_html__('Voucher valid period','create-sasnys-gift-voucher')."</td>  
        <td> <input type='text' style=  'width:15%;' id='voucher_life' value='$numaARR[1]'>
       $choiceScale
       </td>
        <td colspan=2>
        <input type='hidden' name ='holdval' id='idholdval' value='$numaARR[1]' ></td>
    </tr>
    <tr title='".esc_html__('PayPal business Acct Id from','create-sasnys-gift-voucher')." &quot;".esc_html__('Seler account ID','create-sasnys-gift-voucher')."&quot; ".esc_html__('on the paypal page','create-sasnys-gift-voucher')." &quot;".esc_html__('My profile','create-sasnys-gift-voucher')." &quot; ".esc_html__('after registering with PayPal','create-sasnys-gift-voucher')."'>
        <td  align='right' colspan=2 height='25'>PayPal business Acct Id</td>
        <td><input type='text' style=  'width:30%;' id='PayPal_Login' value='$SGVC_valuIS[5]'></td>
        <td  colspan=2>&nbsp;</td>

    </tr>
    <tr title='".esc_html__('PayPal USER Acct E-MAIL which is your login name for PayPal','create-sasnys-gift-voucher')."'>
        <td  align='right' colspan=2 height='25'>".esc_html__('PayPal e-mail address','create-sasnys-gift-voucher')."</td>
        <td><input type='text' style=  'width:40%;' id='PayPal_Email' value='$SGVC_valuIS[6]'></td>
        <td  colspan=2>&nbsp;</td>

    </tr>
    <tr>
        <td><input type='hidden' name ='makevouchsettings' id='datData' value='$datData' >&nbsp;</td>
        <td>
 
        <input type='button' title='".esc_html__('The logo file width is stretched to 510 pixels while the height is limited to 75 pixels','create-sasnys-gift-voucher')."' class='upload_image_button' value='".esc_html__('Select your logo','create-sasnys-gift-voucher')."' onclick='javascript:SGVC_open_media_uploader_image();' ></td>
        <td> <input type='text' title='".esc_html__('The logo file width is stretched to 510 pixels while the height is limited to 75 pixels','create-sasnys-gift-voucher')."' value='$IdLogo' class='sasnys_images' id='sasnys_custom_images'></td>
        <td title='".esc_html__('The logo file width is stretched to 510 pixels while the height is limited to 75 pixels','create-sasnys-gift-voucher')."'>&nbsp;</td>
        <td height='25' title='".esc_html__('The logo file width is stretched to 510 pixels while the height is limited to 75 pixels','create-sasnys-gift-voucher')."'>&nbsp;<input type='hidden' name ='logofilenm' id='idlogofilenm' value='$fulllogo' ></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan=4>".esc_html__('E-Mail Security','create-sasnys-gift-voucher')." &nbsp;&nbsp;
        <input type='text' title='".esc_html__('ssl ,tls or leave blank','create-sasnys-gift-voucher')."' style= 'width:5%;' id='serSMTPSecure' value='$SGVC_valuIS[12]'>&nbsp;&nbsp;Email host &nbsp;&nbsp;<input type='text'  title='".esc_html__('usually mail or smtp.emailaddress.com.au','create-sasnys-gift-voucher')."' style=  'width:20%;' id='serhosting' value='$SGVC_valuIS[13]'>&nbsp;&nbsp;".esc_html__('Email port','create-sasnys-gift-voucher')." &nbsp;&nbsp;<input type='text'  title='usually 25' style=  'width:5%;' id='seremlport' value='$SGVC_valuIS[16]'></td>
    </tr>
        <tr>
        <td>&nbsp;</td>
        <td colspan=4 >".esc_html__('email Username','create-sasnys-gift-voucher')."&nbsp;&nbsp;
        <input type='text'  title='".esc_html__('usually your email address','create-sasnys-gift-voucher')."' style= ' width:16%;' id='serusername' value='$SGVC_valuIS[14]'>&nbsp;&nbsp;".esc_html__('Email password','create-sasnys-gift-voucher')." &nbsp;&nbsp;<input type='password'  title='".esc_html__('your e-mail password','create-sasnys-gift-voucher')."' style=  'width:20%;' id='seremlpassword' value='$SGVC_valuIS[15]'></td>
    </tr >
        <tr align='middle'>
        <td>&nbsp;</td>
        <td><input type='button' onclick='javascript:SGVC_saveinputs(\"$tranytext\",\"$noneselect\")' value='".esc_html__('Save Changes','create-sasnys-gift-voucher')."' id='savedchge'></td>
        
        <td align='left'> </td>  
            <td align='left'></td>
        <td height='25'>&nbsp;</td> 
    </tr>       
    <tr>
        <td>&nbsp;</td>
        <td colspan=3><p class='shadowd' >".esc_html__('PayPal integration details','create-sasnys-gift-voucher')."</p></td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td colspan=3>".esc_html__('When all is configuard above then the only thing left is to copy and paste these two statements to your payPal account','create-sasnys-gift-voucher')."<br /><br /></td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td  align='right'>".esc_html__('Statement one','create-sasnys-gift-voucher')."</td>
         <td colspan=1 id='greening' align='left'>".$SGVC_HomewURL."/makevoucher<br /><br /></td>
        <td>&nbsp;</td>

    </tr>
    <tr>
        <td>&nbsp;</td>
        <td align='right' >".esc_html__('Statement two','create-sasnys-gift-voucher')." </td>
        <td colspan=1  id='pinkinging' align='left'>".$SGVC_HomewURL."/sasnys_pp_ipn.php<br /><br /></td>
        <td>&nbsp;</td>
    </tr>
     
<tr>
        <td>&nbsp;</td>
        
        <td colspan=2  class='blueprt' align='left'>".esc_html__('After logging into your PayPal business account click the gear shaped icon top right.','create-sasnys-gift-voucher')." <br />".esc_html__('This exposes the','create-sasnys-gift-voucher')." &quot;".esc_html__('Selling tools','create-sasnys-gift-voucher')."&quot; ".esc_html__('link.','create-sasnys-gift-voucher')."<br />".esc_html__('the link shows you the','create-sasnys-gift-voucher')." &quot;".esc_html__('Website preferences','create-sasnys-gift-voucher')."&quot; ".esc_html__('update link. That link opens up to these dialogs. These are the default settings.','create-sasnys-gift-voucher')." </td>
        <td>&nbsp;</td>
    </tr>
     <tr>


        <td>&nbsp;</td>
         <td colspan=3 align='left'><img src='".$SGVC_ContentURL."img/PayPal2.png' border='2' width='1011' height='520' alt='PayPal2.png (45,753 bytes)'></td>
       

    </tr>
     <tr>
        <td>&nbsp;</td>
        
        <td colspan=2 class='blueprt'  align='left'>".esc_html__('After logging into your PayPal business account click the gear shaped icon top right.','create-sasnys-gift-voucher')." <br />".esc_html__('This exposes the','create-sasnys-gift-voucher')." &quot;".esc_html__('Selling tools','create-sasnys-gift-voucher')."&quot; ".esc_html__('link.','create-sasnys-gift-voucher')."<br />".esc_html__('the link shows you the','create-sasnys-gift-voucher')." &quot;".esc_html__(' Instant payment','create-sasnys-gift-voucher')."&quot; ".esc_html__('notifications update link. That link opens up to this dialog.','create-sasnys-gift-voucher')."  </td>
        <td>&nbsp;</td>
    </tr>
     <tr>
            <td>&nbsp;</td>
         <td colspan=3  align='left'><img src='".$SGVC_ContentURL."img/paypal1.png' border='2' width='990' height='336' alt='paypal1.png (33,630 bytes)'></td>
       

    </tr>
         <tr>
        <td>&nbsp;</td>
        
        <td colspan=2 class='blueprt'  align='left'><a href='mailto:support@sasnys.com.au?subject=Help with Gift Card settings'><h2 STYLE='COLOR:RED;'>".esc_html__('If you need help click here','create-sasnys-gift-voucher')."</h2></a></td>
        <td>&nbsp;</td>
    </tr>
    
</table></form> 
<div id='donuts'><form action='https://www.paypal.com/cgi-bin/webscr' method='post' target='_top'>
                                    <input type='hidden' name='cmd' value='_s-xclick' />
                                    <input type='hidden' name='hosted_button_id' value='YPM9HTL27TXA6' />
                                    <input type='image' src='https://www.paypalobjects.com/en_AU/i/btn/btn_donate_SM.gif' border='0' name='submit' title='".esc_html__('PayPal - The safer, easier way to pay online!','create-sasnys-gift-voucher')." alt='".esc_html__('Donate with PayPal button','create-sasnys-gift-voucher')."' />
                                    <img alt='' border='0' src='https://www.paypal.com/en_AU/i/scr/pixel.gif' width='1' height='1' />
                        </form>
&nbsp;&nbsp;".esc_html__('Make all this worth a value,donate to this app !','create-sasnys-gift-voucher')."</div>
<div id='sermoviehouseid'><div class='iframe-container' ><iframe width='560' height='315' src='https://www.youtube.com/embed/9YffrCViTVk' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div></div>
<div class='idPayPalHowTo'><iframe width='560' height='315' src='https://www.youtube.com/embed/QNBwCnhJDKg' frameborder='0' allow='accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture' allowfullscreen></iframe></div>"; 
 echo $retMSGis;
   }
SGVC_enqueue_func(1);
echo SGVC_openSettings_funct($tableIs,$SGVC_valuIS,$fulllogo,$IdLogo,$datdata,$tmeScales);
   
   