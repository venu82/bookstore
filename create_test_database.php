<?php

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Debug\Debug;
use Onlinestore\BooksBundle\Entity\Books;
ini_set('auto_detect_line_endings', TRUE);
$loader = require_once __DIR__.'/app/bootstrap.php.cache';
Debug::enable();

require_once __DIR__.'/app/AppKernel.php';

$kernel = new AppKernel('dev', true);
$kernel->loadClassCache();
$request = Request::createFromGlobals();
$kernel->boot();

$container = $kernel->getContainer();
$container->enterScope('request');
$container->set('request', $request);

$em = $container->get('doctrine')->getManager();


$file_handle = fopen('books.csv', 'r');
while (!feof($file_handle) ) {
    $array = fgetcsv($file_handle);
    if(!empty($array)) {
        $line_of_text[] = $array;
    }
}
fclose($file_handle);
$line_of_text = array_slice($line_of_text, 1);
foreach($line_of_text as $row){
       $bookEntry = new Books();
       $bookEntry->setTitle($row[0]);
       $bookEntry->setDescription($row[1]);
       $em->persist($bookEntry);
       $em->flush();
}
