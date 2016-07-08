<?php
namespace Onlinestore\BooksBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Onlinestore\BooksBundle\Entity\Books;
ini_set('auto_detect_line_endings', TRUE);

class CsvImportCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('csv:import')
            ->setDescription('Import csv')
            ->addOption(
                'file',
                null,
                InputOption::VALUE_REQUIRED
            )
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name = $input->getOption('file');
        $em = $this->getContainer()->get('doctrine')->getManager();
        $file_handle = fopen($name, 'r');
        while (!feof($file_handle) ) {
            $array = fgetcsv($file_handle);
            if(!empty($array)) {
                $line_of_text[] = $array;
            }
        }
        fclose($file_handle);
        $line_of_text = array_slice($line_of_text, 1);
        foreach($line_of_text as $row){
            $bookEntry = new Books();
            $bookEntry->setTitle($row[0]);
            $bookEntry->setDescription($row[1]);
            $em->persist($bookEntry);
            $em->flush();
        }
    }
}

