$(document).ready(() => {

	getAllRequests();

	$('#refresh-btn').on('click', event => {
		getAllRequests();
	});
	
});

function getAllRequests() {
	$.ajax({
			type: "POST",
			url: "event_confirmation.php",
			data: {request: 'requesting'},
			cache: false,
			success: function(response) {
				$('.requests-container').html(response);

				$('.select-all').on('click', event => {
					$('.select-' + event.currentTarget.id.substring(11)).prop('checked', event.currentTarget.checked);
				});

				$('.btn-success').on('click', event => {
					if (confirm("Are you sure ?")) {
						var selectedId = [];
						$(':input[class="select-' + event.currentTarget.id.substring(11) + '"]:checked').each(function(i) {
							selectedId[i] = this.id.substring(7);
						});
						btnHandle('yes', selectedId);
					}	
				});

				$('.btn-danger').on('click', event => {
					if (confirm("Are you sure ?")) {
						var selectedId = [];
						$(':input[class="select-' + event.currentTarget.id.substring(12) + '"]:checked').each(function(i) {
							selectedId[i] = this.id.substring(7);
						});
						btnHandle('no', selectedId);
					}	
				});
			}
	});
}

function btnHandle(isAccept, selectedId) {
	$.ajax({
		type: "POST",
		url: "event_confirmation.php",
		data: {request: 'confirming', isAccept: isAccept, selectedId: selectedId},
		cache: false,
		success: function(response) {
			for (i = 0; i < selectedId.length; i++) {
				if (isAccept === 'yes') {
					$('#status-' + selectedId[i]).html('<p class="text-success"><b>ACCEPTED</p></b></h4>');
				} else {
					$('#status-' + selectedId[i]).html('<p class="text-danger"><b>DECLINED</p></b></h4>');
				}
				$('#checkbox-cell-' + selectedId[i]).html("");
			}
		}
	});
}

//header
function showHead() {
    $.ajax({
        type: "GET",
        url: "getHead.php",
        success: function(response){
            if (response=="") {
                return;
              } 
            else{
                $('#buttonUser').html(response);
            }
        }
    });
}
