var dt;

function prestamo(){  
    dt = $("#tabla").DataTable({
        "ajax": "Controlador/controlador_prestamo.php?accion=listar",
        "columns": [
            { "data": "rental_id"},
            { "data": "rental_date" },
            { "data": "inventory_id" },
            { "data": "cliente" },
            { "data": "return_date" },
            { "data": "empleado" },
            { "data": "last_update" },
            // { "data": "estado",
            //     render: function (data){
            //             if (data==1) {
            //                 return "Eliminado"
            //             } else {
            //                 return "Disponible"
            //             }
            //     }
            // },
            { "data": "rental_id",
                render: function (data) {
                    return '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-danger btn-sm borrar"> <i class="fa fa-trash"></i></a>'
                +   '<a href="#" data-codigo="'+ data + 
                    '" class="btn btn-info btn-sm editar"> <i class="fa fa-edit"></i></a>';        
                }
            }
        ]
  })

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
        },
        errorPlacement: function (error, element) {
            if (element.prop('name') === 'rental_date' || element.prop('name') == 'return_date') {
            error.insertAfter(element.parent());
            } else {
            error.insertAfter(element);
            }
        }
    });

    $("#contenido").on("click","button.btncerrar",function(){
        $("#contenido").html('')
        $("#titulo").removeClass("show");
        $("#titulo").addClass("hide");
        $("#abrir").collapse("hide");
    })

    $("#nuevo").on("click",function(){
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_prestamo.php",
            data: {accion:'listacliente'},
            dataType:"json"
            }).done(function(resultado) { 
                $('.rental_id').val();
                $(".customer_id option").remove();
                $(".customer_id").append("<option value disabled selected=''>Seleccione cliente</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".customer_id").append("<option value='" + value.customer_id + "'>" + value.nombre + "</option>")
                
            });
        })
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_prestamo.php",
            data: {accion:'listaempleado'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".staff_id option").remove();
                $(".staff_id").append("<option value disabled selected=''>Seleccione un empleado</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".staff_id").append("<option value='" + value.staff_id + "'>" + value.nombre + "</option>")
            });
        });
        $.ajax({
            type:"get",
            url:"./Controlador/controlador_prestamo.php",
            data: {accion:'listainventario'},
            dataType:"json"
            }).done(function(resultado) { 
                $(".inventory_id option").remove();
                $(".inventory_id").append("<option value disabled selected=''>Seleccione inventario</option>")
                //console.log("nuevo")
                $.each(resultado.data, function (index, value) { 
                    //console.log(value.pais_codi);
                $(".inventory_id").append("<option value='" + value.inventory_id + "'>" + value.inventory_id + "</option>")
            });
        });
        $('.datetimepicker-input').val('');
        // $('.f_return_nuevo').datetimepicker('maxDate', null);
        // $('.f_rental_nuevo').datetimepicker('minDate', null);
        $('.f_rental_nuevo').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
        });
        $('.f_return_nuevo').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        });
        $(".f_rental_nuevo").on("change.datetimepicker", function (e) {
            $('.f_return_nuevo').datetimepicker('minDate', e.date);
        });
        $(".f_return_nuevo").on("change.datetimepicker", function (e) {
            $('.f_rental_nuevo').datetimepicker('maxDate', e.date);
        }); 
        $("#modalnuevo" ).modal('show'); 
    })
    
    $("#nuevoform").validate({
        rules:{
            inventory_id: {
                required: true
            },
            customer_id:{
                required: true,
            },
            staff_id: {
                required: true,
            },
            rental_date:{
                required: true
            },
            return_date: {
                required: true
            }
        }, 
        messages:{
            inventory_id: {
                required: 'Este campo es obligatorio'
            },
            customer_id:{
                required: 'Este campo es obligatorio'
            },
            staff_id: {
                required: 'Este campo es obligatorio'
            },
            rental_date:{
                required: 'Este campo es obligatorio'
            },
            return_date: {
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            //console.log(datos);
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_prestamo.php",
                data: datos,
                dataType:"json"
            }).done(function( resultado ) {
                //   console.log(datos);
                if(resultado.respuesta){
                    $('#nuevoform')[0].reset();
                    $('.datetimepicker-input').val('');
                    dt.ajax.reload();
                    alertify.success('El prestamo se grabó correctamente');
                } else {
                    alertify.error("Error al grabar");  
                }
            });
        }
    });

    $("#tabla").on("click","a.editar",function(){
       //Recupera datos del fromulario
       var codigo = $(this).data("codigo");
       var cliente; 
       var empleado; 
       var inventario;
       $.ajax({
           type:"get",
           url:"./Controlador/controlador_prestamo.php",
           data: {codigo: codigo, accion:'consultar'},
           dataType:"json"
        }).done(function(prestamo) {
            // console.log(prestamo);
                if(prestamo.respuesta === "no existe"){
                    alertify.error("El prestamo no existe");  
                } else {
                    $(".rental_id").val(prestamo.codigo);   
                    empleado = prestamo.empleado;   
                    cliente = prestamo.cliente;
                    inventario=prestamo.inventario;
                }
            });

           $.ajax({
             type:"get",
             url:"./Controlador/controlador_prestamo.php",
             data: {accion:'listaempleado'},
             dataType:"json"
           }).done(function( resultado ) {    
            // console.log(resultado.data);       
              $(".staff_id option").remove();
              $.each(resultado.data, function (index, value) { 
                if(empleado === value.staff_id){
                  $(".staff_id").append("<option selected value='" + value.staff_id + "'>" + value.nombre + "</option>")
                }else {
                  $(".staff_id").append("<option value='" + value.staff_id + "'>" + value.nombre + "</option>")
                }
            });
        }); 
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_prestamo.php",
                data: {accion:'listacliente'},
                dataType:"json"
            }).done(function( resultado ) {    
            // console.log(resultado.data);       
                $(".store_id option").remove();
                $.each(resultado.data, function (index, value) { 
                if(cliente === value.customer_id){
                    $(".customer_id").append("<option selected value='" + value.customer_id + "'>" + value.nombre + "</option>")
                }else {
                    $(".customer_id").append("<option value='" + value.customer_id + "'>" + value.nombre + "</option>")
                }
            });
        }); 
            $.ajax({
                type:"get",
                url:"./Controlador/controlador_prestamo.php",
                data: {accion:'listainventario'},
                dataType:"json"
            }).done(function( resultado ) {    
            // console.log(resultado.data);       
                $(".inventory_id option").remove();
                $.each(resultado.data, function (index, value) { 
                if(inventario === value.inventory_id){
                    $(".inventory_id").append("<option selected value='" + value.inventory_id + "'>" + value.inventory_id + "</option>")
                }else {
                    $(".inventory_id").append("<option value='" + value.inventory_id + "'>" + value.inventory_id + "</option>")
                }
            });
        }); 
        $('.datetimepicker-input').val('');
        // $('.f_return_editar').datetimepicker('minDate', null);
        // $('.f_rental_editar').datetimepicker('maxDate', null);
        $('.f_rental_editar').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss'
        });
        $('.f_return_editar').datetimepicker({
            format: 'YYYY-MM-DD HH:mm:ss',
            useCurrent: false
        });
        $(".f_rental_editar").on("change.datetimepicker", function (e) {
            $('.f_return_editar').datetimepicker('minDate', e.date);
        });
        $(".f_return_editar").on("change.datetimepicker", function (e) {
            $('.f_rental_editar').datetimepicker('maxDate', e.date);
        });
        $('#modaleditar').modal('show');   
    })

    $("#editarform").validate({
        rules:{
            inventory_id: {
                required: true
            },
            customer_id:{
                required: true,
            },
            staff_id: {
                required: true,
            },
            rental_date:{
                required: true
            },
            return_date: {
                required: true
            }
        }, 
        messages:{
            inventory_id: {
                required: 'Este campo es obligatorio'
            },
            customer_id:{
                required: 'Este campo es obligatorio'
            },
            staff_id: {
                required: 'Este campo es obligatorio'
            },
            rental_date:{
                required: 'Este campo es obligatorio'
            },
            return_date: {
                required: 'Este campo es obligatorio'
            }
        },
        submitHandler: function(form) {
            var datos=$(form).serialize();
            // console.log(datos);
            $.ajax({
               type:"get",
               url:"./Controlador/controlador_prestamo.php",
               data: datos,
               dataType:"json"
             }).done(function( resultado ) {
                 if(resultado.respuesta){
                   alertify.success("El prestamo ha sido actualizado!");  
                   dt.ajax.reload();
                   $("#titulo").html("Listado de prestamos");
                } else {
                   alertify.error("Error al actualizar");  
               }
           });
        }
    });

   $("#tabla").on("click","a.borrar",function(){
    //Recupera datos del formulario
    var codigo = $(this).data("codigo");
    alertify.confirm('Eliminar prestamo', '¿Seguro que quieres eliminar este prestamo?',function(){
                var request = $.ajax({
                method: "get",
                url: "./Controlador/controlador_prestamo.php",
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
    