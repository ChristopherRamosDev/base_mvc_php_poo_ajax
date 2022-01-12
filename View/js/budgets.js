$(document).ready(function () {
  $('#exampleModal').on('show.bs.modal', function () { })

  tablaPresupuestos = $('#tablaPresupuestos').DataTable({
    paging: false,
    bFilter: true,
    ordering: false,
    searching: false,
    destroy: true,
    "ajax": {
      url: "ajaxPresupuestos/index",
      method: "POST", //usamos el metodo POST
      "dataSrc": ""
    },
    language: {
      url: "ServerSide/Spanish.json",
    },
    "columns": [
      { data: "nombre", class: 'text-center' },
      { data: "cantidad", class: 'text-center' },
      { data: "fecha", class: 'text-center' },
      {
        data: null, class: 'text-center',
        render: function (data, type, row) {
          return (
            '<a class="text-center" href="http://localhost:8080/usa/Presupuestos/editBudget/' +
            Number(row.idPresupuesto) +
            '" ">Ver</a>'
          );
        },
      },
      {
        data: null, class: 'text-center',
        render: function (data, type, row) {
          return (
            `<div class="text-center"><div class="btn-group"><button  data-id="${Number(row.idPresupuesto)}" class="btn btn-primary btnEditar">Editar</button></div></div>`
          );
        },
      },

    ]
  });
  $("#nuevoPre").click(function () {
    let data = $("#frmPresu").serializeArray();
    $.ajax({
      url: "Presupuestos/create",
      type: "POST",
      data: data,
      success: function (resp) {
        let data = JSON.parse(resp);
        let dataZero = data[0]
        if (Array.isArray(data)) {
          tablaPresupuestos.ajax.reload(null, false);
          tablaPresupuestos.row.add(dataZero)
          Swal.fire("¡Buen trabajo!", "Registro Exitoso", "success");
          $('#exampleModal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: JSON.parse(resp),
          });
        }
      },
    });
  })
  $("#updatePre").click(function () {
    let data = $("#frmPresuUpdate").serializeArray();
    let id = $('#idPresu').val();
    let idData = { "name": "idPre", "value": id }
    $.ajax({
      url: "Presupuestos/edit",
      type: "POST",
      data: data,
      success: function (resp) {
        /* console.log(resp); */
        let data = JSON.parse(resp);
        if (Array.isArray(data)) {
          tablaPresupuestos.ajax.reload(null, false);
          Swal.fire("¡Buen trabajo!", "Actualización exitosa", "success");
          $('#updateModal').modal('hide');
          $('body').removeClass('modal-open');
          $('.modal-backdrop').remove();
        } else {
          Swal.fire({
            icon: "error",
            title: "Error",
            text: JSON.parse(resp),
          });
        }
      },
    });
  })
  $('#tablaPresupuestos').on('click', '.btnEditar ', function (event) {
    var table = $('#tablaPresupuestos').DataTable();
    var trid = $(this).closest('tr').attr('id');
    // console.log(selectedRow);
    var id = $(this).data('id');
    $('#updateModal').modal('show');
    $('#updateModal').find('.modal-title').text('Editar presupuesto N°' + id)
    $.ajax({
      url: "Presupuestos/getOnes",
      data: {
        id: id
      },
      type: 'post',
      success: function (data) {
        let json = JSON.parse(data);
        let datos = json[0]
/*         console.log(datos); */
        $('#nombreUpdate').val(datos.nombre);
        $('#cantidadUpdate').val(datos.cantidad);
        $('#idPresu').val(id);
        $('#trid').val(trid);
      }
    })
  })
});