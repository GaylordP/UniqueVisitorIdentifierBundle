<?php

namespace GaylordP\UniqueVisitorIdentifierBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * UniqueVisitorIdentifier
 *
 * @ORM\Entity(repositoryClass="GaylordP\UniqueVisitorIdentifierBundle\Repository\UniqueVisitorIdentifierRepository")
 */
class UniqueVisitorIdentifier
{
    /**
     * @var integer
     *
     * @ORM\Id
     * @ORM\Column(name="id", type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=36)
     */
    private $uuid;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $httpAcceptLanguage;

    /**
     * @var string
     *
     * @ORM\Column(type="string")
     */
    private $httpUserAgent;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=15)
     */
    private $remoteAddr;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $antiFloodDate;

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * Get id
     *
     * @return int
     */
    public function getId(): ?string
    {
        return $this->id;
    }

    /**
     * Get uuid
     *
     * @return string
     */
    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    /**
     * Set uuid
     *
     * @param string $uuid
     */
    public function setUuid(?string $uuid): void
    {
        $this->uuid = $uuid;
    }

    /**
     * Get http accept language
     *
     * @return string
     */
    public function getHttpAcceptLanguage(): ?string
    {
        return $this->httpAcceptLanguage;
    }

    /**
     * Set http accept language
     *
     * @param string $httpAcceptLanguage
     */
    public function setHttpAcceptLanguage(?string $httpAcceptLanguage): void
    {
        $this->httpAcceptLanguage = $httpAcceptLanguage;
    }

    /**
     * Get http user agent
     *
     * @return string
     */
    public function getHttpUserAgent(): ?string
    {
        return $this->httpUserAgent;
    }

    /**
     * Set http user agent
     *
     * @param string $httpUserAgent
     */
    public function setHttpUserAgent(?string $httpUserAgent): void
    {
        $this->httpUserAgent = $httpUserAgent;
    }

    /**
     * Get remote addr
     *
     * @return string
     */
    public function getRemoteAddr(): ?string
    {
        return $this->remoteAddr;
    }

    /**
     * Set remote addr
     *
     * @param string $remoteAddr
     */
    public function setRemoteAddr(?string $remoteAddr): void
    {
        $this->remoteAddr = $remoteAddr;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt(): ?\DateTime
    {
        return $this->createdAt;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $date
     */
    public function setCreatedAt(\DateTime $date): void
    {
        $this->createdAt = $date;
    }

    /**
     * Get antiFloodDate
     *
     * @return \DateTime
     */
    public function getAntiFloodDate(): ?\DateTime
    {
        return $this->createdAantiFloodDatet;
    }

    /**
     * Set antiFloodDate
     *
     * @param \DateTime $date
     */
    public function setAntiFloodDate(\DateTime $date): void
    {
        $this->antiFloodDate = $date;
    }
}
