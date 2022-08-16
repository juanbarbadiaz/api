<?php

namespace AppBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

class ApiCommand extends ContainerAwareCommand
{
    /*
        Para ejecutar el comando usar
        php bin/console app:lanzar-llamada
    */
    protected function configure()
    {
        $this
            // the name of the command (the part after "bin/console")
            ->setName('app:lanzar-llamada')

            // the short description shown while running "php bin/console list"
            ->setDescription('Lanza un ejemplo de llamada a un api')

            // the full command description shown when running the command with
            // the "--help" option
            ->setHelp("Lanza un ejemplo de llamada a un api")
            // argumentos
            ->addArgument('url', InputArgument::REQUIRED, 'introduzca uel');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $this->generarLlamada($input, $output);

    }


    private function generarLlamada($input, $output)
    {

        return $input['url'];
    }

}