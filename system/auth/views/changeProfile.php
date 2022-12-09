<!--pagina para definir nova senha-->

<?php
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    $sel_lang = "ptb";
    require ROOTPATH . '/lang/' . $sel_lang . "/auth/login.php";

?>

<!DOCTYPE html>
<html lang="ptb">
    <head>
        <title><?php echo $data['page_title']; ?></title>
        <link rel="shortcut icon" href="/SEIA/media/icone_seia.svg"></link>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link href="<?php echo BASE_URL;?>/external/enjoyhint/enjoyhint.css" rel="stylesheet">
        <link rel="stylesheet" href="/SEIA/style/header.css">
        <link rel="stylesheet" href="/SEIA/style/janela-modal.css">
        <link rel="stylesheet" href="/SEIA/style/menu-usuario.css">
        <link rel="stylesheet" href="/SEIA/style/body.css">
        <link rel="stylesheet" href="/SEIA/style/area-titulo.css">
        <link rel="stylesheet" href="/SEIA/style/cards.css">
        <link rel="stylesheet" href="/SEIA/style/numero-pagina.css">
        <link rel="stylesheet" href="/SEIA/style/responsivo.css">
        <link rel="stylesheet" href="/SEIA/style/animacoes.css">
        <!--<link rel="stylesheet" href="<?php echo BASE_URL;?>/activity/views/paper.css">
        <link rel="stylesheet" href="<?php echo BASE_URL;?>/external/bootstrap.min.css">
        <link rel="shortcut icon" href="<?php echo BASE_URL;?>/ui/favicon.ico" />-->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Righteous&display=swap" rel="stylesheet">
        <script src="/SEIA/scripts/mobile-navbar.js"></script>
        <script src="/SEIA/scripts/mostrar_senha.js"></script>
        <script src="/SEIA/scripts/janela-modal.js"></script>
        <script src="/SEIA/scripts/dropdown-search.js"></script>
        <script src="<?php echo BASE_URL;?>/external/jquery.min.js"></script>
        <script src="<?php echo BASE_URL;?>/external/popper.min.js"></script>
        <script src="<?php echo BASE_URL;?>/external/bootstrap.min.js"></script>
        <script  src="<?php echo BASE_URL;?>/external/face-api.js"></script>  
        <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vfl2dBoXz/www-widgetapi.js" async=""></script>  
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="<?php echo BASE_URL;?>/external/enjoyhint/enjoyhint.js"></script>
    </head>

    <body>

    <?php 
        if(!isset($_SESSION)) 
        { 
            session_start(); 
        } 
        $sel_lang = "ptb";
        if(!defined('ROOTPATH')){
            require '../root.php';
        }
        require ROOTPATH . '/lang/' . $sel_lang . "/menu.php";
        require_once ROOTPATH . '/utils/GetData.php';


        require_once ROOTPATH . '/utils/checkUser.php';
        checkUser(["professional","admin","student"], BASE_URL);


        $user_id = $_SESSION['username'];
    ?>

<!-- Menu bts-->

<div id="menu-usuario">

    <nav>

        <div class="fechar-modal" onclick="fecharMenu()">
            <img src="/SEIA/media/icones/cancelar_branco.svg"></img>
        </div>

        <div class="area-img-user">
            <div class="img-user">
                <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/user/<?php echo $user_id;?>/avatar.png">
            </div>
        </div>

        <p><?php echo $user_id;?></p>

        <ul>
            <a href="<?php echo BASE_URL;?>/ui/mudar_foto_perfil.php?action=changeProfile" type="button">
                <li>
                    <button class=" mt-1 btn btn-danger btn-lg btn-block border border-dark "type="button">
                        <img src="/SEIA/media/menu_usuario/camera_fotografica.svg">
                        Mudar foto de perfil
                    </button>
                </li>
            </a>

            <a href="<?php echo BASE_URL;?>/auth/index.php?action=changePassword" type="button">                
                <li><img src="/SEIA/media/menu_usuario/configuracoes.svg">Alterar senha</li>
            </a>

            <a href="<?php echo BASE_URL;?>/auth/index.php?action=logout" type="button">
                <li><img src="/SEIA/media/menu_usuario/logout.svg">Sair</li>
            </a>
        </ul>

    </nav>

</div><!--menu-usuario-->

<div class="fundo-escuro" onclick="fecharMenu()"></div>

<header id="header-normal" class="menu">

    <!--<nav>

        <<button id="UIMenu" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarToggleExternalContent" aria-controls="navbarToggleExternalContent" aria-expanded="false" aria-label="Toggle navigation">
            <span></span>Menu
        </button>

    </nav>-->    

    <nav><!-- Links -->

        <img class="logo" src="/SEIA/media/icone_seia_branco.svg"></img>

        <div class="mobile-menu" onclick="menuNavbar()">
            <div class="line1"></div>
            <div class="line2"></div>
            <div class="line3"></div>
        </div>  

        <div class="menuX" onclick="fechaMenuNavbar()">
            <div class="line21"></div>
            <div class="line22"></div>
        </div>

        <ul class="menu-links">

            <a href="<?php echo BASE_URL . "/professional";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/inicio_branco.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/inicio_azul.svg"></img>
                    <p>Início</p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/activity";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/minhas_atividades.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/minhas_atividades_azul.svg"></img>
                    <p><?php echo $lang["activities"];?></p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/stimuli";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/estimulos.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/estimulos_azul.svg"></img>
                    <p><?php echo $lang["stimuli"];?></p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/professional?action=student";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/estudantes.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/estudantes_azul.svg"></img>
                    <p><?php echo $lang["students"];?></p>
                </li>
            </a>
                        
            <a href="<?php echo BASE_URL . "/activity/index.php?action=reinforcementIndex";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/reforcos.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/reforcos_azul.svg"></img>
                    <p><?php echo $lang["reforcos"];?></p>
                </li>
            </a>

            <a href="<?php echo BASE_URL . "/activity/index.php?action=userTemplateIndex";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/lampada_branco.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/lampada_azul.svg"></img>
                    <p>Meus Templates</p>
                </li>
            </a>
            
            <!--repositorio-->
            <a href="<?php echo BASE_URL . "/activity/index.php?action=userTemplateIndex";?>">
                <li>
                    <img class="icone-branco" src="/SEIA/media/header/repositorio.svg"></img>
                    <img class="icone-azul" src="/SEIA/media/header/repositorio_azul.svg"></img>
                    <p>Repositório</p>
                </li>
            </a>

        </ul>

        <div class="icone-usuario" onclick="exibirMenu()">

            <div class="mais-usuario">
                <div class="bolinha"></div>
                <div class="bolinha"></div>
                <div class="bolinha"></div>
            </div>

            <a>
                <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/user/<?php echo $user_id;?>/avatar.png">
            </a>
            
        </div>

    </nav>

</header>

        <div class="col corpo">    
                
                <div class="titulo-pagina">
                    <h1>Nova senha</h1>
                    <div class="texto"><div class="barra-horizontal"></div></div>
                </div><!--titulo-pagina-->
                
            <div class="container">
                
                <div class="container-senha">
                    <form action="index.php?action=setNewPass" method="post" onsubmit="return checkPass()"  >

                        <div class="form-group">
                            <label for="new_pass">Nova senha</label>
                            <input type="password" required class="form-control" id="new_pass" name="new_pass">
                        </div>

                        <div class="form-group">
                            <label for="confirm_pass">Confirme a nova senha</label>
                            <input type="password"  required class="form-control" id="confirm_pass" name="confirm_pass">
                        </div>        

                        <div class="container-botao">
                            <button type="submit" class="btn btn-primary btn-lg btn-block botao_cadastrar"><p>Alterar Senha</p></button>
                        </div>

                    </form>
                </div><!--container-senha-->

            </div><!--container-->
        </div><!--corpo-->

        <footer>

            <h2>Este sistema está em desenvolvimento na Universidade Federal do ABC. Esta é a versão de testes.</h2>

            <h3>Contatos referentes ao:</h3>

            <div>
            
            <div class="contato">
                <h3>
                <p>Código-fonte:</p>
                <div class="barra-horizontal"></div>
                </h3>

                <p>trevisandiogo@gmail.com</p>
                <p>joao.gois@ufabc.edu.br</p>
            </div>

            <div class="contato">
                <h3>
                <p>Conteúdo educacional e comportamental:</p>
                <div class="barra-horizontal"></div>
                </h3>
                <p>priscila.benitez@ufabc.edu.br</p>
            </div>

            </div>

            <div>
            <h2>
                <p>Projeto financiado pela Fundação de Amparo à Pesquisa do Estado de São Paulo - FAPESP.</p>
                <p>(proc. no. 2019/25795-2)</p>
            </h2>
            </div>

        </footer>

        <script>
            function checkPass(){
                console.log("Check");
                var pass1 = document.getElementById("new_pass").value;
                var pass2 = document.getElementById("confirm_pass").value;

                if(pass1==pass2)
                    return true;
                else{ 
                    alert("As senhas não são iguais!");
                    return false;
                }
                
            }
        </script>

    </body>
</html>

    <!--script>
        
        /* setInterval(function(){ 
            console.log("evento");
            window.dispatchEvent(new Event('resize'));
        }, 1000);*/

        var modal_loadFile = function (event) {
            var inpt = document.getElementById('inp_fileName');
            var file = event.target.files[0];
            var fileURL = URL.createObjectURL(file);

            inpt.value = file.name;
            var type = file.type
            console.log("type: " + type);

            var preview = document.getElementById("preview");

            if (type.startsWith("image")) {
                var media = document.createElement("img");
                media.classList.add("img-fluid");
                media.classList.add("rounded");
                media.classList.add("mx-auto");
                media.classList.add("d-block");


                media.src = fileURL;
                preview.innerHTML = "";
                preview.appendChild(media);
            }
            
        };
        
        var modal_addImage = function(event){
            
            var form = document.getElementById('newAvatar');
            
            let req = new XMLHttpRequest();
            let formData = new FormData(document.getElementById('newAvatar'));
            req.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                    if(this.responseText == "AVATAR_SWAP"){
                        location.reload();
    
                    }
                    else
                        console.log("Não funcionou :( ");
                }
            };
            var url = "<?php echo BASE_URL . '/professional/index.php?action=changeAvatar'; ?> ";
            req.open("POST", url);
            req.send(formData);
        }
        
        function selectAvatar(){
            var content = document.getElementById('swapAvatarTemplate').cloneNode(true);
            content.id = "newAvatar";
            content.classList.remove('d-none');
            showModal("Selecione o avatar", content, function () {
                modal_addImage();
            }, true);
            
        }
    </script>

    <form hidden id="swapAvatarTemplate" class="d-none" enctype="multipart/form-data" autocomplete="off" action="" method="post">
    
        <div class="input-group mb-3">
            <input name="student_id" id="student_id" type="text" hidden value="<?php echo $student_data['id'];?>">
            <input required name="stimuli_file" id="stimuli_image" onchange="modal_loadFile(event)" class="inputFile" accept="image/*" type="file" style="display: none;">

            <div class="input-group-prepend">
                <button  onclick="document.querySelector('#stimuli_image').click();"class="btn btn-outline-secondary" type="button">Selecionar arquivo</button>
            </div>

            <input id="inp_fileName" type="text" readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">

        </div>

        <div class="container" id="preview"></div>

        <div class="modal-footer">
            <button id="modal-accept" type="button" class="btn btn-primary">Confirmar</button>
        </div>
    </form>