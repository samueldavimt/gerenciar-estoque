formRegister = document.querySelector("#form-register")

formRegister.addEventListener('submit', function(e){
    e.preventDefault();
    RegisterAjax(e)
})

function RegisterAjax(e){

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

        }else if(data.response == true){
            message.innerHTML = "Cadastro Efeituado com Sucesso!";
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