class DFTImage{

    constructor(databaseID, size, position, instruction, stimulus, resizable=true){
        
        this.stimulus = stimulus;
        this.id = databaseID;
        this.size = size;
        this.position = [parseInt(position[0]), parseInt(position[1])];
        this.canDrag = false;
        this.instruction = instruction;
        this.resizeButtonSize = 22;
        this.strokeSize = 3;
        this.resizable =  resizable;
        this.resizeImage;
        
        this.borderColor = null;
        this.gearIcon = document.getElementById('_gearIcon');
        this.lixeira = document.getElementById('_lixeira');
        this.redim = document.getElementById('_redim');
        this.mouse_first_click = [];
        
        this.clickXButton = function(){ 
            
            this.instruction.removeStimulus(this.stimulus);
        }
        this.clickConfigButton = function(){ 
            
            this.instruction.configureStimulus(this.stimulus);
        }
        
        this.hasButtonClick = false;
        this.removeButtonSquare =[this.size[0]-this.resizeButtonSize, 0, this.size[0], this.resizeButtonSize];
        this.gearButtonSquare = [this.size[1]-2*this.resizeButtonSize, 0, this.size[0]-this.resizeButtonSize, this.resizeButtonSize];
        this.resizeButtonSquare = [];
    }

    render(ctx, scale=1){

        var link = document.createElement('link');
        link.setAttribute('rel', 'stylesheet');
        link.setAttribute('type', 'text/css');
        //link.setAttribute('href', 'href="https://fonts.googleapis.com/css2?family=Righteous&display=swap');
        document.head.appendChild(link);
        
        var img = document.getElementById(this.id);

        if(!img){
            //console.log("no image " +this.id);
            return;
        }
        
        ctx.drawImage(img, 
        this.position[0]* scale, this.position[1] * scale,
        this.size[0] * scale, this.size[1]* scale);
        //if(this.instruction.isEditing()){
            
            if(this.borderColor!=null){
                ctx.beginPath();
                ctx.strokeStyle  = this.borderColor;
                ctx.lineWidth = 3;
                ctx.rect(this.position[0]*scale, this.position[1]*scale,
                this.size[0] * scale, this.size[1]* scale);
                ctx.stroke();
            }            
            
       // }
       
        if(this.instruction.isEditing() && this.beingEdited){                        
            ctx.beginPath();
            var blur_bkp = ctx.shadowBlur;
            var col_bkp = ctx.shadowColor;
            
            ctx.rect(this.position[0]*scale, this.position[1]*scale,
            this.size[0] * scale, this.size[1]* scale);
            ctx.stroke();
            
            ctx.setLineDash([]);
            
            ctx.shadowBlur = 3;
            ctx.shadowColor = "#fff";
            ctx.strokeStyle  = "#0086b3";
            ctx.lineWidth = 3;
            
            
            
            var sq = [this.position[0]*scale+this.size[0]*scale - this.resizeButtonSize,
                      this.position[1]*scale+this.size[1]*scale - this.resizeButtonSize];
           
            
           /************************* redim arrow *****************************/
           if(this.resizable){
                ctx.beginPath();

                ctx.drawImage(this.redim,sq[0]* scale, sq[1] * scale,this.resizeButtonSize * scale, this.resizeButtonSize* scale);

                ctx.shadowBlur = 3;
                ctx.shadowColor = "#fff";

                /*
                ctx.strokeStyle  = "#22499c";
                ctx.lineWidth = 4;
                
                ctx.moveTo(sq[0], sq[1]);
                ctx.lineTo(sq[0]+this.resizeButtonSize,sq[1]+ this.resizeButtonSize+1);

                ctx.moveTo(sq[0]+this.resizeButtonSize, sq[1]);
                ctx.lineTo(sq[0]+this.resizeButtonSize,sq[1]+ this.resizeButtonSize+1);

                ctx.moveTo(sq[0], sq[1]+this.resizeButtonSize);
                ctx.lineTo(sq[0]+this.resizeButtonSize,sq[1]+ this.resizeButtonSize+1);

                ctx.stroke();*/
            }
           /************************* redim arrow *****************************/
            
            //************************************* botão de excluir
            if(this.stimulus.canRemove){
                ctx.beginPath();

                sq = [this.position[0]+this.size[0] - this.resizeButtonSize, this.position[1]];

                ctx.drawImage(this.lixeira,sq[0]* scale, sq[1] * scale,this.resizeButtonSize * scale, this.resizeButtonSize* scale);
                
                ctx.shadowBlur = 3;
                ctx.shadowColor = "#fff";

                /*
                ctx.strokeStyle  = "#ff1a1a";
                ctx.lineWidth = 4;
                sq = [this.position[0]+this.size[0] - this.resizeButtonSize, this.position[1]];
                ctx.moveTo(sq[0], sq[1]);
                ctx.lineTo(sq[0]+this.resizeButtonSize,sq[1]+ this.resizeButtonSize);
                ctx.moveTo(sq[0]+this.resizeButtonSize, sq[1]);
                ctx.lineTo(sq[0],sq[1]+ this.resizeButtonSize);
                ctx.stroke();*/
            }
            //************************************* botão de excluir
            
            //************************************* gear icon.

                ctx.beginPath();
                
                sq = [this.position[0]+this.size[0] - (this.resizeButtonSize)*2, this.position[1]];
                
                ctx.drawImage(this.gearIcon, sq[0]* scale, sq[1] * scale, this.resizeButtonSize * scale, this.resizeButtonSize* scale);

                ctx.shadowBlur = 3;
                ctx.shadowColor = "#fff";
            
            //************************************* gear icon.            
            
            ctx.shadowBlur = blur_bkp;
            ctx.shadowColor = col_bkp;

            ctx.font = '36px Righteous';
            ctx.fillStyle = '#22499c';
            ctx.strokeStyle = '#15306bda';
            ctx.lineWidth = 2;
            ctx.beginPath();
            
            ctx.fillText(this.stimulus.getPosition(), this.position[0], this.position[1]+this.size[1]);
            ctx.strokeText(this.stimulus.getPosition(), this.position[0], this.position[1]+this.size[1]);

            ctx.stroke();

        }
    }
    
    renderPreview(ctx, scale){
        this.render(ctx, scale);
        
    }
    
    isPointInside(pos){
        
        if(pos[0] > this.position[0] && pos[0] < (this.position[0]+this.size[0]))
        {
            if(pos[1] > this.position[1] && pos[1] < this.position[1]+this.size[1]){
                return true;
            }
        }
        return false;
    }

    distFrom(anotherImage){
        var center1 = [(this.position[0] + this.size[0])/2,(this.position[1] + this.size[1])/2];
        
        var center2 = [(anotherImage.position[0] + anotherImage.size[0])/2,(anotherImage.position[1] + anotherImage.size[1])/2];
        
        var diff = [center1[0]-center2[0], center1[1]-center2[1]];
        
        var dst = Math.sqrt(diff[0]*diff[0] + diff[1]*diff[1]);

        return dst;
    }
    
    isClose(anotherImage, maxDistance){
        
        
        var center1 = [(this.position[0] + this.size[0])/2,(this.position[1] + this.size[1])/2];
        
        var center2 = [(anotherImage.position[0] + anotherImage.size[0])/2,(anotherImage.position[1] + anotherImage.size[1])/2];
        
        var diff = [center1[0]-center2[0], center1[1]-center2[1]];
        
        var dst = Math.sqrt(diff[0]*diff[0] + diff[1]*diff[1]);
        console.log(dst);
        if(dst<maxDistance)
            return true;
        
        return false;
    }
    
    inside(anotherImage){
        var points = [];
        var inside_ = true;
        points.push([this.position[0], this.position[1]]);
        points.push([this.position[0], this.position[1]+ this.size[1]]);
        points.push([this.position[0] + this.size[0], this.position[1]]);
        points.push([this.position[0] + this.size[0], this.position[1]+ this.size[1]]);
        
        var i;
        for(i =0 ; i < points.length; i++){
            if(!anotherImage.isPointInside(points[i]))
                inside_ = false;
        }

        return inside_;
    }

    touches(anotherImage){
        var points = [];
        points.push([this.position[0], this.position[1]]);
        points.push([this.position[0], this.position[1]+ this.size[1]]);
        points.push([this.position[0] + this.size[0], this.position[1]]);
        points.push([this.position[0] + this.size[0], this.position[1]+ this.size[1]]);
        
        var i;
        for(i =0 ; i < points.length; i++){
            if(anotherImage.isPointInside(points[i]))
                return true;
        }
        
        return false;
    }
    
    pointerDown(evt) {
        
        if(this.instruction.isEditing())
            this.editPointerDown(evt);
        
        this.stimulus.pointerDown();
    }
    
    pointerUp(evt) {
        if(this.instruction.isEditing())
            this.editPointerUp(evt);
        this.stimulus.pointerUp(evt);
    }
    pointerMove(evt) {
        
        //throw new Error('You have to implement the pointerMove method!');
    }
    pointerDrag(evt){
       
        var move = this.instruction.activity.pointerMovement;
        if(this.canDrag && this.stimulus.isDraggable){
       
            this.position[0] = this.position[0] + move[0];
            this.position[1] = this.position[1] + move[1];
        }
    }
    
    editPointerUp(evt){
        var pos = this.instruction.activity.lastPointerPos;
        if(this.instruction.isEditing())
            this.checkClickButton(pos);
       
        this.stimulus.editPointerUp(evt);
    }
    
    editPointerDown(evt){
        
        this.mouse_first_click = this.instruction.activity.lastPointerPos;
        var pos = this.instruction.activity.lastPointerPos;
        
        pos[0] = parseInt(pos[0]);
        pos[1] = parseInt(pos[1]);
        var posInsideImage = [pos[0]-this.position[0], pos[1] - this.position[1]];
        this.hasButtonClick = false;
        if(this.stimulus.isClickable || this.instruction.isEditing()){
            if(pos[0] > this.position[0] && pos[0] < (this.position[0]+this.size[0]))
            {
                if(pos[1] > this.position[1] && pos[1] < this.position[1]+this.size[1]){
                    if(this.instruction.isEditing()){
                        //on top left
                        this.resizeImage = false;
                        
                        if(posInsideImage[0] +1 >= (this.size[0]-this.resizeButtonSize) && 
                                posInsideImage[1] +1 >= (this.size[1]-this.resizeButtonSize) ){
                            this.resizeImage = true;
                            this.hasButtonClick = true;
                            
                        }
                        
                            
                    }
                    
                    
                }
            }
        }

        this.stimulus.editPointerDown(evt);
    }
    
    wasPointed(){
       
        var pos = this.instruction.activity.lastPointerPos;
        pos[0] = parseInt(pos[0]);
        pos[1] = parseInt(pos[1]);
        console.log("pointer pos");
        console.log(pos);
        if(this.stimulus.isClickable || this.instruction.isEditing()){
            if(pos[0] > this.position[0] && pos[0] < (this.position[0]+this.size[0]))
            {
                if(pos[1] > this.position[1] && pos[1] < this.position[1]+this.size[1]){
                    return true;
                }
            }
        }
        return false;
    }
    setSize(size){
        this.size = size;
        this.removeButtonSquare =[this.size[0]-this.resizeButtonSize, 0, this.size[0], this.resizeButtonSize];
        this.gearButtonSquare =[this.size[0]-2*this.resizeButtonSize, 0, this.size[0]-this.resizeButtonSize, this.resizeButtonSize];
        
    }
    editPointerMove(evt){
        //throw new Error('You have to implement the editMouseDrag method!');
    }
    editPointerDrag(evt){
        var move = this.instruction.activity.pointerMovement;
        if(this.canDrag){
       
            this.position[0] = this.position[0] + move[0];
            this.position[1] = this.position[1] + move[1];
        }
        else if(this.resizeImage){
            
            this.size[0] = this.size[0] + move[0];
            this.size[1] = this.size[1] + move[1];
            
            //minimum size. does not accept negative values
           /* if(this.size[0]<40)
            {
                this.size[0] = 40;
            }
            if(this.size[1] < 40){
                this.size[1] = 40;
                
            }*/
            
            this.removeButtonSquare =[this.size[0]-this.resizeButtonSize, 0, this.size[0], this.resizeButtonSize];
            this.gearButtonSquare =[this.size[0]-2*this.resizeButtonSize, 0, this.size[0]-this.resizeButtonSize, this.resizeButtonSize];
            return;
        }
    }
    
    checkClickButton(pos){
        
        var pos = this.instruction.activity.lastPointerPos;
        pos[0] = parseInt(pos[0]);
        pos[1] = parseInt(pos[1]);
        var posInsideImage = [pos[0]-this.position[0], pos[1] - this.position[1]];
        this.hasButtonClick = false;
         if(this.clickable || this.instruction.isEditing()){
            if(pos[0] > this.position[0] && pos[0] < (this.position[0]+this.size[0]))
            {
                
                if(pos[1] > this.position[1] && pos[1] < this.position[1]+this.size[1]){
                    if(this.instruction.isEditing()){
                        
                        if(posInsideImage[0] +1 >= this.removeButtonSquare[0] && 
                           posInsideImage[0] +1 <= this.removeButtonSquare[2] &&      
                           posInsideImage[1] +1 >= this.removeButtonSquare[1] && 
                           posInsideImage[1] +1 <= this.removeButtonSquare[3] ){
                            //remove
                            if(!this.stimulus.canRemove){
                                return;
                            }
                            this.hasButtonClick = true;
                            
                            if(this.clickXButton == null)
                            {
                                throw new Error('Set clicXButton');
                            }
                            else
                                this.clickXButton();
                           
                            
                        }
                        else if(posInsideImage[0] +1 >= this.gearButtonSquare[0] && 
                           posInsideImage[0] +1 <= this.gearButtonSquare[2] &&      
                           posInsideImage[1] +1 >= this.gearButtonSquare[1] && 
                           posInsideImage[1] +1 <= this.gearButtonSquare[3] ){
                           
                            //config
                            this.hasButtonClick = true;
                            
                            if(this.clickConfigButton == null)
                            {
                                throw new Error('Set clicConfigButton');
                            }
                            else
                                this.clickConfigButton();
                            
                            
                        }
                    }
                }
            }
        }
    }
}

