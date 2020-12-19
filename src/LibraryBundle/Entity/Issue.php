<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Issue
 *
 * @ORM\Table(name="issue", indexes={@ORM\Index(name="bookid", columns={"bookid"}), @ORM\Index(name="memberid", columns={"memberid"})})
 * @ORM\Entity(repositoryClass="LibraryBundle\Repository\IssueRepository")
 */
class Issue
{
    /**
     * @var integer
     *
     * @ORM\Column(name="issueid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $issueid;

    /**
     * @var string
     *
     * @ORM\Column(name="booktitle", type="string", length=255, nullable=false)
     */
    private $booktitle;

    /**
     * @var string
     *
     * @ORM\Column(name="membername", type="string", length=255, nullable=false)
     */
    private $membername;

    /**
     * @var string
     *
     * @ORM\Column(name="memberlastname", type="string", length=255, nullable=false)
     */
    private $memberlastname;

    /**
     * @var integer
     *
     * @ORM\Column(name="membermobile", type="integer", nullable=false)
     */
    private $membermobile;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="issuetime", type="datetime", nullable=false)
     */
    private $issuetime = 'CURRENT_TIMESTAMP';

    /**
     * @var \Book
     *
     * @ORM\ManyToOne(targetEntity="Book")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="bookid", referencedColumnName="bookId")
     * })
     */
    private $bookid;

    /**
     * @var \User
     *
     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="memberid", referencedColumnName="id")
     * })
     */
    private $memberid;

    /**
     * @return int
     */
    public function getIssueid()
    {
        return $this->issueid;
    }

    /**
     * @param int $issueid
     */
    public function setIssueid($issueid)
    {
        $this->issueid = $issueid;
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
    public function getMembername()
    {
        return $this->membername;
    }

    /**
     * @param string $membername
     */
    public function setMembername($membername)
    {
        $this->membername = $membername;
    }

    /**
     * @return string
     */
    public function getMemberlastname()
    {
        return $this->memberlastname;
    }

    /**
     * @param string $memberlastname
     */
    public function setMemberlastname($memberlastname)
    {
        $this->memberlastname = $memberlastname;
    }

    /**
     * @return int
     */
    public function getMembermobile()
    {
        return $this->membermobile;
    }

    /**
     * @param int $membermobile
     */
    public function setMembermobile($membermobile)
    {
        $this->membermobile = $membermobile;
    }

    /**
     * @return \DateTime
     */
    public function getIssuetime()
    {
        return $this->issuetime;
    }

    /**
     * @param \DateTime $issuetime
     */
    public function setIssuetime($issuetime)
    {
        $this->issuetime = $issuetime;
    }

    /**
     * @return \Book
     */
    public function getBookid()
    {
        return $this->bookid;
    }

    /**
     * @param \Book $bookid
     */
    public function setBookid($bookid)
    {
        $this->bookid = $bookid;
    }

    /**
     * @return UserBundle\Entity\User
     */
    public function getMemberid()
    {
        return $this->memberid;
    }

    /**
     * @param UserBundle\Entity\User $memberid
     */
    public function setMemberid($memberid)
    {
        $this->memberid = $memberid;
    }

}

