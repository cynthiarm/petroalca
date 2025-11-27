$(document).ready(function () {
  $("#newsletter_form").on("submit", function (e) {
    e.preventDefault();

    var $form = $(this);

    // Evitar doble envío
    if ($form.data("sending") === true) return false;
    $form.data("sending", true);

    var email = $form.find("input[name='newsletter_email']").val().trim();
    var validationDiv = $form.find(".validation");

    validationDiv.html("").hide();

    // Validación básica
    if (email === '') {
        validationDiv.html(msgEmpty).show();
        $form.data("sending", false);
        return false;
    }

    var emailExp = /^[^\s()<>@,;:\/]+@\w[\w\.-]+\.[a-z]{2,}$/i;
    if (!emailExp.test(email)) {
        validationDiv.html(msgInvalid).show();
        $form.data("sending", false);
        return false;
    }

      $.ajax({
          type: "POST",
          url: action,
          data: str,
          success: function (msg) {
              msg = msg.trim();
              if (msg === "OK_NEWSLETTER_EN") {
                  $("#sendmessage_newsletter").addClass("show").html("Thanks for subscribing!");
                  $("#errormessage_newsletter").removeClass("show").html("");
                  $('#newsletter_form')[0].reset();
              } else {
                  $("#errormessage_newsletter").addClass("show").html(msg);
              }
              $("#newsletter_form").data("sending", false);
          },
          error: function () {
              $("#errormessage_newsletter").addClass("show").html("❌ Connection Error.");
              $("#newsletter_form").data("sending", false);
          }
      });
  });
});