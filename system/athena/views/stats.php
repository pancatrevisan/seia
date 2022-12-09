<!--modo athena: estatisticas gerais-->

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
?>

<div class="corpo row">

    <div class="titulo-pagina">
        <h1>Estatísticas gerais</h1>
        <div class="texto"><div class="barra-horizontal"></div></div>
    </div><!--titulo pagina-->

    <div class="col">

        <!-- resultados -->

        <div class="container mt-3">

            <?php
                require_once ROOTPATH . '/utils/DBAccess.php';
                $SQL = "";
                $db = new DBAccess();
                
                $SQL = "SELECT COUNT(*) as total FROM user WHERE role='professional'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de profissionais cadastrados: </p><p>". $res['total']; ?></p>
            </div>

            <?php
                $SQL = "SELECT COUNT(*) as total FROM user WHERE role='tutor'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de tutores cadastrados: </p><p>" . $res['total']; ?></p>
            </div>            

            <?php
                $SQL = "SELECT COUNT(*) as total FROM student WHERE name!='Estudante Exemplo'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de estudantes (descontando exemplo): </p><p>" . $res['total'];?></p>
            </div>

            <?php
                $SQL = "SELECT COUNT(*) as total FROM student ";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de estudantes (contando exemplo): </p><p>" . $res['total'];?></p>
            </div>            

            <?php
                $SQL = "SELECT COUNT(*) as total FROM activity WHERE active='TRUE' AND category!='reinforcement' AND category!='template'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>
            
            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de atividades: </p><p>" . $res['total']; ?></p>
            </div>

            <?php
                $SQL = "SELECT COUNT(*) as total FROM activity WHERE active='TRUE' AND category='reinforcement'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de reforçadores: </p><p>" . $res['total'];?></p>
            </div>

            <?php
                $SQL = "SELECT COUNT(*) as total FROM session_program WHERE active='TRUE'";
                $res = $db->query($SQL);
                $res = mysqli_fetch_assoc($res);
            ?>

            <div class="alert alert-primary" role="alert">
                <p class="titulo-card"><?php echo "Numero de programas de ensino: </p><p>" . $res['total'];?></p>
            </div>
        </div>
    </div>
</div>