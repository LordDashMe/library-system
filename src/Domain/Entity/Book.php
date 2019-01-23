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
    /**
     * @ORM\Id
     * @ORM\Column(type="guid")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="text")
     */
    private $author;

    /**
     * @ORM\Column(type="text")
     */
    private $date_published;

    /**
     * @ORM\Column(type="text")
     */
    private $date_created;

    /**
     * @ORM\Column(type="text", options={"comment": "np = Not Published | p = Published"})
     */
    private $is_published = 'np';

    /**
     * @ORM\Column(type="text", options={"comment": "We use date flag for the is deleted inorder to log when the deletion happened."})
     */
    private $is_deleted = '';

    public function __construct(
        BookId $id,
        Title $title,
        Description $description,
        Author $author,
        DatePublished $date_published,
        DateCreated $date_created
    ) {
        $this->id = $id->get();
        $this->title = $title->get();
        $this->description = $description->get();
        $this->author = $author->get();
        $this->date_published = $date_published->get();
        $this->date_created = $date_created->get();
    }

    public function id()
    {
        return $this->id;
    }

    public function title()
    {
        return $this->title;
    }

    public function description()
    {
        return $this->description;
    }

    public function author()
    {
        return $this->author;
    }

    public function datePublished()
    {
        return $this->date_published;
    }

    public function dateCreated()
    {
        return $this->date_created;
    }

    public function isPublished()
    {
        return $this->is_published;   
    }

    public function setIsDeleted($is_deleted)
    {
        $this->is_deleted = $is_deleted;
    }

    public function setIsPublished($is_published)
    {
        $this->is_published = $is_published;
    }
}
