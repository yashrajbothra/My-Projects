var Layout = {
	dataTables: function(){
		$('.dataTables-example').DataTable({
			pageLength: 50,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
				{extend: 'excel'},
				{extend: 'pdf'},
				{extend: 'print',
				 customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
					}
				}
			]
		});
		$('.dataTables-search').DataTable({
			pageLength: 50,
			responsive: true,
			dom: 'lTfgitp'
		});
	},
	Report_dataTables: function(){
		$('.dataTables-example').DataTable({
			pageLength: 50,
			responsive: true,
			dom: '<"html5buttons"B>lTfgitp',
			buttons: [
				{extend: 'excel'},
				{extend: 'pdf'},
				{extend: 'print',
				 customize: function (win){
					$(win.document.body).addClass('white-bg');
					$(win.document.body).css('font-size', '10px');

					$(win.document.body).find('table')
						.addClass('compact')
						.css('font-size', 'inherit');
					}
				}
			]
		});
	},
	date: function(){
		$('.date').datepicker({
			todayBtn: "linked",
			keyboardNavigation: false,
			forceParse: false,
			calendarWeeks: true,
			autoclose: true,
			format : 'dd-mm-yyyy'
		});
		
		$('.month').datepicker({
			minViewMode: 1,
			format : 'M-yyyy'
		});
		
		$('.year').datepicker({
			minViewMode: 2,
			format : 'yyyy'
		});
	},
	Ladda : function(){
        Ladda.bind( '.ladda-button',{ timeout: 2000 });
	},
	chosen_select : function(){
        $('.chosen-select_1').chosen({width: "250px"});
        $('.chosen-select').chosen({width: "100%"});
		/*
		$('.chosen-select').each(function(index) {
			$(this).chosen({
				disable_search_threshold: 5,
				no_results_text: "?????? ?? ???????!"
			});
			this.setAttribute('style','display:visible; clip:rect(0,0,0,0)');
		});
		*/
	},
	i_check : function(){
		$('.i-checks').iCheck({
			checkboxClass: 'icheckbox_square-green',
			radioClass: 'iradio_square-green'
		});
	},
	date_rangepicker : function(){
		$('input[name="daterange"]').daterangepicker();
		$('#reportrange span').html(moment().format('MMMM D, YYYY') + ' - ' + moment().format('MMMM D, YYYY'));
		$('#reportrange').daterangepicker({
			format: 'MM/DD/YYYY',
			startDate: moment(),
			endDate: moment(),
			minDate: '01/01/2012',
			maxDate: '12/31/2024',
			dateLimit: { days: 60 },
			showDropdowns: true,
			showWeekNumbers: true,
			timePicker: false,
			timePickerIncrement: 1,
			timePicker12Hour: true,
			ranges: {
				'Today': [moment(), moment()],
				'Yesterday': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
				'Last 7 Days': [moment().subtract(6, 'days'), moment()],
				'Last 30 Days': [moment().subtract(29, 'days'), moment()],
				'This Month': [moment().startOf('month'), moment().endOf('month')],
				'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
			},
			opens: 'right',
			drops: 'down',
			buttonClasses: ['btn', 'btn-sm'],
			applyClass: 'btn-primary',
			cancelClass: 'btn-default',
			separator: ' to ',
			locale: {
				applyLabel: 'Submit',
				cancelLabel: 'Cancel',
				fromLabel: 'From',
				toLabel: 'To',
				customRangeLabel: 'Custom',
				daysOfWeek: ['Su', 'Mo', 'Tu', 'We', 'Th', 'Fr','Sa'],
				monthNames: ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'],
				firstDay: 1
			}
		}, function(start, end, label) {
		   // console.log(start.toISOString(), end.toISOString(), label);
			$('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
			startDate = start.format('YYYY-MM-D');
			endDate = end.format('YYYY-MM-D');  
		});
	},
	scroll_content : function(){
		// Add slimscroll to element
		$('.scroll_content').slimscroll({
			height: '300px'
		});
	}
};