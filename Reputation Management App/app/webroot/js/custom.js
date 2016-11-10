$(document).ready(function(){
		$("#find_country").change(function(){
		 	$.ajax({                   
                url: ajax_url+'businesses/findState',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (states) {
                	var options = '';
                	options = '<option value="">Select State</option>';
                	$.each(states.html, function(index, states) {
					    options += '<option value="' + index + '">' + states + '</option>';
					});
					options1 = '<option value="">Select City</option>';
					$('#find_state').html(options);
					$('#find_city').html(options1);
                }
            });
            return false;
		});
		$("#find_state").change(function(){
			$.ajax({                   
                url: ajax_url+'businesses/findCity',
                cache: false,
                type: 'POST',
                data: {'id':$(this).val()},
                dataType: 'json',
                success: function (states) {
                	var options = '';
                	options = '<option value="">Select City</option>';
                	$.each(states.html, function(index, cities) {
					    options += '<option value="' + index + '">' + cities + '</option>';
					});
					$('#find_city').html(options);
                }
            });
            return false;		
        });

        $('.response-msg').click(function(){
            $(this).slideUp();
        })

	});


