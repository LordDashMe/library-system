<?php

namespace JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine;

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\CreatedAt;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class BookRepositoryImpl implements BookRepository
{
    public function getAllBooks()
    {
        global $entityManager;

        return $entityManager->getRepository(Book::class)->findBy(array(), array('date_created' => 'DESC'));
    }

    public function add(Book $book)
    {
        global $entityManager;
        
        $entityManager->persist($book);
        $entityManager->flush();
    }

    public function edit(Book $book)
    {
        global $entityManager;
        
        $entityManager->merge($book);
        $entityManager->flush();
    }

    public function softDelete(BookId $bookId)
    {
        global $entityManager;

        $bookEntity = $entityManager->getRepository(Book::class)->findBy(['id' => $bookId->get()]);

        $deletedAt = (new CreatedAt(CreatedAt::GENERATE))->get();
        $bookEntity[0]->setIsDeleted($deletedAt);

        $entityManager->flush();
    }
}
