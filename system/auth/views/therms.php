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
    <p class="texto-conteudo"><?php echo $lang['info']; echo $lang['info2'];?></p>

    <form action="index.php?action=newUser" method="post" onsubmit="return validate(this);">
    
    <div class="desenho-e-texto">

      <div class="texto">

            <p class="texto-conteudo">Os campos marcados com (*) são obrigatórios.</p>
                
                <div class="form-group">
                    <label for="signup_username"><?php echo $lang['username'];?></label>
                    <input required type="text" class="form-control" id="signup_username" name="signup_username">
                </div>

                <div class="form-group">
                    <label for="signup_name"><?php echo $lang['name'];?></label>
                    <input required type="text" class="form-control" id="signup_name" name="signup_name">
                </div>

                <div class="form-group">
                    <label for="signup_email"><?php echo $lang['email'];?></label>
                    <input required type="email" class="form-control" id="signup_email" name="signup_email">
                </div>

                <div class="form-group">
                    <label for="signup_pass"><?php echo $lang['pass'];?></label>
                    <input required type="password" class="form-control" id="signup_pass" name="signup_pass">                      
                </div>

                <div class="form-group">
                    <label for="signup_city"><?php echo $lang['city'];?></label>
                    <input required type="text" class="form-control" id="signup_city" name="signup_city">
                </div>
                    
                <div class="form-group">
                    <label for="signup_comment"><?php echo $lang['presentation'];?></label>
                    <textarea required class="form-control" rows="5" id="signup_comment" name="signup_comment"></textarea>
                </div>    

      </div>

      <div class="barra-vertical"></div>

      <div class="texto" id="termos-de-uso">

        <section>

          <h3>Termos de Uso:</h3>

          <p class="texto-conteudo">Este sistema está sob desenolvimento na Universidade Federal do ABC. Alguns dados podem ser coletados, porém, respeitando a privacidade - nenhum dado pessoal de profissionais ou estudantes será divulgado. 
          </p>
                  
          <p class="texto-conteudo">Os dados coletados serão utilizados para estudos científicos, a fim de melhorar o sistema. Agradecemos a compreensão.</p>
                  
          <div class="alinhar-ao-centro">
            <div class="checkbox-termos">
              <input required type="checkbox"></input>
              <p class="texto-conteudo">Concordo com os termos de uso.</p>
            </div>
          </div>

        </section>

      </div><!--texto-->

    </div>  <!--desenho-e-texto-->

      <div class="form-group" id="criar-conta">
          <button type="submit" class="btn btn-primary btn-lg btn-block">
          <?php echo $lang['button_signup'];?>
          </button>
      </div>

    </form>
          
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