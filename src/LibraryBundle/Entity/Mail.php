<?php

namespace LibraryBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Mail
 *
 * @ORM\Table(name="mail")
 * @ORM\Entity
 */
class Mail
{
    /**
     * @var integer
     *
     * @ORM\Column(name="mailid", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $mailid;

    /**
     * @var string
     *
     * @ORM\Column(name="toemail", type="string", length=255, nullable=false)
     */
    private $toemail;

    /**
     * @var string
     *
     * @ORM\Column(name="subjet", type="string", length=255, nullable=false)
     */
    private $subjet;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="string", length=255, nullable=false)
     */
    private $message;

    /**
     * @return int
     */
    public function getMailid()
    {
        return $this->mailid;
    }

    /**
     * @param int $mailid
     */
    public function setMailid($mailid)
    {
        $this->mailid = $mailid;
    }

    /**
     * @return string
     */
    public function getToemail()
    {
        return $this->toemail;
    }

    /**
     * @param string $toemail
     */
    public function setToemail($toemail)
    {
        $this->toemail = $toemail;
    }

    /**
     * @return string
     */
    public function getSubjet()
    {
        return $this->subjet;
    }

    /**
     * @param string $subjet
     */
    public function setSubjet($subjet)
    {
        $this->subjet = $subjet;
    }

    /**
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param string $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

}

