<?php
namespace SID\Api\DrugBundle\Security;

use Doctrine\Common\Collections\ArrayCollection;
use SID\Api\DrugBundle\Entity\Droguero;
use SID\Api\SubstanceBundle\Entity\Droga;
use SID\Api\UserBundle\Entity\User;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authorization\Voter\Voter;

class DrogueroVoter extends Voter
{

    /**
     * @return ArrayCollection
     */
    protected function handlers (){
        return new ArrayCollection (array(
            "view" => function(Droguero $droguero, User $user){
                return $user->isAdmin() || $droguero->hasInclusiveAccess($user);
            },
            "create" => function(Droguero $droguero, User $user){
                return $user->isAdmin();
            },
            "edit" => function(Droguero $droguero, User $user){
                return $user->isAdmin();
            },
            "entry" => function(Droguero $droguero, User $user){
                return $droguero->hasInclusiveAccess($user);
            },
            "access" => function(Droguero $droguero, User $user){
                return $droguero->isResponsable($user);
            },
            "config" => function(Droguero $droguero, User $user){
                return $droguero->isResponsable($user);
            },
            "movement" => function(Droguero $droguero, User $user){
                return $droguero->hasInclusiveAccess($user);
            }
        ));
    }


    /**
     * @param string $attribute
     * @param Droguero $droguero
     * @param User $user
     *
     * @return boolean
     */
    protected function handle($attribute, $droguero, $user){
        return $this->handlers()[$attribute]($droguero, $user);
    }

    protected function supports($attribute, $subject)
    {
        if(!$this->handlers()->containsKey($attribute)){
            return false;
        }

        if (!$subject instanceof Droguero) {
            return false;
        }

        return true;
    }

    /**
     * @param string $attribute
     * @param Droguero $droguero
     * @param TokenInterface $token
     *
     * @return bool
     */
    protected function voteOnAttribute($attribute, $droguero, TokenInterface $token)
    {
        $user = $token->getUser();

        if (!$user instanceof User) {
            return false;
        }

        return $this->handle($attribute, $droguero, $user);
    }
}