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

    $user_id = $_GET['user'];

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



        <div class="card-columns">
            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                $user_id = $user_id;
                $status = FALSE;
                if($_GET['option']=='block'){
                    $status = FALSE;
                }
                else if($_GET['option'] == 'unblock'){
                    $status = TRUE;
                }

                $SQL = "UPDATE user SET active='$status' WHERE username='$user_id'";
                $res = $db->query($SQL);

                $SQL = "SELECT *  FROM user WHERE username='$user_id'";

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
                    <i  style="color:red">Bloqueado!</i>
                <?php 

            }else 
            {
                ?> 
                    <i style="color:green">Desbloqueado!</i>
                <?php 
            }
            ?>
        
        </p>

            
            

           
                                  
        </h4>
    </div>

<?php } ?>
        </div>
    </div>
</div>

