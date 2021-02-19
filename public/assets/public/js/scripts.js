// const { each } = require("jquery");

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

			var getInputsSearch = localStorage.getItem('search-form') || '';
			
			var txtCity = $("select[name='city']").data('txt-select');
			$("select[name='city']").change(function () {
				getZones(txtCity, $(this));
			});
			
			if(getInputsSearch){
				getInputsSearch = JSON.parse(getInputsSearch);
				$("select[name='property_type']").val(getInputsSearch.type);
				$("select[name='city']").val(getInputsSearch.city);
				$("select[name='zone']").val(getInputsSearch.zone);
				$("input[name='bedrooms']").val(getInputsSearch.bedrooms);
				$("input[name='arrival']").val(getInputsSearch.arrival);
				$('#edit-arrival').val(getInputsSearch.arrivalTxt);
				$("input[name='departure']").val(getInputsSearch.departure);
				$('#edit-departure').val(getInputsSearch.departureTxt);
				$("input[name='adults']").val(getInputsSearch.adults);
				$("input[name='children']").val(getInputsSearch.children);
				
				$("#zone").attr('data-zone', getInputsSearch.zone);

				var d = new Date(getInputsSearch.arrival);
				var currentYear = d.getFullYear();
				$.each(['.modal-prev', '.modal-next', '.btn-calendar'], function(i, val) {
					$(val).attr('data-year', currentYear);
				});
				
				if(getInputsSearch.petFriendly){
					$("input[name='pet_friendly']").prop('checked', true);
				}
				if(getInputsSearch.adultsOnly){
					$("input[name='adults_only']").prop('checked', true);
				}
				if(getInputsSearch.beachFront){
					$("input[name='beach_front']").prop('checked', true);
				}
				
				if ($("select[name='city'] ").val() != "") {
					getZones(txtCity, $("select[name='city'] option:selected"));
				}
			}else{
				if ($("select[name='city'] ").val() != "") {
					getZones(txtCity, $("select[name='city'] option:selected"));
				}
			}
			
			$("#avail-search-form").submit(function(e){
				var petFriendly = ($("input[name='pet_friendly']").is(":checked"))?true:false;
				var adultsOnly  = ($("input[name='adults_only']").is(":checked"))?true:false;
				var beachFront  = ($("input[name='beach_front']").is(":checked"))?true:false;
				localStorage.removeItem("breadcrumbs");
				localStorage.removeItem("search-form");
				type = $("select[name='property_type']").val();
				type_txt = $("select[name='property_type'] option:selected").text();

				city = $("select[name='city']").val();
				city_txt = $("select[name='city'] option:selected").text();

				zone = $("select[name='zone']").val();
				zone_txt = $("select[name='zone'] option:selected").text();
			
				bedrooms = $("input[name='bedrooms']").val();
				
				arrival = $("input[name='arrival']").val();
				arrivalTxt = $('#edit-arrival').val();

				departure = $("input[name='departure']").val();
				departureTxt = $('#edit-departure').val();

				adults = $("input[name='adults']").val();
				children = $("input[name='children']").val();

				var inputsForm = {
					type: type,
					city: city,
					zone: zone,
					bedrooms: bedrooms,
					arrival: arrival,
					arrivalTxt: arrivalTxt,
					departure: departure,
					departureTxt: departureTxt,
					adults: adults,
					children: children,
					petFriendly: petFriendly,
					adultsOnly: adultsOnly,
					beachFront: beachFront,
				};

				// Save session for use in property details
				setDatesProperty(arrival, arrivalTxt, departure, departureTxt);

				localStorage.setItem("search-form", JSON.stringify(inputsForm));
			});

			$("#return-availability-results").click(function(){
				$("#avail-search-form").submit();
			});

			setTimeout(function(){
				var type = $("select[name='property_type']").val();
				var type_txt = $("select[name='property_type'] option:selected").text();
				
				var city = $("select[name='city']").val();
				var city_txt = $("select[name='city'] option:selected").text();
				
				var zone = $("select[name='zone']").val();
				var zone_txt = $("select[name='zone'] option:selected").text();

				var bedrooms = $("input[name='bedrooms']").val();
				
				var arrival = $("input[name='arrival']").val();
				var arrivalTxt = $('#edit-arrival').val();
				
				var departure = $("input[name='departure']").val();
				var departureTxt = $('#edit-departure').val();
				
				var adults = $("input[name='adults']").val();
				var children = $("input[name='children']").val();

				setDatesProperty(arrival, arrivalTxt, departure, departureTxt);
				
				var breadcrumbs = localStorage.getItem('breadcrumbs') || '';
	
				if(!breadcrumbs){
					txt = '';
					
					if(city){
						txt += city_txt + ' / ';
					}
					
					if(zone){
						txt += zone_txt + ' / ';
					}
					
					if(type){
						txt += type_txt + ' / ';
					}
					
					if((arrivalTxt) && (departureTxt)){			
						txt += 'Travel dates' + ': ' + arrivalTxt + ' - ' + departureTxt + ' / ';
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
					
					localStorage.setItem('breadcrumbs', txt);
				}
				
				$('.search-params-breadcrumbs').html(localStorage.getItem('breadcrumbs'));
			}, 500);

		});
		
	});

	function setDatesProperty(arrival, arrivalTxt, departure, departureTxt){
		// Save session for use in property details
		var datesProperty = [arrival, arrivalTxt, departure, departureTxt];
		document.cookie = `datesProperty=${datesProperty};path=/`;
	}


	function getZones(txtCity, city){
		$("select[name='zone']").empty();
		$("select[name='zone']").append("<option value=''>"+txtCity+"...</option>");
		$.getJSON("/property/zones/" + $(city).val(), function (data) {
			if(data.data.length > 0){
				$("select[name='zone']").show();
				$.each(data.data, function (key, value) {
					var selected = (value.zone_id == $('#zone').data('zone'))?'selected':'';
					$("select[name='zone']").append("<option "+ selected +" value=" + value.zone_id + ">" + value.name + "</option>");
				});
			}else{
				$("select[name='zone']").hide();
			}
		});
	}

	var rw = localStorage.getItem('rw') || '[]';
	rw = JSON.parse(rw);

	if(rw.length > 0){
		$('#block-recent-views-recent-views-block').removeClass('hide-recent-views');
	}else{
		$('#block-recent-views-recent-views-block').addClass('hide-recent-views');
	}

	rw.reverse().map((data) => {
		$('#recent-views').append(`<div class="row recent-views-row">
				<div class="col-xs-4"> <img src="${data.image}" width="100%" height="65"> </div>
				<div class="col-xs-8">
					<h2 class="recent-views-title"><a href="${data.route}" title="View FULL details" class="full-details">${data.name}</a></h2>
					<div class="avg-rate">$${data.rate} USD <small>/ avg. night</small></div>
					<div class="recent-views-icons">
						<div class="col-xs-4 text-center" title="Bedrooms"> <i class="fa fa-bed"></i>&nbsp;&nbsp;${data.beds}
						</div>
						<div class="col-xs-4 text-center icons-middle" title="Bathrooms"> <i class="fa fa-shower"></i>&nbsp;&nbsp;${data.baths} </div>
						<div class="col-xs-4 text-center" title="Max. Occupancy"> <i class="fa fa-users"></i>&nbsp;&nbsp;${data.pax} </div>
					</div>
				</div>
				<div class="col-xs-12">
					<div class="w-100 divider">&nbsp;</div>
				</div>
			</div>`
		);
	});

	// First Months of Availability
	if ( $(".first-calendar").length){
		setTimeout(function(){
			var dataFirstAvailability = {
				'id': $('.btn-calendar').data("source"),
				'year' : $('.btn-calendar').data("year"),
			};
		
			var containerFirstAvailability = $(".first-calendar");
			var url = containerFirstAvailability.data("url");
		
			$.ajax({
				url: url,
				type: "GET",
				data:{"source": dataFirstAvailability}
			}).done(function(data) {
				containerFirstAvailability.html(data.calendar);
			});
		}, 500);
	}

	var modals = $(".app-modal-calendar");

    modals.each(function() {
        var id = $(this).attr("id");
        var modal = $("#" + id);
        var container = $(this).find(".app-modal-calendar-container");
        var url = container.data("url");

        modal.on("show.bs.modal", function(e) {
            var data = {
                'id': $(e.relatedTarget).data("source"),
                'year' : $(e.relatedTarget).data("year"),
            };
            $.ajax({
                url: url,
                type: "GET",
                data:{"source": data}
            }).done(function(data) {
                container.html(data.calendar);
                $('.modal-prev').attr("data-year", data.prev);
                $('.modal-current').html(data.current);
                $('.modal-next').attr("data-year", data.next);
                setTimeout(function(){
                    $('.modal-prev, .modal-next').on('click', function(e){
                        var dataNew = {
                            'id': e.currentTarget.attributes[1].value,
                            'year' : e.currentTarget.attributes[2].value,
                        };
                        $.ajax({
                            url: url,
                            type: "GET",
                            data:{"source": dataNew}
                        }).done(function(data) {
                            $('.modal-prev').attr("data-year", data.prev);
                            $('.modal-current').html(data.current);
                            $('.modal-next').attr("data-year", data.next);
                            container.html(data.calendar);
                        });
                    });
                }, 500);
            });
        });
    });

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
