let container_btn = document.querySelector('.container_btn');
let container_geomotif = document.querySelector('.container_geomotif');
for (var i=0; i<= 80; i++){
    let blocks = document.createElement('div');
    blocks.classList.add('block');
    container_geomotif.appendChild(blocks);
}

function circle(){
    let circleBtn = document.querySelector('.circleBtn');
    container_geomotif.classList.toggle('circle'); // J'ai ajouté .geomotif pour cibler la classe correcte
}

function generer(){
    anime({
        targets :  '.block',
        translateX : function(){
            return anime.random(-700,700);
        },
        translateY : function(){
            return anime.random(-400,400);
        },
        scale : function(){
            return anime.random(1,3);
        }
    })
}

generer()