<!--pagina meus templates-->

<?php

    if (!isset($_SESSION)) {
        session_start();
    }

    if (!defined('ROOTPATH')) {
        require '../root.php';
    }


    require_once ROOTPATH . '/utils/checkUser.php';

    checkUser(["admin", "professional"], BASE_URL);

    require ROOTPATH . "/ui/modal.php";

    $filter_value = "";

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }

?>

<div class="container">

    <div class="header-titulo" id="meus-templates">

        <div class="desenho-e-texto">

            <div class="texto">

                <h1>Meus templates</h1>

                <div class="barra-horizontal"></div>

                <p class="texto-conteudo">Templates criados por você.</p>

            </div>

            <div class="desenho"><img src="/SEIA/media/vetores/meus_templates.svg"></img></div>

        </div>

    </div>

</div><!--container-->

<div class="corpo">
    <div class="container">

    <!--
        <div class="row mt-3">
            <div class="col">
                <h3><a class="btn btn-secondary btn-lg btn-block border-dark text-white" href="index.php?action=newUserTemplate">Novo template</a></h3>
            </div>
            
            <div class="col">
                <h3><a class="btn btn-warning btn-lg btn-block border-dark text-white" href="activity_pub.php">Buscar no repositório</a></h3>
            </div>
        </div>row
    -->

    <!--filtrar-->
        <!--
            <div class="row mt-4">
                <div class="col">
                    <form autocomplete="off" class="form mt-1" action="index.php?action=filter_form" method="post">                                
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
            </div>
        -->

    <!--resultados-->

        <div class="card-columns">
        
            <div class="card text-white bg-secondary border-dark" id="<?php echo $fetch['id']; ?>">

                <a class="btn btn-secondary btn-lg btn-block border-dark text-white" href="index.php?action=newUserTemplate">
                    <div class="card-img-top rounded img-thumbnail">
                        <div class="filtro"></div>
                        <img src="/SEIA/media/icones/adicionar_template.svg">
                    </div>
                </a>

                <h4 class="card-header border-dark">
                    <p class="titulo-card">Novo Template</p>
                </h4>
            </div><!--card-->
        </a>

            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $_SESSION['username'];
                $query = "";

                $SQL = "SELECT COUNT(*) AS total  FROM activity WHERE owner_id ='$user_id' AND active='1' AND auto='0' AND auto_guide='0' AND category LIKE '%template%'";

                    if (isset($data['query'])) {

                        $query = $data['query'];

                        $SQL = $SQL . " AND " .
                            "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%' OR category LIKE '%$query%')";
                    }

                    $num_res = $db->query($SQL);
                    $num_res = mysqli_fetch_assoc($num_res);
                    $num_res = $num_res['total'];
                    $results_per_page = 12;
                    $num_pages = intdiv($num_res, $results_per_page);
                    if (($num_pages * $results_per_page) < $num_res)
                        $num_pages = $num_pages + 1;

                    ///gets results.
                    $s_page = $data['page'] - 1;
                    if ($s_page < 0) {
                        $s_page = 0;
                    }

                    $offset = $s_page * $results_per_page;
                    $limit  = $results_per_page;

                    $SQL = "SELECT * FROM activity WHERE owner_id ='$user_id' AND active=1 AND auto=FALSE AND auto_guide=FALSE AND  LIKE '%template%'  LIMIT  $limit OFFSET  $offset";

                    if (isset($data['query'])) {

                        $query = $data['query'];
                        $SQL = "SELECT * FROM activity WHERE owner_id ='$user_id' AND active=1 AND auto=FALSE AND auto_guide=FALSE AND  category LIKE '%template%'";
                        $SQL = $SQL . " AND " .
                            "(name LIKE '%$query%' OR antecedent LIKE '%$query%' OR behavior LIKE '%$query%' OR consequence LIKE '%$query%') LIMIT  $limit OFFSET  $offset";
                    }
                    $res = $db->query($SQL);

            ?>

            <?php
                while ($fetch = mysqli_fetch_assoc($res)) {
            ?>

                <div class="card text-white bg-secondary border-dark" id="<?php echo $fetch['id']; ?>">

                    <div class="card-img-top rounded img-thumbnail">
                        <div class="filtro"></div>
                        <img src="<?php
                            require_once ROOTPATH . '/activity/ActivityController.php';
                            $ac = new ActivityController();
                            echo $ac->getThumbnail(['id' => $fetch['id']]);
                        ?>">
                    </div>

                    <h4 class="card-header border-dark">
                        <p class="titulo-card"><?php echo $fetch['name']; ?></p>

                        <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                        </div>

                        <div class="container-fluid">
                            <div class="conteudo-vermais">
                                <div class="row">
                                    <a href="index.php?action=editTemplateWizzard&templateId=<?php echo $fetch['id']; ?>" class="btn btn-block btn-dark">
                                        <p><img src="/SEIA/media/icones/editar.svg">Editar</p>
                                    </a>
                                </div>

                                <div class="row">                                    
                                    <a href="#" class="btn btn-block btn-dark" onclick="removeActivity('<?php echo $fetch['id']; ?>')">
                                        <p><img src="/SEIA/media/icones/excluir.svg">Excluir</p>
                                    </a>
                                </div>

                                <a id="verMaisCancelar" onclick="fechaOpcoes('<?php echo $fetch['id'];?>')">
                                    <p><img src="/SEIA/media/icones/cancelar.svg">Cancelar</p>
                                </a>
                            </div>
                        </div>
                    </h4>
                    
                    <div class="card-body">

                        <!--
                        <h4 class="card-text">Antecedente</h4>                        
                        <p class="card-text"><?php echo $fetch['antecedent']; ?></p>
                                    
                        <h4 class="card-text">Comportamento Esperado</h4>
                        <p class="card-text"><?php echo $fetch['behavior']; ?></p>

                        <h4 class="card-text">Consequência</h4>
                        <p class="card-text"><?php echo $fetch['consequence']; ?></p> 
                                        
                        <cite class="card-text"><?php echo $fetch['category']; ?></cite>
                        -->
                    </div><!--card-body-->
                </div><!--card-->

            <?php
                }
            ?>
                        
        </div><!--card-colums-->

    <!--pagination -->
    <div class="conteiner-pagination">                        
            
            <ul class="pagination">
                <!--botton previous -->
                    
                <?php if ($num_pages <= 1) { ?>
    
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
                                
                <?php }}} /*botton next*/ if (($data['page']) >= $num_pages) { ?>
                        
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
                </div>
            </div>
        </div>
    </div>
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