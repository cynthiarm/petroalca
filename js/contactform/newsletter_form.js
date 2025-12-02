$(document).ready(function () {

    var msgEmpty = "Please enter an email address.";
    var msgInvalid = "Please enter a valid email address.";
    var action = "newsletter_form.php";

    $("#newsletter_form_footer").submit(function (e) {
        e.preventDefault();

        var $form = $(this);

        if ($form.data("sending") === true) return false;
        $form.data("sending", true);

        var email = $("#newsletter_email_footer").val().trim();
        var validationDiv = $("#errormessage_newsletter_footer");

        validationDiv.removeClass("show").html("");

        if (email === "") {
            validationDiv.addClass("show").html(msgEmpty);
            $form.data("sending", false);
            return false;
        }

        var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
        if (!emailExp.test(email)) {
            validationDiv.addClass("show").html(msgInvalid);
            $form.data("sending", false);
            return false;
        }

        var str = $form.serialize();

        $.ajax({
            type: "POST",
            url: action,
            data: str,
            success: function (msg) {
                msg = msg.trim();

                if (msg === "OK_NEWSLETTER_EN") {
                    $("#sendmessage_newsletter_footer").addClass("show").html("Thanks for subscribing!");
                    $("#errormessage_newsletter_footer").removeClass("show").html("");
                    $form[0].reset();
                } else {
                    $("#errormessage_newsletter_footer").addClass("show").html(msg);
                }

                $form.data("sending", false);
            },
            error: function () {
                $("#errormessage_newsletter_footer").addClass("show").html("❌ Connection Error.");
                $form.data("sending", false);
            }
        });

        return false;
    });

});