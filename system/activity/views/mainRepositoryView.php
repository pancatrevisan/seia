<?php

    if(!isset($_SESSION)) 
    { 
        session_start(); 
    } 

    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    
    require_once ROOTPATH . '/utils/checkUser.php';

    checkUser(["admin","professional"], BASE_URL);

    require ROOTPATH . "/ui/modal.php";

    $filter_value = "";

    isset($data['rep'])? $repository = $data['rep']: $repository = 'false';

    if(isset($data['query']) && strlen($data['query']) >0){
        $filter_value=$data['query'];
    }
    $me = $_SESSION['username'];

    $DIFFICULTY = ["NOT_RATED"=>"Não avaliado", "EASY"=> "Fácil", "MEDIUM"=>"Médio","HARD"=>"Difícil"];

?>

<script>
    /*
    setInterval(function(){ 
        window.dispatchEvent(new Event('resize'));
    }, 1000);
    */  
    function mobileAndTabletcheck() {
        var check = false;
        (function (a) {
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(a) || /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(a.substr(0, 4)))
                check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
    }
        var tuto_finished = "<?php echo $_SESSION['tuto_finished'];?>" == "1" ;
        function askToPerformTour(){
            if(mobileAndTabletcheck()){
                alert("A criação de atividades deve ser feita utilizando um computador/notebook :)");
                return;
            }
            var steps = [
            {'click #tutoNovaAtividade': "Clique aqui para inserir uma nova atividade. A atividade pode ser usada em diferentes programas de ensino e sessões.",
                'nextButton' :{className: "d-none"},
                "skipButton" : {className: "d-none"}
            }
        ];  
        
        var hint = new EnjoyHint();
        hint.set(steps);
        hint.run();
    }
    document.body.onload=function(){
        if(!tuto_finished)
        askToPerformTour();
    };
</script>

<script> 
  
    function showHelp(){
        var content = '<iframe width="560" height="315" src="https://www.youtube.com/embed/Kwjmb7Za6yI" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        showModal("Ajuda",content);
    }
  
</script>

<?php if($repository=='true'){?>

    <div class="container">

        <div class="header-titulo" id="rep-atv">

            <div class="desenho-e-texto">

                <div class="texto">

                    <h1>Repositório de atividades</h1>

                    <div class="barra-horizontal"></div>

                    <p class="texto-conteudo">Visualize atividades criadas pela comunidade e adicione-as às suas atividades.</p>

                </div>

                <div class="desenho"><img src="/SEIA/media/vetores/rep_atv.svg"></img></div>

            </div>

        </div>

    </div><!--container-->

<?php } ?>

<div class="corpo">

    <div class="barra-pesquisa">

        <ul class="dropdown-search">
            <a><li id="dropwdownTrigger">
                <p>
                    <img src="/SEIA/media/barra_pesquisa/triangulo_arredondado_branco.svg"  class="icone-branco">Ver opções
                </p>

                <ul id="dropdown-opcoes">

                    <a id="tutoNovaAtividade"class="btn btn-warning btn-lg btn-block border-dark text-white" href="index.php?action=new">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg" class="icone-branco">
                                Nova atividade
                            </p>
                        </li>
                    </a>

                    <a id="fechar-dropdown" onclick="fecharDropdown()">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">Fechar
                            </p>
                        </li>
                    </a>
                </ul>

            </li></a>
        </ul>

        <!-- filtrar -->    
                                
        <form autocomplete="off" class="form mt-1" action="index.php?action=filter_form" method="post">
            <input hidden id="rep" name="rep" type="rep" value="<?php echo $repository?>">

            <div class="form-group" id="pesquisar">
                <button type="submit" class="btn btn-outline-success form-control">
                    <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                </button>

                <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="PESQUISE POR ATIVIDADES" aria-label="Search" value="">
            </div>
                                        
        </form>
                            
    </div><!--barra-pesquisa-->

                    <!--div class="row mt-3">
                        <div class="col">

                            <h3> <a id="tutoNovaAtividade"class="btn btn-warning btn-lg btn-block border-dark text-white" href="index.php?action=new">Nova atividade </a></h3>

                        </div>
                        <div class="col">
                            <h3> <a class="btn btn-warning btn-lg btn-block border-dark text-white " href="index.php?action=repository">Buscar no repositório</a></h3>

                        </div>
                    </div>
                    
                    <div class="row mt-4">
                        <div class="col">
                            <form autocomplete="off" class="form mt-1" action="index.php?action=filter_form" method="post">
                                <input hidden id="rep" name="rep" type="rep" value="<?php echo $repository?>">
                                <div class="form-row">
                                    <div class="form-group col-md-11">
                                        <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="Filtrar" aria-label="Search" value="">
                                    </div>
                                    <div class="form-group col-md-1">
                                        <button type="submit" class="btn btn-outline-success form-control">
                                            <i class="fas fa-search"></i> 
                                        </button>

                                    </div>
                                </div> 
                                
                            </form>
                        </div>
                    </div-->
                    
                    
                    <!-- resultados -->
                    
        <div class="card-columns">

            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $_SESSION['username'];
                if($repository=='true'){
                    $user_id = '_REPOSITORY';
                }
                $query = "";

                $SQL = "SELECT COUNT(*) AS total  FROM activity WHERE owner_id ='$user_id' AND active='1' AND auto='0' AND auto_guide='0' AND NOT category LIKE '%reinforcement%' AND NOT category LIKE '%template%'";

                if(isset($data['query'])){

                    $query = $data['query'];

                    $SQL = $SQL. " AND ".
                        "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%' OR category LIKE '%$query%')";
                }

                $num_res = $db->query($SQL);
                        
                $num_res = mysqli_fetch_assoc($num_res);
                $num_res = $num_res['total'];
                $results_per_page = 12;
                $num_pages = intdiv($num_res , $results_per_page);
                if( ($num_pages * $results_per_page) < $num_res || $num_pages==0)
                    $num_pages += 1;

                ///gets results.
                $s_page = $data['page']-1;
                if($s_page < 0){
                    $s_page = 0;
                }

                $offset = $s_page * $results_per_page;
                $limit  = $results_per_page;

                $SQL = "SELECT * FROM activity WHERE owner_id ='$user_id' AND active=1 AND auto=FALSE AND auto_guide=FALSE   AND NOT category LIKE '%reinforcement%' AND NOT category LIKE '%template%' LIMIT $limit OFFSET  $offset";

                if(isset($data['query'])){

                    $query = $data['query'];
                    $SQL = "SELECT * FROM activity WHERE owner_id ='$user_id' AND active=1 AND auto=FALSE AND auto_guide=FALSE AND NOT category LIKE '%reinforcement%' AND NOT category LIKE '%template%'";
                    $SQL = $SQL. " AND ".
                    "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%' OR category LIKE '%$query%') LIMIT  $limit OFFSET  $offset";
                }
                $res = $db->query($SQL);
            ?>

            <?php
                while($fetch = mysqli_fetch_assoc($res)) { 
            ?>
                    
            <div class="card text-white bg-warning border-dark" id="<?php echo $fetch['id'];?>">
                <div class="card-img-top rounded img-thumbnail">
                    <div class="filtro"></div>
                    <img src="<?php 
                        require_once ROOTPATH . '/activity/ActivityController.php';
                        $ac = new ActivityController();
                            if($fetch['owner_id']=='_REPOSITORY'){
                                echo $ac->getThumbnail(['id'=>$fetch['id'],'rep'=>true]);
                            }
                            else
                                echo $ac->getThumbnail(['id'=>$fetch['id']]);
                    ?>">
                </div>
                                
                <h4 class="card-header border-dark">
                    <p class="titulo-card"><?php echo $fetch['name'];?></p>

                    <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                    </div>

                    <div class="container-fluid">

                        <div class="conteudo-vermais">
                            <div class="row">
                                <?php if($repository=='false'){ ?>
                                            
                                    <a href="index.php?action=edit&id=<?php echo $fetch['id'];?>" class="btn btn-block btn-dark">
                                        <p><img src="/SEIA/media/icones/editar.svg">Editar</p>
                                    </a>

                                    <a href="#" class="btn btn-block btn-dark" onclick="removeActivity('<?php echo $fetch['id'];?>')">
                                        <p><img src="/SEIA/media/icones/excluir.svg">Excluir</p>
                                    </a>

                                <?php } else { ?>

                                    <a href="index.php?action=run&id=<?php echo $fetch['id'];?>" class="btn btn-block btn-dark">
                                        <p><img src="/SEIA/media/icones/minhas_atividades.svg">Visualizar</p>
                                    </a>

                                <?php } ?>
                            </div>

                            <div class="row mt-1">
                                <?php if($repository=='true'){ ?>
                                    <a href="#" class="btn btn-block btn-dark" onclick="askToCopy('<?php echo $fetch['id'];?>')">
                                        <p><img src="/SEIA/media/icones/copiar.svg">Copiar para suas atividades</p>
                                    </a>
                                                
                                <?php } else { ?>
                                    <a href="#" class="btn btn-block btn-dark" onclick="askToMakePublic('<?php echo $fetch['id'];?>')">
                                        <p><img src="/SEIA/media/icones/copiar.svg">Disponibilizar para o público</p>
                                    </a>

                                <?php
                                    }
                                ?>
                            </div>                                    

                            <a id="verMaisCancelar" onclick="fechaOpcoes('<?php echo $fetch['id'];?>')">
                                <p><img src="/SEIA/media/icones/cancelar.svg">Cancelar</p>
                            </a>
                        </div>

                    </div><!--container-fluid-->
                </h4>

                <div class="card-body">                                 
                                 
                    <!--<h4 class="card-text">Antecedente</h4>
                    <p class="card-text"><?php echo $fetch['antecedent'];?></p>
                                 
                    <h4 class="card-text">Comportamento Esperado</h4>
                        <p class="card-text"><?php echo $fetch['behavior'];?></p>
                    <h4 class="card-text">Consequência</h4>
                    <p class="card-text"><?php echo $fetch['consequence'];?></p> 
                                    
                    <cite class="card-text"><?php echo $fetch['category'];?></cite>-->

                    <span class="badge badge-secondary"><?php echo $DIFFICULTY[$fetch['difficulty']];?></span>                                    
                </div>
            </div><!--card-->

            <?php
                }
            ?>
        </div><!--card-columns-->

        <!--pagination -->
        <div class="conteiner-pagination">                        
            
            <ul class="pagination">
                <!--botton previous -->

                <?php
                    if($data['page']==0) {
                        $data['page']=1;
                    }

                    if ($num_pages <= 1) {
                ?>
    
                    <a class="page-link" href="#">
                        <li class="voltar-avancar">                
                            <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                        </li>
                    </a>
                        
                    <a class="page-link" href="#"><li class="page-item disabled">1</li></a>
                        
                    <a class="page-link" href="#">
                        <li class="voltar-avancar">                
                            <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>
                        </li>
                    </a>
    
                <?php } else { if (($data['page'] - 1) <= 0) { ?>
                                
                    <a class="page-link" href="#">
                        <li class="voltar-avancar">                            
                            <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                        </li>
                    </a>
                                
                <?php } else { ?>
    
                    <a class="page-link" href="index.php?action=repository&page=<?php echo ($data['page'] - 1); ?>">
                        <li class="voltar-avancar">                            
                            <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                        </li>
                    </a>
    
                <?php } /* listing */

                    $i = 0;

                    for ($i = (($data['page'] - 6)); $i < (($data['page'] + 5)); $i++) {
                        if (($data['page'] - 1) == $i) {
                            //curr page
                ?>
                    
                    <a class="page-link" href="#"><li class="page-item disabled"><?php echo ($i + 1); ?></li></a>

                <?php } else {
                    if ($i >= 0 && $i <= (($num_pages)-1)) {
                ?>

                    <a class="page-link" href="index.php?action=repository&page=<?php echo ($i + 1); ?>"><li class="page-item"><?php echo ($i + 1); ?></li></a>

                <?php
                            }
                        }
                    }
                ?>
                                
                <?php /*botton next*/
                    if (($data['page']) >= $num_pages) {
                ?>

                    <a class="page-link" href="#">
                        <li class="voltar-avancar">                            
                            <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>
                        </li>
                    </a>

                <?php } else { ?>

                    <a class="page-link" href="index.php?action=repository&page=<?php echo ($data['page'] + 1); ?>">
                        <li class="voltar-avancar">                            
                            <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>
                        </li>
                    </a>

                <?php 
                        }
                    }
                ?>
            </ul>
                
        </div><!--conteiner pagination-->

    <div id='help'>
        <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()"><i class="fas fa-question"></i></button>
    </div>

</div><!--corpo-->

<script>
    function askToCopy(id){
        showModal("Adicionar às suas atividades?","A atividade será adicionada às suas atividades e você poderá utilizá-la nas programações de ensino.", function(){
                
                console.log("send http");
                var xhr = new XMLHttpRequest();
                
                xhr.onreadystatechange = function () {
                    if (this.readyState != 4) return;

                    if (this.status == 200) {
                        var data = this.responseText;// JSON.parse(this.responseText);

                    console.log("Retorno: "+data);
                        closeModal();
                    }

                
                };
                
                xhr.open("POST", '<?php echo BASE_URL;?>/activity/index.php?action=copyActivity', true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

                var url ='source_user=_REPOSITORY&dest_user=<?php echo $me;?>&id='+id;
                xhr.send(url);
            },true); 
    }
    function askToMakePublic(id){

        showModal("Disaponibilizar esta atividade?","Uma cópia da atividade será disponibilizada para os outros usuários.", function(){
                
                console.log("send http");
                var xhr = new XMLHttpRequest();
                
                xhr.onreadystatechange = function () {
                    if (this.readyState != 4) return;

                    if (this.status == 200) {
                        var data = this.responseText;// JSON.parse(this.responseText);
                        console.log("Retorno: "+data);
                        closeModal();
                    }

                
                };
                
                xhr.open("POST", '<?php echo BASE_URL;?>/activity/index.php?action=copyActivity', true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");

                var url ='source_user=<?php echo $me;?>&dest_user=_REPOSITORY&id='+id;
                xhr.send(url);
            },true); 
        
    }
        function removeActivity(id){
            
            showModal("Remover Atividade?","Isso não poderá ser desfeito. A atividade continuará a existir em programas de ensino existentes, mas não aparecerá mais neste lista.", function(){
                
                console.log("send http");
                var xhr = new XMLHttpRequest();
                
                xhr.onreadystatechange = function () {
                    if (this.readyState != 4) return;

                    if (this.status == 200) {
                        var data = this.responseText;// JSON.parse(this.responseText);
                        var el = document.getElementById(data);
                        el.parentNode.removeChild(el);
                        closeModal();
                    }

                
                };
                
                xhr.open("POST", '<?php echo BASE_URL;?>/activity/index.php?action=removeActivity', true);
                xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
                var url ='activityId='+id+"&page="+<?php echo $data['page'];?>;
                
                var query = "<?php echo $query;?>";
                
                url = url + "&query="+ query;
                xhr.send(url);
            },true);   
        }
</script>