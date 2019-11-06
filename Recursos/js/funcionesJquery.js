function Inicio(){

	$('.sidebar-menu').tree();

	$(".treeview-menu a").click(function(e){
		e.preventDefault();
        url = $(this).attr("href");
        $.post( url, {url:url},function(data) {
        		if(url!="#")
        			$(".content-header" ).html(data);
        });
     });

	 $('#datosactualizar').on('hidden.bs.modal', function () {
        $('#actualizarform').validate().resetForm();
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
	
	$("#btnupdatedatos").on("click",function(){
        $("#datosactualizar" ).modal('show'); 
        // console.log("nuevo")
    })

    $("#actualizarform").validate({
        rules:{
            first_name: {
                required: true,
                lettersonly:true
            },
            last_name:{
                required: true,
                lettersonly:true
            },
            email:{
                required: true,
                email: true
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
                // extension: 'Tipo de archivo no permitido solo Jpeg/Png/Jpg'
            }
        },
        submitHandler: function(form) {
            var formData = new FormData();
            formData.append("staff_id", $(".staff_id").val());
            formData.append("first_name", $(".first_name").val());
            formData.append("last_name", $(".last_name").val());
            formData.append("email", $(".email").val());
            formData.append("rol_id", $(".rol_id").val() );
            formData.append("username", $(".username").val());
            formData.append("password", $(".password").val());
            formData.append("picture", $(".pictured")[0].files[0]);
            formData.append("accion", "editar");
            $.ajax({
                type:"POST",
                url:"./Controlador/controladorUsuario.php",
                data: formData,
                dataType:"json",
                cache: false,
                contentType: false,
                processData: false,
            }).done(function( resultado ) {
                // console.log(resultado);
                if(resultado.respuesta){
					$('#actualizarform')[0].reset();
					$('#datosactualizar').modal('hide');
                    alertify.success("Datos actualizados!");  
                   dt.ajax.reload();
                } else {
                    alertify.error("Error al actualizar");  
                }
            });
        }
    }); 
}