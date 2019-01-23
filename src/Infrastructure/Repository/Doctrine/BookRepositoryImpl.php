<?php

namespace JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine;

use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class BookRepositoryImpl implements BookRepository
{
    public function getAllBooks($options)
    {
        global $entityManager;

        $total = $entityManager->getRepository(Book::class)->createQueryBuilder('b')
            ->select('count(b.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $queryBuilder = $entityManager->getRepository(Book::class)->createQueryBuilder('b');
        $queryBuilder->where("b.title LIKE :title");
        $queryBuilder->orWhere('b.author LIKE :author');
        $queryBuilder->andWhere("b.is_deleted = ''");
        $queryBuilder->setParameter('title', "%{$options['search']}%");
        $queryBuilder->setParameter('author', "%{$options['search']}%");
        $queryBuilder->orderBy("b.{$options['order_column']}", \strtoupper($options['order_by']));
        
        if ($options['limit'] > 0) {
            $queryBuilder->setMaxResults($options['limit']);
        }
        
        $queryBuilder->setFirstResult($options['offset']);

        $result = $queryBuilder->getQuery()->getResult();

        return [
            'total' => $total,
            'filteredTotal' => \count($result),
            'result' => $result
        ];
    }

    public function find(BookId $bookId)
    {
        global $entityManager;

        $bookEntity = $entityManager->getRepository(Book::class)->findBy(['id' => $bookId->get()]);
        
        return $bookEntity[0];
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

        $deletedAt = (new DateCreated(DateCreated::GENERATE))->get();
        $bookEntity[0]->setIsDeleted($deletedAt);

        $entityManager->flush();
    }
}
