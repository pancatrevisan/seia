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

<!-- Menu-->

<body>

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
                <a type="button" href="<?php echo BASE_URL;?>/auth/index.php?action=changeProfile">
                    <li>
                        <button onclick='selectAvatar()' class="mt-1 btn btn-danger btn-lg btn-block border border-dark" type="button">
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

    <button id="goBack" onclick="goBack()"><img src="/SEIA/media/icones/voltar.svg"></button>

    <script>
        function mobileAndTabletcheck() {
            var check = false;
            (function (a) {
                if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                    check = true;
            })(navigator.userAgent || navigator.vendor || window.opera);
            return check;
        }
            function askToPerformTour(){
                if(mobileAndTabletcheck()){
                    alert("A criação de atividades deve ser feita utilizando um computador/notebook :)");
                    return;
                }
                var steps = [
                {'click #tutoAtividades': "Aqui é possível visualizar, editar e criar novas atividades",
                    'nextButton' :{'text':'Próximo'},
                    "skipButton" : {className: "d-none"}
                }
            ];  
            
            var hint = new EnjoyHint();
            hint.set(steps);
            hint.run();
        }
    </script>

<!-- Menu -->