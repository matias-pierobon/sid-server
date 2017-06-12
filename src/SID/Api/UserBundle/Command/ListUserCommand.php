<?php

namespace SID\Api\UserBundle\Command;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
class ListUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:users:list')
            ->setDescription('List all users')
            ->setHelp('This command lists all system users');
    }
    protected function getDoctrine()
    {
        return $this->getContainer()->get('doctrine');
    }
    protected function getManager(): EntityManager
    {
        return $this->getDoctrine()->getManager();
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $io = new SymfonyStyle($input, $output);
        $io->newLine();
        $io->title('User\'s list');
        $users = new ArrayCollection($this->getManager()->getRepository('UserBundle:User')->findAll());
        $io->table(
            array('id', 'Username', 'Name', 'Lastname', 'Role' , 'sysDate'),
            $users->map(function (User $user){
                return array(
                    $user->getId(),
                    $user->getUsername(),
                    $user->getName(),
                    $user->getLastname(),
                    $user->isAdmin() ? 'Admin' : 'User',
                    $user->getSysDate()->format("d/m/Y H:m:s")
                );
            })->toArray()
        );
    }
}