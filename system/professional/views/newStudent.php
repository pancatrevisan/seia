<!--pagina cadastrar estudante-->

<div class="row corpo">
    <div class="col">
        <div class="container">

        <div class="titulo-pagina">        
            <h1>Cadastrar novo estudante</h1>

            <div class="texto"><div class="barra-horizontal"></div></div>

        </div><!--titulo pagina-->

            <form method="post" autocomplete="off" action="index.php?action=newStudent" class="form-professional">
                <div class="form-group">
                    <label class="label-cadastro" for="studentName">Nome</label>
                    <input type="text" class="form-control" id="studentName" name="studentName">
                </div>
                
                <div class="input-estimulos">
                    <div class="form-group">
                        <label class="label-cadastro" for="birthday">Data de Nascimento</label>
                        <input type="date" class="form-control" id="birthday" name="birthday">
                    </div>
                    
                    <div class="form-group">                        
                        
                        <label class="label-cadastro" for="sex">Gênero</label>

                        <div class="col-sm-3">
                            <select name="sex" class="form-control">
                                <option value="male">Masculino</option>
                                <option value="female">Feminino</option>
                            </select>
                        </div>                                               

                    </div><!--form group-->
                </div><!--input estimulos-->
                
                <div class="form-group row">
                    
                    <div class="col-sm-9">
                        <label class="label-cadastro" for="city">Cidade</label>                    
                        <input class="form-control" id="city" name="city" >
                    </div>

                        <div class="col-sm-3">
                        <label class="label-cadastro" for="city">UF</label>                                                
                            <select name="state" class="form-control">
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
                
                <div class="form-group">
                    <label class="label-cadastro" for="medication">Uso de medicação? Qual/quais?</label>
                    <input type="text" class="form-control" id="medication" name="medication">
                </div>
                
                <div class="container-botao">
                    <button type="submit" class="btn-lg btn-block btn-primary botao_cadastrar">
                        <p>Cadastrar</p>
                    </button>
                </div><!--container botao-->

            </form>
        </div>
    </div>
</div>

