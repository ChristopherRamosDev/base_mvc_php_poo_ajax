$("#logout").click(function (e) {
  e.preventDefault();
  $.ajax({
    url: "ajaxUsuarios/logout",
    type: "POST",
  }).done(function () {
    Swal.fire({
      title: "¿Deseas cerrar sesion?",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Si",
    }).then((result) => {
      if (result.isConfirmed) {
        window.location.href = "";
      }
    });
  });
  return false;
});
