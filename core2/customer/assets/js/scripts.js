$("#logmeout").click(function (event) {
    event.preventDefault();

    $.ajax({
        url: "../checklogin.php",
        method: "POST",
        data: { function_name: 'logmeout' },

        success: function (response) {
            var rsp = response;

            switch (rsp) {
                case 'logout':
                    location.href = '../login.php';
                    break;
                default:
                    console.log(rsp);
            }
        },
    });
});
