



document.querySelector(".btn-send-contact").addEventListener("click", (e)=>{
    e.preventDefault();

    const btn_send = document.querySelector("#cont-send");
    const btn_sending = document.querySelector("#cont-sending");

    const name = document.querySelector("#name").value;
    const email = document.querySelector("#email").value;
    const message = document.querySelector("#message").value;

    if(name == "" || email == "" || message == ""){
        Swal.fire('Error!','Debe llenar todos los datos para continuar','error');
        return false;
    }


    const parameters = {
        name: name,
        email: email,
        message: message
    }

    new Promise((resolve, reject) => {
        $.ajax({
            data: parameters,
            url: "./includes/send_contact.inc.php",
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            beforeSend:function(){
                btn_send.style.display = 'none';
                btn_sending.style.display = 'block';
            },
            success:function(response){
                resolve(response);
            }
        })
    }).then((res) => {
        if(res == 'success'){
            Swal.fire('Contacto','correo enviado correctamente','success');
            document.querySelector("#name").value = '';
            document.querySelector("#email").value = '';
            document.querySelector("#message").value = '';
        }else{
            Swal.fire('Error!','Error intente mas tarde','error');
        }
        btn_send.style.display = 'block';
        btn_sending.style.display = 'none';
    })




})