<?php
/**
 * Created by PhpStorm.
 * User: Barry
 * Date: 28/08/2017
 * Time: 22:42
 */

namespace AppBundle\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class TestCommand  extends Command
{
    protected function configure()
    {
        $this
            ->setName('app:test:command')
            ->setDescription('Command test')
            ->setHelp('This command a test command in symfony');

        $this->addArgument('username',InputArgument::REQUIRED, 'The username of the user');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln(['test 1',
                          'test 1',
                          'test 1'
                        ]);
        $output->writeln('test 2');
        $output->writeln('test 3');
    }


}