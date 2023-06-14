document.getElementById("contact-form").addEventListener("submit", function(event) {
  event.preventDefault(); 
  var nombre = document.getElementById("nombre").value;
  var correo = document.getElementById("correo").value;
  var mensaje = document.getElementById("mensaje").value;
  var asunto = "Nuevo mensaje de contacto - " + nombre;

  var confirmacion = confirm("Have you checked your email?");

  if (confirmacion) {
    var emailData = {
      sender: { email: correo },
      to: [{ email: MAIL }],
      subject: asunto,
      htmlContent: mensaje
    };

    // Realizar la solicitud POST a la API de Sendinblue
    fetch('https://api.sendinblue.com/v3/smtp/email', {
      method: 'POST',
      headers: {
        'Content-Type': 'application/json',
        'api-key': API_KEY 
      },
      body: JSON.stringify(emailData)
    })
    .then(function(response) {
      if (response.ok) {
        alert("Mail sent successfully");
        document.getElementById("contact-form").reset();
      } else {
        throw new Error('Error sending mail');
      }
    })
    .catch(function(error) {
      console.log(error);
      alert("There was an error sending the mail");
    });
  }
});