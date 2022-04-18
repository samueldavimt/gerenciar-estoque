formRegister = document.querySelector("#form-register")
formLogin = document.querySelector("#form-login")


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
    message = document.querySelector("#register-message");

    
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

        }else if(data.response == "register success"){
            message.innerHTML = "Cadastro Efeituado com Sucesso!";
            message.classList.remove("alert-danger");
            message.classList.add("alert-success");

            setTimeout(()=>{
                location.href = "index.php";
            },1000)

        }else if(data.response == "login success"){
            message.innerHTML = "Login Efeituado com Sucesso!";
            message.classList.remove("alert-danger");
            message.classList.add("alert-success");

            setTimeout(()=>{
                location.href = "index.php";
            },1000)
        }
    })
    .catch(function(error){
       
        message.innerHTML = "Erro ao Enviar os dados! Tente Novamente."
    })
}