$(document).on('ready', function () {
    $('.addButton').click(function () {
        var ajaxurl = 'sqlController.php',
            data = {
                'action': 'insert',
                'firstname': $('#firstname').val(),
                'lastname': $('#lastname').val(),
                'email': $('#email').val()
            };
        $.post(ajaxurl, data, function (response) {
            $('#sqlTable').html(response);
            $('#exampleModal').modal('hide');
            $('.firstname').val('');
            $('.lastname').val('');
            $('.email').val('');
        });
    });
    $('.searchfield').on('keypress',function(e) {
        if(e.which == 13) {
            var ajaxurl = 'sqlController.php',
                data = {
                    'action': 'search',
                    'searchterm': document.getElementById('search').value
                };
            $.post(ajaxurl, data, function (response) {
                //location.reload();
                //document.getElementById("sqlTable").innerHTML = response;
                $('#sqlTable').html(response);
                $('.searchfield').val('');
            });
        }
    });
    $(document).on('click','#deleteButton' ,function (e) {
        e.preventDefault();
        var table = document.getElementsByTagName("table")[0];
        var tbody = table.getElementsByTagName("tbody")[0];
        var id = -1;
            e = e || window.event;
            var data = [];
            var target = e.srcElement || e.target;
            while (target && target.nodeName !== "TR") {
                target = target.parentNode;
            }
            if (target) {
                id = target.getElementsByTagName("td")[0].innerHTML;
                var ajaxurl = 'sqlController.php',
                    data = {
                        'action': 'delete',
                        'id': id
                    };
                $.post(ajaxurl, data, function (response) {
                    $('#sqlTable').html(response);
                });
            }
    });
});
