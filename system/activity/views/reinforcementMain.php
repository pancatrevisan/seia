<!--pagina listando as consequências-->

<?php

    if (!isset($_SESSION)) {
        session_start();
    }
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }
    require ROOTPATH . "/ui/modal.php";
    require_once ROOTPATH . "/utils/checkUser.php";


    $filter_value = "";

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }

    checkUser(["admin", "professional"], BASE_URL);

?>

<div class="container">

    <div class="header-titulo" id="reforcos">

        <div class="desenho-e-texto">

            <div class="texto">

                <h1>Consequências</h1>

                <div class="barra-horizontal"></div>

                <p class="texto-conteudo">Crie ou edite suas Consequências, ou aquelas adicionadas do Repositório.</p>

            </div>

            <div class="desenho"><img src="/SEIA/media/vetores/reforcos.svg"></img></div>

        </div>

    </div>

</div><!--container-->

<div class="corpo">

    <div class="barra-pesquisa">

        <ul class="dropdown-search">
            <a><li id="dropwdownTrigger">
                <p>
                    <img src="/SEIA/media/barra_pesquisa/triangulo_arredondado_branco.svg" class="icone-branco">Ver opções
                </p>

                <ul id="dropdown-opcoes">

                    <a id="tutoNovaAtividade"class="btn btn-warning btn-lg btn-block border-dark text-white" href="index.php?action=new">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">
                                <span>Nova consequência</span>
                            </p>
                        </li>
                    </a>

                    <a href="index.php?action=repository">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/repositorio_branco.svg" class="icone-branco">
                                <span>Buscar no repositório</span>
                            </p>
                        </li>
                    </a>

                    <a id="fechar-dropdown" onclick="fecharDropdown()">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">
                                <span>Fechar</span>
                            </p>
                        </li>
                    </a>
                </ul>

            </li></a>
        </ul>

        <!-- filtrar -->    
                                
        <form autocomplete="off" class="form mt-1" action="index.php?action=reinforcementIndex" method="post">
            <input hidden id="rep" name="rep" type="rep"  value="<?php echo $repository?>">

            <div class="form-group" id="pesquisar">
                <button type="submit" class="btn btn-outline-success form-control">
                    <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                </button> 

                <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="PESQUISE POR CONSEQUÊNCIAS" aria-label="Search" value="">
            </div>
                                        
        </form>
                        
    </div><!--barra-pesquisa-->  
    
    <!-- resultados -->
    <div class="card-columns" id="cards-reforcos">
    
        <?php

            require_once ROOTPATH . '/utils/DBAccess.php';
            $SQL = "";
            $db = new DBAccess();
            $user_id = $_SESSION['username'];
            $query = $data['query'];

            $SQL = "SELECT COUNT(*) AS total  FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub') AND category LIKE '%reinforcement%' AND NOT category LIKE '%template%' AND active=1";


            if (isset($data['query'])) {

                $query = $data['query'];
                $SQL = $SQL . " AND " .
                    "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%')";
            }

            $num_res = $db->query($SQL);
            $num_res = mysqli_fetch_assoc($num_res);
            $num_res = $num_res['total'];
            $results_per_page = 12;
            $num_pages = intdiv($num_res, $results_per_page);
            
                if (($num_pages * $results_per_page) < $num_res)
                    $num_pages = $num_pages + 1;
                //echo "num res: $num_res num pages? $num_pages <br>";

                ///gets results.
                    $s_page = $data['page'] - 1;

                    if ($s_page < 0) {
                        $s_page = 0;
                    }

                    $offset = $s_page * $results_per_page;
                    $limit  = $results_per_page;

                    $SQL = "SELECT * FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub') AND category LIKE '%reinforcement%' AND NOT category LIKE '%template%' AND active=1 LIMIT  $limit OFFSET  $offset";

                        if (isset($data['query'])) {

                            $query = $data['query'];
                            $SQL = "SELECT * FROM activity WHERE (owner_id ='$user_id' OR owner_id='pub') AND category LIKE '%reinforcement%' AND NOT category LIKE '%template%' AND active=1";
                            $SQL = $SQL . " AND " .
                                "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%') LIMIT  $limit OFFSET  $offset";
                        }
                        $res = $db->query($SQL);

        ?>

        <?php while ($fetch = mysqli_fetch_assoc($res)) { ?>

        <div class="card text-white bg-success border-dark" id="<?php echo $fetch['id']; ?>">

            <div class="card-img-top rounded img-thumbnail">
                <img src="<?php require_once ROOTPATH . '/activity/ActivityController.php'; $ac = new ActivityController(); echo $ac->getThumbnail(['id' => $fetch['id']]); ?>">
            </div><!--card-img-top-->
                            
            <h4 class="card-header border-dark">
                <p class="titulo-card"><?php echo $fetch['name']; ?></p>

                <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                    <div class="bolinha"></div>
                    <div class="bolinha"></div>
                    <div class="bolinha"></div>
                </div>

                <div class="container-fluid">
                    <div class="row">
                        <a href="index.php?action=edit&id=<?php echo $fetch['id']; ?>" class="btn btn-block btn-dark">
                            <p><img src="/SEIA/media/icones/minhas_atividades.svg">Visualizar</p>
                        </a>

                        <a href="#" class="btn btn-block btn-dark" onclick="removeActivity('<?php echo $fetch['id']; ?>')">
                            <p><img src="/SEIA/media/icones/excluir.svg">Excluir</p>
                        </a>

                        <a id="verMaisCancelar" onclick="fechaOpcoes('<?php echo $fetch['id'];?>')">
                            <p><img src="/SEIA/media/icones/cancelar.svg">Cancelar</p>
                        </a>
                    </div>
                </div><!--container-fluid-->
            </h4>
            
            <div class="card-body">

                <div class="categorias-estimulo">
                    <p class="card-text">Antecedente:</p>
                    <p><?php echo $fetch['antecedent']; ?></p>
                </div>

                <div class="categorias-estimulo">
                    <p class="card-text">Comportamento esperado:</p>
                    <p><?php echo $fetch['behavior']; ?></p>
                </div>

                <div class="categorias-estimulo">
                    <p class="card-text">Consequência:</p>
                    <p><?php echo $fetch['consequence']; ?></p>
                </div>

                <!--<a href="index.php?action=edit&id=<?php echo $fetch['id']; ?>"  class="btn btn-primary">Visualizar/Editar</a>-->

            </div><!--card-body-->

        </div><!--card-->

        <?php } ?>

    </div><!--card-columns-->

    <!--pagination -->
    <div class="conteiner-pagination">                        
                
                <ul class="pagination">
                    <!--botton previous -->
                    
                    <?php
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

                    <?php
                        } else {
                            if (($data['page'] - 1) <= 0) { ?>
                                
                                <a class="page-link" href="#">
                                    <li class="voltar-avancar">                            
                                        <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                                    </li>
                                </a>
                                
                            <?php } else { ?>

                                <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] - 1); ?>">
                                    <li class="voltar-avancar">                            
                                        <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                                    </li>
                                </a>

                            <?php }

                            /* listing */
                            
                                $i = 0;

                            for ($i = (($data['page'] - 6)); $i < (($data['page'] + 5)); $i++) {
                                if (($data['page'] - 1) == $i) {
                                    //curr page
                            
                            ?>

                                <a class="page-link" href="#">
                                    <li class="page-item disabled"><?php echo ($i + 1); ?></li>
                                </a>

                                <?php
                            
                                    } else {

                                        if ($i >= 0 && $i <= (($num_pages)-1)) {
                                
                                ?>

                                
                                <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($i + 1); ?>">
                                    <li class="page-item"><?php echo ($i + 1); ?></li>
                                </a>
                                
                                <?php }}}

                    /*botton next*/

                        if (($data['page']) >= $num_pages) { ?>
                        
                            <a class="page-link" href="#">
                                <li class="voltar-avancar">
                                    <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                        
                                </li>
                            </a>
                            
                        <?php } else { ?>
                            
                            
                            <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($data['page'] + 1); ?>">
                                <li class="voltar-avancar">
                                    <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                        
                                </li>
                            </a>
                            
                        <?php }}?>
                                            
                </ul>
                
        </div><!--conteiner pagination-->    

    </div><!--corpo-->
            
    <!--botão de ajuda-->                                    
    <div id='help'>
        <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()">
            <i class="fas fa-question"></i>
        </button>
    </div>

<script>
    function removeActivity(id) {

        showModal("Remover Atividade?", "Isso não poderá ser desfeito. A atividade continuará a existir em programas de ensino existentes, mas não aparecerá mais neste lista.", function() {

            console.log("send http");
            var xhr = new XMLHttpRequest();

            xhr.onreadystatechange = function() {
                if (this.readyState != 4) return;

                if (this.status == 200) {
                    var data = this.responseText; // JSON.parse(this.responseText);
                    var el = document.getElementById(data);
                    el.parentNode.removeChild(el);
                    closeModal();
                    // we get the returned data
                }


            };

            xhr.open("POST", '<?php echo BASE_URL; ?>/activity/index.php?action=removeActivity', true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded; charset=UTF-8");
            var url = 'activityId=' + id + "&page=" + <?php echo $data['page']; ?>;

            var query = "<?php echo $query; ?>";

            url = url + "&query=" + query;
            xhr.send(url);
        }, true);
    }
</script>