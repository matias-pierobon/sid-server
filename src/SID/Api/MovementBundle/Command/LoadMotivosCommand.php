<?php

namespace SID\Api\MovementBundle\Command;
use Doctrine\ORM\EntityManager;
use SID\Api\MovementBundle\Entity\Motivo;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadMotivosCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:motivos:load')
            ->setDescription('Load Motivos')
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
        $io->block('Bienvenido al cargador de Motivos de Movimientos SID', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();
        $em = $this->getManager();

        $data = array(
            array("Uso", "USA", -1),
            array("Fabricación", "FAB", +1),
            array("Merma", "MER", -1),
            array("Destrucción", "DES", -1),
            array("Pérdida", "PER", -1),
            array("Compra", "CPR", 1),
            array("Venta", "VTA", -1),
            array("Importación", "IMP", 1),
            array("Exportación", "EXP", -1),
            array("Cesión-I", "CEI", 1),
            array("Cesión-E", "CEE", -1),
            array("Devolución-I", "DEI", 1),
            array("Devolución-E", "DEE", -1),
            array("Excedente-I", "EXI", 1),
            array("Excedente-E", "EXE", -1)
        );

        foreach ($data as $datum) {
            $motivo = new Motivo();
            $motivo
                ->setNombre($datum[0])
                ->setDetalle($datum[1]);
            $em->persist($motivo);
        }

        $em->flush();

        $io->newLine();
        $io->success("se han cargado los motivos de movimiento con éxito!");
        $io->newLine();
    }
}