<?php

namespace SID\Api\UnityBundle\Command;

use Doctrine\ORM\EntityManager;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class AddUserCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:unities:addUser')
            ->setDescription('Adds an user to a specific unity')
            ->setHelp('This command let you add a user to a unity');
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
        $io->block('Welcome to the SID promotion command', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();

        $em = $this->getManager();
        $userId = $io->ask("User id (null for finish)");
        while ($userId){
            $unityId = $io->ask("Unity id");
            $usuario = $em->getRepository('UserBundle:User')->find($userId);
            $unidad = $em->getRepository('UnityBundle:UnidadEjecutora')->find($unityId);
            $usuarioUnidad = new UsuarioUnidad($usuario, $unidad);
            $em->persist($usuarioUnidad);
            $userId = $io->ask("User id (null for finish)");
        }

        $em->flush();

        $io->newLine();
        $io->success("Transactions have been finished!");
        $io->newLine();
    }
}