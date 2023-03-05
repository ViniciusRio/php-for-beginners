<?php

// Anonymous function
//$filter = function ($items, $fn) {
//    $filteredItems = [];
//
//    foreach ($items as $item) {
//        if ($fn($item)) {
//            $filteredItems[] = $item;
//        }
//    }
//
//    return $filteredItems;
//};
// Using Anonymous function
//        $filteredBooks = $filter($books, function ($book) {
//            return $book['year'] > 1994;
//        });

//$books = [
//    [
//        'name' => 'Game Of Thrones',
//        'author' => 'George Martin',
//        'year' => 1995,
//        'purchaseUrl' => 'https://amazon.com'
//    ],
//    [
//        'name' => 'Fire and Blood',
//        'author' => 'George Martin',
//        'year' => 2000,
//        'purchaseUrl' => 'https://amazon.com'
//    ],
//    [
//        'name' => 'Dominando Android',
//        'author' => 'Nelson Glauber',
//        'year' => 2019,
//        'purchaseUrl' => 'https://amazon.com'
//    ]
//];

//$filteredBooks = array_filter($books, function ($book) {
//    return $book['year'] > 1950 && $book['year'] < 2020;
//});

$heading = 'Home';

require "views/index.view.php";