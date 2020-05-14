<?php

namespace GaylordP\UniqueVisitorIdentifierBundle;

use Doctrine\ORM\EntityManagerInterface;
use GaylordP\UniqueVisitorIdentifierBundle\Entity\UniqueVisitorIdentifier as UniqueVisitorIdentifierEntity;
use Symfony\Component\HttpFoundation\RequestStack;

class UniqueVisitorIdentifier
{
    private $sessionName = 'uvi';
    private $sessionAntiFloodTime = 300;

    private $requestStack;
    private $em;

    public function __construct(RequestStack $requestStack, EntityManagerInterface $em)
    {
        $this->requestStack = $requestStack;
        $this->em = $em;
    }

    public function get(): UniqueVisitorIdentifierEntity
    {
        $request = $this->requestStack->getCurrentRequest();

        $identifierEntity = null;

        if (null !== $request->getSession()->get($this->sessionName)) {
            $identifierEntity = $this
                ->em
                ->getRepository(UniqueVisitorIdentifierEntity::class)
                ->findOneByUuid($request->getSession()->get($this->sessionName))
            ;
        }

        if (null === $identifierEntity) {
            $antiFloodTime = new \DateTime();
            $antiFloodTime->modify('-' . $this->sessionAntiFloodTime . 'seconds');

            $identifierEntity = $this
                ->em
                ->getRepository(UniqueVisitorIdentifierEntity::class)
                ->findByAntiFlood($request->server->get('REMOTE_ADDR'), $antiFloodTime)
            ;
        }

        if (null === $identifierEntity) {
            $uuid = uuid_create(UUID_TYPE_RANDOM);

            $identifierEntity = new UniqueVisitorIdentifierEntity();
            $identifierEntity->setUuid($uuid);
            $identifierEntity->setHttpAcceptLanguage($request->server->get('HTTP_ACCEPT_LANGUAGE'));
            $identifierEntity->setHttpUserAgent($request->server->get('HTTP_USER_AGENT'));
            $identifierEntity->setRemoteAddr($request->server->get('REMOTE_ADDR'));

            $this->em->persist($identifierEntity);

            $request->getSession()->set($this->sessionName, $uuid);
        }

        $identifierEntity->setAntiFloodDate(new \DateTime());
        $this->em->flush();

        return $identifierEntity;
    }
}
