$("#btnLogin").click(function (e) {
  e.preventDefault();
  let data = $("#fromLoginUser").serializeArray();
  let usuario = document.querySelector("#user").value;
  let password = document.querySelector("#pass").value;
  if (usuario !== "" && password !== "") {
    $.ajax({
      dataType: "json",
      url: "ajaxUsuarios/login",
      type: "POST",
      data: data,
    }).done(function (resp) {
      if (Array.isArray(resp)) {
        window.location.href = "Home";
      } else {
        Swal.fire({
          icon: "error",
          title: "Error",
          text: resp,
        });
      }
    });
  } else {
    Swal.fire({
      icon: "error",
      title: "Error",
      text: "Llene todos los campos",
    });
  }
  return false;
});
