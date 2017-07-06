<?php

namespace SID\Api\SubstanceBundle\Command;
use Doctrine\ORM\EntityManager;
use SID\Api\SubstanceBundle\Entity\UnidadMedida;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

class LoadUnidadesCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:unidadmedida:load')
            ->setDescription('Load unidad de medida')
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
        $io->block('Bienvenido al cargador de unidades de medidas de SID', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();
        $em = $this->getManager();

        $data = array(
            array("kg", "Kilogramo"),
            array("l", "Litro")
        );

        foreach ($data as $datum) {
            $unidad = new UnidadMedida();
            $unidad
                ->setSigla($datum[0])
                ->setDetalle($datum[1]);
            $em->persist($unidad);
        }

        $em->flush();

        $io->newLine();
        $io->success("se han cargado las unidades de medidas con éxito!");
        $io->newLine();
    }
}