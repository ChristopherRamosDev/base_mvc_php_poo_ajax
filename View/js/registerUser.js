$(document).ready(function () {
  $("#btnInsertar").click(function (e) {
    e.preventDefault();
    let data = $("#formRegisterUser").serializeArray();
    let nombres = $("#nombres").val();
    let apellidos = document.querySelector("#apellidos").value;
    let email = document.querySelector("#email").value;
    let usuario = document.querySelector("#usuario").value;
    let password = document.querySelector("#password").value;
    if (
      nombres !== "" &&
      apellidos !== "" &&
      email !== "" &&
      usuario !== "" &&
      password !== ""
    ) {
      if (onlyLetters(nombres) && onlyLetters(apellidos)) {
        if (isEmail(email)) {
          if (password.length > 7) {
            $.ajax({
              dataType: "json",
              url: "ajaxUsuarios/insert",
              type: "POST",
              data: data,
            }).done(function () {
              Swal.fire("Buen trabajo", "Registro exitoso", "success").then(
                function () {
                  if (true) {
                    window.location = "Login";
                  }
                }
              );
            });
          } else {
            Swal.fire({
              icon: "error",
              title: "Error",
              text: "La contraseña debe tener mas de 8 caracteres",
            });
          }
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: "Formato invalido del correo",
          });
        }
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: "Formato invalido del nombre y/o apellido",
        });
      }
    } else {
      Swal.fire({
        icon: "error",
        title: "Error",
        text: "Llene todos los campos",
      });
    }
    return false;
  });
  function isEmail(email) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(email);
  }
  function onlyLetters(value) {
    var regex = /^[A-Za-z\s]+$/;
    return regex.test(value);
  }
});
