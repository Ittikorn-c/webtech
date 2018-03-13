$("#users-delete").click(function () {
    $(document).ready(() => {
        table = document.getElementById("post-table");
        tr = table.getElementsByTagName("tr");
        var inputElements = table.getElementsByClassName('child');
        var array_delete_users = [];
        for (var i = 0; inputElements[i]; ++i) {
            if (inputElements[i].checked) {
                checkedValue = inputElements[i].value;
                td = tr[i].getElementsByTagName("td")[1];
                array_delete_users.push(td.textContent);
                console.log(td.textContent);
            }
        }
        if (array_delete_users.length > 0) {
            for (var j = 0; j < array_delete_users.length; ++j) {
                $.ajax({
                    type: "GET",
                    url: "admin-php/admin-users-delete.php?q=" + array_delete_users[j],
                    success: function (response) {
                        console.log("Delete user is Complete");
                    }
                });
            }
            alert("Delete event Complete");
            location.reload();
        }
    });
});