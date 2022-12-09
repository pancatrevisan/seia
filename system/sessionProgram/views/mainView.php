<!--pagina que lista as programações do estudante-->

<?php

    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    require ROOTPATH . "/ui/modal.php";

    isset($data['athena'])?$athena = $data['athena']: $athena = 'false';

?>

<script>
    var studentId = "<?php echo $data['student_id'];?>";
    function showHelp(){
        var content = 
       '<iframe width="560" height="315" src="https://www.youtube.com/embed/lHzMbF6vv7E" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
        
        showModal("Ajuda",content);
    }
</script>

<script>
    
    document.body.onload = function(){
        var xhttp = new XMLHttpRequest();
        
        
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var objs = JSON.parse(this.responseText, true);
                var  me = "<?php echo $_SESSION['username'];?>";

                document.getElementById('loading').innerHTML = "";

                for(var i =0; i < objs.length; i++){

                    var date = objs[i]['date'];
                    var criador = objs[i]['owner_id'];
                    var color = "bg-light";
                    if(criador!=me)
                        color = "bg-warning";
                    var c = '<div class="card">'+
                    
                    '<div class="card-body border border-dark' + color + '">'+
                    '<h4 class="card-title">'+ objs[i]['name'] + '<div class="barra-horizontal"></div>'+
                    '<div class="card-text">' + '<p class="card-label">Data de criação:</p><p>' + date +  '</p></div>' +
                    '<div class="card-text">' + '<p class="card-label"> Criador:</p><p>' + criador +  '</p></div></h4>' +
                    '<div class="botoes-prog"><a class="btn btn-lg btn-block btn-info" href="<?php echo BASE_URL;?>/sessionProgram/index.php?action=editSessionProgram&athena=<?php echo $athena;?>&sessionId=' + objs[i]['id'] + '"><button><img src="/SEIA/media/icones/editar_branco.svg">Editar</button></a>'+
                    '<a class="btn btn-lg btn-block btn-success" href="<?php echo BASE_URL;?>/sessionProgram/index.php?action=runSessionProgram&athena=<?php echo $athena;?>&session_id=' + objs[i]['id'] + '&student_id=' + studentId+'"><button><img src="/SEIA/media/icones/minhas_atividades_branco.svg">Iniciar</button></a>'+
                    
                    <?php if($athena == 'false'){ ?>
                    '<button class="btn btn-lg btn-block btn-warning border border-dark" title="Copia o programa para outro estudante" onclick="copy(\'' + objs[i]['id'] +'\')"><img src="/SEIA/media/icones/copiar_branco.svg">Copiar</button>'+
                    '<button type="button" class="btn btn-lg btn-block btn-danger border border-dark" onclick="askToRemoveSessionProgram(\'' + objs[i]['id'] +'\')"><img src="/SEIA/media/icones/excluir_branco.svg">Remover</button></div>'+
                    <?php } else { ?>
                        '<button disabled class="btn btn-lg btn-block btn-warning disabled border border-dark" title="Copia o programa para outro estudante" onclick="copy(\'' + objs[i]['id'] +'\')"><img src="/SEIA/media/icones/copiar_branco.svg">Copiar</button>'+
                        '<button disabled type="button" class="btn btn-lg btn-block btn-danger" onclick="askToRemoveSessionProgram(\'' + objs[i]['id'] +'\')"><img src="/SEIA/media/icones/excluir_branco.svg">Remover</button></div>'+
                    <?php } ?>

                    
                    '</div>'+
                    '</div>';
                    document.getElementById('programs').innerHTML += c;
                }
                
            }
        }

        xhttp.open("GET", "<?php echo BASE_URL;?>/sessionProgram/index.php?action=getSessionPrograms&json=true&studentId=" + studentId, true);
        xhttp.send();
    };

    function askToRemoveSessionProgram(id){
        showModal("Remover sessão","Gostaria de remover a programação de sessão? Isso não pode ser desfeito",function(){
            var xhttp = new XMLHttpRequest();
        
        
            xhttp.onreadystatechange = function () {
                if (this.readyState == 4 && this.status == 200) {
                    
                    closeModal();
                    location.reload();
                }
            }
            
            xhttp.open("POST", "<?php echo BASE_URL;?>/sessionProgram/index.php?action=removeSessionProgram", true);
            xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
            
            
            xhttp.send("session_id=" + id);
        });
    }

    function copy(programId){
        var xhttp = new XMLHttpRequest();
        
        
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if(this.responseText == "OK"){
                    alert("Programa copiado! Vá ao perfil do outro estudante e cole o programa para ele! ");//+programId);
                }
            }
        }

        xhttp.open("POST", "<?php echo BASE_URL;?>/sessionProgram/index.php?action=addToTransferArea", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send("copy_program=" + programId);
        
        
    }

    function pasteProgram(){
        var xhttp = new XMLHttpRequest();
        
        
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                if(this.responseText == "OK"){
                    alert("Programa copiado! A página irá recarregar! ");//+programId);
                    window.location.reload();
                }
            }
        }

        xhttp.open("POST", "<?php echo BASE_URL;?>/sessionProgram/index.php?action=copyProgram", true);
        xhttp.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
        xhttp.send("dest_student=" + studentId);
    }
</script>


<div class="corpo row mt-3" id="programacoes">
    <div class="container">
        <div class="row row-2"><!--infos do estudante-->

            <div class="col-3">

                <?php
                    $student_id = $data['student_id'];
                    $SQL = "SELECT *  FROM student WHERE id='$student_id'";

                    $db = new DBAccess();
                    $res = $db->query($SQL);
                    if (!$res) {
                        die("ERROR LOADING STUDENT $student_id. CONTACT ADMIN.");
                    }

                    $fetch = mysqli_fetch_assoc($res);
                ?>

                <div class="card text-white bg-secondary" id="<?php echo $fetch['id']; ?>">
                    <!--<div class="card-header font-weight-bold text-uppercase"></div>-->
                    
                    <!--<div class="card text-white bg-danger border-dark" id="<?php echo $fetch['id']; ?>">-->

                    <div class="row">
                        <div class="col">
                            <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/student/<?php echo $fetch['id'];?>/<?php echo $fetch['avatar'];?>">
                        </div>
                    </div>
                    
                    <div class="card-body">

                        <h4 class="card-header">
                            <p class="titulo-card"><?php echo $fetch['name']; ?></p>
                        </h4>

                        <p class="card-text">Nascimento: <?php $date=date_create($fetch['birthday']); echo date_format($date,"d/m/Y"); ?></p>
                        <p class="card-text">Endereço: <?php echo $fetch['city'];
                        echo " - " . $fetch['state']; ?></p>
                        <p class="card-text">Medicação: <?php echo $fetch['medication']; ?></p>                    

                        <!--<a type="button" class="btn btn-lg btn-block btn-info" href="<?php echo BASE_URL;?>/professional/index.php?action=editStudent&studentId=<?php echo $data['student_id'];?>"> <i class="fas fa-arrow-left"></i>Voltar</a>-->

                    </div><!--card-body-->
                    <!--</div>card-->
                </div><!--card-->
            </div><!--col-3-->            

            <div class="student-tools">
                <?php if($athena=='false'){ ?>

                    <div class='row alert alert-warning'>
                        <div class="col">
                            <button>
                                <a href="<?php echo BASE_URL;?>/sessionProgram/index.php?action=newSessionProgram&student_id=<?php echo $data['student_id'];?>" class="btn btn-success btn-block btn-lg">
                                    <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">Adicionar nova programação
                                </a>
                            </button>

                            <button type="button" onclick="pasteProgram()" class="btn btn-warning btn-block btn-lg <?php if(!isset($_SESSION['copy_program'])) echo "disabled";?>" <?php if(!isset($_SESSION['copy_program'])) echo "disabled";?>>
                                <a><img src="/SEIA/media/icones/copiar_branco.svg">Colar programação copiada</a>
                            </button>
                        </div><!--col-->
                    </div><!--row alert-->

                <?php } ?>

                <?php if($athena=='true'){ ?>

                    <div class='row alert alert-warning'>
                        <div class="col">
                            <button disabled>
                                <a disabled href="<?php echo BASE_URL;?>/sessionProgram/index.php?action=newSessionProgram&student_id=<?php echo $data['student_id'];?>" class="disabled btn btn-success btn-block btn-lg">
                                    <img src="/SEIA/media/barra_pesquisa/adicionar_branco.svg">Adicionar nova programação
                                </a>
                            </button>

                            <button disabled type="button" onclick="pasteProgram()" class="btn btn-warning btn-block btn-lg disabled <?php if(!isset($_SESSION['copy_program'])) echo "disabled";?>" <?php if(!isset($_SESSION['copy_program'])) echo "disabled";?>>
                                <a><img src="/SEIA/media/icones/copiar_branco.svg">Colar programação copiada</a>
                            </button>
                        </div><!--col-->
                    </div><!--row alert-->

                <?php } ?>
            </div><!--student-tools-->

        </div><!--row-2-->

        <div class="titulo-pagina">        
            <h1>Programar sessões de ensino</h1>

            <div class="texto"><div class="barra-horizontal"></div></div>

        </div><!--titulo pagina-->

        <div class="col-9" id="content">            
                <div class="row mt-3">
                    <div class="col">
                        
                        <div id="loading">
                            <img src="<?php echo BASE_URL;?>/ui/load.gif" class="mx-auto d-block" alt="Responsive image">
                        </div>
                            
                        <div id="programs" class="card-columns"></div>

                    </div><!--col-->
                </div><!--row mt-3-->
            </div><!--col-9-->

            <div id='help'>
                <button class='btn btn-block btn-lg btn-warning' onclick="showHelp()"><i class="fas fa-question"></i></button>
            </div>
        </div><!--col-9-->

    </div><!--container-->
</div><!--corpo-->




