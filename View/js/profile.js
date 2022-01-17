$(document).ready(function () {
    $('#exampleModalInfo').on('show.bs.modal', function () { })

    $.ajax({
        method: "POST",
        url: "Perfil/getData",
        success: function (e) {
            let data = JSON.parse(e)
            /* console.log(data); */
            let nombres = `<h3 class="mb-3">Nombres: ${data.nombres}</h3>`
            let idUser = `<input type="hidden" name="idGasto" id="idGasto" data-id="${data.idUser}">`;
            let apellidos = `<h3 class="mb-3">Apellidos: ${data.apellidos}</h3>`
            let correo = `<h3 class="mb-3">Correo: ${data.correo}</h3>`
            let usuario = `<h3 class="mb-3">Usuario: ${data.user}</h3>`
            $('#divInfo').append(nombres);
            $('#divInfo').append(apellidos);
            $('#divInfo').append(correo);
            $('#divInfo').append(usuario);
            $('#divInfo').append(idUser);
            /*  console.log(idUser); */
        }
    })

    $("#btnEditInfo").click(function () {
        $(this).attr("data-id")
        let divInfo = $("#divInfo");
        let dataId = $("#idGasto").attr('data-id');
        $('#updateModalInfo').modal('show');
        $('#updateModalInfo').find('.modal-title').text('Usuario N° ' + dataId)
        $.ajax({
            url: "Perfil/getData",
            data: {
                id: dataId
            },
            type: 'post',
            success: function (data) {
                let json = JSON.parse(data);
                $('#nombreUpdateInfo').val(json.nombres);
                $('#apellidoInfo').val(json.apellidos);
                $('#correoInfo').val(json.correo);
                $('#usuarioInfo').val(json.user);
            }
        })
    })
    $("#updateInfo").click(function () {


        let Id = $("#idGasto").attr('data-id');
        let idData = { "name": "idUser", "value": Id }
        let data = $("#frmInfoUpdate").serializeArray();
        let dataPushed = data.push(idData)
        $.ajax({
            url: "Perfil/edit",
            type: "POST",
            data: data,
            success: function (resp) {
                let data = JSON.parse(resp);
                console.log(data);
                /*   if (Array.isArray(data['create'])) {
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
                    } */
            },
        });
    })
});