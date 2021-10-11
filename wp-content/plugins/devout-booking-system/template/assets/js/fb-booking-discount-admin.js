(function( $ ) {
	'use strict';

	jQuery( document ).ready(function() {		
		
		var tbody_html = '';
		tbody_html += `<tr> 
						<td> <input type="text" min="1" max="999" class="fb_bd_hours_input"> <i> hours </i> </td> 
						<td>
							<select class="fb_bd_select">
								<option class="fb_bd_enable" value="enable"> Enable </option>
								<option class="fb_bd_disable" value="disable"> Disable </option>
							</select>
						</td>`;
			tbody_html += '<td> <input type="number" min="1" max="999" class="fb_bd_discount_input"> <i> % </i> </td>';
			tbody_html += '<td> <img src="'+FB_AJAX.img_sorting_url+'" class="sorting_images"></td><td> <button name="add_fb_bd_remove" id="add_fb_bd_remove" class="button button-primary button-large  remove_fb_bd_row"> Remove </button></td></tr>';

		function load_Discount_Rules() {			
			var discount_rules = JSON.parse(FB_AJAX.discount_rules);
			jQuery('#fb_bd_tbody').html('');
			jQuery(discount_rules).each(function(index, value) {
				console.log(value);
				var tbody_html = '';
				tbody_html += '<tr>';
				tbody_html += '<td> <input type="text" min="1" max="999" class="fb_bd_hours_input" value="'+value.fb_bd_hours_input+'"> <i> hours </i> </td>';
				tbody_html += '<td>';
				tbody_html += '<select class="fb_bd_select">';
				if(value.fb_bd_select == 'enable') {
					tbody_html += '<option class="fb_bd_enable" value="enable" selected="selected"> Enable </option>';
					tbody_html += '<option class="fb_bd_disable" value="disable"> Disable </option>';
				} else if(value.fb_bd_select == 'disable') {
					tbody_html += '<option class="fb_bd_enable" value="enable" selected="selected"> Enable </option>';
					tbody_html += '<option class="fb_bd_disable" value="disable" selected="selected"> Disable </option>';
				} else {
					tbody_html += '<option class="fb_bd_enable" value="enable"> Enable </option>';
					tbody_html += '<option class="fb_bd_disable" value="disable"> Disable </option>';
				}

				tbody_html += '</select>';
				tbody_html += '</td>';
				tbody_html += '<td> <input type="number" min="1" max="999" class="fb_bd_discount_input" value="'+value.fb_bd_discount_input+'"> <i> % </i> </td>';
				tbody_html += '<td> <img src="'+FB_AJAX.img_sorting_url+'" class="sorting_images"></img> </td>';
				tbody_html += '<td> <button name="add_fb_bd_remove" id="add_fb_bd_remove" class="button button-primary button-large  remove_fb_bd_row"> Remove </button></td>';
				tbody_html += '</tr>';
				jQuery('#fb_bd_tbody').append(tbody_html);
				
			});
		}

		if(jQuery('#fb_bd_table').length > 0) {
			jQuery( window ).load(function() {
				load_Discount_Rules();				
			});
		}
		jQuery(document).on('click','#add_fb_bd_row', function() {
			jQuery('#fb_bd_tbody').append(tbody_html);
			jQuery('.remove_fb_bd_row').attr('disabled',false);
			
		});

		jQuery(document).on('click','#add_fb_bd_remove',function() {
			var fb_bd_tbody_tr = jQuery('tbody#fb_bd_tbody tr').length;
			if(fb_bd_tbody_tr > 1) {
				jQuery(this).closest('tr').remove();
			} else {
				jQuery(this).closest('tr').remove();				
				jQuery('#fb_bd_tbody').append(tbody_html);
			}
			
		});


		jQuery(document).on('click','#save_fb_bd_row', function() {			
			var all_discount_rules = [];
			var request_status = true;		

			jQuery('#fb_bd_tbody tr').each(function() {
				var fb_bd_hours_input = jQuery(this).find('.fb_bd_hours_input').val();
				var fb_bd_select = jQuery(this).find('.fb_bd_select').val();
				var fb_bd_discount_input = jQuery(this).find('.fb_bd_discount_input').val();

				if(fb_bd_hours_input == "") {
					alert('Hours input field cannot be empty.');
					request_status = false;
					return false;
				}
				if(fb_bd_hours_input < 1) {
					alert('Hours value cannot be less than 1 hour.');
					request_status = false;
					return false;
				}
				if(fb_bd_select == "") {
					alert('status input field cannot be empty.');
					request_status = false;
					return false;
				}
				if(fb_bd_discount_input == "") {
					alert('Discount input field cannot be empty.');
					request_status = false;
					return false;
				}				
					var discount_rules = {
						'fb_bd_hours_input': fb_bd_hours_input,
						'fb_bd_select': fb_bd_select,
						'fb_bd_discount_input': fb_bd_discount_input,
					};
					all_discount_rules.push(discount_rules);
			});
			if(request_status) {
				var myArray = [
					{'pointer-events':'none','opacity':'0.6'},
					{'pointer-events':'unset','opacity':'unset'}
				  ];
				jQuery('#save_fb_bd_row').text('saving...');
				jQuery('table#fb_bd_table').css(myArray[0]);
				var data = {
					'action': 'fb_discount_rules_action',
					'status': '1',
					'discount_rules': all_discount_rules
				};
				// We can also pass the url value separately from ajaxurl for front end AJAX implementations
				jQuery.post(FB_AJAX.ajaxurl, data, function(response) {
					jQuery('#save_fb_bd_row').text('save');
					jQuery('table#fb_bd_table').css(myArray[1]);
					if(response.status) {
						jQuery('.alert_section').html('');
						var alert_msg = '<div id="message" class="updated notice notice-success is-dismissible"><p>'+response.msg+'</p></div>';
						jQuery('.alert_section').append(alert_msg);
					} else {
						jQuery('.alert_section').html('');
						var alert_msg = '<div id="message" class="updated error notice-error is-dismissible"><p>'+response.msg+'</p></div>';
						jQuery('.alert_section').append(alert_msg);
					}
					setTimeout(function() {
						jQuery('.alert_section').html('');
					},3000);
				});
			}			
		});
		jQuery( "#fb_bd_tbody" ).sortable();
		jQuery( "#fb_bd_tbody" ).disableSelection();

		if(jQuery('.time_picker').length > 0) {
			jQuery('.time_picker').hunterTimePicker();
		}

		


	});
})( jQuery );
