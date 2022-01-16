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
                        '<a class="text-center" href="http://localhost:8080/usa/Gastos/index/' +
                        Number(row.idGasto) +
                        '" ">Ver</a>'
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
});