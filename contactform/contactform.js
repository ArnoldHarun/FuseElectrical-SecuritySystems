const $ = require("jquery") // Declare the $ variable

$(() => {
  $(".contactForm").submit(function (e) {
    e.preventDefault()

    var form = $(this)
    var formData = {
      name: form.find('input[name="name"]').val(),
      email: form.find('input[name="email"]').val(),
      subject: form.find('input[name="subject"]').val(),
      message: form.find('textarea[name="message"]').val(),
    }

    // Basic validation
    var errors = []
    if (!formData.name || formData.name.length < 4) {
      errors.push("Please enter at least 4 characters for your name")
    }
    if (!formData.email || !isValidEmail(formData.email)) {
      errors.push("Please enter a valid email address")
    }
    if (!formData.subject || formData.subject.length < 8) {
      errors.push("Please enter at least 8 characters for the subject")
    }
    if (!formData.message) {
      errors.push("Please write a message")
    }

    if (errors.length > 0) {
      $("#errormessage").html(errors.join("<br>")).show()
      $("#sendmessage").hide()
      return
    }

    // Hide error messages
    $("#errormessage").hide()

    // Send email using EmailJS or similar service
    // For now, we'll simulate sending
    $.ajax({
      url: "submit-contact.php",
      method: "POST",
      data: formData,
      success: (response) => {
        $("#sendmessage").show()
        $("#errormessage").hide()
        form[0].reset()
      },
      error: () => {
        $("#errormessage").html("Sorry, there was an error sending your message. Please try again.").show()
        $("#sendmessage").hide()
      },
    })
  })

  function isValidEmail(email) {
    var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/
    return emailRegex.test(email)
  }
})
