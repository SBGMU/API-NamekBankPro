<?php

// src/Command/DisplayCreditCardsNumberCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\CreditCard;
use App\Repository\CreditCardRepository;

class DisplayCreditCardsNumberCommand extends Command
{
    private $creditCardRepository;

	public function __construct(CreditCardRepository $creditCardRepository)   
    {
    	$this->creditCardRepository = $creditCardRepository;
        parent::__construct();
    }


    protected function configure()
    {
    	$this
	        // the name of the command (the part after "bin/console")
	        ->setName('app:creditcards-number')

	        // the short description shown while running "php bin/console list"
	        ->setDescription('Displays the number of credit cards.')

	        // the full command description shown when running the command with
	        // the "--help" option
	        ->setHelp('This command allows you to display the number of credit cards...')
	    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	    // outputs multiple lines to the console (adding "\n" at the end of each line)
	    $output->writeln([
	    	'',
	        'Nombre de Carte de Credit',
	        '',
	    ]);

	    $creditCards = $this->creditCardRepository->findAll();


        $output->writeln(['Nombre de Carte de Credit : '. count($creditCards) , '']);
    }
}

?>