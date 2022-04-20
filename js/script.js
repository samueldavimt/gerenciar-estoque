formRegister = document.querySelector("#form-register")
formLogin = document.querySelector("#form-login")
formEditUser = document.querySelector("#form-edit")
message = document.querySelector("#register-message");

formResetPassword = document.querySelector("#form-reset-password")



function displayMessage(view=false, type="error", msg=""){

    if(view){
        message.style.maxHeight = 'none';
        message.style.opacity = '1';
    }else{
        message.style.maxHeight = '0px';
        message.style.opacity = '0';
    }

    if(type == 'success'){
        message.classList.remove("alert-danger");
        message.classList.add("alert-success");
    }else{

        message.classList.add("alert-danger");
        message.classList.remove("alert-success");
    }

    message.innerHTML = msg;


}

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
            displayMessage(true, 'error', data.error)

        }else{

            redirect = false

            if(data.response == "register success"){
                displayMessage(true, 'success', "Cadastro Efeituado com Sucesso!")
                redirect = true
    
            }else if(data.response == "login success"){
                displayMessage(true, 'success', "Login Efeituado com Sucesso!")
                redirect = true

            }else if(data.response == "edit account success"){
                displayMessage(true, 'success', "Conta Editada com Sucesso!")
                

            }

            if(redirect){
                setTimeout(()=>{
                    location.href = "index.php";
                },1000)
            }
        }
    })
    .catch(function(error){
        displayMessage(true, 'error', "Erro ao Enviar os dados! Tente Novamente.")
    })
}

