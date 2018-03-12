$(document).ready(() => {

	$('#user-info-checkbox').attr('checked', 'checked');

	setBuyerInfo();

	$('#cancel-btn').on('click', event => {
		if (confirm("Cancel this Order ?")) {
			
		}
	});

	$('#checkbox-form').on('click', event => {
		if ($('#user-info-checkbox').is(':checked')) {
			setBuyerInfo();
		} else {
			unsetBuyerInfo();
		}
	});
	
});

function setBuyerInfo() {

	$('#fname').val('fname');
	$('#lname').val();
	$('#email').val();
	$('#tel').val();
	$('#cc-num').val();
	$('#cc-name').val();
	$('#cc-exp-date').val();
	$('#cc-ccv').val();

}

function unsetBuyerInfo() {

	$('#fname').val('');
	$('#lname').val('');
	$('#email').val('');
	$('#tel').val('');
	$('#cc-num').val('');
	$('#cc-name').val('');
	$('#cc-exp-date').val('');
	$('#cc-ccv').val('');

}