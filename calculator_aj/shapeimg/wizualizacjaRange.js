if(ksztalt == "profilPelny"){

    console.log("profilPelny");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        // newPixel = newPixel *3;
        newPixel = Math.round(newPixel);
        
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');

        $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
        $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');

        $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('height',parseFloat($('#productCustomTopright').css('height'))+newPixel+'px');

        $('#productCustomFace').css('top',parseFloat($('#productCustomFace').css('top'))+newPixel+'px');
        $('#productCustomFace').css('left',(parseFloat($('#productCustomFace').css('left'))+newPixel)+'px');

        $('#productCustomEnding2').css('top',parseFloat($('#productCustomEnding2').css('top'))+newPixel+'px');
        $('#productCustomEnding2').css('left',(parseFloat($('#productCustomEnding2').css('left'))+newPixel)+'px');

        $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
        $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');
        oldDlugosc = value;
    }

    if(inputId=='dodatkoweZaslepki'){
        var value = parseInt($(e.target).val());
       
        if(value == 0){
            $('#productCustomEnding1').css('visibility','hidden');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 1){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 2){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','visible');
        }
    }
}

if(ksztalt == "deska"){

    // console.log("deska");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = Math.round(newPixel);
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');
        $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
        $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');
        $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
        $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');
        oldDlugosc = value;
    }
    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel * 10;
        $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('width',parseFloat($('#productCustomTopleft2').css('width'))+newPixel+'px');
        $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');
        $('#productCustomFront').css('width',parseFloat($('#productCustomFront').css('width'))+newPixel+'px');
        oldSzerokosc = value;
    }
}

if(ksztalt == "deskaWall"){
   
    // console.log("deskaWall");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = Math.round(newPixel);
       
      
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');

        $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');

        $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
        $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');

        $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
        $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');

        oldDlugosc = value;
    }

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel * 10;
        $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('width',parseFloat($('#productCustomTopleft2').css('width'))+newPixel+'px');
        $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');
        $('#productCustomFront').css('width',parseFloat($('#productCustomFront').css('width'))+newPixel+'px');



        oldSzerokosc = value;

    }

}

if(ksztalt == "elastycznaimitacjadeski"){
   
    // console.log("elastycznaimitacjadeski");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = newPixel *3;
        newPixel = Math.round(newPixel);
       
      
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomLeftRdzen').css('width',parseFloat($('#productCustomLeftRdzen').css('width'))+newPixel+'px');
        $('#productCustomLeftRdzen').css('height',parseFloat($('#productCustomLeftRdzen').css('height'))+newPixel+'px');

        $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');

        $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
        $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');

        $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
        $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');

        oldDlugosc = value;
    }

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel * 10;
        $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('width',parseFloat($('#productCustomTopleft2').css('width'))+newPixel+'px');
        $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');
        $('#productCustomFront').css('width',parseFloat($('#productCustomFront').css('width'))+newPixel+'px');



        oldSzerokosc = value;

    }

}

if(ksztalt == "elastycznaokleina"){
   
    // console.log("elastycznaokleina");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = Math.round(newPixel);
       
      
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');

        $('#productCustomTopleft2').css('left',(parseFloat($('#productCustomTopleft2').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('height',parseFloat($('#productCustomTopleft2').css('height'))+newPixel+'px');

        $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+(newPixel)+'px');
        $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');

        $('#productCustomFront').css('top',parseFloat($('#productCustomFront').css('top'))+newPixel+'px');
        $('#productCustomFront').css('left',(parseFloat($('#productCustomFront').css('left'))+newPixel)+'px');

        oldDlugosc = value;
    }

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel * 10;
        $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
        $('#productCustomTopleft2').css('width',parseFloat($('#productCustomTopleft2').css('width'))+newPixel+'px');
        $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');
        $('#productCustomFront').css('width',parseFloat($('#productCustomFront').css('width'))+newPixel+'px');



        oldSzerokosc = value;

    }

}

// L profil
if(ksztalt == "katownik"){

    // console.log("katownik");

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = newPixel *1.2;
        newPixel = Math.round(newPixel);

        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');

        $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
        $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');
        
        $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');

        $('#productCustomTopright2').css('width',parseFloat($('#productCustomTopright2').css('width'))+newPixel+'px');
        $('#productCustomTopright2').css('height',parseFloat($('#productCustomTopright2').css('height'))+newPixel+'px');

        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
        $('#productCustomEdge1').css('left',(parseFloat($('#productCustomEdge1').css('left'))+newPixel)+'px');
        oldDlugosc = value;
    }

    

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel *5;
        $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('left',(parseFloat($('#productCustomTopright').css('left'))+newPixel)+'px');
        $('#productCustomTopright2').css('left',(parseFloat($('#productCustomTopright2').css('left'))+newPixel)+'px');


        oldSzerokosc = value;

    }
    if(inputId=='wysokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldWysokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldWysokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldWysokosc,value)*roznica;
        }
        newPixel = newPixel *5;
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');


        oldWysokosc = value;
    }

    if ($('#dodatkoweOzdobneKrawedzie').is(':checked')) {
        $('#productCustomTopright').css('height', $('#productCustomTopright2').css('height'));
    }


}

// O profil
if(ksztalt == "profilPrzelotowy"){

    if(inputId=='dlugosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = newPixel *1.5;
        newPixel = Math.round(newPixel);
        $('#productCustomBottom').css('left',(parseFloat($('#productCustomBottom').css('left'))+newPixel)+'px');
        $('#productCustomBottom').css('height',parseFloat($('#productCustomBottom').css('height'))+newPixel+'px');

        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        
        $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
        $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');

        $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('height',parseFloat($('#productCustomTopright').css('height'))+newPixel+'px');

        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
        $('#productCustomEdge1').css('left',(parseFloat($('#productCustomEdge1').css('left'))+newPixel)+'px');

        $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
        $('#productCustomEdge2').css('left',(parseFloat($('#productCustomEdge2').css('left'))+newPixel)+'px');

        $('#productCustomEnding2').css('top',parseFloat($('#productCustomEnding2').css('top'))+newPixel+'px');
        $('#productCustomEnding2').css('left',(parseFloat($('#productCustomEnding2').css('left'))+newPixel)+'px');
        oldDlugosc = value;
    }

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        // newPixel = Math.round(newPixel);
        newPixel = newPixel *5;
        
        $('#productCustomBottom').css('width',parseFloat($('#productCustomBottom').css('width'))+newPixel+'px');
        $('#productCustomRight').css('left',(parseFloat($('#productCustomRight').css('left'))+newPixel)+'px');
        $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('left',(parseFloat($('#productCustomTopright').css('left'))+newPixel)+'px');
        $('#productCustomEdge2').css('left',(parseFloat($('#productCustomEdge2').css('left'))+newPixel)+'px');
        $('#productCustomEnding1').css('width',parseFloat($('#productCustomEnding1').css('width'))+newPixel+'px');
        $('#productCustomEnding2').css('width',parseFloat($('#productCustomEnding2').css('width'))+newPixel+'px');

        oldSzerokosc = value;
    }
    if(inputId=='wysokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldWysokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldWysokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldWysokosc,value)*roznica;
        }
        newPixel = newPixel *5;
        $('#productCustomBottom').css('top',parseFloat($('#productCustomBottom').css('top'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
        $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
        $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
        $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');


        oldWysokosc = value;
    }

    if(inputId=='dodatkoweZaslepki'){
        var value = parseInt($(e.target).val());
       
        if(value == 0){
            $('#productCustomEnding1').css('visibility','hidden');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 1){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 2){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','visible');
        }
    }

}

// U profil
if(ksztalt == "Ceownik"){

    // console.log("Ceownik");

    if(inputId=='dlugosc'){
    
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldDlugosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldDlugosc,value);
        }else{
            var newPixel = checkDirectionValue(oldDlugosc,value)*roznica;
        }
        newPixel = Math.round(newPixel);
        $('#productCustomRight').css('width',parseFloat($('#productCustomRight').css('width'))+newPixel+'px');
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');

        $('#productCustomInneredge').css('width',parseFloat($('#productCustomInneredge').css('width'))+newPixel+'px');
        $('#productCustomInneredge').css('height',parseFloat($('#productCustomInneredge').css('height'))+newPixel+'px');
        
        $('#productCustomLeft').css('width',parseFloat($('#productCustomLeft').css('width'))+newPixel+'px');
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        
        $('#productCustomTopleft').css('left',(parseFloat($('#productCustomTopleft').css('left'))+newPixel)+'px');
        $('#productCustomTopleft').css('height',parseFloat($('#productCustomTopleft').css('height'))+newPixel+'px');

        $('#productCustomTopright').css('width',parseFloat($('#productCustomTopright').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('height',parseFloat($('#productCustomTopright').css('height'))+newPixel+'px');

        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
        $('#productCustomEdge1').css('left',parseFloat($('#productCustomEdge1').css('left'))+newPixel+'px');

        $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
        $('#productCustomEdge2').css('left',parseFloat($('#productCustomEdge2').css('left'))+newPixel+'px');

        $('#productCustomPlankleft').css('width',parseFloat($('#productCustomPlankleft').css('width'))+newPixel+'px');
        $('#productCustomPlankleft').css('height',parseFloat($('#productCustomPlankleft').css('height'))+newPixel+'px');

        $('#productCustomPlankright').css('width',parseInt($('#productCustomPlankright').css('width'))+newPixel+'px');
        $('#productCustomPlankright').css('height',parseInt($('#productCustomPlankright').css('height'))+newPixel+'px');

        $('#productCustomEnding2').css('top',parseFloat($('#productCustomEnding2').css('top'))+newPixel+'px');
        $('#productCustomEnding2').css('left',parseFloat($('#productCustomEnding2').css('left'))+newPixel+'px');
        // 
        oldDlugosc = value;
    }

    if(inputId=='szerokosc'){
        var value = parseFloat($(e.target).val());
        var roznica = Math.abs(value - oldSzerokosc);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldSzerokosc,value);
        }else{
            var newPixel = checkDirectionValue(oldSzerokosc,value)*roznica;
        }
        newPixel = newPixel *5;
        // newPixel = Math.round(newPixel);
        $('#productCustomRight').css('left',parseFloat($('#productCustomRight').css('left'))+newPixel+'px');
        $('#productCustomInneredge').css('left',parseFloat($('#productCustomInneredge').css('left'))+newPixel+'px');
        $('#productCustomTopleft').css('width',parseFloat($('#productCustomTopleft').css('width'))+newPixel+'px');
        $('#productCustomTopright').css('left',parseFloat($('#productCustomTopright').css('left'))+newPixel+'px');
        $('#productCustomEdge2').css('left',parseFloat($('#productCustomEdge2').css('left'))+newPixel+'px');
        $('#productCustomPlankleft').css('width',parseFloat($('#productCustomPlankleft').css('width'))+newPixel+'px');
        $('#productCustomPlankright').css('left',parseFloat($('#productCustomPlankright').css('left'))+newPixel+'px');
        $('#productCustomEnding1').css('width',parseFloat($('#productCustomEnding1').css('width'))+newPixel+'px');
        $('#productCustomEnding2').css('width',parseFloat($('#productCustomEnding2').css('width'))+newPixel+'px');
        oldSzerokosc = value;
    }
    if(inputId=='wysokoscA'){

        var value = parseFloat($(e.target).val());
        
// console.log('wysokoscA: ' + value);

        var roznica = Math.abs(value - oldWysokoscA);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldWysokoscA,value);
        }else{
            var newPixel = checkDirectionValue(oldWysokoscA,value)*roznica;
        }
        newPixel = newPixel *5;
        // newPixel = Math.round(newPixel);
        $('#productCustomLeft').css('height',parseFloat($('#productCustomLeft').css('height'))+newPixel+'px');
        $('#productCustomEdge1').css('top',parseFloat($('#productCustomEdge1').css('top'))+newPixel+'px');
        $('#productCustomPlankleft').css('top',parseFloat($('#productCustomPlankleft').css('top'))+newPixel+'px');
        $('#productCustomPlankright').css('top',parseFloat($('#productCustomPlankright').css('top'))+newPixel+'px');

        
        if(value > parseFloat($('#wysokoscB').val())){
            $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
            $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');
        }
        if(newPixel<0){
                if(value == parseFloat($('#wysokoscB').val())){
                $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))-(newPixel*(-1))+'px');
                $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))-(newPixel*(-1))+'px');
                
            }
        }
        
        
        
// css ==


        oldWysokoscA = value;
    }
    if(inputId=='wysokoscB' || inputId=='wysokoscA'){

        var value = parseFloat($(e.target).val());

// console.log('wysokoscB: ' + value);

        var roznica = Math.abs(value - oldWysokoscB);
        if(roznica == 0){
            var newPixel = checkDirectionValue(oldWysokoscB,value);
        }else{
            var newPixel = checkDirectionValue(oldWysokoscB,value)*roznica;
        }
        newPixel = newPixel *5;
        // newPixel = Math.round(newPixel);
        $('#productCustomRight').css('height',parseFloat($('#productCustomRight').css('height'))+newPixel+'px');
        $('#productCustomInneredge').css('top',parseFloat($('#productCustomInneredge').css('top'))+newPixel+'px');
        $('#productCustomEdge2').css('top',parseFloat($('#productCustomEdge2').css('top'))+newPixel+'px');
        $('#productCustomPlankleft').css('top',parseFloat($('#productCustomPlankleft').css('top'))+newPixel+'px');
        $('#productCustomPlankright').css('top',parseFloat($('#productCustomPlankright').css('top'))+newPixel+'px');

        if(value > parseFloat($('#wysokoscA').val())){
            $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))+newPixel+'px');
            $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))+newPixel+'px');
        }
        if(newPixel<0){
            if(value == parseFloat($('#wysokoscA').val())){
                $('#productCustomEnding1').css('height',parseFloat($('#productCustomEnding1').css('height'))-(newPixel*(-1))+'px');
                $('#productCustomEnding2').css('height',parseFloat($('#productCustomEnding2').css('height'))-(newPixel*(-1))+'px');
            
            }
        }
        oldWysokoscB = value;
    }

    if(inputId=='dodatkoweZaslepki'){
        var value = parseInt($(e.target).val());
       
        if(value == 0){
            $('#productCustomEnding1').css('visibility','hidden');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 1){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','hidden');
        }
        if(value == 2){
            $('#productCustomEnding1').css('visibility','visible');
            $('#productCustomEnding2').css('visibility','visible');
        }
    }
    
}