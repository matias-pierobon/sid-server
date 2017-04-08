<?php

namespace SID\Api\UserBundle\Service;

use SID\Api\UserBundle\Model\UserInterface;
use Symfony\Component\Security\Core\Encoder\BCryptPasswordEncoder;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class PasswordUpdaterService{

    private $encoderFactory;

    public function __construct(EncoderFactoryInterface $encoderFactory)
    {
        $this->encoderFactory = $encoderFactory;
    }


    public function hashPassword(UserInterface $user)
    {
        $plainPassword = $user->getPlainPassword();
        $encoder = $this->encoderFactory->getEncoder($user);

        $user->setSalt(rtrim(str_replace('+', '.', base64_encode(random_bytes(32))), '='));
        $hashedPassword = $encoder->encodePassword($plainPassword, $user->getSalt());
        $user->setPassword($hashedPassword);
        $user->eraseCredentials();
    }

}