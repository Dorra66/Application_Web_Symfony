<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * Userrequest
 *
 * @ORM\Table(name="userrequest")
 * @ORM\Entity(repositoryClass="LibraryBundle\Repository\UserRequestRepository")
 */
class Userrequest
{
    /**
     * @var integer
     *
     * @ORM\Column(name="idrequest", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $idrequest;

    /**

     * @ORM\ManyToOne(targetEntity="UserBundle\Entity\User")
     * @ORM\JoinColumn(name="memberid", referencedColumnName="id")
     */
    private $memberid;



    /**

     * @ORM\ManyToOne(targetEntity="LibraryBundle\Entity\Book")
     * @ORM\JoinColumn(name="bookId", referencedColumnName="bookId")
     */
    private $bookid;

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
     * @ORM\Column(name="memberlastname", type="string", length=255, nullable=false)
     */
    private $memberlastname;

    /**
     * @var string
     *
     * @ORM\Column(name="memberemail", type="string", length=255, nullable=false)
     */
    private $memberemail;

    /**
     * @var integer
     * @Assert\Length(min=8,max=8)
     * @ORM\Column(name="membermobile", type="integer", nullable=false)
     */
    private $membermobile;

    /**
     * @var \DateTime
     *
     *
     * @ORM\Column(name="Issuedate", type="date", nullable=false)
     */
    private $issuedate;

    /**
     * @var integer
     *
     * @ORM\Column(name="issueperiod", type="integer", nullable=false)
     */
    private $issueperiod;

    /**
     * @var string
     *
     * @ORM\Column(name="requeststate", type="string", length=255, nullable=false)
     */
    private $requeststate = 'Not Confirmed';

    /**
     * @var integer
     *
     * @ORM\Column(name="weakmemberid", type="integer")
     */
    private $weakmemberid ;


    /**
     * @return int
     */
    public function getIdrequest()
    {
        return $this->idrequest;
    }

    /**
     * @param int $idrequest
     */
    public function setIdrequest($idrequest)
    {
        $this->idrequest = $idrequest;
    }

    /**
     * @return mixed
     */
    public function getMemberid()
    {
        return $this->memberid;
    }

    /**
     * @param mixed $memberid
     */
    public function setMemberid($memberid)
    {
        $this->memberid = $memberid;
    }

    /**
     * @return mixed
     */
    public function getBookid()
    {
        return $this->bookid;
    }

    /**
     * @param mixed $bookid
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
     * @return string
     */
    public function getMemberemail()
    {
        return $this->memberemail;
    }

    /**
     * @param string $memberemail
     */
    public function setMemberemail($memberemail)
    {
        $this->memberemail = $memberemail;
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
    public function getIssuedate()
    {
        return $this->issuedate;
    }

    /**
     * @param \DateTime $issuedate
     */
    public function setIssuedate($issuedate)
    {
        $this->issuedate = $issuedate;
    }

    /**
     * @return int
     */
    public function getIssueperiod()
    {
        return $this->issueperiod;
    }

    /**
     * @param int $issueperiod
     */
    public function setIssueperiod($issueperiod)
    {
        $this->issueperiod = $issueperiod;
    }

    /**
     * @return string
     */
    public function getRequeststate()
    {
        return $this->requeststate;
    }

    /**
     * @param string $requeststate
     */
    public function setRequeststate($requeststate)
    {
        $this->requeststate = $requeststate;
    }

    /**
     * @return int
     */
    public function getWeakmemberid()
    {
        return $this->weakmemberid;
    }

    /**
     * @param int $weakmemberid
     */
    public function setWeakmemberid($memberid)
    {
        $this->weakmemberid = $memberid;
    }
}