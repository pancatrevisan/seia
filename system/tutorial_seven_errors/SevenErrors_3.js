class SevenErrors  extends Instruction {
    //construtor, com dados padrão.
    constructor(data = { 'type': 'SevenErrors', 'position': -1, 'editable': true, 'next': -1 }, activity) {
        super(data,activity);
    
        this.editableAttributes.push(
            new AttributeDescriptor("original_image", ['image'], false, "<i class='fas fa-star'></i>Imagem Modelo", 'swap'),
            new AttributeDescriptor("error_image", ['image'], false, "<i class='fas fa-star'></i>Imagem com Diferenças", 'swap'),
            new AttributeDescriptor("showTime",['integer'],false,"<img src='/SEIA/media/icones/tempo_branco.svg'>Tempo de exibição",'swap')
        );
        

        'showTime' in data? this.showTime = data['showTime']*1000: this.showTime = -1;
        this.timer = 0;

    }
 
    

    resize(scale){
        //Chamada para redimensionar a atividade em uma tela diferente.
        //Aqui não precisa fazer algo especial.
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
        
        //por enquanto são estes dados. 
        
        exp['stimuli'] = this.stimulis;
        return exp;
    }

    startRunning(){
        
        super.startRunning();
        console.log("start running");
        
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
        console.log("Timer: " + this.timer + " Total Time: " + this.showTime);
        return;
    }

    render(ctx, scale=1){
        var i;
        //render padrão, manda desenhar todos estímulos. 
        for(i = 0; i < this.stimulis.length; i++){
            this.stimulis[i].render(ctx, scale);
        }
    }
    
    
    renderPreview(ctx, scale=1){
        //o preview é usado na edição, caso seja necessário desenhar de maneira diferente...
        this.render(ctx, scale);
    }
    
    pointerUp(evt){
        //ao soltar o mouse ou touch. Evento chamado, aqui trata. 
    }
    pointerDown(evt){
        //ao pressionar o mouse ou touch. Evento chamado, aqui trata. 
    }
    editPointerDown(evt){
        //na edição, ao clicar...
        this.clickEditImage();       
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