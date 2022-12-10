<!--modo athena: estudantes-->

<?php
    if (!isset($_SESSION)) {
        session_start();
    }
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    require_once ROOTPATH . '/utils/checkUser.php';
    require_once ROOTPATH . '/ui/modal.php';
    checkUser(["professional", "admin", "athena"], BASE_URL);

    $user_id = $_SESSION['username'];

    if (isset($data['query']) && strlen($data['query']) > 0) {
        $filter_value = $data['query'];
    }
?>

<div class="corpo row athena">
    <div class="container">
        <div class="titulo-pagina">
            <h1>Usuários</h1>
            <div class="texto"><div class="barra-horizontal"></div></div>
        </div><!--titulo pagina-->

        <!-- filtrar -->
        <div class="barra-pesquisa">
            <form autocomplete="off" class="form mt-1" action="<?php echo BASE_URL; ?>/athena/index.php?action=users" method="get">

            <?php
                if ($data['page'] > 1) {
            ?>
                <input hidden name="page" id="page" value="1">
            <?php
                } else {
            ?>

                <input hidden name="page" id="page" value="<?php echo $data['page']; ?>">

            <?php } ?>

                <input hidden name="action" id="action" value="users">

                <div class="form-group" id="pesquisar">
                    <button type="submit" class="btn btn-outline-success form-control">
                        <img src="/SEIA/media/barra_pesquisa/pesquisa.svg"></img>
                    </button>
                    
                    <input class="form-control mr-sm-2" id="query" name="query" type="query" placeholder="Filtrar" aria-label="Search" value="">
                </div>
            </form>
        </div>

        <div class="card-columns">
            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $user_id;
                $query = "";

                $SQL = "SELECT COUNT(*) AS total  FROM user ";

                if (isset($data['query'])) {

                    $query = $data['query'];

                    $SQL = $SQL . " WHERE " .
                        "name LIKE '%$query%'";
                }
                $SQL = $SQL . " ORDER BY username";

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

                $SQL = "SELECT *  FROM user ";



                if (isset($data['query'])) {
                    if (strlen($data['query']) > 0) {

                        $query = $data['query'];
                        //$SQL = "SELECT *  FROM user  ORDER BY 'username' ASC";

                        $SQL = $SQL .
                            " WHERE name LIKE '%$query%' "; //  LIMIT  $limit OFFSET  $offset";                        
                    }
                }
                $SQL = $SQL . " ORDER BY 'username' ASC LIMIT $limit OFFSET  $offset";

                $res = $db->query($SQL);

            ?>

            <?php while ($fetch = mysqli_fetch_assoc($res)) { ?>

                <?php if ($fetch['role'] == "tutor") { ?>

                    <div class="card text-white bg-info border-dark" id="<?php echo $fetch['username']; ?>">
                    
                <?php } else if ($fetch['role'] == 'professional') { ?>

                    <div class="card text-white bg-success border-dark" id="<?php echo $fetch['username']; ?>">

                <?php } ?>

                        <div class="card-img-top rounded img-thumbnail">
                            <div class="filtro"></div>
                            <img class="img-fluid rounded img-thumbnail" src="<?php echo BASE_URL; ?>/data/user/<?php echo $fetch['username']; ?>/<?php echo $fetch['avatar']; ?>">
                        </div>

                        <h4 class="card-header border-dark">
                            <p class="titulo-card"><?php echo $fetch['name']; ?>
                        
                            <?php if ($fetch['active'] == 0){
                                ?>
                                    <i  class="fa-sharp fa-solid fa-lock"></i>
                                <?php 

                            }else 
                            {
                                ?> 
                                    <i class="fa-solid fa-lock-open"></i>
                                <?php 
                            }
                            ?>
                        
                        </p>

                            <div class="ver-mais" onclick="mostraOpcoes('<?php echo $fetch['username'];?>')">
                                <div class="bolinha"></div>
                                <div class="bolinha"></div>
                                <div class="bolinha"></div>
                            </div>
                            

                            <div class="dropdown-menu container-fluid" aria-labelledby="dropdownMenuButton">
                                <div>
                                    <div class="row mt-1">
                                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=viewUserStudents&user=<?php echo $fetch['username']; ?>">
                                            <p>Estudantes</p>                                                
                                        </a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=viewUserActivities&user=<?php echo $fetch['username']; ?>">
                                            <p>Atividades e Recompensas</p>
                                        </a>
                                        <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=viewUserAccessLog&user=<?php echo $fetch['username']; ?>">
                                            <p>Logs de acesso</p>
                                        </a>
                                        <?php if ($fetch['active'] == 0){
                                            ?>
                                                 <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=blockUnblockUser&option=unblock&user=<?php echo $fetch['username']; ?>">
                                            <p>Desbloquear</p>
                                             </a>
                                            <?php 

                                        }else 
                                        {
                                            ?> 
                                                     <a class="dropdown-item" href="<?php echo BASE_URL; ?>/athena/index.php?action=blockUnblockUser&option=block&user=<?php echo $fetch['username']; ?>">
                                            <p>Bloquear</p>
                                             </a>
                                            <?php 
                                        }
                                        ?>
                                       
                                        
                                    </div>
                                </div>
                            </div>  
                                                  
                        </h4>
                    </div>

                <?php } ?>
        </div>
        
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

                <a class="page-link" href="#">
                    <li class="voltar-avancar">                
                        <img src="/SEIA/media/numero-pagina/pag-anterior.svg"></img>
                    </li>
                </a>

                <?php 
                    }

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

                <a class="page-link" href="index.php?query=<?php echo $query; ?>&page=<?php echo ($i + 1); ?>"><li class="page-item"><?php echo ($i + 1); ?></li></a>

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
        </div>
    </div>
</div>

<script>

</script>