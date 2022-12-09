<!--pagina para editar os dados do estudante-->

<?php
    if (!defined('ROOTPATH')) {
        require '../root.php';
    }

    require_once ROOTPATH . '/utils/DBAccess.php';
    require_once ROOTPATH . '/program/ProgramController.php';
    require_once ROOTPATH . '/ui/modal.php';
?>

<div class="corpo">
    <div class="container">

        <form id="swapAvatarTemplate"class="d-none" enctype="multipart/form-data" autocomplete="off" action="" method="post" hidden>
            
            <div class="input-group mb-3">
                <input name="student_id" id="student_id" type="text" hidden value="<?php echo $data['id'];?>">
                <input required name="stimuli_file" id="stimuli_image" onchange="modal_loadFile(event)" class="inputFile" accept="image/*" type="file" style="display: none;">
                <div class="input-group-prepend">
                    <button  onclick="document.querySelector('#stimuli_image').click();"class="btn btn-outline-secondary" type="button">Selecionar Arquivo</button>
                </div>
                <input id="inp_fileName" type="text" readonly class="form-control" placeholder="" aria-label="" aria-describedby="basic-addon1">
            </div>

            <div class="container" id="preview">
                Selecione um arquivo.
            </div>

        </form>

        <script>
            var modal_loadFile = function (event) {
                var inpt = document.getElementById('inp_fileName');
                var file = event.target.files[0];
                var fileURL = URL.createObjectURL(file);

                inpt.value = file.name;
                var type = file.type
                console.log("type: " + type);

                var preview = document.getElementById("preview");

                if (type.startsWith("image")) {
                    var media = document.createElement("img");
                    media.classList.add("img-fluid");
                    media.classList.add("rounded");
                    media.classList.add("mx-auto");
                    media.classList.add("d-block");


                    media.src = fileURL;
                    preview.innerHTML = "";
                    preview.appendChild(media);
                }
                
            };
            
            
            
            var modal_addImage = function(event){
                
                var form = document.getElementById('newAvatar');
                console.log(form);
                
                
                
                let req = new XMLHttpRequest();
                let formData = new FormData(document.getElementById('newAvatar'));
                req.onreadystatechange = function() {
                    if (this.readyState == 4 && this.status == 200) {
                    console.log(this.responseText);
                        if(this.responseText == "AVATAR_SWAP"){
                            location.reload();
        
                        }
                        else
                            console.log("Não funcionou :( ");
                    }
                };
                var url = "<?php echo BASE_URL . '/professional/index.php?action=swapStudentAvatar'; ?> ";
                req.open("POST", url);
                req.send(formData);
            }
            
            function selectAvatar(){
                var content = document.getElementById('swapAvatarTemplate').cloneNode(true);
                content.id = "newAvatar";
                content.classList.remove('d-none');
                showModal("Selecione o avatar", content, function () {
                    modal_addImage();
                }, true);
                
            }
        </script>

        <div class="row mt-3">
            <div class="container">
                <form method="post" autocomplete="off" action="index.php?action=updateStudentData">

                    <div class="row row-2">
                        <div class="col-3">
                            <div class="row">
                                <div class="col">
                                    <img class="img-fluid rounded" src="<?php echo BASE_URL;?>/data/student/<?php echo $data['id'];?>/<?php echo $data['avatar'];?>">
                                </div>
                            </div>

                            <p><input type="text" name ="student_id" id="student_id" class="d-none" value="<?php echo $data['id'];?>"></p>
                        </div><!--col-3-->

                        <div class="student-tools">
                            <div class="row alert alert-warning">
                                <div class="col">
                                    <button onclick='selectAvatar()'class=" mt-1 btn btn-primary btn-lg btn-block" type="button"><a><img src="/SEIA/media/icones/camera_fotografica_branco.svg">Mudar foto de perfil</a></button>
                                </div>
                            </div>
                        </div><!--student-tools-->
                    </div><!--row-->
                
                    <div class="row">
                        <div class="col-9">
                            <div class="titulo-form">
                                <p>Dados pessoais</p>
                            </div>

                            <div class="row alert" role="alert">
                                <div class="col">
                                    <p>Nome: </p>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="studentName" name="studentName" value="<?php echo $data['name'];?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row alert alert-primary" role="alert">
                                <div class="col">
                                    <p>Data de Nascimento: </p>
                                    <div class="col-8">
                                        <input type="date" class="form-control" id="birthday" name="birthday" value="<?php echo $data['birthday'];?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <p>Gênero: </p>
                                    <div class="col-8">
                                        <select name="sex" class="form-control" value="<?php echo $data['sex'];?>">
                                            <option value="male">Masculino </option>
                                            <option value="female">Feminino </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row alert alert-primary" role="alert">
                                <div class="col">
                                    <p>Cidade: </p>
                                    <div class="col-8">
                                        <input class="form-control" id="city" name="city" value="<?php echo $data['city'];?>">
                                    </div>
                                </div>

                                <div class="col">
                                    <p>UF: </p>
                                    <div class="col-8">
                                        <select name="state" class="form-control" value="<?php echo $data['state'];?>">
                                            <option value="AC">Acre</option>
                                            <option value="AL">Alagoas</option>
                                            <option value="AP">Amapá</option>
                                            <option value="AM">Amazonas</option>
                                            <option value="BA">Bahia</option>
                                            <option value="CE">Ceará</option>
                                            <option value="DF">Distrito Federal</option>
                                            <option value="ES">Espírito Santo</option>
                                            <option value="GO">Goiás</option>
                                            <option value="MA">Maranhão</option>
                                            <option value="MT">Mato Grosso</option>
                                            <option value="MS">Mato Grosso do Sul</option>
                                            <option value="MG">Minas Gerais</option>
                                            <option value="PA">Pará</option>
                                            <option value="PB">Paraíba</option>
                                            <option value="PR">Paraná</option>
                                            <option value="PE">Pernambuco</option>
                                            <option value="PI">Piauí</option>
                                            <option value="RJ">Rio de Janeiro</option>
                                            <option value="RN">Rio Grande do Norte</option>
                                            <option value="RS">Rio Grande do Sul</option>
                                            <option value="RO">Rondônia</option>
                                            <option value="RR">Roraima</option>
                                            <option value="SC">Santa Catarina</option>
                                            <option value="SP">São Paulo</option>
                                            <option value="SE">Sergipe</option>
                                            <option value="TO">Tocantins</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row alert" role="alert">
                                <div class="col">
                                    <p>Medicação(ões): </p>
                                    <div class="col-8">
                                        <input type="text" class="form-control" id="medication" name="medication" value="<?php echo $data['medication'];?>">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row m-1">
                                <div class="col">
                                    <button type="submit" class="btn-lg btn-block btn-primary">Atualizar</button>
                                </div>
                            </div>

                        </div><!--col-9-->
                    </div><!--row-->
                </form>
            </div><!--container-->
        </div><!--row-->

    </div><!--container-->
</div><!--corpo-->