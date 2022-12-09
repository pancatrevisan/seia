<!--modo athena: pagina inicial-->

<?php 
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 
    if(!defined('ROOTPATH')){
        require '../root.php';
    }

    require_once ROOTPATH . '/utils/checkUser.php';
    require_once ROOTPATH . '/ui/modal.php';
    checkUser(["professional","admin", "athena"], BASE_URL);

    $user_id = $_SESSION['username'];
?>

<div class="container" id="container-athena">
    <div class="header-titulo" id="modo-athena">        
        <div class="desenho-e-texto">
            <div class="texto">
                <h1>Modo athena</h1>

                <div class="barra-horizontal"></div>

                <p class="texto-conteudo">Visualize atividades criadas pela comunidade e adicione-as às suas atividades.</p>
            </div>

            <div class="desenho"><img src="/SEIA/media/vetores/pegasus.svg"></img></div>
        </div>
    </div>
</div>

<div class="corpo row mt-3 mb-3" id="athena">
    <div class="container">
            <div class="card-columns mt-3">
                <div class="card bg-secondary text-light" id="tutoEstudantes">
                    <a href="<?php echo BASE_URL;?>/athena/index.php?action=users" class="btn btn btn-block  btn-danger border border-dark">
                        <div class="card-body">
                            <div class="card-header">Usuários</div>
                            <p>Visualizar todos os usuários</p>
                        </div>
                        <img src="/SEIA/media/header/estudantes.svg">
                    </a>
                </div>                

                <div class="card bg-secondary text-light" id="tutoEstimulos">
                    <a  href="<?php echo BASE_URL; ?>/athena/index.php?action=stimuli" class="btn btn btn-block  btn-primary border border-dark">
                        <div class="card-body">
                            <div class="card-header">Estímulos</div>
                            <p>Visualizar estímulos cadastrados</p>
                        </div>
                        <img src="/SEIA/media/header/estimulos.svg">
                    </a>
                </div>                
                
                <div class="card bg-secondary text-light" id="tutoAtividades">
                    <a href="<?php echo BASE_URL ;?>/athena/index.php?action=viewUserActivities&user=ALL" class="btn btn btn-block  btn-warning border border-dark">
                        <div class="card-body">
                            <div class="card-header ">Atividades</div>
                            <p>Visualizar atividades cadastradas</p>
                        </div>
                        <img src="/SEIA/media/header/minhas_atividades.svg">
                    </a>
                </div>

                <div class="card bg-secondary text-light" id="tutoAtividades">
                    <a href="<?php echo BASE_URL ;?>/athena/index.php?action=viewUserStudents&user=ALL" class="btn btn btn-block  btn-success border border-dark">
                        <div class="card-body">
                            <div class="card-header">Estudantes</div>
                            <p>Visualizar estudantes cadastrados</p>
                        </div>
                        <img src="/SEIA/media/header/estudantes2.svg">
                    </a>
                </div>

                <div class="card bg-secondary text-light" id="tutoAtividades">
                    <a href="<?php echo BASE_URL ;?>/athena/index.php?action=generalStats" class="btn btn btn-block  btn-info border border-dark">
                        <div class="card-body">
                            <div class="card-header">Estatísticas gerais</div>
                            <p>Visualizar estatísticas</p>
                        </div>
                        <img src="/SEIA/media/header/estatisticas.svg">
                    </a>
                </div>               
            </div><!--card-columns-->
    </div>
</div>

    

    <div id='help'>
        <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()">
            <i class="fas fa-question"></i>
        </button>
    </div>
</div>