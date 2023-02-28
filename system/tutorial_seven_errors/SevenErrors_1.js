class SevenErrors  extends Instruction {
    //construtor, com dados padrão.
    constructor(data = { 'type': 'SevenErrors', 'position': -1, 'editable': true, 'next': -1 }, activity) {
        super(data,activity);
    
        this.editableAttributes.push(
            new AttributeDescriptor("original_image", ['image'], false, "<i class='fas fa-star'></i>Imagem Modelo", 'swap'),
            new AttributeDescriptor("error_image", ['image'], false, "<i class='fas fa-star'></i>Imagem com Diferenças", 'swap'),
            new AttributeDescriptor("showTime",['integer'],false,"<img src='/SEIA/media/icones/tempo_branco.svg'>Tempo de exibição",'swap')
        );

    }
    
}