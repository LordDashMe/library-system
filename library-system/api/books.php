<?php

require '../../vendor/autoload.php';
require '../../doctrine_config.php';

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;
use JoshuaReyes\LibrarySystem\Domain\UseCase\ShowBooks;

$showBooks = new ShowBooks(new BookRepositoryImpl());

$records = $showBooks->execute();
echo '<pre>';
var_dump($records);
