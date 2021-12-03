$(document).ready(function () {
  $.ajax({
    type: "POST",
    url: "ajaxPresupuestos/index",
    success: function (resp) {
      
      let datos = JSON.parse(resp);
      console.log(Number(datos[0][5]));
      /* datos.forEach((e) => {
        console.log(e);
      }); */
      $("#tablaPresupuestos").DataTable({
        paging: true,
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
                '" onclick="editClick(this)">Ver</a>'
              );
            },
          },
        ],
      });
    },
  });
});
