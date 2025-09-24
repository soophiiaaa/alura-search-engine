<?php

namespace Sophia\SearchEngine;

use GuzzleHttp\ClientInterface;
use Symfony\Component\DomCrawler\Crawler;

class SearchEngine
{
    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var Crawler
     */
    private $crawler;

    public function __construct(
        ClientInterface $httpClientInterface,
        Crawler $crawler
    ) {
        $this->httpClient = $httpClientInterface;
        $this->crawler = $crawler;
    }

    public function search(string $url): array
    {
        $response = $this->httpClient->request('GET', $url);

        // Access the html body
        $html = $response->getBody();

        $this->crawler->addHtmlContent($html);

        $coursesElement = $this->crawler->filter('span.card-curso__nome');

        $courses = [];

        // Adds the text content of each element to the array
        foreach ($coursesElement as $element) {
            $courses[] = $element->textContent;
        }

        return $courses;
    }
}
