<?php

namespace SID\Api\UserBundle\Command;
use Doctrine\ORM\EntityManager;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
class LoadUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:users:load')
            ->setDescription('Load users')
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
        $io->block('Bienvenido al creador de usuarios de SID', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();
        $em = $this->getManager();
        for ($i = 2; $i < 21; $i++){
            $io->text("Creando usuario ". $i);
            $user = new User();
            $user
                ->setEmail('user'.$i.'@google.com')
                ->setLastname('Usuario')
                ->setName($i)
                ->setPassword('chunk')
                ->setSalt('chunk')
                ->setPlainPassword('1234')
                ->setUsername('user'. $i)
                ->setRoles(array('ROLE_USER'));
            $em->persist($user);
        }

        $em->flush();

        $io->newLine();
        $io->success($user->getUsername() . " se ha creado con éxito!");
        $io->newLine();
    }
}