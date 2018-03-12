window.onload = function () {
    $(document).ready(() => {
        $.ajax({
            type: "GET",
            url: "admin-php/admin-dashboard-content.php?q=",
            success: function (response) {
                $('#dashboard-table').html(response);
            }
        });
    })
};
function showHead(str) {
    $.ajax({
        type: "GET",
        url: "../home/php/getHead.php",
        success: function (response) {
            if (str == "") {
                return;
            }
            else {
                $('#buttonUser').html(response);
            }
        }
    });
}