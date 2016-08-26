<?php

require_once 'Crawler.php';

$url = 'http://www.w3schools.com/';

$crawler = new Crawler($url);

$crawler->getLinks();
