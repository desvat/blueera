<?php
$data = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'liczbaSztuk' => [
        'editable' => true,
        'tytul' => 'Počet kusov',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,

    ],
    'dodatkowaOzdobnaScianka' => [
        'editable' => false,
        'tytul' => 'Dodatočná dekoratívna stena',
        'typ' => 'checkbox',
        'checked' => 'false',
    ], 
    'dodatkoweZaslepki' => [
        
        'editable' => true,
        'tytul' => 'Dodatočné zástrčky',
        'typ' => 'number',
        'cena' => 10,

        // 'min' => 1,
        // 'max' => 2,
        // 'step' => 1,
    ],  
    'przekroj'=>[
            'editable' => true,
            'tytul' => 'Prierez',
            'typ'=>'radio',
            'wartosci'=>[
                    0 =>[ 
                        'dlugosc'=> 11,
                        'szerokosc'=> 10,
                    ],
                    1 =>[ 
                        'dlugosc'=> 12,
                        'szerokosc'=> 10,
                    ],
            ],

    ],

];
?>