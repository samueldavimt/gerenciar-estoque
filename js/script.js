formRegister = document.querySelector("#form-register")
formLogin = document.querySelector("#form-login")
formEditUser = document.querySelector("#form-edit")
message = document.querySelector("#register-message");

formResetPassword = document.querySelector("#form-reset-password")

if(formResetPassword){
    
    formResetPassword.addEventListener('submit', function(e){
        e.preventDefault();
        message.style.maxHeight = 'none';
        message.style.opacity = '1';
        message.classList.add("alert-danger");
        message.classList.remove("alert-success");

        message.innerHTML = "Está Função não está Implementada";

        
    })
}

if(formEditUser){
    formEditUser.addEventListener('submit', function(e){
        e.preventDefault();
        AccountHandleAjax(e)
    })
}

if(formRegister){
    formRegister.addEventListener('submit', function(e){
        e.preventDefault();
        AccountHandleAjax(e)
    })
}

if(formLogin){
    formLogin.addEventListener('submit', function(e){
        e.preventDefault();
        AccountHandleAjax(e)
    })
    
}


function AccountHandleAjax(e){

    data = new FormData(e.currentTarget);
    
    fetch('account_action.php',{
        method: 'POST',
        body: data,

    })
    .then(res => res.json())
    .then(function(data){
        
        message.style.maxHeight = 'none';
        message.style.opacity = '1';

        if(data.error){
            message.classList.add("alert-danger");
            message.classList.remove("alert-success");
            message.innerHTML = data.error;

        }else{

            redirect = false

            message.classList.remove("alert-danger");
            message.classList.add("alert-success");

            if(data.response == "register success"){
                message.innerHTML = "Cadastro Efeituado com Sucesso!";
                redirect = true
    
            }else if(data.response == "login success"){
                message.innerHTML = "Login Efeituado com Sucesso!";
                redirect = true

            }else if(data.response == "edit account success"){
                message.innerHTML = "Conta Editada com Sucesso!";

            }

            if(redirect){
                setTimeout(()=>{
                    location.href = "index.php";
                },2000)
            }
        }
    })
    .catch(function(error){
       
        message.innerHTML = "Erro ao Enviar os dados! Tente Novamente."
    })
}