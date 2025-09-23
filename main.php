<?php

require 'vendor/autoload.php';

use GuzzleHttp\Client;
use Sophia\SearchEngine\SearchEngine;
use Symfony\Component\DomCrawler\Crawler;

// Client creation and the foundation of your domain
$client = new Client(['base_uri' => 'http://alura.com.br/']);
$crawler = new Crawler();

$searchEngine = new SearchEngine($client,$crawler);

// Make a request from the path
$courses = $searchEngine->search('/cursos-online-programacao/php');

foreach ($courses as $course) {
    echo "{$course}\n";
}
