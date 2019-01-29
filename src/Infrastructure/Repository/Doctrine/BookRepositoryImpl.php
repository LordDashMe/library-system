<?php

namespace JoshuaReyes\LibrarySystem\Infrastructure\Repository\Doctrine;

use Doctrine\ORM\EntityManagerInterface;
use JoshuaReyes\LibrarySystem\Domain\Entity\Book;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;
use JoshuaReyes\LibrarySystem\Domain\Repository\BookRepository;

class BookRepositoryImpl implements BookRepository
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function add(Book $book)
    {
        $this->entityManager->persist($book);
        $this->entityManager->flush();
    }

    public function edit(Book $book)
    {
        $this->entityManager->merge($book);
        $this->entityManager->flush();
    }

    public function find(BookId $bookId)
    {
        $bookEntity = $this->entityManager->getRepository(Book::class)->findBy(['id' => $bookId->get()]);
        
        return $bookEntity[0];
    }

    public function softDelete(BookId $bookId)
    {
        $bookEntity = $this->entityManager->getRepository(Book::class)->findBy(['id' => $bookId->get()]);

        $deletedAt = (new DateCreated())->generate()->get();
        $bookEntity[0]->setIsDeleted($deletedAt);

        $this->entityManager->flush();
    }

    public function getBooksDataTable($options)
    {
        $total = $this->entityManager->getRepository(Book::class)->createQueryBuilder('b')
            ->select('count(b.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $queryBuilder = $this->entityManager->getRepository(Book::class)->createQueryBuilder('b');
        $queryBuilder->where("b.isDeleted = ''");
        $queryBuilder->andWhere("b.title LIKE :title OR b.author LIKE :author");
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
}
