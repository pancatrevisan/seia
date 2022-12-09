<!--modo athena: estudantes-->

<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }
    require ROOTPATH . "/ui/modal.php";

    $filter_value = "";

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }

    require_once ROOTPATH . '/utils/checkUser.php';

    checkUser(["athena"], BASE_URL);

    $user_id = $data['user'];
?>

<div class="corpo row athena">
    <div class="container">
        <div class="titulo-pagina">
            <h1>Estudantes</h1>
            <div class="texto"><div class="barra-horizontal"></div></div>
        </div><!--titulo pagina-->

        <div class="col-2 p-3" hidden>
            <img class="img-fluid rounded " width="100%" height="auto" src="<?php echo BASE_URL; ?>/data/user/<?php echo $user_id; ?>/avatar.png">
            <p class="alert alert-primary "> Usuário: <?php echo $data['user']; ?></p>
        </div>

        <div class="barra-pesquisa">

            <!-- filtrar -->
            <form autocomplete="off" class="form mt-1" action="<?php echo BASE_URL; ?>/athena/index.php?action=viewUserStudents" method="get">

                <?php
                    if ($data['page'] > 1) {
                ?>
                        <input hidden name="page" id="page" value="1">

                <?php
                    } else {
                ?>
                        <input hidden name="page" id="page" value="<?php echo $data['page']; ?>">
                <?php
                    }
                ?>

                <input hidden name="action" id="action" value="viewUserStudents">
                <input hidden name="user" id="user" value="<?php echo $user_id; ?>">

                <div class="form-group" id="pesquisar">
                    <button type="submit" class="btn btn-outline-success form-control">
                        <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                    </button>

                    <input class="form-control mr-sm-2" id="query" name="query" type="query" placeholder="PESQUISE POR ESTUDANTES" aria-label="Search" value="">
                </div>
            </form>
        </div><!--barra-pesquisa-->

        <!-- resultados -->

        <div class="card-columns mt-4" id="cards-estudantes">
            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $user_id;
                $query = "";
                if ($user_id == "ALL") {
                    $SQL = "SELECT COUNT(*) AS total  FROM student";
                } else {
                    $SQL = "SELECT COUNT(*) AS total  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' ";
                }

                if (isset($data['query'])) {

                    if (strlen($data['query']) > 1) {
                        $query = $data['query'];
                        if ($user_id != "ALL") {
                            $SQL = $SQL . " AND ";
                        }
                        $SQL = $SQL . " WHERE " .
                            "name LIKE '%$query%'";
                    }
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
                        if ($user_id == "ALL") {
                            $SQL = "SELECT *  FROM student  LIMIT $limit OFFSET  $offset";
                        } else {
                            $SQL = "SELECT *  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' LIMIT $limit OFFSET  $offset";
                        }


                        //echo $SQL;

                        if (isset($data['query'])) {

                            $query = $data['query'];
                            if (strlen($data['query']) > 1) {
                                if ($user_id == "ALL") {
                                    $SQL = "SELECT *  FROM student";
                                } else {
                                    $SQL = "SELECT *  FROM student LEFT JOIN student_tutorship  ON student.id=student_tutorship.student_id WHERE student_tutorship.professional_id ='$user_id' ";
                                }

                                $query = $data['query'];
                                if ($user_id != "ALL") {
                                    $SQL = $SQL . " AND ";
                                }
                                $SQL = $SQL . " WHERE " .
                                    "name LIKE '%$query%'  LIMIT  $limit OFFSET  $offset";
                            }
                        }
                        $res = $db->query($SQL);


            ?>

            <?php
                while ($fetch = mysqli_fetch_assoc($res)) {

                    if ($user_id == "ALL") {
            ?>
                        
                <div class="card text-white bg-danger border-dark" id="<?php echo $fetch['id']; ?>">
                    <div class="card-img-top rounded img-thumbnail">
                        <div class="filtro"></div>
                        <img class="img-fluid rounded img-thumbnail" src="<?php echo BASE_URL; ?>/data/student/<?php echo $fetch['id']; ?>/<?php echo $fetch['avatar']; ?>">
                    </div>

                    <h4 class="card-header border-dark">
                        <p class="titulo-card"><?php echo $fetch['name']; ?></p>

                        <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                        </div>

                        <div class="dropdown-menu container-fluid" aria-labelledby="dropdownMenuButton">
                            <div>
                                <div class="row mt-1">
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/professional/index.php?action=editStudent&athena=true&studentId=<?php echo $fetch['id']; ?>">
                                        <p><img src="/SEIA/media/icones/perfil.svg">Ver perfil</p>
                                    </a>
                                                
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=index&athena=true&studentId=<?php echo $fetch['id']; ?>">
                                        <p><img src="/SEIA/media/icones/livro.svg">Programações</p>
                                    </a>
                                                
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=editFullSession&athena=true&id=<?php echo $fetch['curriculum_id']; ?>" &studentId=<?php echo $fetch['id']; ?>">
                                        <p><img src="/SEIA/media/icones/iniciar_sessao_ensino.svg">Aplicar currículo</p>
                                    </a>
                                                
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/professional/index.php?action=studentReport&athena=true&studentId=<?php echo $fetch['id']; ?>">
                                        <p><img src="/SEIA/media/icones/papel.svg">Relatórios</p>
                                    </a>

                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=studentTotalReport&athena=true&studentId=<?php echo $fetch['id']; ?>">
                                        <p>Relatório Geral</p>
                                    </a>

                                    <a class="dropdown-item" id="verMaisCancelar" onclick="fechaOpcoes('<?php echo $fetch['id'];?>')">
                                        <p><img src="/SEIA/media/icones/cancelar.svg">Cancelar</p>
                                    </a>
                                </div><!--row-->
                            </div>
                        </div><!--container-fluid-->
                    </h4>

                    <div class="card-body">
                        <div class="categorias-estimulo">
                            <p class="card-text">Nascimento:</p>
                            <p><input class="form-control" type="date" disabled value="<?php echo $fetch['birthday']; ?>"></p>
                        </div>

                        <div class="categorias-estimulo">
                            <p class="card-text">Endereço:</p>
                            <p><?php echo $fetch['city']; echo " - " . $fetch['state']; ?></p>
                        </div>

                        <div class="categorias-estimulo">
                            <p class="card-text">Medicação: </p>
                            <p><?php echo $fetch['medication']; ?></p>
                        </div>
                    </div><!--card-body-->
                </div><!--card-->

                <?php } else { ?>

                <div class="card text-white bg-danger border-dark" id="<?php echo $fetch['id']; ?>">
                    <div class="card-img-fluid rounded img-thumbnail">
                        <div class="filtro"></div>
                        <img class="img-fluid rounded img-thumbnail" src="<?php echo BASE_URL; ?>/data/student/<?php echo $fetch['student_id']; ?>/<?php echo $fetch['avatar']; ?>">
                    </div>
                    
                    <h4 class="card-header border-dark">
                        <p class="titulo-card"><?php echo $fetch['name']; ?>
                        
                        <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['id'];?>')">
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                            <div class="bolinha"></div>
                        </div>

                        <div class="dropdown-menu container-fluid" aria-labelledby="dropdownMenuButton">
                            <div>
                                <div class="row mt-1">
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/professional/index.php?action=editStudent&athena=true&studentId=<?php echo $fetch['student_id']; ?>">
                                        <p><img src="/SEIA/media/icones/perfil.svg">Ver perfil</p>
                                    </a>

                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=index&athena=true&studentId=<?php echo $fetch['student_id']; ?>">
                                        <p><img src="/SEIA/media/icones/livro.svg">Programações</p>
                                    </a>
                                    
                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/sessionProgram/index.php?action=editFullSession&athena=true&id=<?php echo $fetch['curriculum_id']; ?>" &studentId=<?php echo $fetch['student_id']; ?>">
                                        <p><img src="/SEIA/media/icones/iniciar_sessao_ensino.svg">Aplicar currículo</p>
                                    </a>

                                    <a class="dropdown-item" href="<?php echo BASE_URL; ?>/professional/index.php?action=studentReport&athena=true&studentId=<?php echo $fetch['student_id']; ?>">
                                        <p><img src="/SEIA/media/icones/papel.svg">Relatórios</p>
                                    </a>

                                    <a class="dropdown-item" id="verMaisCancelar" onclick="fechaOpcoes('<?php echo $fetch['id'];?>')">
                                        <p><img src="/SEIA/media/icones/cancelar.svg">Cancelar</p>
                                    </a>
                                </div><!--row-->
                            </div>
                        </div>
                    </h4>
                    
                    <div class="card-body">
                        <div class="categorias-estimulo">
                            <p class="card-text">Nascimento: </p>
                            <p><input class="form-control" type="date" disabled value="<?php echo $fetch['birthday']; ?>"></p>
                        </div>

                        <div class="categorias-estimulo">
                            <p class="card-text">Endereço: </p>
                            <p><?php echo $fetch['city']; echo " - " . $fetch['state']; ?></p>
                        </div>
                        
                        <div class="categorias-estimulo">
                            <p class="card-text">Medicação: </p>
                            <p><?php echo $fetch['medication']; ?></p>
                        </div>
                    </div><!--card-body-->
                </div><!--card-->
                
                <?php
                        }
                    }
                ?>
        </div><!--card-columns-->

        <!-- pagination -->
        <div class="conteiner-pagination">
            <ul class="pagination">
                <!--botton previous -->
                <?php if ($num_pages <= 1) { ?>

                <a class="page-link" href="#">
                    <li class="voltar-avancar">                
                        <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                    </li>
                </a>

                <a class="page-link" href="#"><li class="page-item  disabled">1</li></a>

                <a class="page-link" href="#">
                    <li class="voltar-avancar">                
                        <img src="/SEIA/media/numero-pagina/prox-pag.svg"></img>                
                    </li>
                </a>
                
                <?php 
                    } else {
                    
                    if (($data['page'] - 1) <= 0) {
                ?>
                                        
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

                <a class="page-link" href="#"><li class="page-item disabled"><?php echo ($i + 1); ?></li></a>
                
                <?php
                    } else {
                        if ($i >= 0 && $i <= (($num_pages)-1)) {
                ?>

                <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($i + 1); ?>">
                    <li class="page-item"><?php echo ($i + 1); ?></li>
                </a>

                <?php
                            }
                        }
                    }

                    /*botton next*/
                    if (($data['page']) >= $num_pages) {
                ?>
                        
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

                <?php
                        }
                    }
                ?>
            </ul>
        </div><!--container-pagination-->
    </div>
</div>