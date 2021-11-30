$("#btnLogin").click(function (e) {
  e.preventDefault();
  let data = $("#fromLoginUser").serializeArray();
  /* data.push({name:'tag',value:'loginUser'})   */
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

  return false;
});
