<?php

namespace SID\Api\UnityBundle\Command;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use SID\Api\UnityBundle\Entity\UsuarioUnidad;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadUsersCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:unities:loadUsers')
            ->setDescription('Load users to unities')
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

        $unidades = $em->getRepository('UnityBundle:UnidadEjecutora')->findAll();
        $users = new ArrayCollection($em->getRepository('UserBundle:User')->findAll());

        foreach ($unidades as $unidad) {
            foreach ($users as $user) {
                if(rand(0,2) == 1){
                    $em->persist(new UsuarioUnidad($user, $unidad));
                }
            }
        }

        $em->flush();

        $io->newLine();
        $io->success("Unidades cargadas");
        $io->newLine();
    }
}