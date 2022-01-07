$(document).ready(function () {
  $("#btnNewBudget").click(async function (e) {
    const { value: budget } = await swal.fire({
      title: "Añade un nuevo presupuesto",
      html:
        '<input id="nombre" class="swal2-input" placeholder="Nombre">' +
        '<input id="descripcion" class="swal2-input" placeholder="Descripcion">' +
        '<input id="cantidad" class="swal2-input" placeholder="Monto">',
      preConfirm: () => ({
        nombre: $("#nombre").val(),
        descripcion: $("#descripcion").val(),
        cantidad: $("#cantidad").val(),
      }),
    });
    var delayInMilliseconds = 100; //1 second
    if (budget) {
      $.ajax({
        url: "Presupuestos/create",
        type: "POST",
        data: budget,
        success: function (resp) {
          let data = JSON.parse(resp);
          let dataZero = data[0]
          if (Array.isArray(data)) {
            let tablaPresupuestos = $("#tablaPresupuestos").DataTable()
            tablaPresupuestos.row.add(dataZero).draw();
            Swal.fire("¡Buen trabajo!", "Registro Exitoso", "success");
          } else {
            setTimeout(function () {
              Swal.fire({
                icon: "error",
                title: "Error",
                text: JSON.parse(resp),
              });
            }, delayInMilliseconds);
          }
        },
      });
    }
  });
  $.ajax({
    type: "POST",
    url: "ajaxPresupuestos/index",
    success: function (resp) {
      let datos = JSON.parse(resp);
      $("#tablaPresupuestos").DataTable({
        paging: false,
        bFilter: true,
        ordering: false,
        searching: false,
        destroy: true,
        language: {
          url: "ServerSide/Spanish.json",
        },
        data: datos,
        columns: [
          { data: "nombre" },
          { data: "descripcion" },
          { data: "cantidad" },
          { data: "fecha" },
          {
            data: null,
            render: function (data, type, row) {
              return (
                '<a href="http://localhost:8080/usa/Presupuestos/edit/' +
                Number(row.idPresupuesto) +
                '" ">Ver</a>'
              );
            },
          },
        ],
      });
    },
  });
});
