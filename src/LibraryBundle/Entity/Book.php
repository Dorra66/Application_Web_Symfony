<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Book
 *
 * @ORM\Table(name="book")
 * @ORM\Entity(repositoryClass="LibraryBundle\Repository\BookRepository")
 */
class Book
{
    /**
     * @var integer
     *
     * @ORM\Column(name="bookId", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $bookid;

    /**
     * @var string
     *
     * @ORM\Column(name="bookTitle", type="string", length=255, nullable=false)
     */
    private $booktitle;

    /**
     * @var string
     *
     * @ORM\Column(name="bookAuthor", type="string", length=50, nullable=false)
     */
    private $bookauthor;

    /**
     * @ORM\ManyToOne(targetEntity="LibraryBundle\Entity\Category")
     *
     * @ORM\JoinColumn(name="bookcategory",referencedColumnName="name")
     */
    private $bookcategory;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="bookAddDate", type="date", nullable=false)
     */
    private $bookadddate;

    /**
     * @var string
     *
     * @ORM\Column(name="bookImage", type="string", length=255, nullable=false)
     */
    private $bookimage;

    /**
     * @var integer
     *
     * @ORM\Column(name="bookquantity", type="integer", nullable=false)
     */
    private $bookquantity;

    /**
     * @var boolean
     *
     * @ORM\Column(name="bookAvail", type="boolean", nullable=false)
     */
    private $bookavail ;

    /**
     * @return int
     */
    public function getBookid()
    {
        return $this->bookid;
    }

    /**
     * @param int $bookid
     */
    public function setBookid($bookid)
    {
        $this->bookid = $bookid;
    }

    /**
     * @return string
     */
    public function getBooktitle()
    {
        return $this->booktitle;
    }

    /**
     * @param string $booktitle
     */
    public function setBooktitle($booktitle)
    {
        $this->booktitle = $booktitle;
    }

    /**
     * @return string
     */
    public function getBookauthor()
    {
        return $this->bookauthor;
    }

    /**
     * @param string $bookauthor
     */
    public function setBookauthor($bookauthor)
    {
        $this->bookauthor = $bookauthor;
    }

    /**
     * @return mixed
     */
    public function getBookcategory()
    {
        return $this->bookcategory;
    }

    /**
     * @param mixed $bookcategory
     */
    public function setBookcategory($bookcategory)
    {
        $this->bookcategory = $bookcategory;
    }

    /**
     * @return \DateTime
     */
    public function getBookadddate()
    {
        return $this->bookadddate;
    }

    /**
     * @param \DateTime $bookadddate
     */
    public function setBookadddate($bookadddate)
    {
        $this->bookadddate = $bookadddate;
    }

    /**
     * @return string
     */
    public function getBookimage()
    {
        return $this->bookimage;
    }

    /**
     * @param string $bookimage
     */
    public function setBookimage($bookimage)
    {
        $this->bookimage = $bookimage;
    }

    /**
     * @return int
     */
    public function getBookquantity()
    {
        return $this->bookquantity;
    }

    /**
     * @param int $bookquantity
     */
    public function setBookquantity($bookquantity)
    {
        $this->bookquantity = $bookquantity;
    }

    /**
     * @return bool
     */
    public function isBookavail()
    {
        return $this->bookavail;
    }

    /**
     * @param bool $bookavail
     */
    public function setBookavail($bookavail)
    {
        $this->bookavail = $bookavail;
    }
}