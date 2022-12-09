<!--página para quando o programa criado está vazio-->

<?php
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    $sel_lang = "ptb";
    require ROOTPATH . '/lang/' . $sel_lang . "/auth/new_user_success.php";

?>

<!DOCTYPE html>
    <html lang="ptb">
    <head>
    <title><?php echo $lang['page_name'];?></title>
        <link rel="shortcut icon" href="/SEIA/media/icone_seia.svg"></link>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.12.1/css/all.min.css">
        <link href="<?php echo BASE_URL;?>/external/enjoyhint/enjoyhint.css" rel="stylesheet">
        <link rel="stylesheet" href="/SEIA/style/header.css">
        <link rel="stylesheet" href="/SEIA/style/janela-modal.css">
        <link rel="stylesheet" href="/SEIA/style/menu-usuario.css">
        <link rel="stylesheet" href="/SEIA/style/body.css">
        <link rel="stylesheet" href="/SEIA/style/area-titulo.css">
        <link rel="stylesheet" href="/SEIA/style/cards.css">
        <link rel="stylesheet" href="/SEIA/style/numero-pagina.css">
        <link rel="stylesheet" href="/SEIA/style/responsivo.css">
        <link rel="stylesheet" href="/SEIA/style/animacoes.css">
        <link rel="stylesheet" href="<?php echo BASE_URL;?>/activity/views/paper.css">
        <!--<link rel="stylesheet" href="<?php echo BASE_URL;?>/external/bootstrap.min.css">-->
        <link rel="shortcut icon" href="<?php echo BASE_URL;?>/ui/favicon.ico" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Righteous&display=swap" rel="stylesheet">
        <script src="/SEIA/scripts/mobile-navbar.js"></script>
        <script src="/SEIA/scripts/mostrar_senha.js"></script>
        <script src="/SEIA/scripts/janela-modal.js"></script>
        <script src="/SEIA/scripts/dropdown-search.js"></script>
        <script src="/SEIA/scripts/animacoes.js"></script>
        <script src="<?php echo BASE_URL;?>/external/jquery.min.js"></script>
        <script src="<?php echo BASE_URL;?>/external/popper.min.js"></script>
        <script src="<?php echo BASE_URL;?>/external/bootstrap.min.js"></script>
        <script  src="<?php echo BASE_URL;?>/external/face-api.js"></script>  
        <script type="text/javascript" id="www-widgetapi-script" src="https://s.ytimg.com/yts/jsbin/www-widgetapi-vfl2dBoXz/www-widgetapi.js" async=""></script>  
        <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
        <script src="<?php echo BASE_URL;?>/external/enjoyhint/enjoyhint.js"></script>
    </head>

    <body>
        <div class="corpo">
            <div class="col">
                <div class="container">
                    <h2 class='jumbotron'>O programa <b><?php echo $data['program_name'];?></b> está vazio! Não existem atividades a serem realizadas.</h2>
                </div><!--container-->
            </div><!--col-->
        </div><!--corpo-->
    </body>
</html>