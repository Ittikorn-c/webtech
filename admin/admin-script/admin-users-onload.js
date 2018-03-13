window.onload = function () {
    $(document).ready(() => {
        $.ajax({
            type: "GET",
            url: "admin-php/admin-users-table.php?q=",
            success: function (response) {
                $('#post-table').html(response);

                $("#parent").click(function () {
                    $(".child").prop("checked", this.checked);
                });

                $('.child').click(function () {
                    if ($('.child:checked').length == $('.child').length) {
                        $('#parent').prop('checked', true);
                    } else {
                        $('#parent').prop('checked', false);
                    }
                });

                // link to profile users
                $('#post-table tr').dblclick(function () {
                    $get_users_id = $(this).find("td").eq(1).html();
                    window.open('../profile/user_profile.php?u=' + $get_users_id);
                });

                $("#users-admin").click(function () {
                    var filter, table, tr, td, i;
                    filter = "ADMIN";
                    table = document.getElementById("post-table");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                });
                $("#users-organizer").click(function () {
                    var filter, table, tr, td, i;
                    filter = "ORGANIZER";
                    table = document.getElementById("post-table");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                });
                $("#users-user").click(function () {
                    var filter, table, tr, td, i;
                    filter = "USER";
                    table = document.getElementById("post-table");
                    tr = table.getElementsByTagName("tr");
                    for (i = 0; i < tr.length; i++) {
                        td = tr[i].getElementsByTagName("td")[3];
                        if (td) {
                            if (td.innerHTML.toUpperCase().indexOf(filter) > -1) {
                                tr[i].style.display = "";
                            } else {
                                tr[i].style.display = "none";
                            }
                        }
                    }
                });
                $("#users-all").click(function () {
                    var value = $(this).val().toLowerCase();
                    $("#post-table tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#post-table tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                var script = document.createElement('script');
                script.src = 'admin-script/admin-users-delete.js';
                script.type = 'text/javascript';
                var head = document.getElementsByTagName("head")[0];
                head.appendChild(script);

            }
        });
    })
};

//header
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