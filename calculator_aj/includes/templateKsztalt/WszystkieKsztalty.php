<?php

$data2 = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'szerokosc' => [
        'editable' => true,
        'tytul' => 'Šírka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'wysokoscA' => [
        'editable' => true,
        'tytul' => 'Výška A',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'wysokoscB' => [
        'editable' => true,
        'tytul' => 'Výška B',
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
    'dodatkoweOzdobneKrawedzie' => [
        'editable' => false,
        'tytul' => 'Ďalšie ozdobné hrany',
        'typ' => 'checkbox',
        'checked' => 'false',
    ],
    'dodatkoweZaslepki' => [
        // to moze nie dzialac
        'editable' => true,
        'tytul' => 'Dodatočné zástrčky',
        'typ' => 'number',
        'cena' => 10,

        // 'min' => 1,
        // 'max' => 2,
        // 'step' => 1,
    ],

];

// $profil -> khc_testAssignedShape($data2);
// Przykładowa tablica DESKA
$data123 = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'szerokosc' => [
        'editable' => true,
        'tytul' => 'Šírka',
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
     'gruboscRdzenia'=>[
                    'editable' => true,
                    'tytul' => 'Hrúbka jadra',
                    'typ'=>'radio',
                    'wartosci'=>[
                           0 => 2.5,
                           1 => 5,
                    ],
        ],

];
// Przykładowa tablica PROFIL PELNY
$datafdsaf = [
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
// Przykładowa tablica PROFIL Przelotowy
$data123431 = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'szerokosc' => [
        'editable' => true,
        'tytul' => 'Šírka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'wysokosc' => [
        'editable' => true,
        'tytul' => 'Výška',
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
    'dodatkoweZaslepki' => [
        
        'editable' => true,
        'tytul' => 'Dodatočné zástrčky',
        'typ' => 'number',
        'cena' => 10,

        // 'min' => 1,
        // 'max' => 2,
        // 'step' => 1,
    ],     
 
];
// Przykładowa tablica Kątownik
$datax2 = [
    'dlugosc' => [
        'editable' => true,
        'tytul' => 'Dĺžka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'szerokosc' => [
        'editable' => true,
        'tytul' => 'Šírka',
        'typ' => 'number',
        'min' => 1,
        'max' => 20,
        'step' => 1,
    ],
    'wysokosc' => [
        'editable' => true,
        'tytul' => 'Výška',
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
    'dodatkoweOzdobneKrawedzie' => [
        'editable' => false,
        'tytul' => 'Ďalšie ozdobné hrany',
        'typ' => 'checkbox',
        'checked' => 'false',
    ],
     
];

?>