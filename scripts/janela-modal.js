function janelaModal() { 
 
    let modal = document.querySelector('.modal'); 
    let fundo = document.querySelector('.fundo-escuro'); 
    let menuUser = document.querySelector('#menu-usuario'); 
    let containerModal = document.querySelector('.conteiner-modal'); 
 
    modal.style.display = 'block'; 
    fundo.style.display = 'block'; 
    menuUser.style.display = 'none'; 
    containerModal.style.display = "flex"; 
 
}   
 
function fecharModal() { 
    let modal = document.querySelector('.modal'); 
    let fundo = document.querySelector('.fundo-escuro'); 
    let containerModal = document.querySelector('.conteiner-modal'); 
 
    modal.style.display = 'none'; 
    fundo.style.display = 'none'; 
    containerModal.style.display = "none"; 
}
 
/*exibe o menu do usuario*/ 
 
    function exibirMenu() { 
        let modal = document.querySelector('#menu-usuario'); 
        let fundo = document.querySelector('.fundo-escuro'); 
 
        modal.style.display = 'flex'; 
        fundo.style.display = 'block'; 
    } 
 
    function fecharMenu() { 
        let modal = document.querySelector('#menu-usuario'); 
        let fundo = document.querySelector('.fundo-escuro'); 
         
        modal.style.display = 'none'; 
        fundo.style.display = 'none'; 
    }

/*exibe as opcoes de cada card*/

    function mostraOpcoes(id){
        var div = window.document.getElementById(id).querySelector(".container-fluid");
        var content = window.document.getElementById(id).querySelector(".conteudo-vermais");
        var gatilho = window.document.getElementById(id).querySelector(".ver-mais");
        var fechar = window.document.getElementById(id).querySelector("#verMaisCancelar");
        var largura = window.screen.width;
        var altura = window.screen.height;

        if (largura < 999) {            
            div.style.display = "flex";
            div.style.width = "100vw";
            div.style.margin = "0";
            div.style.position = "fixed";
            div.style.overflow = "hidden";
            div.style.height = "100%";
            div.style.top = "0";
            div.style.left = "0";
            div.style.zIndex = "3";
            div.style.background = "rgba(34, 73, 156, 0.7)";
            content.style.boxShadow = "0px -3px 25px 0px #0e1a35";
            content.style.position = "absolute";
            content.style.width = "100%";
            content.style.margin = "0";
            content.style.bottom = "0";
            content.style.background ="#eceff5";

            div.addEventListener("click", function(){div.style.display="none";});
        }
        else {
            div.style.display = "flex";
        }        
    }

    function fechaOpcoes(id){
        var div = window.document.getElementById(id).querySelector(".container-fluid");
        var gatilho = window.document.getElementById(id).querySelector(".ver-mais");
        var fechar = window.document.getElementById(id).querySelector("#verMaisCancelar");

        div.style.display = "none";
    }

/*volta para a página anterior*/

    function goBack() {window.history.back();}