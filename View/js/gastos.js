$(document).ready(function () {
    $('#exampleModalGasto').on('show.bs.modal', function () { })

    $.ajax({
        method: "POST",
        url: "../../Gastos/getMonto",
        success: function (e) {
            let data = JSON.parse(e)
            let dataOne = data['one'];
            let dataRestante = data['restante']

            let idPre = `<h3 class="font-weight-bold">Presupuesto N°: ${dataOne.idPresupuesto}</h3>`
            let nombre = `<h3 class="font-weight-bold">Nombre: ${dataOne.nombre}</h3>`
            let monto = `<h3 class="font-weight-bold">Monto inicial: ${dataOne.cantidad}</h3>`
            let montoR = `<h3 class="font-weight-bold" id="restante">Monto restante: ${dataRestante.toFixed(2)}</h3>`
            $('#divGastos').append(idPre);
            $('#divGastos').append(nombre);
            $('#divGastos').append(monto);
            $('#divGastos').append(montoR);
        }
    })
    tablaGastos = $('#tablaGastos').DataTable({
        paging: false,
        bFilter: true,
        ordering: false,
        searching: false,
        destroy: true,
        "ajax": {
            url: "../../Gastos/getGastos",
            method: "POST", //usamos el metodo POST
            "dataSrc": ""
        },
        language: {
            url: "ServerSide/Spanish.json",
        },
        "columns": [
            { data: "nombre", class: 'text-center' },
            { data: "monto", class: 'text-center' },
            { data: "fecha", class: 'text-center' },
            {
                data: null, class: 'text-center',
                render: function (data, type, row) {
                    return (
                        `<div class="text-center"><div class="btn-group"><button  data-id="${Number(row.idGasto)}" class="btn btn-primary btnEditar">Editar</button></div></div>`
                    );
                },
            },


        ]
    });
    $("#nuevoGasto").click(function () {
        let data = $("#frmGasto").serializeArray();
        $.ajax({
            url: "../../Gastos/create",
            type: "POST",
            data: data,
            success: function (resp) {
                let data = JSON.parse(resp);
                /* console.log(data); */
                if (Array.isArray(data['create'])) {
                    let dataCreate = data['create'][0]
                    let dataRestante = data['restante'];
                    tablaGastos.ajax.reload(null, false);
                    tablaGastos.row.add(dataCreate)
                    Swal.fire("¡Buen trabajo!", "Registro Exitoso", "success");
                    $("#restante").remove();
                    let monto = `<h3 class="font-weight-bold" id="restante">Monto restante: ${dataRestante.toFixed(2)}</h3>`
                    $('#divGastos').append(monto);
                    $('#exampleModalGasto').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#frmGasto").trigger("reset");
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
    $("#updateGasto").click(function () {
        let data = $("#frmGastoUpdate").serializeArray();
        let id = $('#idGasto').val();
        let idData = { "name": "idPre", "value": id }
        $.ajax({
            url: "../../Gastos/edit",
            type: "POST",
            data: data,
            success: function (resp) {
                let data = JSON.parse(resp);
                if (Array.isArray(data['create'])) {
                    let dataCreate = data['create'][0]
                    let dataRestante = data['restante'];
                    tablaGastos.ajax.reload(null, false);
                    tablaGastos.row.add(dataCreate)
                    Swal.fire("¡Buen trabajo!", "Registro Exitoso", "success");
                    $("#restante").remove();
                    let monto = `<h3 class="font-weight-bold" id="restante">Monto restante: ${dataRestante.toFixed(2)}</h3>`
                    $('#divGastos').append(monto);
                    $('#updateModal').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#frmGastoUpdate").trigger("reset");
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
    $('#tablaGastos').on('click', '.btnEditar ', function (event) {
        var table = $('#tablaGastos').DataTable();
        var trid = $(this).closest('tr').attr('id');
        // console.log(selectedRow);
        var id = $(this).data('id');
        $('#updateModal').modal('show');
        $('#updateModal').find('.modal-title').text('Editar presupuesto N°' + id)
       /*  console.log(id); */
        $.ajax({
            url: "../../Gastos/getOnes",
            data: {
                id: id
            },
            type: 'post',
            success: function (data) {
                let json = JSON.parse(data);
                let datos = json[0]
                $('#nombreUpdateGasto').val(datos.nombre);
                $('#montoUpdate').val(datos.monto);
                $('#idGasto').val(id);
                $('#trid').val(trid);
            }
        })
    })
});