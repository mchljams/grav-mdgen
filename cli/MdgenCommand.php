<?php

namespace Grav\Plugin\Console;

use Grav\Console\ConsoleCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Grav\Plugin\Mdgen\Generator;

/**
 * Class MdgenCommand
 *
 * @package Grav\Plugin\Console
 */
class MdgenCommand extends ConsoleCommand
{
    /**
     * @var array
     */
    protected $options = [];

    /**
     *
     */
    protected function configure()
    {
        $this
            ->setName("generate")
            ->setDescription("Generates a markdown file.")
            ->addArgument(
                'path',
                InputArgument::REQUIRED,
                'The path, inside the pages directory, where the new markdown file will be saved.'
            )
            ->addOption(
                'template',
                't',
                InputOption::VALUE_NONE,
                'Specify a template, otherwise it will be created as default.'
            )
            ->setHelp('The <info>generate</info> command creates a new markdown file at the location inside the pages directory. Optionally, specify the template.');
    }

    /**
     * @return int|null|void
     */
    protected function serve()
    {

        // Collects the arguments and options as defined
        $this->options = [
            'path' => $this->input->getArgument('path'),
            'template' => $this->input->getOption('template')
        ];
        
        Generator::generate($this->options['path'], $this->options['template']);

    }
}