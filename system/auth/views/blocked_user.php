<?php
if (!defined('ROOTPATH')) {
    require '../root.php';
}

$sel_lang = "ptb";
require ROOTPATH . '/lang/' . $sel_lang . "/auth/new_user.php";

?>


<!DOCTYPE html>
<html lang="ptb">
<head>
    <title>Cadastro de profissional</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="/SEIA/media/icone_seia.svg"></link>
    <link rel="stylesheet" href="/SEIA/style/header.css">
    <link rel="stylesheet" href="/SEIA/style/body.css">
    <link rel="stylesheet" href="/SEIA/style/responsivo.css">
    <link rel="stylesheet" href="/SEIA/style/animacoes.css">
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
    <!--link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Exo+2&family=Righteous&display=swap" rel="stylesheet">
    <script src="/SEIA/scripts/mobile-navbar.js"></script>
    <script src="/SEIA/scripts/mostrar_senha.js"></script>
    <script src="/SEIA/scripts/caracteres-especiais-senha.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</head>
<body>

<header id="header-branco">

    <nav>

      <img class="logo" src="/SEIA/media/logo_seia.svg"></img>

      <div class="mobile-menu">
        <div class="line1"></div>
        <div class="line2"></div>
        <div class="line3"></div>
      </div>

      <ul class="nav-list-index">
        <a href="index.php?action=loginForm"><li><p>Entrar</p></li></a>
        <!--<li><p>Esqueceu a senha? Então <a class='text-danger text-underline' href="index.php?action=passRecovery"><u>Recupere sua senha</u></a>!</p></li>-->
        <!--<a href="index.php?action=showTherms"><li class="criar-conta"><p>Criar conta</p></li></a>-->
      </ul>

    </nav>  

</header><!--cabecalho-->

<div class="corpo">
  
  <div class="container" id="pg-cadastro">

    <h2><?php echo $lang['new_user'];?> </h2>
    <h3 > Seu cadastro anda não foi aprovado por um administrador. Aguarde mais um pouco. Caso desejar, entre em contato.</h3>

    
          
  </div><!--container-->
  
</div><!--corpo-->

<footer>

    <h2>Este sistema está em desenvolvimento na Universidade Federal do ABC. Esta é a versão de testes.</h2>

    <h3>Contatos referentes ao:</h3>

    <div>
      
      <div class="contato">
        <h3>
          <p>Código-fonte:</p>
          <div class="barra-horizontal"></div>
        </h3>

        <p>trevisandiogo@gmail.com</p>
        <p>joao.gois@ufabc.edu.br</p>
      </div>

      <div class="contato">
        <h3>
          <p>Conteúdo educacional e comportamental:</p>
          <div class="barra-horizontal"></div>
        </h3>
        <p>priscila.benitez@ufabc.edu.br</p>
      </div>

    </div>

    <div>
      <h2>
        <p>Projeto financiado pela Fundação de Amparo à Pesquisa do Estado de São Paulo - FAPESP.</p>
        <p>(proc. no. 2019/25795-2)</p>
      </h2>
    </div>

</footer>

</body>