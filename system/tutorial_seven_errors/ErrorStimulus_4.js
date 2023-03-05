class ErrorStimulus extends Stimulus{

    constructor(localID, activity, instruction, position){
        
        super(null,'text', localID,true,true, activity, instruction);
        var size = [64,64];
        this.renderImage = new DFTImage('_textFrame',size ,position,instruction,this, false);  
        this.renderImage.beingEdited = true;
        
        //o jogador encontrou? 
        this.found = false;
    }
    setFound(){
        this.found = true;
    }
    getRect(){
        return [this.renderImage.position[0], this.renderImage.position[1], 
            this.renderImage.size[0], this.renderImage.size[1]];
    }

    setRect(r){
        this.renderImage.position = [parseInt(r[0]), parseInt(r[1])];
        this.renderImage.setSize([parseInt(r[2]),parseInt(r[3])]);
    }
    
     wasPointed(){
        
        return this.renderImage.wasPointed();
    }
    exportXML(xmlDoc){
        var text_xml = xmlDoc.createElement('text');
        var txtData =[];
        
        txtData['text'] = this.text;
        txtData['textX'] = this.renderImage.position[0];
        txtData['textY'] = this.renderImage.position[1];
        txtData['localID'] = this.localID;
        return [text_xml,txtData];
    }
    render(ctx, scale=1){
        if(this.activity.editing)//se está no modo edição desenha uma borda..
            this.renderImage.borderColor = "#adb7ca";
        else if (this.found){
            this.renderImage.borderColor = "#00FF00";//um verde
        }
        this.renderImage.render(ctx, scale);
    }
    
    renderPreview(ctx, scale){
        if(this.activity.editing)
            this.renderImage.borderColor = "#adb7ca";
       this.renderImage.render(ctx, scale);
       //console.log(this.renderImage);
       //var drawPos = [this.renderImage.position[0],this.renderImage.position[1]];
    }
    getPosition(){
        return "";//a posicao no array de stimulus; em uma atividades aparece escrito, aqui nao precisa
    }
    
     pointerDown(evt) {
        //throw new Error('You have to implement the pointerDown method!');
    }
    
    pointerUp(evt) {
        //throw new Error('You have to implement the pointerUp method!');
    }
    pointerMove(evt) {
        //throw new Error('You have to implement the pointerMove method!');
    }
    pointerDrag(evt){
        //throw new Error('You have to implement the pointerDrag method!');
    }
    
    editPointerUp(evt){
        
        
    }
    
    editPointerDown(evt){
        //throw new Error('You have to implement the editMouseDown method!');
    }
    
    editPointerMove(evt){
        //throw new Error('You have to implement the editMouseDrag method!');
    }
    editPointerDrag(evt){
        //throw new Error('You have to implement the editPointerDrag method!');
    }
    
}




