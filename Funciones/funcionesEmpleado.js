var dt;

function empleado(){  
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_empleado.php?accion=listar",
        "columns": [
            { "data": "staff_id" },
            { "data": "empleado" },
            { "data": "address" },
            { "data": "email" },
            { "data": "store_id" },
            { "data": "rol_name" },
            // { "data": "estado",
            //     render: function (data){
            //             if (data==1) {
            //                 return "Eliminado"
            //             } else {
            //                 return "Disponible"
            //             }
            //     }
            // },
            { "data": "staff_id",
                render: function (data) {
                        return '<a href="#" data-codigo="'+ data + 
                        '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                    +   '<a href="#" data-codigo="'+ data + 
                        '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';         
                }
            }
        ]
    });

    $('#modalnuevo').on('hidden.bs.modal', function () {
        $('#nuevoform').validate().resetForm();
        $('.error').removeClass('error');
        $('.form-group').removeClass('has-error');
    });
    $('#modaleditar').on('hidden.bs.modal', function () {
        $('#editarform').validate().resetForm();
        $('.error').removeClass('error');
        $('.form-group').removeClass('has-error');
    });

    $.validator.setDefaults({
        errorClass: 'help-block',
        highlight: function(element) {
        $(element)
            .closest('.form-group')
            .addClass('has-error');
        },
        unhighlight: function(element) {
        $(element)
            .closest('.form-group')
            .removeClass('has-error');
        }
    });

    $.validator.addMethod("noSpace", function(value, element) { 
        return this.optional( element ) || /^\S+$/i.test( value );
    }, "No se permiten espacios");

    $.validator.addMethod( "lettersonly", function( value, element ) {
        return this.optional( element ) || /^[a-z\s]+$/i.test( value );
    }, "Solo se aceptan letras" );

    $.validator.addMethod('strongPassword', function(value, element) {
        return this.optional(element) || value.length >= 5 && /\d/.test(value) && /[a-z]/i.test(value);
      }, "Tu contraseña debe tener almenos 5 caracteres y debe contener un número");

    $.validator.addMethod( "extension", function( value, element, param ) {
    param = typeof param === "string" ? param.replace( /,/g, "|" ) : "png|jpe?g";
    return this.optional( element ) || value.match( new RegExp( "\\.(" + param + ")$", "i" ) );
    }, $.validator.format( "El archivo debe ser png,jpg,jpeg" ) );

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenido").html('')
        $("#titulo").removeClass("show");
        $("#titulo").addClass("hide");
        $("#abrir").collapse("hide");
    })

    $("#nuevo").on("click",function(){
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_empleado.php",
            data: {accion:'listapais'},
            dataType:"json"
            }).done(function(resultado) { 
                $('.staff_id').val();
                $('#nuevoform')[0].reset();
                $(".country_id option").remove();
                $(".country_ide option").remove();
                $(".city_ide option").remove();
                $(".city_id option").remove();
                $(".address_ide option").remove();
                $(".address_id option").remove();
                $(".country_id").append("<option value disabled selected=''>Seleccione país</option>")
                $(".city_id").append("<option value disabled selected=''>Seleccione ciudad</option>")
                $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".country_id").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
            });
        });
        $(".country_id").change(function(){
            var pais= $(".country_id").val();
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_empleado.php",
                data: {codigo: pais,accion:'listaciudad'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".city_id option").remove();
                    $(".city_id").append("<option value disabled selected=''>Seleccione ciudad</option>")
                    $(".address_id option").remove();
                    $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                    //console.log("nuevo")
                    $.each(resultado.data, function (index, value) { 
                        //console.log(value.pais_codi);
                    $(".city_id").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
                });
            });
        });

        $(".city_id").change(function(){
            var ciudad= $(".city_id").val();
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_empleado.php",
                data: {codigo: ciudad,accion:'listadireccion'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".address_id option").remove();
                    $(".address_id").append("<option value disabled selected=''>Seleccione dirección</option>")
                    //console.log("nuevo")
                    $.each(resultado.data, function (index, value) { 
                        //console.log(value.pais_codi);
                    $(".address_id").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                });
            });
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_empleado.php",
            data: {accion:'listatienda'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".store_id option").remove();
                $(".store_id").append("<option value disabled selected=''>Seleccione una tienda</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
            });
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_empleado.php",
            data: {accion:'listarol'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".rol_id option").remove();
                $(".rol_id").append("<option value disabled selected=''>Seleccione rol</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".rol_id").append("<option value='" + value.rol_id + "'>" + value.rol_name + "</option>")
            });
        });
        $('#modalnuevo').modal('show'); 
    });

    $("#nuevoform").validate({
        rules:{
            first_name: {
                required: true,
                lettersonly:true
            },
            last_name:{
                required: true,
                lettersonly:true
            },
            country_id: {
                required: true
            },
            city_id: {
                required: true
            },
            address_id:{
                required: true
            },
            picture: {
                extension: true
            },
            email:{
                required: true,
                email: true
            },
            store_id: {
                required: true
            },
            rol_id:{
                required: true
            },
            username: {
                required: true,
                noSpace:true
            },
            password:{
                required: true,
                strongPassword: true
            },
            password_com:{
                equalTo: ".password",
                required: true
            },
            picture:{
                required: true,
                extension: true
            }
        },
        messages:{
            first_name: {
                required: 'Este campo es obligatorio',
                // lettersonly:true
            },
            last_name:{
                required: 'Este campo es obligatorio',
                // lettersonly:true
            },
            country_id: {
                required: 'Este campo es obligatorio'
            },
            city_id: {
                required: 'Este campo es obligatorio'
            },
            address_id:{
                required: 'Este campo es obligatorio'
            },
            picture: {
                extension: 'Tipo de archivo no permitido solo Jpeg/Png/Jpg'
            },
            email:{
                required: 'Este campo es obligatorio',
                email: 'Correo no valido'
            },
            store_id: {
                required: 'Este campo es obligatorio'
            },
            rol_id:{
                required: 'Este campo es obligatorio'
            },
            username: {
                required: 'Este campo es obligatorio',
                // noSpace:true
            },
            password:{
                required: 'Este campo es obligatorio',
                // strongPassword: true,
            },
            password_com:{
                required: 'Este campo es obligatorio',
                equalTo: 'No coinciden las contraseñas'
            },
            picture:{
                required: 'Este campo es obligatorio',
                // extension: true
            }
        },
        submitHandler: function(form) {
            var formData = new FormData();
            formData.append("staff_id", $(".staff_id").val());
            formData.append("first_name", $(".first_name").val());
            formData.append("last_name", $(".last_name").val());
            formData.append("address_id", $(".address_id").val());
            formData.append("email", $(".email").val());
            formData.append("store_id", $(".store_id").val());
            formData.append("rol_id", $(".rol_id").val() );
            formData.append("username", $(".username").val());
            formData.append("password", $(".password").val());
            formData.append("picture", $(".picture")[0].files[0]);
            formData.append("accion", "nuevo");
            // var contra=$(".password").val();
            // $.ajax({
            //     type:"post",
            //     url:"./Controlador/controlador_empleadoforms.php",
            //     data: {password:contra,accion:"cifrar"},
            //     dataType:"json",
            // }).done(function( resultado ) {
            //     // console.log(resultado.respuesta);
            //     formData.append("first_name", $(".first_name").val());
            //     formData.append("last_name", $(".last_name").val());
            //     formData.append("address_id", $(".address_id").val());
            //     formData.append("email", $(".email").val());
            //     formData.append("store_id", $(".store_id").val());
            //     formData.append("rol_id", $(".rol_id").val() );
            //     formData.append("username", $(".username").val());
            //     formData.append("picture", $(".picture")[0].files[0]);
            //     formData.append("accion", "nuevo");
            //     formData.append("password", resultado.respuesta);
            //     // for (const s of formData.entries()) {
            //     //     console.log(s[0], ',' , s[1]);
            //     // }
            // });
            $.ajax({
                type:"POST",
                url:"./Controlador/controlador_empleadoforms.php",
                data: formData,
                dataType:"json",
                cache: false,
                contentType: false,
                processData: false,
            }).done(function( resultado ) {
                console.log(resultado);
                if(resultado.respuesta){
                    $('#nuevoform')[0].reset();
                    dt.ajax.reload();
                    alertify.success('El empleado se grabó correctamente');
                } else {
                    alertify.error("Error al grabar");  
                }
            });
        }
    });

    $("#tabla").on("click","a.editar",function(){
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var nombre; 
       var apellido; 
       var email; 
       var tienda; 
       var rol; 
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_empleado.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(empleado) {
            // console.log(empleado);
                if(empleado.respuesta === "no existe"){
                    alertify.error("El empleado no existe");  
                } else {
                    $(".staff_id").val(empleado.codigo); 
                    $(".first_name").val(empleado.nombre);
                    $(".last_name").val(empleado.apellido);
                    $(".email").val(empleado.email);
                    tienda=empleado.tienda; 
                    rol=empleado.rol; 
                }
            });

           $.ajax({
                type:"get",
                url:"./Controlador/controlador_empleado.php",
                data: {codigo: tienda,accion:'listatienda'},
                dataType:"json"
            }).done(function( resultado ) {    
                $(".store_id option").remove();
                // console.log(Object.keys(resultado.data).length);
                $.each(resultado.data, function (index, value) { 
                    if(tienda === value.store_id){
                        $(".store_id").append("<option selected value='" + value.store_id + "'>" + value.store_id + "</option>")
                    }else {
                        $(".store_id").append("<option value='" + value.store_id + "'>" + value.store_id + "</option>")
                    }
                });      
            }); 

            $.ajax({
                type:"get",
                url:"./Controlador/controlador_empleado.php",
                data: {codigo: rol,accion:'listarol'},
                dataType:"json"
               }).done(function( resultado ) {    
                   $(".rol_id option").remove();
                   // console.log(Object.keys(resultado.data).length);
                   $.each(resultado.data, function (index, value) { 
                    if(rol === value.rol_id){
                        $(".rol_id").append("<option selected value='" + value.rol_id + "'>" + value.rol_name + "</option>")
                    }else {
                        $(".rol_id").append("<option value='" + value.rol_id + "'>" + value.rol_name + "</option>")
                    }   
                });      
            }); 

            $.ajax({
                type:"get",
                url:"./Controlador/controlador_empleado.php",
                data: {accion:'listapais'},
                dataType:"json"
                }).done(function(resultado) { 
                    $(".country_id option").remove();
                    $(".country_ide option").remove();
                    $(".city_id option").remove();
                    $(".city_ide option").remove();
                    $(".address_ide option").remove();
                    $(".address_id option").remove();
                    $(".country_ide").append("<option value disabled selected=''>Seleccione país</option>")
                    $(".city_ide").append("<option value disabled selected=''>Seleccione ciudad</option>")
                    $(".address_ide").append("<option value disabled selected=''>Seleccione dirección</option>")
                    //console.log("nuevo")
                    $.each(resultado.data, function (index, value) { 
                        //console.log(value.pais_codi);
                    $(".country_ide").append("<option value='" + value.country_id + "'>" + value.country + "</option>")
                    });
                });
                $(".country_ide").change(function(){
                    var pais= $(".country_ide").val();
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controlador_empleado.php",
                        data: {codigo: pais,accion:'listaciudad'},
                        dataType:"json"
                        }).done(function(resultado) { 
                            $(".city_ide option").remove();
                            $(".city_ide").append("<option value disabled selected=''>Seleccione ciudad</option>")
                            $(".address_ide option").remove();
                            $(".address_ide").append("<option value disabled selected=''>Seleccione dirección</option>")
                            //console.log("nuevo")
                            $.each(resultado.data, function (index, value) { 
                                //console.log(value.pais_codi);
                            $(".city_ide").append("<option value='" + value.city_id + "'>" + value.city + "</option>")
                        });
                    });
                });
        
                $(".city_ide").change(function(){
                    var ciudad= $(".city_ide").val();
                    $.ajax({
                        type:"get",
                        url:"./Controlador/controlador_empleado.php",
                        data: {codigo: ciudad,accion:'listadireccion'},
                        dataType:"json"
                        }).done(function(resultado) { 
                            $(".address_ide option").remove();
                            $(".address_ide").append("<option value disabled selected=''>Seleccione dirección</option>")
                            //console.log("nuevo")
                            $.each(resultado.data, function (index, value) { 
                                //console.log(value.pais_codi);
                            $(".address_ide").append("<option value='" + value.address_id + "'>" + value.address + "</option>")
                        });
                    });
                });
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            first_name: {
                required: true,
                lettersonly:true
            },
            last_name:{
                required: true,
                lettersonly:true
            },
            country_ide: {
                required: true
            },
            city_ide: {
                required: true
            },
            address_ide:{
                required: true
            },
            picture: {
                extension: true
            },
            email:{
                required: true,
                email: true
            },
            store_id: {
                required: true
            },
            rol_id:{
                required: true
            },
            username: {
                required: true,
                noSpace:true
            },
            password:{
                required: true,
                strongPassword: true
            },
            password_com:{
                equalTo: ".passworde",
                required: true
            },
            picture:{
                required: true,
                extension: true
            }
        },
        messages:{
            first_name: {
                required: 'Este campo es obligatorio',
                // lettersonly:true
            },
            last_name:{
                required: 'Este campo es obligatorio',
                // lettersonly:true
            },
            country_ide: {
                required: 'Este campo es obligatorio'
            },
            city_ide: {
                required: 'Este campo es obligatorio'
            },
            address_ide:{
                required: 'Este campo es obligatorio'
            },
            picture: {
                extension: 'Tipo de archivo no permitido solo Jpeg/Png/Jpg'
            },
            email:{
                required: 'Este campo es obligatorio',
                email: 'Correo no valido'
            },
            store_id: {
                required: 'Este campo es obligatorio'
            },
            rol_id:{
                required: 'Este campo es obligatorio'
            },
            username: {
                required: 'Este campo es obligatorio',
                // noSpace:true
            },
            password:{
                required: 'Este campo es obligatorio',
                // strongPassword: true,
            },
            password_com:{
                required: 'Este campo es obligatorio',
                equalTo: 'No coinciden las contraseñas'
            },
            picture:{
                required: 'Este campo es obligatorio',
                // extension: true
            }
        },
        submitHandler: function(form) {
            var formData = new FormData();
            formData.append("staff_id", $(".staff_id").val());
            formData.append("first_name", $(".first_name").val());
            formData.append("last_name", $(".last_name").val());
            formData.append("address_id", $(".address_ide").val());
            formData.append("email", $(".email").val());
            formData.append("store_id", $(".store_id").val());
            formData.append("rol_id", $(".rol_id").val() );
            formData.append("username", $(".usernamee").val());
            formData.append("password", $(".passworde").val());
            formData.append("picture", $(".pictured")[0].files[0]);
            formData.append("accion", "editar");
            // var contra=$(".password").val();
            // $.ajax({
            //     type:"post",
            //     url:"./Controlador/controlador_empleadoforms.php",
            //     data: {password:contra,accion:"cifrar"},
            //     dataType:"json",
            // }).done(function( resultado ) {
            //     // console.log(resultado.respuesta);
            //     formData.append("first_name", $(".first_name").val());
            //     formData.append("last_name", $(".last_name").val());
            //     formData.append("address_id", $(".address_id").val());
            //     formData.append("email", $(".email").val());
            //     formData.append("store_id", $(".store_id").val());
            //     formData.append("rol_id", $(".rol_id").val() );
            //     formData.append("username", $(".username").val());
            //     formData.append("picture", $(".picture")[0].files[0]);
            //     formData.append("accion", "nuevo");
            //     formData.append("password", resultado.respuesta);
            //     // for (const s of formData.entries()) {
            //     //     console.log(s[0], ',' , s[1]);
            //     // }
            // });
            $.ajax({
                type:"POST",
                url:"./Controlador/controlador_empleadoforms.php",
                data: formData,
                dataType:"json",
                cache: false,
                contentType: false,
                processData: false,
            }).done(function( resultado ) {
                // console.log(resultado);
                if(resultado.respuesta){
                    // $('#nuevoform')[0].reset();
                    alertify.success("El empleado ha sido actualizado!");  
                   dt.ajax.reload();
                } else {
                    alertify.error("Error al actualizar");  
                }
            });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar empleado', '¿Seguro que quieres eliminar este empleado?',function(){
                var request = $.ajax({
                method: "POST",
                url: "./Controlador/controlador_empleadoforms.php",
                data: {codigo: codigo, accion:'borrar'},
                dataType: "json"
            })
            request.done(function( resultado ) {
                // console.log(resultado);
                if(resultado.respuesta == 'correcto'){
                    alertify.success("Eliminado con exito!");   
                    dt.ajax.reload();                            
                } else {
                    alertify.error("Error al eliminar",console.log(textStatus)); 
                }
            });
            request.fail(function( jqXHR, textStatus ) {
                alertify.error("Error al eliminar",console.log(textStatus));  
            });
        }
        , function(){
    });
});
}