<?php
namespace SID\Api\UserBundle\Serializer\Normalizer;

use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use SID\Api\UserBundle\Entity\User;

class UserNormalizer implements NormalizerInterface{

    public function normalizeUser(User $user){
        return array(
            'nombre' => $user->getUsername()
        );
    }

    public function normalize($object, $format = null, array $context = array()){
        $a = array();
        foreach($object as $user){
            $a[] = $this->normalizeUser($user);
        }
        return $a;
    }

    public function supportsNormalization($data, $format = null){
        return true;
    }
}