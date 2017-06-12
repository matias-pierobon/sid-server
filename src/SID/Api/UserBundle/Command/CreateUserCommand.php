<?php

namespace SID\Api\UserBundle\Command;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use SID\Api\UserBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
class CreateUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:users:create')
            ->setDescription('Create user')
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

        $email = $io->ask('User email', null, function ($email) {
            if (!is_string($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                throw new \RuntimeException(
                    'The email is invalid'
                );
            }
            return $email;
        });
        $password = $io->askHidden('User password', null, function ($password) use ($io) {
            if (!is_string($password)) {
                throw new \RuntimeException(
                    'Invalid Password'
                );
            }
        });

        $roles = array('ROLE_USER');

        if($io->confirm("Es admin")){
            $roles[] = 'ROLE_ADMIN';
        }

        $user = new User();
        $user
            ->setEmail($email)
            ->setLastname($io->ask('Apellido'))
            ->setName($io->ask('Nombre'))
            ->setPassword('chunk')
            ->setSalt('chunk')
            ->setPlainPassword($password)
            ->setUsername($io->ask('Nombre de usuario'))
            ->setRoles($roles);

        $this->getManager()->persist($user);
        $this->getManager()->flush();

        $io->newLine();
        $io->success($user->getUsername() . " se ha creado con éxito!");
        $io->newLine();
    }
}