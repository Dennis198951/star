<?php
	$entries = array();
	$xml = simplexml_load_file("https://ontarioconstructionnews.com/feed/","SimpleXMLElement", LIBXML_NOCDATA);
 	$entries = array_merge($entries, $xml->xpath("//item"));
	foreach ($entries as $entry) 
	{
	 	 $text = (string)$entry->description;
		 $post_content= strip_tags($text,'<div><p><img><a><br>');
		 $post_link =(string)$entry->link;
		$post_filename = "blog/".$entry->title;
		
	 	$date= (string)$entry->pubDate;
	 	 $date = date_create($date);
	 	 $post_pubDate = date_format($date,'YmdHis');

		 $doc = new DOMDocument();
		libxml_use_internal_errors(true);
		$doc->loadHTML( $post_content );
		$xpath = new DOMXPath($doc);
		$imgs = $xpath->query("//img");
		for ($i=0; $i < $imgs->length; $i++) {
		    $img = $imgs->item($i);
		    $src = $img->getAttribute("src");
		}
	$check_sql = "select * from data_posts d where d.post_image = '".$src."'";
	$featureResults = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $check_sql);
	$featureNum = mysql_num_rows($featureResults);
	if ($featureNum == 0) 
	{
		$sql = " INSERT INTO data_posts (post_title, post_content,post_image,post_filename,post_category,post_type,data_type,post_status,post_live_date, post_start_date,post_author,user_id,data_id,country_sn, state_sn,post_link) VALUES ('".$entry->title."', '".$post_content."','".$src."','".$post_filename."','Construction','Account','20',1,'".$post_pubDate."','".$post_pubDate."','B2B Media Group Inc',18,14,'CA','ON','".$post_link."')";
	    if (mysql(brilliantDirectories::getDatabaseConfiguration('database'), $sql)) {
	    	//echo "<script>alert('success');</script>";
		} else {
		   // echo "<script>alert('fail');</script>";
		}
	} 
	
}
    $xml = simplexml_load_file("https://canada.constructconnect.com/dcn/feed","SimpleXMLElement", LIBXML_NOCDATA);
    $entries = array_merge($entries, $xml->xpath("//item"));
    foreach ($entries as $entry) 
    {
         $text = (string)$entry->description;
         $post_content= strip_tags($text,'<div><p><img><a><br>');
         $post_link =(string)$entry->link;
        $post_filename = "blog/".$entry->title;
        
        $date= (string)$entry->pubDate;
         $date = date_create($date);
         $post_pubDate = date_format($date,'YmdHis');

         $doc = new DOMDocument();
        libxml_use_internal_errors(true);
        $doc->loadHTML( $post_content );
        $xpath = new DOMXPath($doc);
        
    $check_sql = "select * from data_posts d where d.post_title = '".$entry->title."'";
    $featureResults = mysql(brilliantDirectories::getDatabaseConfiguration('database'), $check_sql);
    $featureNum = mysql_num_rows($featureResults);
    if ($featureNum == 0) 
    {
        $sql = " INSERT INTO data_posts (post_title, post_content,post_image,post_filename,post_category,post_type,data_type,post_status,post_live_date, post_start_date,post_author,user_id,data_id,country_sn, state_sn,post_link) VALUES ('".$entry->title."', '".$post_content."','/uploads/news-pictures/18-vaughan-blog-post-image-20200408091852.jpg','".$post_filename."','Construction','Account','20',1,'".$post_pubDate."','".$post_pubDate."','B2B Media Group Inc',18,14,'CA','ON','".$post_link."')";
        if (mysql(brilliantDirectories::getDatabaseConfiguration('database'), $sql)) {
            //echo "<script>alert('success');</script>";
        } else {
           // echo "<script>alert('fail');</script>";
        }
    } 
    
}
?>

<?php
global $visible_page_labels;
$visible_page_labels = $on_page_labels;
?>
    [widget=Bootstrap Theme - Favorites - Modal]
<?php
addonController::showWidget('auto_suggest','1cdea8837af7cdafc8e7953a51198e4f','');

if (($_COOKIE['editmode'] == 1 || $_COOKIE['editmode'] == 2 || $_COOKIE['editmode'] == 3) && $_ENV['admin_settings']['editor'] != 1) {
    echo widget("Bootstrap Theme - Frontend Admin Menu","",$w['website_id'],$w);
}
if ($pars[1] == "profile") { ?>
    [widget=Bootstrap Theme - Account - Profile Photo Crop Modal]
<?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/autonumeric/1.9.41/autoNumeric.min.js" integrity="sha384-oZIn3Piso9kPFxWDbhbrMuN3hdeb25vGVnkLCJXlD4xKEduPc4stQvKLo0FSDILQ" crossorigin="anonymous"></script>

<?php if ($pars[1] == "leads" || $pars[1] == "upgrade" || $pars[1] == "billing" || $pars[0] == "checkout") { ?>
    <link rel="stylesheet" type="text/css" href="/directory/cdn/assets/bootstrap/css/sweetalert2.min.css">
    <?php
} else { ?>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.css" integrity="sha384-p19gDwnBLB4K+iyz/LFPYGAHbBZ5n5PpGwxF0fQek+47PfjruC8xamX+nvuWmjIk" crossorigin="anonymous">
<?php } ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/6.11.2/sweetalert2.min.js" integrity="sha384-Ei09WS56m6BfYmxv57wehjDKQVJXtPXB0ZIcbsCT+4WIn5CDY2BgIN8+pO/DR/0F" crossorigin="anonymous"></script>
<?
$blockadBlock = getAddOnInfo('adblock_blocker','a05ae9cf4e8c4dbcd128f6d7fa4cd127');
if (isset($blockadBlock['status']) && $blockadBlock['status'] === 'success') {
    echo widget($blockadBlock['widget'], '', $w['website_id'], $w);
}
//custom variables for grid view on member search and features
if ($wa["custom_160"] == "1" || $wa["custom_198"] == "1") { ?>
    <script src="https://npmcdn.com/imagesloaded@4.1/imagesloaded.pkgd.min.js"></script>
    <? if ($wa["custom_160"] == "1") { ?>
        <script>
            setTimeout(function(){
                $('.grid-container').imagesLoaded( function() {
                    if ($(window).width() > 960) {
                        $( ".member_results .views > i.gridView" ).trigger( "click" );
                    }
                    $('.grid-container').delay(10000).addClass('visible');
                });
            }, 850);
        </script>
    <? }

    if ($wa["custom_198"] == "1") { ?>
        <script>
            $('.grid-container').imagesLoaded( function() {
                if ($(window).width() > 960) {
                    $( ".feature-search .js-click" ).trigger( "click" );
                }
                $('.grid-container').delay(10000).addClass('visible');
            })
        </script>
    <? }
}
//custom variable for google map view on member search
if ($wa["custom_160"] == "2") { ?>
    <script>
        $(document).ready(function(){
            if(document.getElementById("google-pin") !== null){
                $( ".member_results .views > i.mapView" ).trigger( "click" );
            } else {
                $('.grid-container').delay(10000).addClass('visible');
            }
        });
    </script>
<?php } if ($wa["custom_198"] == "2") { ?>
    <script>
        $(document).ready(function(){
            if(document.getElementById("google-pin") !== null){
                $( ".views > i.mapView" ).trigger( "click" );
            } else {
                $('.grid-container').delay(10000).addClass('visible');
            }
        });
    </script>
<?php } ?>
    <script>
        function clearContent(thisObj){
            var size;
            if(thisObj.hasClass('input-sm') || thisObj.parents('.input-group').hasClass('input-group-sm')){
                size = "small";
            } else if (thisObj.hasClass('input-lg') || thisObj.parents('.input-group').hasClass('large-autosuggest')){
                size = "large";
            } else {
                size = "medium";
            }
            if(!thisObj.parent().hasClass('input_wrapper')){
                if(thisObj.parent().hasClass('input-group-sm')){
                    thisObj.wrap('<span class="input-group-sm input_wrapper"></span>');
                } else if (thisObj.parent().hasClass('input-group-lg')){
                    thisObj.wrap('<span class="input-group-lg input_wrapper"></span>');
                } else {
                    thisObj.wrap('<span class="input_wrapper"></span>');
                }
            }
            if(thisObj.val() != ""){
                if(thisObj.hasClass('googleSuggest')){
                    thisObj.parent().find('.fill_location').remove();
                }
                if (!thisObj.parent().find('.clear_content').length){
                    thisObj.parent().append('<span class="clear_content '+size+'"><i class="fa fa-times-circle" aria-hidden="true"></i></span>');
                }
            }
            <?php if($wa['location-auto-fill'] == "1"){ ?>
                if(thisObj.hasClass('googleSuggest') && thisObj.val().length == 0){
                    thisObj.parent().append('<span class="fill_location '+size+'"><i class="fa fa-crosshairs" title="%%%use_current_location%%%" aria-hidden="true"></i></span>');
                }
                if (thisObj.val() == "" && thisObj.parent().find('.clear_content').length){
                    thisObj.parent().find('.clear_content').remove();
                }
            <?php } ?>
        }
        $('.sm-autosuggest input, .googleSuggest, .large-autosuggest input, .md-autosuggest input, .normal-autosuggest input, .google-writen-location').keyup(function(){
            clearContent($(this));
        });

        $(document).ready(function(){
			
			
			
            $('.sm-autosuggest input, .googleSuggest, .large-autosuggest input, .md-autosuggest input, .normal-autosuggest input, .google-writen-location').each(function(){
                clearContent($(this));
            })
        })

        $(document).on('click', '.clear_content', function(){
            $(this).parent().find('input').val('');
            clearContent($(this).parent().find('input'));
            $(this).remove();
            
        });
    </script>
    <a href="#" class="scrollup"><i class="fa fa-caret-up"></i></a>
    <script>
        <?php
        if ($wa[custom_152] == "lockedonscroll"){ ?>
        $(document).ready(function () {

            if ($('.navbar-default').length > 0) {
                var menu = $('.navbar-default');
                var origOffsetY = menu.offset().top;

                function scroll() {

                    if ($(window).scrollTop() >= origOffsetY) {
                        $('.navbar-default').addClass('navbar-fixed-top');
                        $('.navbar-default').addClass('transparent_menu');

                    } else {
                        $('.navbar-default').removeClass('navbar-fixed-top');
                        $('.navbar-default').removeClass('transparent_menu');
                    }
                }
                document.onscroll = scroll;
            };
        });
        <?php } ?>

        $(document).ready(function(){
            $('.progress .progress-bar').progressbar({
                display_text: 'fill'
            });
            $(window).scroll(function(){

                if ($(this).scrollTop() > 600) {
                    $('.scrollup').fadeIn();

                } else {
                    $('.scrollup').fadeOut();
                }
            });
            $('.scrollup').click(function(){
                $("html, body").animate({
                    scrollTop: 0
                }, 600);
                return false;
            });
            $('#cropButton').click(function(){
                var iframe = $("#cropiFrame");
                iframe.attr("src", iframe.data("src"));
            });
        });
    </script>
<?php
$filestyleurl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if (strpos($filestyleurl ,'account') !== false && (strpos($filestyleurl ,'profile') !== false || strpos($filestyleurl ,'resume') !== false || strpos($filestyleurl ,'add') !== false || strpos($filestyleurl ,'edit') !== false || strpos($filestyleurl ,'copy') !== false)) { ?>
    <!-- FILESTYLE JS -->
    <script defer src="/directory/cdn/assets/bootstrap/js/bootstrap-filestyle.min.js"></script>
    <script>
        $(document).ready(function(){
            $(".filestyle_uploadcv").filestyle({
                buttonName: "btn-primary",
                input: false,
                buttonText: " %%%filestyle_choose_cv_file%%%"
            });
            var cv_upload_type;
            $(".filestyle_uploadcv").change(function(){
                var that = this;
                var file = that.files[0];

                const imageValidatorObject = new imageValidator(
                    {
                        mimeTypes:[
                            'application/pdf',
                            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                            'application/msword',
                            'image/jpeg',
                            'image/png',
                        ],
                        extensions:['png','jpg','jpeg','doc','docx','pdf'],
                        image:file,
                        ajaxUrl:'/wapi/widget',
                        success:function(){
                        },
                        error:function(){
                            swal({
                                    title: "<?php echo $label['error_label']?>",
                                    text: "<?php echo $label['filestyle_choose_cv_file']?>",
                                    type: "error"
                                }
                            );
                            $(".filestyle_uploadcv").filestyle('clear');
                        },
                        extraParams:{},
                        swalValidationTitle:'<?php echo $label['file_validation_title']?>',
                        swalValidationMessage:'<?php echo $label['file_validation_message']?>'
                    }
                );

                var extension   = file.name.split('.').pop();
                extension       = extension.toLowerCase();

                extraParams = {};
                extraParams.imageName           = file.name;
                extraParams.imageExtension      = extension;
                extraParams.imageSize           = file.size;
                extraParams.imageMimeType       = file.type;
                extraParams.isFromFileManager   = false;
                extraParams.pathFile            = 'Bootstrap Theme - Footer - Scripts';
                extraParams.userId              = "<?php echo $_COOKIE['user_id']; ?>";
                extraParams.validationType      = "<?php echo imageValidator::CV;?>";

                imageValidatorObject.setExtraParams(extraParams);

                imageValidatorObject.run();
            });

        });
    </script>
<?php } ?>
    <link rel="stylesheet" href="/directory/cdn/assets/bootstrap/css/bootstrap-datetimepicker.min.css">
    <script defer src="/directory/cdn/assets/bootstrap/js/moment-with-locales.min.js"></script>
    <script defer src="/directory/cdn/assets/bootstrap/js/bootstrap-datetimepicker.min.js"></script>
<?php

$languageArray = Array(
    "en-US" => "en",
    "fr-FR" => "fr",
    "de-DE" => "de",
    "it-IT" => "it",
    "pt-BR" => "pt",
    "es-ES" => "es"
);

$languageDate = $languageArray[$w['website_language']];

if ($w['website_language'] == "el-GR" || $w['website_language'] == "ja-JP" || $w['website_language'] == "ko-KR" || $w['website_language'] == "ru-RU"  || $w['website_language'] == "") {
    $languageDate = "en";
}

switch ($w['default_jquery_date_format']) {
    case 'mm/dd/yy':
    case 'm/d/y':
    case 'm/d/yy':
    case 'mm/dd/yy':
    case 'mm/dd/yyyy':
        $myDateFormat = 'MM/DD/YYYY';
        break;
    case 'dd/mm/yy':
    case 'd/m/y':
    case 'd/m/yy':
    case 'dd/mm/yy':
    case 'dd/mm/yyyy':
        $myDateFormat = 'DD/MM/YYYY';
        break;
    case 'yy/mm/dd':
    case 'y/m/d':
    case 'yy/m/d':
    case 'yy/mm/dd':
    case 'yyyy/mm/dd':
        $myDateFormat = 'YYYY/MM/DD';
        break;
    case 'yy/dd/mm':
    case 'y/d/m':
    case 'yy/d/m':
    case 'yy/dd/mm':
    case 'yyyy/dd/mm':
        $myDateFormat = 'YYYY/DD/MM';
        break;
    default:
        $myDateFormat = 'MM/DD/YYYY';
}
?>
    <script>
        $(document).ready(function(){
            $('input[field_type="date"]').datetimepicker({
                format: "<?php echo $myDateFormat;?>"
            });
        });

    </script>

<?php
$datetimeurl = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];

if ( strpos($datetimeurl,'account') !== false && (strpos($datetimeurl,'add') !== false || strpos($datetimeurl,'edit') !== false || strpos($datetimeurl,'newgroup') !== false) || $pars[2] == "copy") {

    $numericPostStartDate           = getPrevKey('post_start_date',$post);
    $numericPostEndDate             = getPrevKey('post_expire_date',$post);

    $addOnFormat                    = strtoupper($w['default_jquery_date_format']);
    $addOnMinDate                   = date($w['php_jquery_date_format']." H:i:s");
    $addOnDefaultStartDateWithValue = date($w['php_jquery_date_format']." H:i:s",strtotime($post[$numericPostStartDate]));
    $addOnDefaultEndDateWithValue   = date($w['php_jquery_date_format']." H:i:s",strtotime($post[$numericPostEndDate]));
    $addOnCleanStartDate            = date($w['php_jquery_date_format']." 00:00:00",strtotime($post[$numericPostStartDate]));
    ?>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/moment.min.js"></script>
    <?php if ($languageDate != 'en') {
        echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.19.2/locale/' . $languageDate . '.js"></script>';
    } ?>
    <script defer>

        var addOnDateFormat                 = '';
        var addOnMinDate                    = '';
        var addOnDefaultStartDateWithValue  = '';
        var addOnDefaultEndDateWithValue    = '';
        var addOnCleanStartDate             = '';

        $(document).ready(function(){

            addOnDateFormat                 = '<?php echo $addOnFormat; ?>';
            addOnMinDate                    = moment('<?php echo $addOnMinDate; ?>',addOnDateFormat+'hh:mm A');
            addOnDefaultStartDateWithValue  = moment('<?php echo $addOnDefaultStartDateWithValue; ?>',addOnDateFormat+'hh:mm A');
            addOnDefaultEndDateWithValue    = moment('<?php echo $addOnDefaultEndDateWithValue; ?>',addOnDateFormat+'hh:mm A');
            addOnCleanStartDate             = moment('<?php echo $addOnCleanStartDate; ?>',addOnDateFormat+'hh:mm A');
            var localeDate = '<?php echo $languageDate;?>';

            if($('#startdatetimepicker').length){
                $('#startdatetimepicker').datetimepicker({
                    //DATE FORMAT FIRST
                    locale: localeDate,
                    <?php if ($w['php_jquery_date_format'] === "m/d/y") { ?>
                    format: 'MM/DD/YY hh:mm A',
                    <?php } else if($w['php_jquery_date_format'] === "m/d/Y") { ?>
                    format: 'MM/DD/YYYY hh:mm A',//default if not matched allowed
                    <?php } else if($w['php_jquery_date_format'] === "d/m/y") { ?>
                    format: 'DD/MM/YY hh:mm A',//default if not matched allowed
                    <?php } else if($w['php_jquery_date_format'] === "d/m/Y") { ?>
                    format: 'DD/MM/YYYY hh:mm A',//default if not matched allowed
                    <?php }else{ ?>
                    format: 'MM/DD/YY hh:mm A',
                    <?php } ?>
                    //MIN DATE AND DEFAULT
                    <?php
                    if ($w['allow_past_date_in_posts'] == 0) {

                    if ($post['post_start_date'] == "") { ?>
                    minDate: addOnMinDate
                    <?php }else{ ?>
                    minDate: addOnCleanStartDate
                    <?php }
                    } ?>
                });
            }

            if($('#enddatetimepicker').length){
                $('#enddatetimepicker').datetimepicker({
                    //DATE FORMAT FIRST
                    locale: localeDate,
                    <?php if ($w['php_jquery_date_format'] === "m/d/y") { ?>
                    format: 'MM/DD/YY hh:mm A',
                    <?php } else if($w['php_jquery_date_format'] === "m/d/Y") { ?>
                    format: 'MM/DD/YYYY hh:mm A',//default if not matched allowed
                    <?php } else if($w['php_jquery_date_format'] === "d/m/y") { ?>
                    format: 'DD/MM/YY hh:mm A',//default if not matched allowed
                    <?php } else if($w['php_jquery_date_format'] === "d/m/Y") { ?>
                    format: 'DD/MM/YYYY hh:mm A',//default if not matched allowed
                    <?php }else{ ?>
                    format: 'MM/DD/YY hh:mm A',
                    <?php }?>

                    //DEFAULT
                    <?php if ($post['post_expire_date'] != "" && $post['post_start_date'] != "") { ?>
                    minDate: addOnCleanStartDate
                    <?php }else if($post['post_start_date'] == "" && $post['post_expire_date'] != ""){ ?>
                    minDate: addOnDefaultEndDateWithValue
                    <?php }else{?>
                    minDate: addOnMinDate
                    <?php } ?>
                });
            }

            var endDateExist = $('#enddatetimepicker').length;

            if($('#startdatetimepicker').length){
                $("#startdatetimepicker").on("dp.change", function (e) {
                    if(e.date != null && e.date != undefined){
                        if (endDateExist) {
                            $('#enddatetimepicker').data("DateTimePicker").minDate(e.date);
                            $('#enddatetimepicker').val('');
                        }
                        $('#event_fields').formValidation('revalidateField', 'post_start_date');
                    }
                });
            }
        });
    </script>
    <?php
    $getRecurrentCode = getAddonInfo("recurring_events","a3e7334e4492e23f0970dee52e4a8bac");
    if (isset($getRecurrentCode[status]) && $getRecurrentCode[status] == "success" && $dc['form_name'] == 'event_fields' && ( $dc['enable_recurring_events_addon'] == 1 || !isset($dc['enable_recurring_events_addon']) ) ) {
        echo widget($getRecurrentCode['widget'],"",$w['website_id'],$w);
    }else if($dc['form_name'] != 'event_fields'){

        $addOnMinDate                   = date("Y-m-d");
        $addOnDefaultStartDateWithValue = date("Y-m-d",strtotime($post['post_fixed_start_date']));
        $addOnDefaultEndDateWithValue   = date("Y-m-d",strtotime($post['post_fixed_expire_date']));
        ?>
        <script defer>

            var addOnDateFormat                 = '';
            var addOnMinDate                    = '';
            var addOnDefaultStartDateWithValue  = '';
            var addOnDefaultEndDateWithValue    = '';

            $(document).ready(function(){
                addOnDateFormat                 = '<?php echo $addOnFormat; ?>';
                addOnMinDate                    = moment('<?php echo $addOnMinDate; ?>');
                addOnDefaultStartDateWithValue  = moment('<?php echo $addOnDefaultStartDateWithValue; ?>');
                addOnDefaultEndDateWithValue    = moment('<?php echo $addOnDefaultEndDateWithValue; ?>');

                var localeDate = '<?php echo $languageDate;?>';

                if($('#stardatepicker').length){
                    $('#stardatepicker').datetimepicker({
                        //DATE FORMAT FIRST
                        locale: localeDate,
                        <?php if ($w['php_jquery_date_format'] == "m/d/y") { ?>
                        format: 'MM/DD/YY',
                        <?php } else if($w['php_jquery_date_format'] == "m/d/Y") { ?>
                        format: 'MM/DD/YYYY',//default if not matched allowed
                        <?php } else if($w['php_jquery_date_format'] == "d/m/y") { ?>
                        format: 'DD/MM/YY',//default if not matched allowed
                        <?php } else if($w['php_jquery_date_format'] == "d/m/Y") { ?>
                        format: 'DD/MM/YYYY',//default if not matched allowed
                        <?php }else{ ?>
                        format: 'MM/DD/YY',
                        <?php } ?>
                        //MIN DATE AND DEFAULT
                        <?php
                        if ($w['allow_past_date_in_posts'] == 0) {

                        if ($post['post_start_date'] == "") { ?>
                        minDate: addOnMinDate
                        <?php }else{ ?>
                        minDate: addOnDefaultStartDateWithValue
                        <?php }
                        } ?>
                    });
                }

                if($('#enddatepicker').length){
                    $('#enddatepicker').datetimepicker({
                        //DATE FORMAT FIRST
                        locale: localeDate,
                        <?php if ($w['php_jquery_date_format'] == "m/d/y") { ?>
                        format: 'MM/DD/YY',
                        <?php } else if($w['php_jquery_date_format'] == "m/d/Y") { ?>
                        format: 'MM/DD/YYYY',//default if not matched allowed
                        <?php } else if($w['php_jquery_date_format'] == "d/m/y") { ?>
                        format: 'DD/MM/YY',//default if not matched allowed
                        <?php } else if($w['php_jquery_date_format'] == "d/m/Y") { ?>
                        format: 'DD/MM/YYYY',//default if not matched allowed
                        <?php }else{ ?>
                        format: 'MM/DD/YY',
                        <?php }?>

                        //DEFAULT
                        <?php if ($post['post_expire_date'] != "" && $post['post_start_date'] != "") { ?>
                        minDate: addOnDefaultStartDateWithValue
                        <?php }else if($post['post_start_date'] == "" && $post['post_expire_date'] != ""){ ?>
                        minDate: addOnDefaultEndDateWithValue
                        <?php }else{?>
                        minDate: addOnMinDate
                        <?php } ?>
                    });
                }

                if($('#stardatepicker').length){
                    $("#stardatepicker").on("dp.change", function (e) {
                        if(e.date != null && e.date != undefined){
                            if($('#enddatepicker').length){
                                $('#enddatepicker').data("DateTimePicker").minDate(e.date);
                                $('#enddatepicker').val('');
                            }
                        }
                    });
                }
            });
        </script>
        <?php
    }

}
if ($label['widget_javascript'] != '') {
    echo eval("?>".$label['widget_javascript']."<?");
} ?>
    <script>
        function decision(message, url)
        {

            if(confirm(message)) {
                setTimeout(function(){
                    window.location = url;
                }, 0);
            }
        }
        var ajax = new Array();
        function getCityList(sel)
        {
            var countryCode = sel;
            var result = '';
            var flag = ''
            document.getElementById('state').options.length = 0;    // Empty city select box

            if (countryCode.length > 0) {

                if (countryCode == "CA" || countryCode == "CR") {
                    result = "Province";
                    flag = "<img src='flags/CA.png' style='width:16px;height:11px;'>";

                } else if (countryCode == "UK") {
                    result = "Region";
                    flag = "<img src='/flags/UK.png' style='width:16px;height:11px;'>";

                } else if (countryCode == "US") {
                    result = "Zip Code";
                    flag = "<img src='/flags/US.png' style='width:16px;height:11px;'>";

                } else {
                    result = "&nbsp;";
                    document.getElementById('state').disabled = false;
                    flag = "<img src='/flags/All.png' style='width:16px;height:16px;'>";
                }
                document.getElementById('byregion').innerHTML = result;
                document.getElementById('sflag').innerHTML = flag;

                if (countryCode == "US") {
                    document.getElementById('zipcode').style.visibility = 'visible';
                    document.getElementById('state').style.visibility = 'hidden';
                    document.getElementById('state').style.display = 'none';
                    document.getElementById('zipcode').style.display = 'block';

                } else {
                    document.getElementById('zipcode').style.visibility = 'hidden';
                    document.getElementById('state').style.visibility = 'visible';
                    document.getElementById('state').style.display = 'block';
                    document.getElementById('zipcode').value = '';
                    document.getElementById('zipcode').style.display = 'none';
                }
                var index = ajax.length;
                ajax[index] = new sack();
                ajax[index].requestFile = '/getStateList.php?statetype=code&category='+countryCode; // Specifying which file to get
                ajax[index].onCompletion = function(){ createCities(index) };   // Specify function that will be executed after file has been found
                ajax[index].runAJAX();      // Execute AJAX function
            }
        }
        function getCityListSearch(sel)
        {
            var countryCode = sel;
            var result = '';
            document.getElementById('state').options.length = 0;    // Empty city select box

            if (countryCode.length > 0) {

                if (countryCode == "CA" || countryCode == "CR") {
                    document.getElementById('zipsearch').style.visibility = 'collapse';
                    document.getElementById('zipsearch').style.height = '0px';
                    document.getElementById('statesearch').style.visibility = 'visible';
                    document.getElementById('statesearch').style.height = '62px';
                    document.getElementById('zipcode').value = '';
                    result = "Province";
                    flag = "<img src='/flags/CA.png' style='width:16px;height:11px;'>";

                } else if (countryCode == "UK") {
                    document.getElementById('zipsearch').style.visibility = 'collapse';
                    document.getElementById('zipsearch').style.height = '0px';
                    document.getElementById('statesearch').style.visibility = 'visible';
                    document.getElementById('statesearch').style.height = '62px';
                    document.getElementById('zipcode').value = '';
                    result = "Region";
                    flag = "<img src='/flags/UK.png' style='width:16px;height:11px;'>";

                } else if (countryCode == "US") {
                    result = "&nbsp;";
                    document.getElementById('statesearch').style.visibility = 'collapse';
                    document.getElementById('statesearch').style.height = '0px';
                    document.getElementById('zipsearch').style.visibility = 'visible';
                    document.getElementById('zipsearch').style.height = '112px';
                    result = "Zip Code";
                    flag = "<img src='/flags/US.png' style='width:16px;height:11px;'>";

                } else {
                    result = "&nbsp;";
                    document.getElementById('zipsearch').style.visibility = 'collapse';
                    document.getElementById('zipsearch').style.height = '0px';
                    document.getElementById('statesearch').style.visibility = 'collapse';
                    document.getElementById('statesearch').style.height = '0px';
                    document.getElementById('zipcode').value = '';
                    flag = "<img src='/flags/All.png' style='width:16px;height:16px;'>";
                }
                document.getElementById('byregion').innerHTML = result;
                document.getElementById('sflag').innerHTML = flag;
                var index = ajax.length;
                ajax[index] = new sack();
                ajax[index].requestFile = '/getStateList.php?type=account&statetype=code&category='+countryCode;    // Specifying which file to get
                ajax[index].onCompletion = function(){ createCities(index) };   // Specify function that will be executed after file has been found
                ajax[index].runAJAX();      // Execute AJAX function
            }
        }
        function getCityListAccount(sel)
        {
            var countryCode = sel;
            var result = '';
            document.getElementById('state').options.length = 0;    // Empty city select box

            if (countryCode == "CA") {
                result = "Province";

            } else if (countryCode == "UK") {
                result = "Region";

            } else if (countryCode == "US" || countryCode == "AU") {
                result = "State";

            } else {
                result = "Region";
            }
            if (result != "") {
                $("#state").prev('.control-label').text(result);
            }
            if (countryCode.length > 0){
                var index = ajax.length;
                ajax[index] = new sack();
                ajax[index].requestFile = '/getStateList.php?type=account&statetype=code&category=' + countryCode;    // Specifying which file to get
                ajax[index].onCompletion = function(){
                    createCities(index)
                };   // Specify function that will be executed after file has been found
                ajax[index].runAJAX();      // Execute AJAX function
            }
        }
        function getCityListPayment(sel)
        {
            var countryCode = sel;
            var result = '';
            document.getElementById('state').options.length = 0;    // Empty city select box

            if(countryCode.length > 0){

                if (countryCode == "CA") {
                    result = "Province";
                    document.getElementById('state').disabled = false;

                } else if (countryCode == "UK") {
                    result = "Region";
                    document.getElementById('state').disabled = false;

                } else if (countryCode == "US" || countryCode == "AU") {
                    result = "State";
                    document.getElementById('state').disabled = false;

                } else {
                    result = "Region";
                }
                document.getElementById('byregion').innerHTML = result;
                var index = ajax.length;
                ajax[index] = new sack();
                ajax[index].requestFile = '/getStateList.php?nota=1&statetype=code&category='+countryCode;  // Specifying which file to get
                ajax[index].onCompletion = function(){
                    createCities(index)
                };   // Specify function that will be executed after file has been found
                ajax[index].runAJAX();      // Execute AJAX function
            }
        }
        function createCities(index)
        {
            var obj = document.getElementById('state');
            eval(ajax[index].response); // Executing the response from Ajax as Javascript code
        }
    </script>

<?php
if (stristr($page['content'],'select2') || stristr($page['content'],'<select') || $page['seo_type']=="home") { ?>
    <!-- DROPDOWN SELECT SCRIPT -->
    <!-- Select2 Bootstrap CSS-->
    <link rel="stylesheet" href="/directory/cdn/bootstrap/select2/3.5.2/select2.min.css">
    <link rel="stylesheet" href="/directory/cdn/bootstrap/select2/master/css/select2-bootstrap.min.css">
    <script defer src="/directory/cdn/bootstrap/select2/3.5.2/select2.min.js"></script>
    <!--[if lt IE 9]>
    <script defer src="//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script defer src="/directory/cdn/bootstrap/select2/master/js/respond.min.js"></script>
    <![endif]-->
    <script>
        $(document).ready(function() {

            function getSecondLevel(div,id)
            {
                $("#" + div).select2("data", {
                    id: "",
                    text: "Loading..."
                });
                $.ajax({
                    url : '/ajaxsearch/get-services',
                    type : "GET",
                    data : {
                        'specialty_id' : id
                    },
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }
                        if (div == "tid"){
                            $("#ttid").select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']?>"
                            });
                            $("#ttid").select2("enable", false);
                        }
                        if (data.length > 1) {
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);
                            $("#" + div).select2("val", "");
                            <?php
                            if ($w['chained_search_focus_open'] == 1) { ?>
                            $("#" + div).select2("open");
                            <?php } ?>

                        } else {
                            $("#"+div).select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']?>"
                            });
                            $("#"+div).select2("val", "");
                        }
                    }
                });
            }
            function getSecondLevelAccount(div,id)
            {
                $("#" + div).select2("data", {
                    id: "",
                    text: "Loading..."
                });
                $.ajax({
                    url : '/ajaxsearch/get-services',
                    type : "GET",
                    data : {
                        'specialty_id' : id
                    },
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }
                        if (data.length > 1) {
                            $("#" + div).select2("close");
                            $("#" + div).select2("val", "");
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);

                            <?php
                            if ($user_data[sub_category] != "") { ?>
                            $("#" + div).select2("val","<?php echo $user_data['sub_category']; ?>");
                            <?php } ?>

                        } else {
                            $("#"+div).select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']; ?>"
                            });
                            $("#"+div).select2("val", "");
                        }
                    }
                });
            }
            function getThirdLevel(div,id,id2)
            {
                $("#"+div).select2("data", {
                    id: "",
                    text: "Loading..."
                });

                $.ajax({
                    url : '/ajaxsearch/get-locations',
                    type : "GET",
                    data : {
                        'specialty_id' : id,
                        'treatment_id' : id2,
                    },
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }
                        if (data.length > 1) {
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);
                            $("#" + div).select2("val", "");
                            <?php
                            if ($w['chained_search_focus_open'] == 1) { ?>
                            $("#" + div).select2("open");
                            <?php } ?>

                        } else {
                            $("#"+div).select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']; ?>"
                            });
                            $("#"+div).select2("val", "");
                        }
                    }
                });
            }
            function getStateList(div,id)
            {
                $("#"+div).select2("data", {
                    id: "",
                    text: "Loading..."
                });
                $.ajax({
                    url : '/ajaxsearch/get-states',
                    type : "GET",
                    data : {
                        'country' : id
                    },
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }
                        if (data.length > 1) {
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);
                            $("#" + div).select2("val", "");
                            $("#" + div).select2("open");
                        }
                    }
                });
            }
            function getInfinityChained(div,id)
            {
                $("#"+div).select2("data", {
                    id: "",
                    text: "Loading..."
                });
                $.ajax({
                    url : '/ajaxsearch/get-subcategory',
                    type : "GET",
                    data : {
                        'parent' : id
                    },
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }
                        if (data.length > 1) {
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);
                            $("#" + div).select2("val", "");
                            <?php
                            if ($w['chained_search_focus_open'] == 1) { ?>
                            $("#" + div).select2("open");
                            <?php } ?>

                        } else {
                            $("#" + div).select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']; ?>"
                            });
                        }
                    }
                });
            }
            function categoryChained(div,id)
            {
                $("#" + div).select2("data", {
                    id: "",
                    text: "Loading..."
                });
                if(div == "tid"){
                    url_link = '/ajaxsearch/get-services'
                    data_passed = {'specialty_id' : id}
                } else {
                    url_link = '/ajaxsearch/category-list';
                    data_passed = {'parent' : id} ;
                }
                $.ajax({
                    url : url_link,                
                    type : "GET",
                    data : data_passed,
                    dataType: "json",
                    success : function(data) {
                        var options = '';

                        for (var i = 0; i < data.length; i++) {
                            options += '<option value="' + data[i].value + '">' + data[i].title + '</option>';
                        }

                        if (data.length > 1) {
                            $("#" + div).select2("enable",true);
                            $("#" + div).html(options);
                            $("#" + div).select2("val", "");
                            <?php
                            if ($w['chained_search_focus_open'] == 1) { ?>
                            $("#" + div).select2("open");
                            <?php } ?>

                        } else {
                            $("#" + div).select2("data", {
                                id: "",
                                text: "<?php echo $Label['chained_search_no_results']; ?>"
                            });
                        }
                    }
                });
            }
            $("#bd-chained").select2({
                title: "<?php echo $Label['home_search_default_1']; ?>",
                placeholder: "<?php echo $Label['home_search_default_1']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                $("#tid").select2("enable",false);
                getInfinityChained("tid",id);
                <?php
                if ($w['chained_search_focus_open'] == 1) { ?>
                $("#tid").select2("open");
                <?php } ?>
            });
            $("#category-chained").select2({
                title: "<?php echo $Label['home_search_default_1']; ?>",
                placeholder: "<?php echo $Label['home_search_default_1']; ?>",
                allowClear: true
            }).change(function () {
                var id = $(this).val();
                $("#subcategory-chained").select2("enable",false);
                categoryChained("subcategory-chained",id);
                <?php
                if ($w['chained_search_focus_open'] == 1) { ?>
                $("#subcategory-chained").select2("open");
                <?php } ?>
            });
            $(".infinite-chained").select2({
                title: "<?php echo $label['select_option_from_list']?>",
                placeholder: "<?php echo $label['click_select_option']?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                var attr = $(this).attr('next');

                if (typeof attr !== 'undefined' && attr !== false) {
                    $("#" + attr).select2("enable",false);
                    categoryChained(attr,id);
                    <?php
                    if ($w['chained_search_focus_open'] == 1) { ?>
                    $("#" + attr).select2("open");
                    <?php } ?>
                }
            });
            $("#subcategory-chained").select2();
            $(".combobox").select2();
            $(".search-chained").select2();
            $("#country-chained").select2({
                title: "<?php echo $user_data['country_code']; ?>",
                placeholder: "<?php echo $user_data['country_code']; ?>",
                val: "<?php echo $user_data['country_code']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                $("#state-chained").select2("enable",false);
                getStateList("state-chained",id);
                var state = "";

                if (id == "CA") {
                    state = "Province";

                } else if (id == "UK") {
                    state = "Region";

                } else if (id == "US" || id == "AU") {
                    state = "State";

                } else {
                    state = "Region";
                }
                $("#state-chained").prev(".control-label").text(state);
            });
            $("#state-chained").select2();
            $("#country-chained-2").select2({
                title: "Select Country",
                placeholder: "(select country)",
                val: "<?php echo $user_data['billing_state']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                $("#state-chained-2").select2("enable",false);
                getStateList("state-chained-2",id);
                var state = "";

                if (id == "CA") {
                    state = "Province";

                } else if (id == "UK") {
                    state = "Region";

                } else if (id == "US" || id == "AU") {
                    state = "State";

                } else {
                    state = "Region";
                }
                $("#state-chained-2").prev(".control-label").text(state);
            });
            $("#state-chained-2").select2();
            $("#profession_id").select2({
                placeholder: "<?php echo $Label['account_default_top_category']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                getSecondLevelAccount("category_id",id);
                <?php
                if ($w[chained_search_focus_open] == 1) { ?>
                $("#category_id").select2("open");
                <?php } ?>
            });
            <?php
            if ($user_data['profession_id'] > 0 && $pars[0] == "account") { ?>
            $("#category_id").select2("enable",true);
            getSecondLevelAccount("category_id","<?php echo $user_data['profession_id']; ?>");
            <?php } ?>
            $("#sid").select2({
                title: "<?php echo $Label['home_search_default_1']; ?>",
                placeholder: "<?php echo $Label['home_search_default_1']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            }).change(function () {
                var id = $(this).val();
                $("#tid").select2("enable",false);
                getSecondLevel("tid",id);
                $("#tid").select2("open");
            });
            $("#location_value_dropdown").select2({
                title: "<?php echo $Label['home_search_default_3']; ?>",
                placeholder: "<?php echo $Label['home_search_default_3']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
            });
            $("#tid").select2({
                title: "<?php echo $Label['home_search_default_2']; ?>",
                placeholder: "<?php echo $Label['home_search_default_2']; ?>",
                allowClear: true,
                formatNoMatches: function () {
                    return "<?php echo $label['no_matches_select']?>";
                }
                <?php
                if ($w['chained_search_location_field'] != "input") { ?>
            }).change(function () {
                var id = $("#sid").val();
                var id2 = $(this).val();
                $("#location_value_dropdown").select2("enable",false);
                getThirdLevel("location_value_dropdown",id,id2);
                <?php } ?>
            });
            $("#location_value_dropdown").select2({
                title: "<?php echo $Label['home_search_default_3']; ?>",
                placeholder: "<?php echo $Label['home_search_default_3']; ?>",
                allowClear: true
            });
        });
    </script>
    <script>
        /**This function is for price and sqr foot only accepts numbers**/
        (function(factory){if(typeof define === 'function' && define.amd){define(['jquery'], factory);}else{factory(window.jQuery);}}(function($){$.fn.numeric=function(config,callback){if(typeof config==="boolean"){config={decimal:config,negative:true,decimalPlaces:-1}}config=config||{};if(typeof config.negative=="undefined"){config.negative=true}var decimal=config.decimal===false?"":config.decimal||".";var negative=config.negative===true?true:false;var decimalPlaces=typeof config.decimalPlaces=="undefined"?-1:config.decimalPlaces;callback=typeof callback=="function"?callback:function(){};return this.data("numeric.decimal",decimal).data("numeric.negative",negative).data("numeric.callback",callback).data("numeric.decimalPlaces",decimalPlaces).keypress($.fn.numeric.keypress).keyup($.fn.numeric.keyup).blur($.fn.numeric.blur)};$.fn.numeric.keypress=function(e){var decimal=$.data(this,"numeric.decimal");var negative=$.data(this,"numeric.negative");var decimalPlaces=$.data(this,"numeric.decimalPlaces");var key=e.charCode?e.charCode:e.keyCode?e.keyCode:0;if(key==13&&this.nodeName.toLowerCase()=="input"){return true}else if(key==13){return false}var allow=false;if(e.ctrlKey&&key==97||e.ctrlKey&&key==65){return true}if(e.ctrlKey&&key==120||e.ctrlKey&&key==88){return true}if(e.ctrlKey&&key==99||e.ctrlKey&&key==67){return true}if(e.ctrlKey&&key==122||e.ctrlKey&&key==90){return true}if(e.ctrlKey&&key==118||e.ctrlKey&&key==86||e.shiftKey&&key==45){return true}if(key<48||key>57){var value=$(this).val();if($.inArray("-",value.split(""))!==0&&negative&&key==45&&(value.length===0||parseInt($.fn.getSelectionStart(this),10)===0)){return true}if(decimal&&key==decimal.charCodeAt(0)&&$.inArray(decimal,value.split(""))!=-1){allow=false}if(key!=8&&key!=9&&key!=13&&key!=35&&key!=36&&key!=37&&key!=39&&key!=46){allow=false}else{if(typeof e.charCode!="undefined"){if(e.keyCode==e.which&&e.which!==0){allow=true;if(e.which==46){allow=false}}else if(e.keyCode!==0&&e.charCode===0&&e.which===0){allow=true}}}if(decimal&&key==decimal.charCodeAt(0)){if($.inArray(decimal,value.split(""))==-1){allow=true}else{allow=false}}}else{allow=true;if(decimal&&decimalPlaces>0){var dot=$.inArray(decimal,$(this).val().split(""));if(dot>=0&&$(this).val().length>dot+decimalPlaces){allow=false}}}return allow};$.fn.numeric.keyup=function(e){var val=$(this).val();if(val&&val.length>0){var carat=$.fn.getSelectionStart(this);var selectionEnd=$.fn.getSelectionEnd(this);var decimal=$.data(this,"numeric.decimal");var negative=$.data(this,"numeric.negative");var decimalPlaces=$.data(this,"numeric.decimalPlaces");if(decimal!==""&&decimal!==null){var dot=$.inArray(decimal,val.split(""));if(dot===0){this.value="0"+val;carat++;selectionEnd++}if(dot==1&&val.charAt(0)=="-"){this.value="-0"+val.substring(1);carat++;selectionEnd++}val=this.value}var validChars=[0,1,2,3,4,5,6,7,8,9,"-",decimal];var length=val.length;for(var i=length-1;i>=0;i--){var ch=val.charAt(i);if(i!==0&&ch=="-"){val=val.substring(0,i)+val.substring(i+1)}else if(i===0&&!negative&&ch=="-"){val=val.substring(1)}var validChar=false;for(var j=0;j<validChars.length;j++){if(ch==validChars[j]){validChar=true;break}}if(!validChar||ch==" "){val=val.substring(0,i)+val.substring(i+1)}}var firstDecimal=$.inArray(decimal,val.split(""));if(firstDecimal>0){for(var k=length-1;k>firstDecimal;k--){var chch=val.charAt(k);if(chch==decimal){val=val.substring(0,k)+val.substring(k+1)}}}if(decimal&&decimalPlaces>0){var dot=$.inArray(decimal,val.split(""));if(dot>=0){val=val.substring(0,dot+decimalPlaces+1);selectionEnd=Math.min(val.length,selectionEnd)}}this.value=val;$.fn.setSelection(this,[carat,selectionEnd])}};$.fn.numeric.blur=function(){var decimal=$.data(this,"numeric.decimal");var callback=$.data(this,"numeric.callback");var negative=$.data(this,"numeric.negative");var val=this.value;if(val!==""){var re=new RegExp("^" + (negative?"-?":"") + "\d+$|^" + (negative?"-?":"") + "\d*" + decimal + "\d+$");if(!re.exec(val)){callback.apply(this)}}};$.fn.removeNumeric=function(){return this.data("numeric.decimal",null).data("numeric.negative",null).data("numeric.callback",null).data("numeric.decimalPlaces",null).unbind("keypress",$.fn.numeric.keypress).unbind("keyup",$.fn.numeric.keyup).unbind("blur",$.fn.numeric.blur)};$.fn.getSelectionStart=function(o){if(o.type==="number"){return undefined}else if(o.createTextRange&&document.selection){var r=document.selection.createRange().duplicate();r.moveEnd("character",o.value.length);if(r.text=="")return o.value.length;return Math.max(0,o.value.lastIndexOf(r.text))}else{try{return o.selectionStart}catch(e){return 0}}};$.fn.getSelectionEnd=function(o){if(o.type==="number"){return undefined}else if(o.createTextRange&&document.selection){var r=document.selection.createRange().duplicate();r.moveStart("character",-o.value.length);return r.text.length}else return o.selectionEnd};$.fn.setSelection=function(o,p){if(typeof p=="number"){p=[p,p]}if(p&&p.constructor==Array&&p.length==2){if(o.type==="number"){o.focus()}else if(o.createTextRange){var r=o.createTextRange();r.collapse(true);r.moveStart("character",p[0]);r.moveEnd("character",p[1]-p[0]);r.select()}else{o.focus();try{if(o.setSelectionRange){o.setSelectionRange(p[0],p[1])}}catch(e){}}}}}));
        $("input.justNumbers").numeric();
    </script>
<? } ?>


