<?php

namespace JoshuaReyes\LibrarySystem\Domain\Entity;

use Doctrine\ORM\Mapping AS ORM;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\BookId;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Title;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Description;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\Author;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DatePublished;
use JoshuaReyes\LibrarySystem\Domain\ValueObject\DateCreated;

/**
 * @ORM\Entity
 * @ORM\Table(name="books")
 */
class Book
{
    const IS_PUBLISHED = 1;
    const IS_NOT_PUBLISHED = 2;

    /**
     * @ORM\Id
     * @ORM\Column(type="guid", name="id")
     */
    private $id;

    /**
     * @ORM\Column(type="text", name="title")
     */
    private $title;

    /**
     * @ORM\Column(type="text", name="description")
     */
    private $description;

    /**
     * @ORM\Column(type="text", name="author")
     */
    private $author;

    /**
     * @ORM\Column(type="text", name="date_published")
     */
    private $datePublished;

    /**
     * @ORM\Column(type="text", name="date_created")
     */
    private $dateCreated;

    /**
     * @ORM\Column(type="integer", length=2, name="is_published", options={"comment": "1 = Published | 2 = Not Published"})
     */
    private $isPublished = 2;

    /**
     * @ORM\Column(type="text", name="is_deleted", options={"comment": "We use date flag for the field is_deleted in order to log when the deletion happened."})
     */
    private $isDeleted = '';

    public function __construct(
        BookId $id,
        Title $title,
        Description $description,
        Author $author,
        DatePublished $datePublished,
        DateCreated $dateCreated
    ) {
        $this->id = $id->get();
        $this->title = $title->get();
        $this->description = $description->get();
        $this->author = $author->get();
        $this->datePublished = $datePublished->get();
        $this->dateCreated = $dateCreated->get();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getDatePublished()
    {
        return $this->datePublished;
    }

    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    public function getIsPublished()
    {
        return $this->isPublished;   
    }

    public function setIsDeleted($isDeleted)
    {
        $this->isDeleted = $isDeleted;
    }

    public function setIsPublished($isPublished)
    {
        $this->isPublished = $isPublished;
    }

    public function isPublished()
    {
        return $this->isPublished === Book::IS_PUBLISHED ? true : false;
    }
}
