<?php

require 'vendor/autoload.php';
require 'Data.php';

use Illuminate\Database\Capsule\Manager as Capsule;


$capsule = new Capsule;

$capsule->addConnection([
    "driver" => "mysql",
    "host" =>"127.0.0.1",
    "database" => "covid",
    "username" => "admin",
    "password" => "password"
]);

//Make this Capsule instance available globally.
$capsule->setAsGlobal();

// Setup the Eloquent ORM.
$capsule->bootEloquent();

$query = Data::query();

$fp = fopen('./../src/data/i/countries.json', 'w');



//$date = $query->select('date')->distinct()->orderBy('date')->pluck('date')->toJson();

//$series = $query->select('country', 'cases', 'date')
//    ->get()
//    ->groupBy('country')
//    ->map(function ($values, $key) {
//        return [
//            'label' => $key,
//            'data' => $values->sortBy(function ($d) {
//                return $d->date->timestamp;
//            })->pluck('cases')
//        ];
//    });

//$datasets = $query->selectRaw('sum(cases) as cases')
//    ->groupBy('date')
//    ->pluck('cases');

//$china = $query->selectRaw('sum(cases) as cases')
//    ->where('country', '<>', 'United_States_of_America')
//    ->groupBy('date')
//    ->orderBy('date')
//    ->pluck('cases');

//$country = $query->select('country')->distinct()->orderBy('country')->pluck('country');

$countries = $query->select('country')
    ->where('date', '2020-03-15')
    ->orderBy('country')
    ->pluck('country');


fwrite($fp, $countries->values()->toJSON());

fclose($fp);






