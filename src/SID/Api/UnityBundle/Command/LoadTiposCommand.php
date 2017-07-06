<?php

namespace SID\Api\UnityBundle\Command;
use Doctrine\ORM\EntityManager;
use SID\Api\MovementBundle\Entity\Motivo;
use SID\Api\UnityBundle\Entity\Tipo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadTiposCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:tipos:load')
            ->setDescription('Load Tipos de Unidad')
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
        $io->block('Bienvenido al cargador de Tipos de Unidades SID', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();
        $em = $this->getManager();

        $data = array(
            array("Instituto", "Instituto"),
            array("Laboratorio", "Laboratorio")
        );

        foreach ($data as $datum) {
            $tipo = new Tipo();
            $tipo
                ->setNombre($datum[0])
                ->setDetalle($datum[1]);
            $em->persist($tipo);
        }

        $em->flush();

        $io->newLine();
        $io->success("se han cargado los tipos de unidades con éxito!");
        $io->newLine();
    }
}