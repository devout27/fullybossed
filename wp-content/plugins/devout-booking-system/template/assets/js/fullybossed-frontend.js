(function( $ ) {
	'use strict';
  jQuery( document ).ready(function() {
      console.log( "hello fullybossed" );
      // jquery code start here
      var session_dates_arr = FB_AJAX.session_dates_arr;

      function ShowLoder(){
        jQuery("#loder-img").show();
      }

      function convert(str) {
        var date = new Date(str),
        mnth = ("0" + (date.getMonth() + 1)).slice(-2),
        day = ("0" + date.getDate()).slice(-2);
        return [date.getFullYear(), mnth, day].join("-");
      }

      function disableDates() {
        jQuery("div").find(".selected").removeClass('selected');
        jQuery("div").find(".day.highlight").removeClass('highlight');
        jQuery('.weeks-wrapper').not('.header').addClass('required_week_dates');
          jQuery(FB_AJAX.session_dates_arr).each(function(i,v) {
            var filtered_date = new Date(v);          
            jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',false);
            jQuery("div").find("[data-date='"+filtered_date+"']").addClass('availabel_date');
        });
      }


      function CheckAvailability(date){
          jQuery('#proceed_to_pay').show();
          var url = FB_AJAX.ajaxurl;
          var service_id = jQuery("#service_id").val();
          var session_id = jQuery("#session_id").val();
          jQuery("#booking_slot_id").val('');

          jQuery("#payemt-data").html('<li><div class="row"><div class="col-md-12"><div class="alert alert-warning" role="alert">Please select the time slot</div></div></div></li>');
          jQuery.ajax({
              type: "POST",
              url: url,
              data: {
                  'action':'check_slot_availability',
                  'session_date':date,
                  'service_id':service_id,
                  'session_id':session_id
                },
              beforeSend:function() {
                jQuery("#loder-img").show();
                jQuery('button[type=submit]').attr('disabled', true);
              },
              success: function(data) {
                console.log(data);
                jQuery("#loder-img").hide();	
                jQuery('button[type=submit]').attr('disabled', false);
                let response = JSON.parse(data);

                if(response.status == 'success') {
                  jQuery('#slot_details').show();
                  jQuery("#slotData").html(response.html);
                  jQuery(response.all_booked_slots).each(function(index,value) {
                    console.log(value);
                  });
      
                }
              },
              error: function (error) {
                jQuery("#loder-img").hide();	
              },
          });
        }

      function disableDates() {
        jQuery("div").find(".selected").removeClass('selected');
            jQuery("div").find(".day.highlight").removeClass('highlight');
            jQuery('.weeks-wrapper').not('.header').addClass('required_week_dates');
              jQuery(FB_AJAX.session_dates_arr).each(function(i,v) {
                var filtered_date = new Date(v);          
                jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',false);
                jQuery("div").find("[data-date='"+filtered_date+"']").addClass('availabel_date');
              });
      }

      function selectDate(date) {
        jQuery(this).addClass('availabel_selected');
        var cdate=convert(date);
        jQuery("#session_date").val(cdate);	
        CheckAvailability(cdate);
        jQuery('.calendar-wrapper').updateCalendarOptions({
           date: date
        });
        jQuery("div").find("[data-date='"+date+"']").addClass('availabel_selected');
        disableDates();
      }
      
      function onClickToday() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      function onChangeMonth() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      function onClickMonthNext() {
        setTimeout(function() {
          disableDates();
        },500);
      }

      function onClickMonthPrev() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      function onClickYearNext() {
        setTimeout(function() {
          disableDates();
        },500);
      }

      function onClickYearPrev() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      
      function onShowYearView() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      function onSelectYear() {
        setTimeout(function() {
          disableDates();
        },500);
      }
      
      if(jQuery('.calendar-wrapper').length > 0) {
        var defaultConfig = {
          weekDayLength: 1,        
          date:new Date(),
          onClickDate: selectDate,
          onClickToday: onClickToday,
          onChangeMonth:onChangeMonth,
          onClickMonthNext: onClickMonthNext,
          onClickMonthPrev: onClickMonthPrev,
          onClickYearNext: onClickYearNext,
          onClickYearPrev: onClickYearPrev,
          onShowYearView: onShowYearView,
          onSelectYear: onSelectYear,       
          disable: function (date) { 
            return new Date(); 
          },
          showYearDropdown: true,
          startOnMonday: true,
          showTodayButton: true,
          min:FB_AJAX.crdate
        };      
        jQuery('.calendar-wrapper').calendar(defaultConfig);
        setTimeout(function() {
          disableDates();

        },500);
      }

      function emailValidate(email){
        var check = "" + email;
        if((check.search('@')>=0)&&(check.search(/\./)>=0))
            if(check.search('@')<check.split('@')[1].search(/\./)+check.search('@')) return true;
            else return false;
        else return false;
    }
    function get_User_Data() {
      // var session_type_opt = jQuery('.session_type_opt').val();
      // if(session_type_opt == 'no' || session_type_opt == 'yes') {

        if(emailValidate(jQuery('.bc_email').val())) {
          jQuery('div#booking-u-detials-loder-img').show();  
          var myCSSArray = [
            {'position':'relative','pointer-events':'none','opacity':'0.4'},
            {'position':'unset','pointer-events':'unset','opacity':'unset'}            
          ];
          jQuery('.booking-u-detials').css(myCSSArray[0]);
          var data = {
            'action': 'get_DetailByEmail_action',
            'email': jQuery('.bc_email').val(),
            'status' : '1',
          };
            jQuery.ajax({
              type: "get",            
              url: FB_AJAX.ajaxurl,
              data: data,
              success: function(response){
                if(response.status) {
                  jQuery('.session_type_opt').val('no');
                  console.log(response.user_data);
                  jQuery('.bc_name').val(response.user_data.name);
                  jQuery('.bc_surname').val(response.user_data.surname);
                  jQuery('.bc_mobile_number').val(response.user_data.mobile_number);
                  jQuery('.bc_who_you_are').val(response.user_data.who_you_are);
                  jQuery('.bc_current_position').val(response.user_data.current_position);
                  jQuery('.bc_interested_content').val(response.user_data.interested_content);
                  jQuery('.bc_booking_type').val(response.user_data.booking_type);
                  jQuery('.bc_goals').val(response.user_data.goals);
                  jQuery('.bc_top_strength').val(response.user_data.top_strength);
                  jQuery('.bc_top_development_point').val(response.user_data.top_development_point);
                  jQuery('.bc_number_of_sessions').val(response.user_data.number_of_sessions);
                  jQuery('.bc_instagram_handle').val(response.user_data.instagram_handle);
                  jQuery('.bc_linkedin_handle').val(response.user_data.linkedin_handle);
                  jQuery('.bc_facebook_handle').val(response.user_data.facebook_handle);
                  jQuery('.bc_twitter_handle').val(response.user_data.twitter_handle);
                  jQuery('.bc_comments').val(response.user_data.comments);
                  jQuery('.booking-u-detials').css(myCSSArray[1]);
                  jQuery('div#booking-u-detials-loder-img').hide();
                  jQuery('#supplierAdd').validate().resetForm();
                } else {
                  jQuery('.session_type_opt').val('yes');
                  jQuery('.bc_name, .bc_surname, .bc_mobile_number, .bc_who_you_are, .bc_current_position, .bc_interested_content, .bc_booking_type, .bc_goals, .bc_top_strength, .bc_top_development_point, .bc_number_of_sessions, .bc_instagram_handle, .bc_linkedin_handle, .bc_facebook_handle, .bc_twitter_handle, .bc_comments, .booking-u-detials').val('');

                  jQuery(".bc_current_position").val(jQuery(".bc_current_position option:first").val());
                  jQuery(".bc_who_you_are").val(jQuery(".bc_who_you_are option:first").val());
                  jQuery(".bc_interested_content").val(jQuery(".bc_interested_content option:first").val());
                  jQuery(".bc_booking_type").val(jQuery(".bc_booking_type option:first").val());
                  jQuery(".bc_number_of_sessions.valid").val(jQuery(".bc_number_of_sessions.valid option:first").val());

                  
                  // jQuery('.bc_who_you_are').val();
                  // jQuery('.bc_current_position').val();
                  // jQuery('.bc_interested_content').val();
                  // jQuery('.bc_booking_type').val();
                  // jQuery('.bc_goals').val();
                  // jQuery('.bc_top_strength').val();
                  // jQuery('.bc_top_development_point').val();
                  // jQuery('.bc_number_of_sessions').val();
                  // jQuery('.bc_instagram_handle').val();
                  // jQuery('.bc_linkedin_handle').val();
                  // jQuery('.bc_facebook_handle').val();
                  // jQuery('.bc_twitter_handle').val();
                  // jQuery('.bc_comments').val();
                  jQuery('.booking-u-detials').css(myCSSArray[1]);
                  jQuery('div#booking-u-detials-loder-img').hide();
                }
              }
          });
        }
      
    }

    jQuery('.bc_email').on('input', function() {
      get_User_Data();
    });
    jQuery('.session_type_opt').on('change', function() {
      get_User_Data();
      // var select_val = jQuery(this).val();
      // if(select_val == 'no' || select_val == 'yes') {}
  });

      
    jQuery(document).on('click', '.slot_radio_btns', function() {
      var booking_main_slot_id = jQuery(this).val();
      jQuery('#booking_main_slot_id').val(booking_main_slot_id);
      jQuery('.sub-slots').hide();
      jQuery('.subslots_cls').prop('checked',false);
      var empty_HTML = '<li><div class="row"><div class="col-md-12"><div class="alert alert-warning" role="alert">Please select the time slot</div></div></div></li>';
      jQuery("#payemt-data").html(empty_HTML);

        if(jQuery(this).is(':checked')) { 
          var slot_id = jQuery(this).val();
          jQuery(this).closest('li').find('.form-row.sub-slots').show();    
        }
    });
    
    jQuery(document).on("change",".custom-control-input",function() {
          var slot_id = jQuery(this).data('slot-id');
          var html_slot_id = 'slot_id_'+slot_id;
            var checked_arr = [];
            jQuery(".custom-control-input").each(function() {
                if(jQuery(this).prop("checked") == true){
                    var val_ = jQuery(this).val();
                    checked_arr.push(val_);
                }                
            });
            console.log(checked_arr);
            if(checked_arr.length > 0) {
              jQuery('#add-supplier-btn').attr('disabled',false);
              jQuery("#booking_slot_id").val('');
              jQuery.ajax({
                  type: "POST",
                  url: FB_AJAX.ajaxurl,
                  data: {
                    'action':'get_slot_payment',
                    'slot_id':slot_id,
                    'subSlots_data':checked_arr
                  },
                  beforeSend:function() {
                    jQuery("#loder-img").show();	
                    jQuery('button[type=submit]').attr('disabled', true);
                  },
                  success: function(data) {
                    jQuery("#loder-img").hide();	
                    jQuery('button[type=submit]').attr('disabled', false);
                    let response = JSON.parse(data);
                    if(response.status == 'success') {
                      jQuery('#price_details').show();
                      jQuery("#payemt-data").html(response.html);
                      jQuery("#booking_slot_id").val(response.slot_id);
                      jQuery('#' + html_slot_id + ' '+'.sub-slots').show();
                      jQuery('#discount_val').val(response.discount_val);
                      jQuery('#discount_percent').val(response.discount_percent);
                      jQuery('#subtotal_val').val(response.subtotal);                      
                      jQuery('#subtotal').val(response.subtotal);
                    }
                  },
                  error: function (error) {
                    jQuery("#loder-img").hide();	
                  },
              });
            } else {
				
              var empty_HTML = '<li><div class="row"><div class="col-md-12"><div class="alert alert-warning" role="alert">Please select the time slot</div></div></div></li>';
              jQuery("#payemt-data").html(empty_HTML);
              jQuery('#add-supplier-btn').attr('disabled',true);
            }
        
    });

    
    jQuery(document).on('change','.subslots_cls', function() {
      var yourArray = [];
      jQuery('.subslots_cls').each(function(index,value) {
        if(jQuery(this).prop('checked')) {
           var date_time = jQuery(this).val();
           yourArray.push(date_time);
        }
        var stringify = JSON.parse(JSON.stringify(yourArray));        
        jQuery('#booking_sub_slot_time').val(stringify);
        
      });
    });

   jQuery(document).on('change','#location-type', function() {
	   
	   
       var location_type=jQuery("#location-type").val();
	   jQuery('#fb-speaking-total-price').html('');
	   
	   jQuery('#fb-speaking-service-time-sec,#fb-speaking-total-price-sec,#fb-speaking-proceed-to-pay,#fb-speaking-total-price').hide();
	   $("#fb-speaking-time-from").val('');
	   $("#fb-speaking-time-to").val('');
	   if(location_type=='in-personal'){
		   
		    jQuery(".location_description_div").show();
			jQuery(".meating_link_div").hide();
			jQuery("#location_description").attr('required','required');
			FB_AJAX_SPEAKING.location_type='in-personal';
	   }else{
		   
		    jQuery(".location_description_div").hide();
			jQuery(".meating_link_div").show();
			FB_AJAX_SPEAKING.location_type='online';
	   }
		  jQuery("div").find(".selected").removeClass('selected');
		  jQuery("div").find(".day.highlight").removeClass('highlight');
		  jQuery('.weeks-wrapper').not('.header').addClass('required_week_dates');
		  
		  if(FB_AJAX_SPEAKING.location_type=='online'){
			  
				    jQuery(FB_AJAX_SPEAKING.session_dates_arr_speaking_inpersonal).each(function(i,v) {
					var filtered_date = new Date(v);
					if(FB_AJAX_SPEAKING.session_dates_arr_speaking_online.indexOf(v) >=0){
						
						jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',false);
					}else{
						jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',true);
						
					}			
				  });
			  }else {
				  jQuery(FB_AJAX_SPEAKING.session_dates_arr_speaking_inpersonal).each(function(i,v) {
					var filtered_date = new Date(v);
					jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',true);			
				  });
		   }
	   
    });
	
    if(jQuery('.fb-speaking-booking-overview-calendar').length > 0) {
		
      function Speaking_selectDate(date) {
		  
        jQuery('#fb-speaking-service-time-sec').show();
        console.log(date);
        var cdate = convert(date);
        jQuery("#session_date").val(cdate);
        jQuery("#selected_date").val(cdate);        
        jQuery('.fb-speaking-booking-overview-calendar').updateCalendarOptions({
          date: date
        });
        
      }
	  function disableSpeakingDates() {
		  
              jQuery("div").find(".selected").removeClass('selected');
              jQuery("div").find(".day.highlight").removeClass('highlight');
              jQuery('.weeks-wrapper').not('.header').addClass('required_week_dates');
			  
			  if(FB_AJAX_SPEAKING.location_type=='online'){
				    console.log(FB_AJAX_SPEAKING.session_dates_arr_speaking_inpersonal);
					console.log(FB_AJAX_SPEAKING.session_dates_arr_speaking_online);
					
				    jQuery(FB_AJAX_SPEAKING.session_dates_arr_speaking_inpersonal).each(function(i,v) {
						
					var filtered_date = new Date(v);
					
					if(FB_AJAX_SPEAKING.session_dates_arr_speaking_online.indexOf(v) >=0){
						
						jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',true);
						
					}else{
						jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',false);
					}
							
				  });
			  }else {
				  jQuery(FB_AJAX_SPEAKING.session_dates_arr_speaking_inpersonal).each(function(i,v) {
					var filtered_date = new Date(v);
					jQuery("div").find("[data-date='"+filtered_date+"']").attr('disabled',true);			
				  });
			  }
			  
      }
	  function sonClickToday() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
      function sonChangeMonth() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
      function sonClickMonthNext() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
	  

      function sonClickMonthPrev() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
      function sonClickYearNext() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }

      function sonClickYearPrev() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
      
      function sonShowYearView() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
	  
      function sonSelectYear() {
        setTimeout(function() {
          disableSpeakingDates();
        },500);
      }
      var defaultConfig = {
        weekDayLength: 1,        
        date:new Date(),
        onClickDate: Speaking_selectDate,
        onClickToday: sonClickToday,
        onChangeMonth:sonChangeMonth,
        onClickMonthNext: sonClickMonthNext,
        onClickMonthPrev: sonClickMonthPrev,
        onClickYearNext: sonClickYearNext,
        onClickYearPrev: sonClickYearPrev,
        onShowYearView: sonShowYearView,
        onSelectYear: sonSelectYear,		
        disable: function (date) {
            //return new Date();
			//return FB_AJAX_SPEAKING.session_dates_arr;
        },
        showYearDropdown: true,
        startOnMonday: true,
        showTodayButton: true,
        min: FB_AJAX_SPEAKING.crdate
      };
	  
	  setTimeout(function() {
          disableSpeakingDates();
      },500);
	  
      jQuery('.fb-speaking-booking-overview-calendar').calendar(defaultConfig);
        if(jQuery('.fb-speaking-time').length > 0) {
			
          jQuery('.fb-speaking-time').hunterTimePicker({
            callback: function(e){
				
              if(jQuery('#fb-speaking-time-from').val() != '' &&  jQuery('#fb-speaking-time-to').val() != '') {
				  
				var location_type=jQuery("#location-type").val();
				
                var time_from = jQuery('#fb-speaking-time-from').val();
                var time_to = jQuery('#fb-speaking-time-to').val();
                var time_from_time_to = time_from+' - '+time_to;;
                jQuery('#fb-service-time').text('');
                jQuery('#fb-service-time').text(time_from_time_to);
                var cdate = jQuery("#selected_date").val();                
                var formattedDate = new Date(cdate);
                var d = formattedDate.getDate();
                var m =  formattedDate.getMonth();
                m += 1;  // JavaScript months are 0-11
                var y = formattedDate.getFullYear();
                var selectedDate = (d + "-" + m + "-" + y);
                jQuery('#fb-service-date').text(selectedDate);
				
                // Need to run ajax from here
                var data = {
                  'action': 'fb_calculate_speaking_booking_action',
                  'status': '1',
                  'time_from': time_from,
                  'time_to': time_to,
                  'selectedDate' :selectedDate,
				  'location_type':location_type
                };
            
                // since 2.8 ajaxurl is always defined in the admin header and points to admin-ajax.php
                // jQuery.get(FB_AJAX.ajaxurl, data, function(response) {
                   
                // });
				jQuery("#login-msg").html('');
                $("#fb-total-hours").text('');
                $("#speaking_total_hour").val('');
				jQuery('#fb-speaking-total-price').html('');
                jQuery("#loder-img").show();
				
                jQuery.ajax({
                  type: "get",            
                  url: FB_AJAX.ajaxurl,                  
                  data: data,
                  success: function(response){
                    //debugger;
                    var JSON_data = JSON.parse(response);
                    console.log(JSON_data);
                    if(JSON_data.status) {
						
                      jQuery("#loder-img").hide();
                      jQuery('#fb-speaking-total-price').html('');
                      jQuery('#fb-speaking-total-price').html(JSON_data.speakingpayment_html);
                      jQuery('#fb-speaking-total-price-sec,#fb-speaking-proceed-to-pay,#fb-speaking-total-price').show();
					  
                      $("#fb-total-hours").text(JSON_data.total_hours);
                      $("#speaking_total_hour").val(JSON_data.total_hours);
					  
                    } else {
						
                      jQuery("#loder-img").hide();
					  jQuery("#speaking-msg").modal('show');
					   jQuery("#speaking-msg-data").html('<label style="color:red">'+JSON_data.msg+'</label>');	
					  //jQuery("#login-msg").html(JSON_data.msg);
					  
                      jQuery('#fb-speaking-total-price-sec,#fb-speaking-proceed-to-pay,#fb-speaking-total-price').hide();
                    }
                  }
              });                
              }
            }
          });
        }
    }

    if(jQuery('#supplierAdd').length > 0) {
        jQuery('#supplierAdd').validate({
              rules: {
                name: {
                  required: true,
                },
                email: {
                  required: true,
                  email:true
                },
                mobile_number:{
                    required: true,
                  maxlength:12,
                  minlength:8
                  
                },
                booking_slot_id:{
                  required: true,
                }
            },
            messages: {
                service_id:{
                required: 'Select Service',
              },
              name:{
              required: 'Please Enter Name',
            },
            email:{
              required: 'Please Enter Email',
            },
            mobile_number:{
              required: 'Please Enter Mobile Number',
            },
            booking_slot_id:{
                  required: 'Please select time slot',
                }
            },
          submitHandler: function(form) {
            var booking_slot_id = jQuery("#booking_slot_id").val();
            if(booking_slot_id ==''){
              jQuery("#ErrorModal").modal('show');
              return false;
            }
            jQuery("#loder-img").show();
            jQuery("#login-msg").html('');		  
                var url = FB_AJAX.ajaxurl;
                jQuery("#login-msg").html('');
                jQuery.ajax({
                  type: "POST",
                  url: url,
                  data: jQuery(form).serialize(), // serializes the form's elements.
                  beforeSend:function() {
                    jQuery('button[type=submit]').attr('disabled', true);
                  },
                  success: function(data) {
                    jQuery('button[type=submit]').attr('disabled', false);
                    var service_type = jQuery('#service_type').val();
                    let response = JSON.parse(data);
                      if(response.status == 'success') {
                          if(service_type == 'coaching') {

                            //<?php echo home_url()?>/coaching-booking-payment/?booking_id='+response.id+'&service_type='+service_type;		
                            window.location.href = FB_AJAX.site_url+"/coaching-booking-payment/?booking_id="+response.id+'&service_type='+service_type;
                          } else {	
                            // window.location.href='<?php echo home_url()?>/booking-payment/?booking_id='+response.id+'&service_type='+service_type;
                            window.location.href = FB_AJAX.site_url+"/booking-payment/?booking_id="+response.id+'&service_type='+service_type;
                          }
                                              
                      } else{
                        jQuery("#loder-img").hide();	
                        jQuery("#login-msg").html(data.msg);					
                      }
                  }, error: function (error) {
                    jQuery("#loder-img").hide();	
                    jQuery("#login-msg").html(error);
                  },
                });
              },
          });
    }
    if(jQuery('#fb_booking_speaking_form').length > 0) {
      jQuery('#fb_booking_speaking_form').validate({
            rules: {
              name: {
                required: true,
              },
              email: {
                required: true,
                email:true
              },
              mobile_number:{
                  required: true,
                maxlength:12,
                minlength:8
                
              },
              booking_slot_id:{
                required: true,
              }
          },
          messages: {
              service_id:{
              required: 'Select Service',
            },
            name:{
            required: 'Please Enter Name',
          },
          email:{
            required: 'Please Enter Email',
          },
          mobile_number:{
            required: 'Please Enter Mobile Number',
          },
          booking_slot_id:{
                required: 'Please select time slot',
              }
          },
        submitHandler: function(form) {
         
          var booking_slot_id = jQuery("#booking_slot_id").val();
          if(booking_slot_id ==''){
            jQuery("#ErrorModal").modal('show');
            return false;
          }
		    
		     jQuery("#speaking-msg-data").html('');	
             jQuery("#loder-img").show();
             jQuery("#login-msg").html('');		  
              var url = FB_AJAX.ajaxurl;
              jQuery("#login-msg").html('');
              jQuery.ajax({
                type: "POST",
                url: url,
                data: jQuery(form).serialize(), // serializes the form's elements.
                beforeSend:function() {
                  jQuery('button[type=submit]').attr('disabled', true);
                },
                success: function(data) {
                  jQuery('button[type=submit]').attr('disabled', false);
                  var service_type = jQuery('#service_type').val();
                  let response = JSON.parse(data);
                    if(response.status == 'success') {
                      jQuery('#fb_booking_speaking_form')[0].reset();
                      jQuery("#loder-img").hide();
                      jQuery("#speaking-msg").modal('show');
                      jQuery("#speaking-msg-data").html('<label style="color:green">'+response.msg+'</label>');
                      setTimeout(function(){  location.reload(); }, 2000);
                    } else {
                      jQuery("#loder-img").hide();
                      jQuery("#speaking-msg").modal('show');
                      jQuery("#speaking-msg-data").html('<label style="color:red">'+response.msg+'</label>');
                    }
                }, error: function (error) {
                  jQuery("#loder-img").hide();
                  jQuery("#login-msg").html(error);
                },
              });
            },
        });
   }
   
   if(jQuery('#DownloadcopyFrom').length > 0) {
      jQuery('#DownloadcopyFrom').validate({
            rules: {
              first_name: {
                required: true,
              },
			  last_name: {
                required: true,
              },
              email: {
                required: true,
                email:true
              }
          },
          messages: {
             
            first_name:{
            required: 'Please Enter Last Namr',
          },
		  last_name:{
            required: 'Please Enter First Name',
          },
          email:{
            required: 'Please Enter Email',
          }
          },
        submitHandler: function(form) {
            
		     jQuery("#download-msg-data").html('');	
             jQuery("#loder-img").show();
             jQuery("#login-msg").html('');		  
              var url = FB_AJAX.ajaxurl;
              jQuery("#login-msg").html('');
              jQuery.ajax({
                type: "POST",
                url: url,
                data: jQuery(form).serialize(), // serializes the form's elements.
                beforeSend:function() {
                  jQuery('button[type=submit]').attr('disabled', true);
                },
                success: function(data) {
					
				  jQuery("#loder-img").hide();
                  jQuery('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                    if(response.status == 'success') {
						
                      jQuery('#DownloadcopyFrom')[0].reset();
                      jQuery("#loder-img").hide();
                      //jQuery("#subscribeModal").modal('hide');
                      jQuery("#speaking-msg-data").html('<label style="color:green">'+response.msg+'</label>');
					      //location.assign('https://fullybossed.com/download-file/');
						  setTimeout(function(){ 
					  
					      jQuery("#subscribeModal").modal('hide');
                          jQuery("#speaking-msg-data").html('');	 					 
					      },3000);
                    } else {
						
                      jQuery("#loder-img").hide();
                      jQuery("#download-msg-data").html('<label style="color:red">'+response.msg+'</label>');
					  
                    }
                }, error: function (error) {
                  jQuery("#loder-img").hide();
                  jQuery("#login-msg").html(error);
                },
              });
            },
        });
   }
   if(jQuery('#subscribe_us_form').length > 0) {
	   
      jQuery('#subscribe_us_form').validate({
            rules: {
              email: {
                required: true,
                email:true
              }
          },
          messages: {
          email:{
            required: 'Please Enter Email',
          }
          },
        submitHandler: function(form) {
            
		     jQuery("#newsletter-msg-data").html('');	
             jQuery("#loder-img").show();
             jQuery("#login-msg").html('');		  
              var url = FB_AJAX.ajaxurl;
              jQuery("#login-msg").html('');
              jQuery.ajax({
                type: "POST",
                url: url,
                data: jQuery(form).serialize(), // serializes the form's elements.
                beforeSend:function() {
                  jQuery('button[type=submit]').attr('disabled', true);
                },
                success: function(data) {
					
				  jQuery("#loder-img").hide();
                  jQuery('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                    if(response.status == 'success') {
						
                      jQuery('#subscribe_us_form')[0].reset();
                      jQuery("#loder-img").hide();
                      //jQuery("#newsletterModal").modal('hide');
                      jQuery("#newsletter-msg-data").html('<label style="color:green">'+response.msg+'</label>');
					  //location.assign('https://fullybossed.com/download-file/');
					  setTimeout(function(){ 
					  
					     jQuery("#newsletterModal").modal('hide');
                         Query("#newsletter-msg-data").html('');	 					 
					  },3000);
					  
                    } else {
                      jQuery("#loder-img").hide();
                      jQuery("#newsletter-msg-data").html('<label style="color:red">'+response.msg+'</label>');
                    }
                }, error: function (error) {
                  jQuery("#loder-img").hide();
                  jQuery("#login-msg").html(error);
                },
              });
            },
        });
   }
   if(jQuery('#subscribe_home_form').length > 0) {
	   
      jQuery('#subscribe_home_form').validate({
            rules: {
              home_email: {
                required: true,
                email:true
              },
			   home_name: {
                required: true,
     
              }
          },
          messages: {
          home_email:{
            required: 'Please Enter Email',
          },
		  home_name:{
            required: 'Please Enter Name',
          }
          },
        submitHandler: function(form) {
            
		     jQuery("#newsletter-msg-data").html('');	
             jQuery("#loder-img").show();
             jQuery("#login-msg").html('');		  
              var url = FB_AJAX.ajaxurl;
              jQuery("#login-msg").html('');
              jQuery.ajax({
                type: "POST",
                url: url,
                data: jQuery(form).serialize(), // serializes the form's elements.
                beforeSend:function() {
                  jQuery('button[type=submit]').attr('disabled', true);
                },
                success: function(data) {
					
				  jQuery("#loder-img").hide();
                  jQuery('button[type=submit]').attr('disabled', false);
                  let response = JSON.parse(data);
                    if(response.status == 'success') {
						
                      jQuery('#subscribe_home_form')[0].reset();
                      jQuery("#loder-img").hide();
                      jQuery("#newsletter-msg-home-data").html('<label style="color:green">'+response.msg+'</label>');
					 
					  setTimeout(function(){ 
					     
                         Query("#newsletter-msg-home-data").html('');	 					 
					  },3000);
					  
                    } else {
                      jQuery("#loder-img").hide();
                      jQuery("#newsletter-msg-home-data").html('<label style="color:red">'+response.msg+'</label>');
                    }
                }, error: function (error) {
                  jQuery("#loder-img").hide();
                  jQuery("#login-msg").html(error);
                },
              });
            },
        });
   }
   // jquery code end here
  });
})( jQuery );
