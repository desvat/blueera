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
?>