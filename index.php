<?php

require 'vendor/autoload.php';
require 'doctrine_config.php';

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Title;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Description;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Author;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DatePublished;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;

use JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine\BookRepositoryImpl;

$bookRepository = new BookRepositoryImpl();
// $bookRepo->add();

// ADD
// $entityManager->persist(new Book(
//     new BookId(),
//     new Title('test'),
//     new Description('test description'),
//     new Author('John Doe'),
//     new DatePublished(),
//     new DateCreated(DateCreated::GENERATE)
// ));
// $entityManager->flush();

// UPDATE
// $entityManager->merge(new Book(
//     new BookId('5c46e2e080704'),
//     new Title('test'),
//     new Description('test description'),
//     new Author('John Doe121212'),
//     new DatePublished(),
//     new DateCreated(DateCreated::GENERATE)
// ));
// $entityManager->flush();

// SOFT DELETE
// $bookEntity = $entityManager->getRepository(Book::class)->findBy(['id' => '5c46e2e080704']);
// $deletedAt = (new DateCreated(DateCreated::GENERATE))->get();
// $bookEntity[0]->setIsDeleted($deletedAt);
// $entityManager->flush();

// GET ALL
// $records = $entityManager->getRepository(Book::class)->findBy(array(), array('date_created' => 'DESC'));

$records = $bookRepository->getAllBooks();
echo '<pre>';
var_dump($records);
