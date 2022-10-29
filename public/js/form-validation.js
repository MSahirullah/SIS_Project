function validateForm() {
    if ($(".error-msg").length) {
        return false;
    }

    return true;
}

$("#email").on("input", function () {
    const email = $(this).val();
    const uid = $("#userId").val();

    $.post(
        "/admin/users-actions/check",
        {
            _token: post_token,
            email: email,
            uid: uid,
        },
        function (data) {
            if (parseInt(data) == 1) {
                $("#email").parent().append('<span class="text-danger error-msg"> Email already exists </span>');
            } else {
                $("#email").parent().find("span").remove();
            }
        }
    );
});

$("#username").on("input", function () {
    const username = $(this).val();
    const uid = $("#userId").val();

    $.post(
        "/admin/users-actions/check",
        {
            _token: post_token,
            username: username,
            uid: uid,
        },
        function (data) {
            if (parseInt(data) == 1) {
                $("#username")
                    .parent()
                    .append(
                        '<span class="text-danger error-msg"> Username already exists </span>'
                    );
            } else {
                $("#username").parent().find("span").remove();
            }
        }
    );
});
