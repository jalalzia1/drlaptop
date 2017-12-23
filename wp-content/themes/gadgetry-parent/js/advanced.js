jQuery(document).ready(function($) {

//hide header options if homepage_category  is different from tfuse_blog_posts or  tfuse_blog_cases

    if($('#gadgetry_top_ads_space').is(':checked')) jQuery('.gadgetry_top_ads_image,.gadgetry_top_ads_url,.gadgetry_top_ads_adsense').hide();
 	$('#gadgetry_top_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.gadgetry_top_ads_image,.gadgetry_top_ads_url,.gadgetry_top_ads_adsense').hide();
	else
		jQuery('.gadgetry_top_ads_image,.gadgetry_top_ads_url,.gadgetry_top_ads_adsense').show();
    });
	
	if($('#gadgetry_bfc_ads_space').is(':checked')) jQuery('.gadgetry_bfcontent_type1,.gadgetry_bfcontent_number,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_adsense7').hide();
 	$('#gadgetry_bfc_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.gadgetry_bfcontent_type1,.gadgetry_bfcontent_number,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_adsense7').hide();
	else
		jQuery('.gadgetry_bfcontent_type1,.gadgetry_bfcontent_number,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_adsense7').show();
    });
		
	if($('#gadgetry_content_ads_space').is(':checked')) jQuery('.gadgetry_hook_image_admin,.gadgetry_hook_url_admin,.gadgetry_hook_adsense_admin').hide();
 	$('#gadgetry_content_ads_space').live('change',function () {
	if(jQuery(this).is(':checked'))
		jQuery('.gadgetry_hook_image_admin,.gadgetry_hook_url_admin,.gadgetry_hook_adsense_admin').hide();
	else
		jQuery('.gadgetry_hook_image_admin,.gadgetry_hook_url_admin,.gadgetry_hook_adsense_admin').show();
    });
    
    //from posts
    if($('#gadgetry_content_ads_post').is(':checked')) 
	{
		jQuery('.gadgetry_top_ad_space,.gadgetry_bfcontent_ads_space,.gadgetry_hook_space,.gadgetry_top_ad_image,.gadgetry_top_ad_url,.gadgetry_top_ad_adsense,.gadgetry_hook_image,.gadgetry_hook_url,.gadgetry_hook_adsense,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense7,.gadgetry_bfcontent_type,.gadgetry_bfcontent_number').hide();
		jQuery('.gadgetry_content_ads_post,.gadgetry_bfcontent_ads_adsense7,.gadgetry_top_ad_adsense').next().removeClass('divider');
	}
	$('#gadgetry_content_ads_post').live('change',function () {
		if(jQuery(this).is(':checked')){
			jQuery('.gadgetry_top_ad_space,.gadgetry_bfcontent_ads_space,.gadgetry_hook_space,.gadgetry_top_ad_image,.gadgetry_top_ad_url,.gadgetry_top_ad_adsense,.gadgetry_hook_image,.gadgetry_hook_url,.gadgetry_hook_adsense,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense7,.gadgetry_bfcontent_type,.gadgetry_bfcontent_number').hide();
			jQuery('.gadgetry_content_ads_post,.gadgetry_bfcontent_ads_adsense7,.gadgetry_top_ad_adsense').next().removeClass('divider');
		}
		else
		{
			jQuery('.gadgetry_top_ad_space,.gadgetry_bfcontent_ads_space,.gadgetry_hook_space,.gadgetry_top_ad_adsense,.gadgetry_top_ad_image,.gadgetry_top_ad_url,.gadgetry_top_ad_adsense,.gadgetry_hook_image,.gadgetry_hook_url,.gadgetry_hook_adsense,.gadgetry_bfcontent_ads_image1,.gadgetry_bfcontent_ads_url1,.gadgetry_bfcontent_ads_adsense1,.gadgetry_bfcontent_ads_image2,.gadgetry_bfcontent_ads_url2,.gadgetry_bfcontent_ads_adsense2,.gadgetry_bfcontent_ads_image3,.gadgetry_bfcontent_ads_url3,.gadgetry_bfcontent_ads_adsense3,.gadgetry_bfcontent_ads_image4,.gadgetry_bfcontent_ads_url4,.gadgetry_bfcontent_ads_adsense4,.gadgetry_bfcontent_ads_image5,.gadgetry_bfcontent_ads_url5,.gadgetry_bfcontent_ads_adsense5,.gadgetry_bfcontent_ads_image6,.gadgetry_bfcontent_ads_url6,.gadgetry_bfcontent_ads_adsense6,.gadgetry_bfcontent_ads_image7,.gadgetry_bfcontent_ads_url7,.gadgetry_bfcontent_ads_adsense7,.gadgetry_bfcontent_type,.gadgetry_bfcontent_number').show();
			jQuery('.gadgetry_content_ads_post,.gadgetry_bfcontent_ads_adsense7,.gadgetry_top_ad_adsense').next().addClass('divider');
		}
	});

 $('.tfuse_selectable_code').live('click', function () {
        var r = document.createRange();
        var w = $(this).get(0);
        r.selectNodeContents(w);
        var sel = window.getSelection();
        sel.removeAllRanges();
        sel.addRange(r);
    });
    $(document).bind({
        contact_form_preview_open:function(){
        var params = {
            changedEl: ".select_styled",
            visRows: 5,
            scrollArrows: true
        }
        cuSel(params);
        $(".input_styled input").customInput();
    },
        reservationform_preview:function(){
            var params = {
                changedEl: ".select_styled",
                visRows: 5,
                scrollArrows: true
            }
            cuSel(params);
            $(".input_styled input").customInput();
        }
    });
    $('#tf_rf_form_name_select').change(function(){
        $_get=getUrlVars();
        if($(this).val()==-1 && 'formid' in $_get){
            delete $_get.formid;
        } else if($(this).val()!=-1){
            $_get.formid=$(this).val();
        }
        $_url_str='?';
        $.each($_get,function(key,val){
            $_url_str +=key+'='+val+'&';
        })
        $_url_str = $_url_str.substring(0,$_url_str.length-1);
        window.location.href=$_url_str;
    });


    function getUrlVars() {
        urlParams = {};
        var e,
            a = /\+/g,
            r = /([^&=]+)=?([^&]*)/g,
            d = function (s) {
                return decodeURIComponent(s.replace(a, " "));
            },
            q = window.location.search.substring(1);
        while (e = r.exec(q))
            urlParams[d(e[1])] = d(e[2]);
        return urlParams;
    }
	 $("#slider_slideSpeed,#slider_play,#slider_pause,#gadgetry_map_zoom").keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });
    //custom post types
    $(".tf_images .tfuse-meta-radio-img-box:nth-child(1)").append('<div class="hover1">')
	$(".tf_images .tfuse-meta-radio-img-box:nth-child(1)").hover(function() {
		  $('.hover1').css({'background':'url(../wp-content/themes/gadgetry-parent/images/tip_post1.jpg) no-repeat 0 0 ','position':'relative','z-index':'2','cursor':'pointer','width':'400px','height':'230px'});
		}, function() {
		  $('.hover1').removeAttr( 'style' );
	});
	$(".tf_images .tfuse-meta-radio-img-box:nth-child(2)").append('<div class="hover2">')
	$(".tf_images .tfuse-meta-radio-img-box:nth-child(2)").hover(function() {
		  $('.hover2').css({'background':'url(../wp-content/themes/gadgetry-parent/images/tip_post2.jpg) no-repeat 0 0 ','position':'relative','z-index':'2','cursor':'pointer','width':'400px','height':'230px'});
		}, function() {
		  $('.hover2').removeAttr( 'style' );
	});

    jQuery('#gadgetry_map_lat,#gadgetry_map_long').keydown(function(event) {
        // Allow: backspace, delete, tab, escape, and enter
        if ( event.keyCode == 190 || event.keyCode == 110|| event.keyCode == 189 || event.keyCode == 109 || event.keyCode == 46 || event.keyCode == 8 || event.keyCode == 9 || event.keyCode == 27 || event.keyCode == 13 ||
            // Allow: Ctrl+A
            (event.keyCode == 65 && event.ctrlKey === true) ||
            // Allow: home, end, left, right
            (event.keyCode >= 35 && event.keyCode <= 39)) {
            // let it happen, don't do anything
            return;
        }
        else {
            // Ensure that it is a number and stop the keypress
            if (event.shiftKey || (event.keyCode < 48 || event.keyCode > 57) && (event.keyCode < 96 || event.keyCode > 105 )) {
                event.preventDefault();
            }
        }
    });

    $('#gadgetry_framework_options_metabox .handlediv, #gadgetry_framework_options_metabox .hndle').hide();
    $('#gadgetry_framework_options_metabox .handlediv, #gadgetry_framework_options_metabox .hndle').hide();

    var options = new Array();
    
    options['gadgetry_homepage_category'] = jQuery('#gadgetry_homepage_category').val();
    jQuery('#gadgetry_homepage_category').bind('change', function() {
        options['gadgetry_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['gadgetry_homepage_category'] = jQuery('#gadgetry_homepage_category').val();
    jQuery('#gadgetry_homepage_category').bind('change', function() {
        options['gadgetry_homepage_category'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['gadgetry_header_element'] = jQuery('#gadgetry_header_element').val();
    jQuery('#gadgetry_header_element').bind('change', function() {
        options['gadgetry_header_element'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
   
   options['gadgetry_choose_logo'] = jQuery('#gadgetry_choose_logo').val();
    jQuery('#gadgetry_choose_logo').bind('change', function() {
        options['gadgetry_choose_logo'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_theme_stylesheet'] = jQuery('#gadgetry_theme_stylesheet').val();
    jQuery('#gadgetry_theme_stylesheet').bind('change', function() {
        options['gadgetry_theme_stylesheet'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_navibar_color'] = jQuery('#gadgetry_navibar_color').val();
    jQuery('#gadgetry_navibar_color').bind('change', function() {
        options['gadgetry_navibar_color'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_navibar_color_cat'] = jQuery('#gadgetry_navibar_color_cat').val();
    jQuery('#gadgetry_navibar_color_cat').bind('change', function() {
        options['gadgetry_navibar_color_cat'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_page_title'] = jQuery('#gadgetry_page_title').val();
    jQuery('#gadgetry_page_title').bind('change', function() {
        options['gadgetry_page_title'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });

    options['slider_hoverPause'] = jQuery('#slider_hoverPause').val();
    jQuery('#slider_hoverPause').bind('change', function() {
       if (jQuery(this).next('.tf_checkbox_switch').hasClass('on'))  options['slider_hoverPause']= true;
        else  options['slider_hoverPause'] = false;
        tfuse_toggle_options(options);
    });

    options['map_type'] = jQuery('#gadgetry_map_type').val();
    jQuery(' #gadgetry_map_type').bind('change', function() {
        options['map_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    //advertising
    options['gadgetry_top_ad_space'] = jQuery('#gadgetry_top_ad_space').val();
    jQuery('#gadgetry_top_ad_space').bind('change', function() {
        options['gadgetry_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_hook_space'] = jQuery('#gadgetry_hook_space').val();
    jQuery('#gadgetry_hook_space').bind('change', function() {
        options['gadgetry_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_home_top_ad_space'] = jQuery('#gadgetry_home_top_ad_space').val();
    jQuery('#gadgetry_home_top_ad_space').bind('change', function() {
        options['gadgetry_home_top_ad_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_bfcontent_ads_space'] = jQuery('#gadgetry_bfcontent_ads_space').val();
    jQuery('#gadgetry_bfcontent_ads_space').bind('change', function() {
        options['gadgetry_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_bfcontent_type'] = jQuery('#gadgetry_bfcontent_type').val();
    jQuery('#gadgetry_bfcontent_type').bind('change', function() {
        options['gadgetry_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_bfcontent_type1'] = jQuery('#gadgetry_bfcontent_type1').val();
    jQuery('#gadgetry_bfcontent_type1').bind('change', function() {
        options['gadgetry_bfcontent_type1'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_bfcontent_number'] = jQuery('#gadgetry_bfcontent_number').val();
    jQuery('#gadgetry_bfcontent_number').bind('change', function() {
        options['gadgetry_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    options['gadgetry_home_bfcontent_type'] = jQuery('#gadgetry_home_bfcontent_type').val();
    jQuery('#gadgetry_home_bfcontent_type').bind('change', function() {
        options['gadgetry_home_bfcontent_type'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_home_hook_space'] = jQuery('#gadgetry_home_hook_space').val();
    jQuery('#gadgetry_home_hook_space').bind('change', function() {
        options['gadgetry_home_hook_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_home_bfcontent_ads_space'] = jQuery('#gadgetry_home_bfcontent_ads_space').val();
    jQuery('#gadgetry_home_bfcontent_ads_space').bind('change', function() {
        options['gadgetry_home_bfcontent_ads_space'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    options['gadgetry_home_bfcontent_number'] = jQuery('#gadgetry_home_bfcontent_ads_space').val();
    jQuery('#gadgetry_home_bfcontent_number').bind('change', function() {
        options['gadgetry_home_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
    //blog page
    options['gadgetry_blogpage_category'] = jQuery('#gadgetry_blogpage_category').val();
     jQuery('#gadgetry_blogpage_category').bind('change', function() {
         options['gadgetry_blogpage_category'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });

     options['gadgetry_header_element_blog'] = jQuery('#gadgetry_header_element_blog').val();
     jQuery('#gadgetry_header_element_blog').bind('change', function() {
         options['gadgetry_header_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     options['gadgetry_before_content_element_blog'] = jQuery('#gadgetry_before_content_element_blog').val();
     jQuery('#gadgetry_before_content_element_blog').bind('change', function() {
         options['gadgetry_before_content_element_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
    
     options['gadgetry_blog_top_ad_space'] = jQuery('#gadgetry_blog_top_ad_space').val();
     jQuery('#gadgetry_blog_top_ad_space').bind('change', function() {
         options['gadgetry_blog_top_ad_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
     
     options['gadgetry_home_bfcontent_number'] = jQuery('#gadgetry_home_bfcontent_number option:selected').val();
    jQuery('#gadgetry_home_bfcontent_number').bind('change', function() {
        options['gadgetry_home_bfcontent_number'] = jQuery(this).val();
        tfuse_toggle_options(options);
    });
    
	 options['gadgetry_blog_bfcontent_ads_space'] = jQuery('#gadgetry_blog_bfcontent_ads_space').val();
     jQuery('#gadgetry_blog_bfcontent_ads_space').bind('change', function() {
         options['gadgetry_blog_bfcontent_ads_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['gadgetry_blog_hook_space'] = jQuery('#gadgetry_blog_hook_space').val();
     jQuery('#gadgetry_blog_hook_space').bind('change', function() {
         options['gadgetry_blog_hook_space'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['gadgetry_blog_bfcontent_number'] = jQuery('#gadgetry_blog_bfcontent_number').val();
     jQuery('#gadgetry_blog_bfcontent_number').bind('change', function() {
         options['gadgetry_blog_bfcontent_number'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
	 options['gadgetry_blog_bfcontent_type'] = jQuery('#gadgetry_blog_bfcontent_type').val();
     jQuery('#gadgetry_blog_bfcontent_type').bind('change', function() {
         options['gadgetry_blog_bfcontent_type'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
      options['gadgetry_navibar_color_cat_blog'] = jQuery('#gadgetry_navibar_color_cat_blog').val();
     jQuery('#gadgetry_navibar_color_cat_blog').bind('change', function() {
         options['gadgetry_navibar_color_cat_blog'] = jQuery(this).val();
         tfuse_toggle_options(options);
     });
       
    tfuse_toggle_options(options);

    function tfuse_toggle_options(options)
    {

        jQuery('#gadgetry_page_map_blog,#gadgetry_page_map,#gadgetry_home_top_ad_adsense,#gadgetry_custom_color_navibar_cat_blog,#gadgetry_title_blog,#gadgetry_latitude_blog,#gadgetry_longitude_blog,#gadgetry_adresss_blog,#gadgetry_zoom_blog,#gadgetry_select_slider_blog,#gadgetry_navibar_color_cat,#gadgetry_title_color,#gadgetry_home_page,#gadgetry_categories_select_categ,#gadgetry_home_hook_adsense,#gadgetry_home_hook_url,#gadgetry_home_hook_image,#gadgetry_home_top_ad_url,\n\
        #gadgetry_home_top_ad_image,#gadgetry_categories_select_categ,#gadgetry_top_ad_adsense,#gadgetry_top_ad_url,#gadgetry_top_ad_image,#gadgetry_footer_bg,#gadgetry_footer_image_repeat,#gadgetry_footer_image,#gadgetry_hook_adsense,#gadgetry_hook_url,#gadgetry_hook_image,#gadgetry_bfcontent_type,#gadgetry_bfcontent_number,\n\
        #gadgetry_bfcontent_ads_adsense7,#gadgetry_bfcontent_ads_url7,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_url4,\n\
        #gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image1,#gadgetry_items,\n\
        #gadgetry_custom_color_navibar_cat,#gadgetry_bg_repeat,#gadgetry_custom_color_navibar,#gadgetry_color_title,#gadgetry_color_active,#gadgetry_navibar_color,#gadgetry_bg_color,#gadgetry_bg_site,#gadgetry_logo,#gadgetry_logo_text_subtitle,#gadgetry_logo_text,#gadgetry_zoom,#gadgetry_adresss,#gadgetry_longitude,#gadgetry_latitude,#gadgetry_title,\n\
        #gadgetry_title_header,#gadgetry_post_icon,#gadgetry_subtitle_header,#gadgetry_select_slider,.homepage_category_header_element').parents('.option-inner').hide();
        jQuery('#gadgetry_page_map_blog,#gadgetry_page_map,#gadgetry_home_top_ad_adsense,#gadgetry_custom_color_navibar_cat_blog,#gadgetry_title_blog,#gadgetry_latitude_blog,#gadgetry_longitude_blog,#gadgetry_adresss_blog,#gadgetry_zoom_blog,#gadgetry_select_slider_blog,#gadgetry_navibar_color_cat,#gadgetry_title_color,#gadgetry_home_page,#gadgetry_categories_select_categ,#gadgetry_home_hook_adsense,#gadgetry_home_hook_url,#gadgetry_home_hook_image,\n\
        #gadgetry_home_top_ad_adsense,#gadgetry_home_top_ad_url,\n\
        #gadgetry_home_top_ad_image,#gadgetry_categories_select_categ,#gadgetry_top_ad_adsense,#gadgetry_top_ad_url,#gadgetry_top_ad_image,#gadgetry_footer_bg,#gadgetry_footer_image_repeat,#gadgetry_footer_image,#gadgetry_hook_adsense,#gadgetry_hook_url,#gadgetry_hook_image,#gadgetry_bfcontent_type,#gadgetry_bfcontent_number,\n\
        #gadgetry_bfcontent_ads_adsense7,#gadgetry_bfcontent_ads_url7,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_url4,\n\
        #gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image1,#gadgetry_items,\n\
        #gadgetry_custom_color_navibar_cat,#gadgetry_bg_repeat,#gadgetry_custom_color_navibar,#gadgetry_color_title,#gadgetry_color_active,#gadgetry_navibar_color,#gadgetry_bg_color,#gadgetry_bg_site,#gadgetry_logo,#gadgetry_logo_text_subtitle,#gadgetry_logo_text,#gadgetry_zoom,#gadgetry_adresss,#gadgetry_longitude,#gadgetry_latitude,\n\
        #gadgetry_title,#gadgetry_title_header,#gadgetry_post_icon,#gadgetry_subtitle_header,#gadgetry_select_slider,.homepage_category_header_element').parents('.form-field').hide();

       //blog page
        if(options['gadgetry_blogpage_category']=='all'){
            jQuery('.gadgetry_categories_select_categ_blog').hide();
        }
        else if(options['gadgetry_blogpage_category']=='specific'){
            jQuery('.gadgetry_categories_select_categ_blog').show();
        } 
        //slider blog page 
        
        if(options['gadgetry_header_element_blog'] == 'slider')
        {
            jQuery('#gadgetry_select_slider_blog').parents('.option-inner').show();
            jQuery('#gadgetry_select_slider_blog').parents('.form-field').show();
        }     
        else if (options['gadgetry_header_element_blog'] == 'map')
        {
            jQuery('#gadgetry_page_map_blog').parents('.option-inner').show();
            jQuery('#gadgetry_page_map_blog').parents('.form-field').show();
        }
            jQuery('#gadgetry_custom_color_navibar_cat_blog').parents('.option-inner').show();
            jQuery('#gadgetry_custom_color_navibar_cat_blog').parents('.form-field').show();
        
        
       //header 
        var homepage = true;
        if (jQuery('.homepage_category_header_element').length == 1) homepage = false;
        if ( options['gadgetry_homepage_category'] == 'tfuse_blog_posts' || options['gadgetry_homepage_category'] == 'tfuse_blog_cases')
        {
            homepage = true;
            jQuery('.homepage_category_header_element').parents('.option-inner').show();
            jQuery('.homepage_category_header_element').parents('.form-field').show();
        }
        //homepage
        
        //title color ,navibarcolor
        if(options['gadgetry_homepage_category']=='all'){
            jQuery('.gadgetry_home_page,.gadgetry_use_page_options').hide();
            jQuery('#gadgetry_title_color').parents('.option-inner').show();
            jQuery('#gadgetry_title_color').parents('.form-field').show();
            jQuery('#gadgetry_navibar_color_cat').parents('.option-inner').show();
            jQuery('#gadgetry_navibar_color_cat').parents('.form-field').show();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.option-inner').show();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.form-field').show();
        }
        else if(options['gadgetry_homepage_category'] == 'specific' && homepage)
        {
            jQuery('.gadgetry_home_page,.gadgetry_use_page_options').hide();
            jQuery('#gadgetry_categories_select_categ').parents('.option-inner').show();
            jQuery('#gadgetry_categories_select_categ').parents('.form-field').show();
            jQuery('#gadgetry_title_color').parents('.option-inner').show();
            jQuery('#gadgetry_title_color').parents('.form-field').show();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.option-inner').show();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.form-field').show();
        }
        else if(options['gadgetry_homepage_category'] == 'page'){ 
            jQuery('.gadgetry_home_page,.gadgetry_use_page_options').show();
            jQuery('#gadgetry_home_page').parents('.option-inner').show();
            jQuery('#gadgetry_home_page').parents('.form-field').show();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.option-inner').hide();
            jQuery('#gadgetry_custom_color_navibar_cat').parents('.form-field').hide();
            if($('#gadgetry_use_page_options').is(':checked')) jQuery('#gadgetry_header_element,#gadgetry_home_top_ad_space,#gadgetry_content_top').closest('.postbox').hide();
            jQuery('#gadgetry_use_page_options').live('change',function () {
                if(jQuery(this).is(':checked'))
                    jQuery('#gadgetry_header_element,#gadgetry_home_top_ad_space,#gadgetry_content_top').closest('.postbox').hide();
                else
                    jQuery('#gadgetry_header_element,#gadgetry_home_top_ad_space,#gadgetry_content_top').closest('.postbox').show();
            });
        }
        
        //slider and map
        if(options['gadgetry_header_element'] == 'slider' && homepage)
        {

            jQuery('#gadgetry_select_slider').parents('.option-inner').show();
            jQuery('#gadgetry_select_slider').parents('.form-field').show();
        }     
        else if (options['gadgetry_header_element'] == 'map' && homepage)
        { 
            jQuery('#gadgetry_page_map').parents('.option-inner').show();
            jQuery('#gadgetry_page_map').parents('.form-field').show();
        }
        
        
        //theme styles
        if(options['gadgetry_theme_stylesheet'] == 'custom' && homepage)
        {

            jQuery('#gadgetry_bg_site,#gadgetry_color_title,#gadgetry_color_active,#gadgetry_navibar_color,#gadgetry_bg_repeat,#gadgetry_bg_color').parents('.option-inner').show();
            jQuery('#gadgetry_bg_site,#gadgetry_color_title,#gadgetry_color_active,#gadgetry_navibar_color,#gadgetry_bg_repeat,#gadgetry_bg_color').parents('.form-field').show();
            if(options['gadgetry_navibar_color'] == 'custom' && homepage)
            {

                jQuery('#gadgetry_custom_color_navibar').parents('.option-inner').show();
                jQuery('#gadgetry_custom_color_navibar').parents('.form-field').show();
            }  
            
        }
        //logo type
        if(options['gadgetry_choose_logo'] == 'text' && homepage)
        {

            jQuery('#gadgetry_logo_text,#gadgetry_logo_text_subtitle').parents('.option-inner').show();
            jQuery('#gadgetry_logo_text,#gadgetry_logo_text_subtitle').parents('.form-field').show();
        }
        else
        {
            jQuery('#gadgetry_logo').parents('.option-inner').show();
            jQuery('#gadgetry_logo').parents('.form-field').show();
        }
        //hide page title
        if(options['gadgetry_page_title'] == 'custom_title')
        { 
            jQuery('#gadgetry_custom_title').parents('.option-inner').show();
            jQuery('#gadgetry_custom_title').parents('.form-field').show();
        }
		else
        { 
            jQuery('#gadgetry_custom_title').parents('.option-inner').hide();
            jQuery('#gadgetry_custom_title').parents('.form-field').hide();
        }
        
        //advertising
        if(options['gadgetry_blog_top_ad_space']=='true'){
            jQuery('.gadgetry_blog_top_ad_image,.gadgetry_blog_top_ad_url,.gadgetry_blog_top_ad_adsense').show();
        }
        else{
            jQuery('.gadgetry_blog_top_ad_image,.gadgetry_blog_top_ad_url,.gadgetry_blog_top_ad_adsense').hide();
        }
		
        jQuery('.gadgetry_blog_bfcontent_type,.gadgetry_blog_bfcontent_number,.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3,.gadgetry_blog_bfcontent_ads_adsense3,.gadgetry_blog_bfcontent_ads_image4,.gadgetry_blog_bfcontent_ads_url4,.gadgetry_blog_bfcontent_ads_adsense4,.gadgetry_blog_bfcontent_ads_image5,.gadgetry_blog_bfcontent_ads_url5,.gadgetry_blog_bfcontent_ads_adsense5,.gadgetry_blog_bfcontent_ads_image6,.gadgetry_blog_bfcontent_ads_url6,.gadgetry_blog_bfcontent_ads_adsense6,.gadgetry_blog_bfcontent_ads_image7,.gadgetry_blog_bfcontent_ads_url7,.gadgetry_blog_bfcontent_ads_adsense7').hide();
        if(options['gadgetry_blog_bfcontent_ads_space']=='true'){
                jQuery('.gadgetry_blog_bfcontent_type,.gadgetry_blog_bfcontent_number').show();
                if(options['gadgetry_blog_bfcontent_type']=='image'){
                    if(options['gadgetry_blog_bfcontent_number']=='one'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='two'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='three'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='four'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3,.gadgetry_blog_bfcontent_ads_image4,.gadgetry_blog_bfcontent_ads_url4').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='five'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3,.gadgetry_blog_bfcontent_ads_image4,.gadgetry_blog_bfcontent_ads_url4,.gadgetry_blog_bfcontent_ads_image5,.gadgetry_blog_bfcontent_ads_url5').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='six'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3,.gadgetry_blog_bfcontent_ads_image4,.gadgetry_blog_bfcontent_ads_url4,.gadgetry_blog_bfcontent_ads_image5,.gadgetry_blog_bfcontent_ads_url5,.gadgetry_blog_bfcontent_ads_image6,.gadgetry_blog_bfcontent_ads_url6').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='seven'){
                            jQuery('.gadgetry_blog_bfcontent_ads_image1,.gadgetry_blog_bfcontent_ads_url1,.gadgetry_blog_bfcontent_ads_image2,.gadgetry_blog_bfcontent_ads_url2,.gadgetry_blog_bfcontent_ads_image3,.gadgetry_blog_bfcontent_ads_url3,.gadgetry_blog_bfcontent_ads_image4,.gadgetry_blog_bfcontent_ads_url4,.gadgetry_blog_bfcontent_ads_image5,.gadgetry_blog_bfcontent_ads_url5,.gadgetry_blog_bfcontent_ads_image6,.gadgetry_blog_bfcontent_ads_url6,.gadgetry_blog_bfcontent_ads_image7,.gadgetry_blog_bfcontent_ads_url7').show();
                    }
                }
                else{
                    if(options['gadgetry_blog_bfcontent_number']=='one'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='two'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='three'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_adsense3').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='four'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_adsense3,.gadgetry_blog_bfcontent_ads_adsense4').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='five'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_adsense3,.gadgetry_blog_bfcontent_ads_adsense4,.gadgetry_blog_bfcontent_ads_adsense5').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='six'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_adsense3,.gadgetry_blog_bfcontent_ads_adsense4,.gadgetry_blog_bfcontent_ads_adsense5,.gadgetry_blog_bfcontent_ads_adsense6').show();
                    }
                    else if(options['gadgetry_blog_bfcontent_number']=='seven'){
                            jQuery('.gadgetry_blog_bfcontent_ads_adsense1,.gadgetry_blog_bfcontent_ads_adsense2,.gadgetry_blog_bfcontent_ads_adsense3,.gadgetry_blog_bfcontent_ads_adsense4,.gadgetry_blog_bfcontent_ads_adsense5,.gadgetry_blog_bfcontent_ads_adsense6,.gadgetry_blog_bfcontent_ads_adsense7').show();
                    }
                }	
        }

        if(options['gadgetry_blog_hook_space']=='true'){
            jQuery('.gadgetry_blog_hook_url,.gadgetry_blog_hook_adsense,.gadgetry_blog_hook_image').show();
        }
        else{
            jQuery('.gadgetry_blog_hook_url,.gadgetry_blog_hook_adsense,.gadgetry_blog_hook_image').hide();
        }
        
        if(options['gadgetry_hook_space'] == 'true' && homepage)
        {
            jQuery('#gadgetry_hook_image,#gadgetry_hook_url,#gadgetry_hook_adsense').parents('.option-inner').show();
            jQuery('#gadgetry_hook_image,#gadgetry_hook_url,#gadgetry_hook_adsense').parents('.form-field').show();
        }
        
        if(options['gadgetry_home_hook_space'] == 'true' && homepage)
        {
            jQuery('#gadgetry_home_hook_image,#gadgetry_home_hook_url,#gadgetry_home_hook_adsense').parents('.option-inner').show();
            jQuery('#gadgetry_home_hook_image,#gadgetry_home_hook_url,#gadgetry_home_hook_adsense').parents('.form-field').show();
        }
        
        if(options['gadgetry_top_ad_space'] == 'true' && homepage)
        {
            jQuery('#gadgetry_top_ad_image,#gadgetry_top_ad_url,#gadgetry_top_ad_adsense').parents('.option-inner').show();
            jQuery('#gadgetry_top_ad_image,#gadgetry_top_ad_url,#gadgetry_top_ad_adsense').parents('.form-field').show();
        }
        
        if(options['gadgetry_home_top_ad_space'] == 'true' && homepage)
        {
            jQuery('#gadgetry_home_top_ad_image,#gadgetry_home_top_ad_url,#gadgetry_home_top_ad_adsense').parents('.option-inner').show();
            jQuery('#gadgetry_home_top_ad_image,#gadgetry_home_top_ad_url,#gadgetry_home_top_ad_adsense').parents('.form-field').show();
        }
        /////////////////////////////////////////
        jQuery('.gadgetry_home_bfcontent_type,.gadgetry_home_bfcontent_number,.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3,.gadgetry_home_bfcontent_ads_adsense3,.gadgetry_home_bfcontent_ads_image4,.gadgetry_home_bfcontent_ads_url4,.gadgetry_home_bfcontent_ads_adsense4,.gadgetry_home_bfcontent_ads_image5,.gadgetry_home_bfcontent_ads_url5,.gadgetry_home_bfcontent_ads_adsense5,.gadgetry_home_bfcontent_ads_image6,.gadgetry_home_bfcontent_ads_url6,.gadgetry_home_bfcontent_ads_adsense6,.gadgetry_home_bfcontent_ads_image7,.gadgetry_home_bfcontent_ads_url7,.gadgetry_home_bfcontent_ads_adsense7').hide();
        if(options['gadgetry_home_bfcontent_ads_space']=='true'){ 
                jQuery('.gadgetry_home_bfcontent_type,.gadgetry_home_bfcontent_number').show();
                if(options['gadgetry_home_bfcontent_type']=='image'){ 
                    if(options['gadgetry_home_bfcontent_number']=='one'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='two'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='three'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='four'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3,.gadgetry_home_bfcontent_ads_image4,.gadgetry_home_bfcontent_ads_url4').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='five'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3,.gadgetry_home_bfcontent_ads_image4,.gadgetry_home_bfcontent_ads_url4,.gadgetry_home_bfcontent_ads_image5,.gadgetry_home_bfcontent_ads_url5').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='six'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3,.gadgetry_home_bfcontent_ads_image4,.gadgetry_home_bfcontent_ads_url4,.gadgetry_home_bfcontent_ads_image5,.gadgetry_home_bfcontent_ads_url5,.gadgetry_home_bfcontent_ads_image6,.gadgetry_home_bfcontent_ads_url6').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='seven'){
                            jQuery('.gadgetry_home_bfcontent_ads_image1,.gadgetry_home_bfcontent_ads_url1,.gadgetry_home_bfcontent_ads_image2,.gadgetry_home_bfcontent_ads_url2,.gadgetry_home_bfcontent_ads_image3,.gadgetry_home_bfcontent_ads_url3,.gadgetry_home_bfcontent_ads_image4,.gadgetry_home_bfcontent_ads_url4,.gadgetry_home_bfcontent_ads_image5,.gadgetry_home_bfcontent_ads_url5,.gadgetry_home_bfcontent_ads_image6,.gadgetry_home_bfcontent_ads_url6,.gadgetry_home_bfcontent_ads_image7,.gadgetry_home_bfcontent_ads_url7').show();
                    }
                }
                else{
                    if(options['gadgetry_home_bfcontent_number']=='one'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='two'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='three'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_adsense3').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='four'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_adsense3,.gadgetry_home_bfcontent_ads_adsense4').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='five'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_adsense3,.gadgetry_home_bfcontent_ads_adsense4,.gadgetry_home_bfcontent_ads_adsense5').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='six'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_adsense3,.gadgetry_home_bfcontent_ads_adsense4,.gadgetry_home_bfcontent_ads_adsense5,.gadgetry_home_bfcontent_ads_adsense6').show();
                    }
                    else if(options['gadgetry_home_bfcontent_number']=='seven'){
                            jQuery('.gadgetry_home_bfcontent_ads_adsense1,.gadgetry_home_bfcontent_ads_adsense2,.gadgetry_home_bfcontent_ads_adsense3,.gadgetry_home_bfcontent_ads_adsense4,.gadgetry_home_bfcontent_ads_adsense5,.gadgetry_home_bfcontent_ads_adsense6,.gadgetry_home_bfcontent_ads_adsense7').show();
                    }
                }	
        }

        if(options['gadgetry_bfcontent_ads_space'] == 'true' && homepage)
        { 
            jQuery('#gadgetry_bfcontent_type').parents('.option-inner').show();
            jQuery('#gadgetry_bfcontent_type').parents('.form-field').show();

            if(options['gadgetry_bfcontent_type'] == 'image' && homepage)
            {
                jQuery('#gadgetry_bfcontent_number').parents('.option-inner').show();
                jQuery('#gadgetry_bfcontent_number').parents('.form-field').show();
                switch (options['gadgetry_bfcontent_number'])
                {
                    case 'one' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1').parents('.form-field').show();
                    break;
                    case 'two' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2').parents('.form-field').show();
                    break;
                    case 'three' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3').parents('.form-field').show();
                    break;
                    case 'four' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4').parents('.form-field').show();
                    break;
                    case 'five' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5').parents('.form-field').show();
                    break;
                    case 'six' :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6').parents('.form-field').show();
                    break;
                    default :
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_url7').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_url7').parents('.form-field').show();
                }
            }
            else if(options['gadgetry_bfcontent_type'] == 'adsense' && homepage)
            {
                jQuery('#gadgetry_bfcontent_number').parents('.option-inner').show();
                jQuery('#gadgetry_bfcontent_number').parents('.form-field').show();
                switch (options['gadgetry_bfcontent_number'])
                {
                    case 'one' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1').parents('.form-field').show();
                    break;
                    case 'two' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2').parents('.form-field').show();
                    break;
                    case 'three' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3').parents('.form-field').show();
                    break;
                    case 'four' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4').parents('.form-field').show();
                    break;
                    case 'five' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5').parents('.form-field').show();
                    break;
                    case 'six' :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6').parents('.form-field').show();
                    break;
                    default :
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_adsense7').parents('.option-inner').show();
                        jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_adsense7').parents('.form-field').show();
                }
            }
        }
        if(options['gadgetry_bfcontent_type1'] == 'image' && homepage)
        {
            jQuery('#gadgetry_bfcontent_number').parents('.option-inner').show();
            jQuery('#gadgetry_bfcontent_number').parents('.form-field').show();
            switch (options['gadgetry_bfcontent_number'])
            {
                case 'one' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1').parents('.form-field').show();
                break;
                case 'two' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2').parents('.form-field').show();
                break;
                case 'three' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3').parents('.form-field').show();
                break;
                case 'four' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4').parents('.form-field').show();
                break;
                case 'five' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5').parents('.form-field').show();
                break;
                case 'six' :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6').parents('.form-field').show();
                break;
                default :
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_url7').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_image1,#gadgetry_bfcontent_ads_url1,#gadgetry_bfcontent_ads_image2,#gadgetry_bfcontent_ads_url2,#gadgetry_bfcontent_ads_image3,#gadgetry_bfcontent_ads_url3,#gadgetry_bfcontent_ads_image4,#gadgetry_bfcontent_ads_url4,#gadgetry_bfcontent_ads_image5,#gadgetry_bfcontent_ads_url5,#gadgetry_bfcontent_ads_image6,#gadgetry_bfcontent_ads_url6,#gadgetry_bfcontent_ads_image7,#gadgetry_bfcontent_ads_url7').parents('.form-field').show();
            }
        }
        else if(options['gadgetry_bfcontent_type1'] == 'adsense' && homepage)
        {
            jQuery('#gadgetry_bfcontent_number').parents('.option-inner').show();
            jQuery('#gadgetry_bfcontent_number').parents('.form-field').show();
            switch (options['gadgetry_bfcontent_number'])
            {
                case 'one' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1').parents('.form-field').show();
                break;
                case 'two' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2').parents('.form-field').show();
                break;
                case 'three' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3').parents('.form-field').show();
                break;
                case 'four' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4').parents('.form-field').show();
                break;
                case 'five' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5').parents('.form-field').show();
                break;
                case 'six' :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6').parents('.form-field').show();
                break;
                default :
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_adsense7').parents('.option-inner').show();
                    jQuery('#gadgetry_bfcontent_ads_adsense1,#gadgetry_bfcontent_ads_adsense2,#gadgetry_bfcontent_ads_adsense3,#gadgetry_bfcontent_ads_adsense4,#gadgetry_bfcontent_ads_adsense5,#gadgetry_bfcontent_ads_adsense6,#gadgetry_bfcontent_ads_adsense7').parents('.form-field').show();
            }
        }
        
        //slider
        if (options['slider_hoverPause'])
        {
            jQuery('.slider_pause').show();
            jQuery('.slider_pause').next('.tfclear').show();
        }
        else
        {
            jQuery('.slider_pause').hide();
            jQuery('.slider_pause').next('.tfclear').hide();
        }

        if ( (options['map_type'] == 'map3') && (options['gadgetry_header_element'] == 'map') && homepage)
        {
            jQuery('#gadgetry_map_address').parents('.option-inner').show();
            jQuery('#gadgetry_map_address').parents('.form-field').show();
        }
    }
});