$(document).ready(function () {

    $('#exampleModalInfo').on('show.bs.modal', function () { })

    
    function updateInfo() {
        $.ajax({
            method: "POST",
            url: "Perfil",
            success: function (e) {
                $("#bienvenido").remove();
            }
        })
    }

    $.ajax({
        method: "POST",
        url: "Perfil/getData",
        success: function (e) {
            let data = JSON.parse(e)
            /* console.log(data); */
            let nombres = `<h3 id="nombre" class="mb-3">Nombres: ${data.nombres}</h3>`
            let idUser = `<input  type="hidden" name="idGasto" id="idGasto" data-id="${data.idUser}">`;
            let apellidos = `<h3 id="apellidos" class="mb-3">Apellidos: ${data.apellidos}</h3>`
            let correo = `<h3 id="correo" class="mb-3">Correo: ${data.correo}</h3>`
            let usuario = `<h3 id="usuario" class="mb-3">Usuario: ${data.user}</h3>`
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
    $("#btnEditClave").click(function () {
        $('#updateModalInfoPass').modal('show');
        $('#updateModalInfoPass').find('.modal-title').text('Editar clave')
    })
    $("#updatePass").click(function () {
        let Id = $("#idGasto").attr('data-id');
        let idData = { "name": "idUser", "value": Id }
        let data = $("#frmInfoUpdatePass").serializeArray();
        let dataPushed = data.push(idData)
        $.ajax({
            url: "Perfil/editPass",
            type: "POST",
            data: data,
            success: function (resp) {
                let data = JSON.parse(resp);
                if (data === 'Actualizacion correcta') {
                    Swal.fire("Buen trabajo", data, "success").then();
                    $('#updateModalInfoPass').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#frmInfoUpdatePass").trigger("reset");
                } else {
                    Swal.fire({
                        icon: "error",
                        title: "Error",
                        text: data
                    });
                }
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
                if (Array.isArray(data)) {
                    $("#nombre").remove();
                    $("#apellidos").remove();
                    $("#correo").remove();
                    $("#usuario").remove();
                    updateInfo();
                    let nombres = `<h3 id="nombre" class="mb-3">Nombres: ${data[0].nombres}</h3>`
                    let idUser = `<input  type="hidden" name="idGasto" id="idGasto" data-id="${data[0].idUser}">`;
                    let apellidos = `<h3 id="apellidos" class="mb-3">Apellidos: ${data[0].apellidos}</h3>`
                    let correo = `<h3 id="correo" class="mb-3">Correo: ${data[0].correo}</h3>`
                    let usuario = `<h3 id="usuario" class="mb-3">Usuario: ${data[0].user}</h3>`
                   /*  let bienvenido = `<h3 id="bienvenido" class="font-weight-bold">Bienvenido${data[0].user} </h3>` */
                    $('#divInfo').append(nombres);
                    $('#divInfo').append(apellidos);
                    $('#divInfo').append(correo);
                    $('#divInfo').append(usuario);
                    $('#divInfo').append(idUser);
                 /*    $('#bienvenidoDiv').append(bienvenido); */
                    Swal.fire("Buen trabajo", "Actualización exitosa", "success").then();
                    $('#updateModalInfo').modal('hide');
                    $('body').removeClass('modal-open');
                    $('.modal-backdrop').remove();
                    $("#frmInfoUpdate").trigger("reset");
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