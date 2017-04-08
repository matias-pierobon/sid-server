<?php

namespace SID\Api\UserBundle\Service;

use Doctrine\ORM\EntityManager;

class UserService{

    private $_em;

    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }


}