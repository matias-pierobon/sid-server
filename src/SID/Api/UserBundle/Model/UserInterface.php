<?php

namespace SID\Api\UserBundle\Model;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;

interface UserInterface extends AdvancedUserInterface{
    
    public function getEmail(): string;
    public function getPlainPassword(): string;
}