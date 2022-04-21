
createSection = document.querySelector("#form-create-section");

if(createSection){

    createSection.addEventListener('submit', function(e){
        e.preventDefault();
        SectionHandleAjax(e)
    
    })
}

function SectionHandleAjax(e){

    data = new FormData(e.currentTarget);

    fetch('section_process.php',{

        method: 'POST',
        body: data
    }).then(res => res.json()).then(function(data){

        if(data.error){
            displayMessage(true, 'error', data.error)
            console.log(data.error)
        }else{

            if(data.response == "create success"){
                displayMessage(true, 'success', "Sessão Criada com Sucesso!")
                addSections()
            }
        }

    }).catch(function(error){
        displayMessage(true, 'error', "Erro ao Enviar os dados! Tente Novamente.")
        
    })
}

function addSections(){

    containerSections = document.querySelector(".container-sections")


    data = new FormData()
    data.append("type", "all")

    fetch("section_process.php",{

        method: "POST",
        body: data

    }).then(res => res.json())
    .then(function(data){

        if(data.error){
            displayMessage(true, "error", "Erro ao Carregar Sessões! Tente Novamente!")
        }else{
            containerSections.innerHTML = ""
            data.response.forEach(data=>{

                section = document.querySelector(".card.section").cloneNode(true)
                section.style.display = "block";

                if(data.image == ""){
                    data.image = 'default-sections.jpg'
                }
                section.querySelector("img").src = "images/sections/" + data.image

                section.querySelector(".card-title").innerHTML = data.name
                section.querySelector(".card-text").innerHTML = data.description

                section.querySelector("a").href = "section.php?id=" + data.id  


                containerSections.appendChild(section);
            })
        }

    }).catch(function(){
        displayMessage(true, "error", "Erro ao Carregar Sessões! Tente Novamente!")
    })


}




function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(';');
    for(let i = 0; i <ca.length; i++) {
      let c = ca[i];
      while (c.charAt(0) == ' ') {
        c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
        return c.substring(name.length, c.length);
      }
    }
    return "";
}

