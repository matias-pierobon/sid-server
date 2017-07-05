<?php

namespace SID\Api\SubstanceBundle\Command;
use Doctrine\ORM\EntityManager;
use SID\Api\SubstanceBundle\Entity\GHS;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;
use Symfony\Component\HttpFoundation\File\File;

class LoadGHSCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('sid:ghs:load')
            ->setDescription('Load ghs')
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
        $io->block('Bienvenido al cargador de imgenes de GHS de SID', null, 'bg=blue;fg=white', ' ', true);
        $io->newLine();
        $em = $this->getManager();

        $finder = new Finder();
        $finder->files()->in(__DIR__ . '/../Resources/public/images/ghs');

        /* @var SplFileInfo $file */
        foreach ($finder as $file) {
            $ghs = new GHS();
            $ghs
                ->setDetalle($file->getBasename())
                ->setImageBlob($file);
            $em->persist($ghs);
        }

        $em->flush();

        $io->newLine();
        $io->success("se han cargado las imagenes GHS con éxito!");
        $io->newLine();
    }
}