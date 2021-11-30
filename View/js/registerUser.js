$(document).ready(function () {
  $("#btnInsertar").click(function (e) {
    e.preventDefault();
    let data = $("#formRegisterUser").serializeArray();
    let nombres = $("#nombres").val();
    let apellidos = document.querySelector("#apellidos").value;
    let email = document.querySelector("#email").value;
    let usuario = document.querySelector("#usuario").value;
    let password = document.querySelector("#password").value;
    /* console.log(nombres);
    return false; */
    if (nombres !== "" && apellidos !== "" && email !== "" &&usuario !== "" && password !== ""
    ) {
      
       if (password.length > 7) {
        $.ajax({
          dataType: "json",
          url: "ajaxUsuarios/insert",
          type: "POST",
          data: data,
        }).done(function (resp) {
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
        text: "Llene todos los campos",
      });
    }
    return false;
  });
});
