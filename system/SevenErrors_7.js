class SevenErrors  extends Instruction {
    //construtor, com dados padrão.
    constructor(data = { 'type': 'SevenErrors', 'position': -1, 'editable': true, 'next': -1 }, activity) {
        super(data,activity);
    
        this.editableAttributes.push(
            new AttributeDescriptor("original_image", ['image'], false, "<i class='fas fa-star'></i>Imagem Modelo", 'swap'),
            new AttributeDescriptor("error_image", ['image'], false, "<i class='fas fa-star'></i>Imagem com Diferenças", 'swap'),
            new AttributeDescriptor("showTime",['integer'],false,"<img src='/SEIA/media/icones/tempo_branco.svg'>Tempo de exibição",'swap'),
            new AttributeDescriptor("errors",['error'],true,"<img src='/SEIA/media/icones/add_conteiner.svg'>Adicionar Erro",'add/remove',null,null,null,'errors')
        );
        
        this.errors = [];
        this.idCounter = 0;
        'showTime' in data? this.showTime = data['showTime']*1000: this.showTime = -1;
        this.timer = 0;
        
        if ('errors' in data){//carregar os erros salvos no XML. 
            var sq_arr = JSON.parse(data['errors']); // converte a string para array. 
            console.log(sq_arr);
            for(var i =0; i < sq_arr.length; i++){
                var sq = sq_arr[i];
                console.log(sq);
                this.addError(sq);
            }
        }
        console.log(this.errors);   
    }
    
    removeStimuli(stimuli){
        console.log(this.errors);
        console.log("remove");
        console.log(stimuli);

        if (stimuli.startsWith("ERROR_")){
            for(i= 0; i < this.stimulis.length; i++){
                if(this.errors[i].localID==stimuli ){
                    var s = this.errors[i];
                    this.errors.splice(i,1);
                    delete this.errors[stimuli];
                    console.log(this.errors);
                    return s;
                }
            }
            return; 
        }
        var i;
        for(i= 0; i < this.stimulis.length; i++){
            if(this.stimulis[i].localID==stimuli ){
                var s = this.stimulis[i];
                this.stimulis.splice(i,1);
                delete this.idStimulis[stimuli];
                return s;
            }
        }
        
    }

    addError(sq = null){
        this.idCounter ++;
        var id = this.idCounter; //o id é local à atividade; pode ter um contador, etc. 
        if(sq!=null){
            var error = new ErrorStimulus("ERROR_"+id, this.activity, this, [50,50]);
            error.setRect(sq);
            this.errors.push(error);
            return; 
        }
        this.errors.push(new ErrorStimulus("ERROR_"+id, this.activity, this, [50,50])); 
    }
    

    resize(scale){
        //Chamada para redimensionar a atividade em uma tela diferente.
        //Aqui não precisa fazer algo especial.
        for(var i = 0; i < this.errors.length; i++){
            this.errors[i].resize(scale);
        }
   }

   terminate(){
        
        //essas flags marcam o resultado da atividade, se o aluno acertou, errou ou outro dado. Depois vai mudar
        //por enquanto fica assim.
        this.activity.result=this.activity.RESULT_NEUTRAL;
        this.activity.resultData = "ONLY_SHOW"; 
        
        this.done = true;
    }

    exportXML(){
        // Toda configuração de atividade fica salva em XML. Aqui mostra como exportar o XML desta atividade 
        // em específico.

        var exp =[];
        //dados padrão
        exp['stimuli']   = [];
        exp['header']   = [];
        exp['data']     = [];
        
        exp['header']['type']    ="SevenErrors";//tipo de atividade
        exp['header']['position']=this.position;// cada tela tem uma ordem a ser aprsentada. 
        exp['header']['next']= this.next;//qual a proxima tela? 
        exp['header']['description']=this.description;//descrição da tela. 
        exp['header']['editable'] = this.editable;//o usuário pode editar? 
        

        exp['data']['showTime'] = this.showTime;//tempo de exibição.
        exp['data']['original_image'] = this.original_image; //qual a id (do banco) da imagem
        exp['data']['error_image'] = this.error_image;

        var json_arr = [];
        for(var i = 0; i < this.errors.length; i++){
            var e = this.errors[i].getRect();
            json_arr.push(e);
        }
        exp['data']['errors'] = JSON.stringify(json_arr);

        
        
        exp['stimuli'] = this.stimulis;
        return exp;
    }

    startRunning(){
        
        super.startRunning();
        
        
    }
    pause(){
    }
    update(dt){
        if(!this.activity.isRunning())
            return;

        
        this.timer += dt;
        if(this.timer >= this.showTime){
            this.terminate();
        }
        
        return;
    }

    render(ctx, scale=1){
        var i;
        //render padrão, manda desenhar todos estímulos. 
        for(i = 0; i < this.stimulis.length; i++){
            this.stimulis[i].render(ctx, scale);
        }

        for(i = 0; i < this.errors.length; i++){
            this.errors[i].render(ctx,scale);
        }
    }
    
    
    renderPreview(ctx, scale=1){
        //o preview é usado na edição, caso seja necessário desenhar de maneira diferente...
        for(i = 0; i < this.stimulis.length; i++){
            this.stimulis[i].render(ctx, scale);
        }

        for(var i = 0; i < this.errors.length; i++){
            this.errors[i].renderPreview(ctx,scale);
        }
    }
    
    pointerUp(evt){
        //ao soltar o mouse ou touch. Evento chamado, aqui trata. 
        // durante o jogo, verifica se o erro foi clicado...
        for (var i = this.errors.length-1; i>=0; i=i-1){
            
            //verifica se foi clicado com este método (verifica se o click foi dentro da imagem)
            if(this.errors[i].wasPointed()){
                //se sim, marca como encontrado. 
                this.errors[i].setFound();
            }
                
            
        }
    }
    pointerDown(evt){
        //ao pressionar o mouse ou touch. Evento chamado, aqui trata. 
    }
    editPointerDown(evt){
        //na edição, ao clicar...
        this.imageBeingEdited = null;
        this.clickEditImage();   
        if (this.imageBeingEdited != null)
        return;
        var i;
        
        
        for (i = this.errors.length-1; i>=0; i=i-1){
            var image = this.errors[i].renderImage;
            if(image!=null){
                image.canDrag = false; 
                image.beingEdited = false;
                
            }
        }
        for (i = this.errors.length-1; i>=0; i=i-1){
            var image = this.errors[i].renderImage;
            if(image!=null){
                
                image.editPointerDown();
                if(image.wasPointed()){
                    this.imageBeingEdited = image;
                    if(!image.hasButtonClick){
                        image.canDrag = true; 
                    }
                    image.beingEdited = true;
                    return;
                }
            }
        }
       
    }
    
    editPointerMove(evt){
       
    }
    editPointerDrag(evt){
        //na edição, ao arrastar. Repassa para imagem, pois permite mover e redimensionar ela. Padrão dos outros,
        //mas pode mudar.
        if(this.imageBeingEdited!=null){
            this.imageBeingEdited.editPointerDrag();
        }
    }
}