// JavaScript Document
(function($){
	
	$(document).ready(function(){
		
		$('.paypal-dialog').click(function(e) {
		  e.preventDefault();
		  $('#paypalDialog').modal({
			  backdrop: 'static',
			  keyboard: false
			});
		});	
		
		$('.btn-loading').on('click', function() {
			var $this = $(this);
		  $this.button('loading');
			setTimeout(function() {
			   $this.button('reset');
		   }, 8000);
		});		
		
		$('#toggle-search').click(function(evt){
			evt.preventDefault();		
			$('#block-avail-search-avail-search-block').toggle('slow', function(){
				
				var hide_txt = 'Hide Search Form';
				var edit_txt = 'Edit Search';				
				
				if ($('#toggle-search').hasClass('show-search')) {
					 $('#toggle-search').removeClass('show-search').addClass('hide-search');
					 $('#toggle-search').text(hide_txt);
					 $('#toggle-search').attr('title',hide_txt);
				}
				else {
					 $('#toggle-search').removeClass('hide-search').addClass('show-search');
					 $('#toggle-search').text(edit_txt);
					 $('#toggle-search').attr('title',edit_txt);
				}
				/*
				if ($('#toggle-search').hasClass('hide-search')) {
					 $('#toggle-search').removeClass('hide-search').addClass('show-search');
					 $('#toggle-search').text(edit_txt);
					 $('#toggle-search').attr('title',edit_txt);
				}
				else {
					 $('#toggle-search').removeClass('show-search').addClass('hide-search');
					 $('#toggle-search').text(hide_txt);
					 $('#toggle-search').attr('title',hide_txt);
				}
				*/				
			});
		});		
		
		
		$(function(){

			var txtCity = $("select[name='city']").data('txt-select');
			$("select[name='city']").change(function () {
				getZones(txtCity, $(this));
			});

			getZones(txtCity, $("select[name='city'] option:selected"));
			
			var type = $('#edit-ptype').val();
			var type_txt = $('#edit-ptype option:selected').text();
			var city = $('#edit-city').val();
			var city_txt = $('#edit-city option:selected').text();
			var location = $('#location').val();
			var location_txt = $('#edit-location option:selected').text();			
			var bedrooms = $('#edit-bedrooms').val();
			var arrival = $('#edit-arrival').val();
			var departure = $('#edit-departure').val();
			//var nights = $('#nights').val();
			var adults = $('#edit-adults').val();
			var children = $('#edit-children').val();
			
			txt = '';
			
			if(city){
			
				txt = city_txt + ' / ';
				
			}
			
			if(location){
				txt += location_txt + ' / ';
			}
			
			if(type){
				txt += type_txt + ' / ';
			}
			
			if((arrival) && (departure)){			
			
				txt += 'Travel dates' + ': ' + arrival + ' - ' + departure + ' / ';
				
			}
			
			if(bedrooms){
				txt += 'Bedrooms' + ': ' + bedrooms + ' / ';
			}
			
			if(adults){
				
				txt += 'Adults' + ': ' + adults + ' / ';

				if(children){
					child = children;
				}else{
					child = 0;
				}
							
				txt += 'Children' + ': ' + child;
				
			}
			
			if(txt){
			
				$('.search-params-breadcrumbs').html(txt);
				
			}
			
		});
		
	});


	function getZones(txtCity, city){
		$("select[name='zone']").empty();
		$("select[name='zone']").append("<option value=''>"+txtCity+"...</option>");
		$.getJSON("/property/zones/" + $(city).val(), function (data) {
			if(data.data.length > 0){
				$("select[name='zone']").show();
				$.each(data.data, function (key, value) {
					$("select[name='zone']").append("<option value=" + value.zone_id + ">" + value.name + "</option>");
				});
			}else{
				$("select[name='zone']").hide();
			}
		});
	}

	/*

	var viewport = get_viewport();
	$(window).resize(function(){
		viewport = get_viewport();
	});

	function get_viewport(){
		var w = Math.max(document.documentElement.clientWidth, window.innerWidth || 0);
		var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0);
		return {w: w, h: h};
	}

	function prepare_home_search() {
		var tr1 = $("#avail-search-form table tr:eq(0)");
		var tr2 = $("#avail-search-form table tr:eq(1)");

		// replace inputs
		tr1.find('td:eq(0)').append(tr2.find('td:eq(0) > div').clone());
		tr1.find('td:eq(1)').append(tr2.find('td:eq(1) > div').clone());
		tr1.find('td:eq(2)').append(tr2.find('td:eq(2) > div').clone());
		tr1.find('td:eq(3)').append(tr2.find('td:eq(3) > div').clone());

		// remove old values
		tr2.find('td:eq(3)').remove();
		tr2.find('td:eq(2)').remove();
		tr2.find('td:eq(1)').remove();
		tr2.find('td:eq(0)').remove();

		// re-initialize datepicker
		var cloned_datepicker = tr1.find('td:eq(2) > div:eq(1)');
		var input = cloned_datepicker.find('input');
		input.removeClass('hasDatepicker');
		console.log(input);

		input.datepicker({
			dateFormat: 'D dd/M/yy',
			altFormat: 'yy-mm-dd',
			altField: '#departure-alt',
			changeMonth: true,
			changeYear: true,
			numberOfMonths: 2,
			minDate: '+2d',
			onClose: function( selectedDate ) {
				$('#edit-arrival').datepicker('option', 'maxDate', selectedDate );
			}
		});
	}

	// handlers
	setTimeout(function(){
		prepare_home_search();
	}, 500);

	*/


})(jQuery)
