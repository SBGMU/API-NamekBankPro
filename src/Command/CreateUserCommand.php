<?php

// src/Command/CreateUserCommand.php
namespace App\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use App\Entity\Master;
use Doctrine\ORM\EntityManagerInterface;

class CreateUserCommand extends Command
{
    private $entityManager;

	public function __construct(EntityManagerInterface $entityManager)   
    {
    	$this->entityManager = $entityManager;
        parent::__construct();
    }


    protected function configure()
    {
    	$this
	        // the name of the command (the part after "bin/console")
	        ->setName('app:create-admin')

	        // the short description shown while running "php bin/console list"
	        ->setDescription('Creates a new admin.')

	        // the full command description shown when running the command with
	        // the "--help" option
	        ->setHelp('This command allows you to create a admin...')
	    ;

	    $this
	        // configure an argument
	        ->addArgument('firstname', InputArgument::REQUIRED, 'The firstname of the admin.')
	        ->addArgument('lastname', InputArgument::REQUIRED, 'The lastname of the admin.')
	        ->addArgument('email', InputArgument::REQUIRED, 'The email of the admin.')
	    ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
	    // outputs multiple lines to the console (adding "\n" at the end of each line)
	    $output->writeln([
	        'Administrateur',
	        '',
	    ]);

	    // the value returned by someMethod() can be an iterator (https://secure.php.net/iterator)
	    // that generates and returns the messages with the 'yield' PHP keyword

	    // outputs a message followed by a "\n"

	    $output->write('You are about to ');
	    $output->writeln('create a admin.');

		// retrieve the argument value using getArgument()
		$output->writeln('Firstname: '.$input->getArgument('firstname'));
		$output->writeln('Lastname: '.$input->getArgument('lastname'));
		$output->writeln('Email: '.$input->getArgument('email'));

		$firstname = $input->getArgument('firstname');
		$lastname = $input->getArgument('lastname');
		$email = $input->getArgument('email');

		$admin = new Master();
		$admin->setFirstname($firstname);
        $admin->setLastname($lastname);
        $admin->setEmail($email);
        $admin->setRoles(['ROLE_ADMIN']);

        $this->entityManager->persist($admin);
        $this->entityManager->flush();

        $output->writeln('Adminustrateur créé !');
    }
}

?>