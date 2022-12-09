<?php
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    $sel_lang = "ptb";
    require ROOTPATH . '/lang/' . $sel_lang . "/auth/login.php";
?>

<!DOCTYPE html>
<html lang="ptb">
    <head>
        <title>Cadastro</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    </head>

    <body>
        <div class="corpo">
            <div class="container">
                <!--</*?php if(isset($data['error']) && $data['error']){ ?>
                    <div class="alert alert-danger" role="alert">
                    Nome de usuário ou senha errados.
                </div>
                </*?php } ?>-->
                    
                
                <!--<h2>Recuperação de senha</h2>
                
                <form action="index.php?action=sendRecoveryEmail" method="post">

                    <div class="form-group">
                        <label for="sigin_username">Nome de usuário ou e-mail</label>
                        <input type="text" class="form-control" id="sigin_username" name="sigin_username">
                    </div>

                    <button type="submit" class="btn btn-primary btn-lg btn-block">Recuperar Senha</button>

                </form>-->                
            </div>
        </div>

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
</html>