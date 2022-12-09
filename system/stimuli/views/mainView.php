<!--pagina de estimulos-->

<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    require_once ROOTPATH . '/utils/checkUser.php';
    require ROOTPATH . "/ui/modal.php";
    checkUser(["professional", "admin"], BASE_URL);
    $sel_lang = "ptb";
    require ROOTPATH . '/lang/' . $sel_lang . "/stimuli/mainView.php";
    require_once ROOTPATH . '/utils/GetData.php';

    $filter_value = "";

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }


    if (!isset($data['page'])) {
        $data['page'] = 1;
    }
?>

<script>
    function showHelp() {
        var content = '<iframe width="560" height="315" src="https://www.youtube.com/embed/kqoS2eqSSjc" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        showModal("Ajuda", content);
    }
</script>

<div class="container">

    <div class="header-titulo" id="meus-est">

        <div class="desenho-e-texto">

            <div class="texto">

                <h1>Meus estímulos</h1>

                <div class="barra-horizontal"></div>

                <p class="texto-conteudo">Visualize estímulos adicionados por você, ou aquelas adicionados do Repositório.</p>

            </div>

            <div class="desenho"><img src="/SEIA/media/vetores/meus_estimulos.svg"></img></div>

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

                    <a href="<?php echo BASE_URL . "/stimuli?action=newStimuliForm" ?>">
                        <li>
                            <p>
                                <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">
                                <span>Novo estímulo</span>
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
                                
        <form autocomplete="off" class="form mt-1" action="index.php?action=filter_form" method="post">
            <input hidden id="rep" name="rep" type="rep"  value="<?php echo $repository?>">

            <div class="form-group" id="pesquisar">
                <button type="submit" class="btn btn-outline-success form-control">
                    <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                </button> 

                <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="PESQUISE POR ESTÍMULOS" aria-label="Search" value="">
            </div>
                                        
        </form>
                    
    </div><!--barra-pesquisa-->

    <!--<div class="row mt-3">
        <div class="col">
            <h3> <a class="btn btn-primary btn-lg btn-block" href="<?php echo BASE_URL . "/stimuli?action=newStimuliForm" ?>"><?php echo $lang["new_stimuli"]; ?> </a></h3>
        </div>
        <div class="col">
            <h3><a class="btn btn-primary btn-lg btn-block disabled" href="#"><?php echo $lang["search_database"]; ?> </a></h3>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col">
                <form autocomplete="off" class="form mt-1" action="index.php?action=filter_form" method="post">

                    <div class="form-row">
                        <div class="form-group col-md-11">
                            <input class="form-control mr-sm-2" id="search" name="query" type="query" placeholder="Filtrar" aria-label="Search" value="">
                        </div>
                        <div class="form-group col-md-1">
                            <button type="submit" class="btn btn-outline-success form-control"><i class="fas fa-search"></i></button>
                        </div>
                    </div>

                </form>
            </div>
    </div>-->

    <!-- Results appear here -->
    <div class="card-columns">

        <?php
            require_once ROOTPATH . '/utils/DBAccess.php';

            if (isset($data['query'])) {
                $query = $data['query'];
            }

            ///gets results.
            $s_page = $data['page'] - 1;
            if ($s_page < 0) {
                $s_page = 0;
            }

            $results_per_page = 12;
            $offset = $s_page * $results_per_page;
            $limit  = $results_per_page;

            $sController = new StimuliController();
            $s_data = ['query' => $query, 'offset' => $offset, 'resultsAsArray' => true];
            $res = $sController->get_as_json($s_data);
            $num_res = $res['total'];

            $num_pages = intdiv($num_res, $results_per_page);

            if (($num_pages * $results_per_page) < $num_res) {
                $num_pages = $num_pages + 1;
            }

            foreach ($res['results'] as $fetch) {
        ?>

        <?php if ($fetch['type'] == "image") { ?><!--quando o estimulo for uma imagem-->
                                        
            <div class="card" id="card-<?php echo $fetch['id']; ?>"><!--estimulo imagem-->

                <div class="card-img-top rounded img-thumbnail"><!--imagem-->
                    <div class="filtro"></div>
                    <img src="<?php echo $fetch['data']; ?>" alt="Card image cap"></img>
                </div>

                <h4 class="card-header"><!--nome-->
                    <p class="titulo-card"><?php echo $fetch['name']; ?></p>

                    <?php if ($fetch['owner_id'] != 'pub') { ?><!--opcao para remover o estimulo se ele for publico-->
                        <button class="btn btn-block btn-danger" onclick="askToRemoveStimuli('<?php echo $fetch['id']; ?>')"><img src="/SEIA/media/icones/excluir_branco.svg">Remover</button>
                    <?php } ?>

                <!--
                    <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                    </div>
                -->
                </h4>

                <div class="card-body"><!--descrição-->
                                                                
                    <span class="badge badge-secondary"><?php echo $fetch['description']; ?></span>

                    <div class="categorias-estimulo"><!--categorias-->
                        <?php if ($fetch['owner_id'] != 'pub') { ?><!--tag publico-->
                            <p class="card-text badge badge-secondary">Público</p>
                        <?php } ?>

                        <?php for ($i = 0; $i < count($fetch['labels']); $i++) { ?>
                        <p class="card-text badge badge-secondary"><?php echo $fetch['labels'][$i]; } ?></p>
                    </div>

                </div><!--card body-->

            </div><!--card-->

        <?php } elseif ($fetch['type'] == 'audio') { ?><!--quando o estimulo for um audio-->

            <div class="card" id="card-<?php echo $fetch['id']; ?>"><!--estimulo audio-->

                <div class="card-img-top rounded img-thumbnail"><!--thumbnail-->
                    <audio controls><source src="<?php echo BASE_URL . $fetch['url']; ?>"></audio>
                </div>

                <h4 class="card-title"><!--titulo-->
                    <p class="titulo-card"><?php echo $fetch['name']; ?></p>

                <!--
                    <div class="ver-mais">
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                        <div class="bolinha"></div>
                    </div>
                -->

                </h4>

                <div class="card-body"><!--descrição-->
                    
                    <span class="badge badge-secondary"><?php echo $fetch['description']; ?></span>

                    <?php if ($fetch['owner_id'] != 'pub') { ?>
                        <button class="btn btn-block btn-danger" onclick="askToRemoveStimuli('<?php echo $fetch['id']; ?>')">Remover</button>
                    <?php } ?>

                    <div class="categorias-estimulo"><!--categorias-->
                        <p class="card-text badge badge-secondary">
                            <?php for ($i = 0; $i < count($fetch['labels']); $i++) { echo $fetch['labels'][$i]; } ?>
                        </p>
                    </div><!--categorias estimulo-->

                </div>
            </div><!--card-->

        <?php }} ?>

    </div><!--card columns-->

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

</div>
        
        <!--botão de ajuda-->                                    
        <div id='help'>
            <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()">
                <i class="fas fa-question"></i>
            </button>
        </div>

<script>
    function askToRemoveStimuli(id) {
        showModal("Deseja remover o estímulo?", "Ele ainda continuará aparecendo nas atividades em que foi utilizado, porém, não aparecerá na listagem de estímulos.",
            function() {

                var xhttp = new XMLHttpRequest();

                var activity = this;
                xhttp.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                        console.log(this.responseText);
                        if (this.responseText == "OK") {
                            var card = document.getElementById('card-' + id);
                            console.log(card);
                            card.classList.add('d-none'); //(card);
                        }
                    }
                };
                var url = "<?php echo BASE_URL; ?>/stimuli/index.php?action=removeStimuli";
                console.log(url);
                xhttp.open('POST', url, true);
                xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                xhttp.send("&stimuli_id=" + id);
                closeModal();
            })
    }
</script>