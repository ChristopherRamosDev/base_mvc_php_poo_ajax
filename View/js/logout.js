$("#logout").click(function (e) {
  e.preventDefault();
  /* let data = $("#fromLoginUser").serializeArray(); */
  /* data.push({name:'tag',value:'loginUser'})   */
  /*   console.log('click en logout');
    return false; */
  $.ajax({
    url: "ajaxUsuarios/logout",
    type: "POST",
  }).done(function (resp) {
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
