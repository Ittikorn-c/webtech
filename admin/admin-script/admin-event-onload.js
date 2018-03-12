window.onload = function () {
    $(document).ready(() => {
        $.ajax({
            type: "GET",
            url: "admin-php/admin-event-table.php?q=",
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

                $('#post-table tr').dblclick(function () {
                    $get_event_id = $(this).find("td").eq(1).html();
                    window.open('../event/showEvent.html?event=' + $get_event_id);
                });

                $('#event-create').click(function () {
                    window.open('../event/createEvent.html');
                });

                $("#event-all").click(function () {
                    var value = $(this).val().toLowerCase();
                    $("#post-table tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                $("#event-science").click(function () {
                    var filter, table, tr, td, i;
                    filter = "SCIENCE";
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
                $("#event-business").click(function () {
                    var filter, table, tr, td, i;
                    filter = "BUSINESS";
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
                $("#event-family").click(function () {
                    var filter, table, tr, td, i;
                    filter = "FAMILY";
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

                $("#event-education").click(function () {
                    var filter, table, tr, td, i;
                    filter = "EDUCATION";
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

                $("#event-hobbies").click(function () {
                    var filter, table, tr, td, i;
                    filter = "HOBBIES";
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

                $("#event-music").click(function () {
                    var filter, table, tr, td, i;
                    filter = "MUSIC";
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

                $("#event-health").click(function () {
                    var filter, table, tr, td, i;
                    filter = "HEALTH";
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

                $("#event-community").click(function () {
                    var filter, table, tr, td, i;
                    filter = "COMMUNITY";
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

                $("#event-food").click(function () {
                    var filter, table, tr, td, i;
                    filter = "FOOD";
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

                $("#event-fashion").click(function () {
                    var filter, table, tr, td, i;
                    filter = "FASHION";
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

                $("#event-arts").click(function () {
                    var filter, table, tr, td, i;
                    filter = "ARTS";
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

                $("#event-sports").click(function () {
                    var filter, table, tr, td, i;
                    filter = "SPORTS";
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

                $("#event-films").click(function () {
                    var filter, table, tr, td, i;
                    filter = "FILMS";
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

                $("#event-charity").click(function () {
                    var filter, table, tr, td, i;
                    filter = "CHARITY";
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

                $("#myInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $("#post-table tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });

                var script = document.createElement('script');
                script.src = 'admin-script/admin-pdf.js';
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
        success: function(response){
            if (str=="") {
                return;
              } 
            else{
                $('#buttonUser').html(response);
            }
        }
    });
}