<?php

namespace App\Controller;

use App\Entity\CreditCard;
use App\Repository\CreditCardRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;


class CreditCardController extends FOSRestController
{
	private $creditCardRepository;
	private $entityManager;
	
	public function __construct(CreditCardRepository $creditCardRepository, EntityManagerInterface $entityManager)
	{
		$this->creditCardRepository = $creditCardRepository;
		$this->entityManager = $entityManager;
	}
	
	/**
	 * @Rest\View(serializerGroups={"creditCards"})
	 */
	public function getCreditCardsAction()
	{
		$creditCards = $this->creditCardRepository->findAll();
		return $this->view($creditCards);
	} // "get_creditCards" [GET] /creditcards
	
	/**
	 * @Rest\View(serializerGroups={"creditCards"})
	 */
	public function getCreditCardAction(CreditCard $creditCard)
	{
		return $this->view($creditCard);
	} // "get_creditCard" [GET] /creditcards/{id}
	
	/**
	* @Rest\Post("/creditcards")
	* @ParamConverter("CreditCard", converter="fos_rest.request_body")
	*/
	public function postCreditCardAction(CreditCard $creditCard)
	{
		$this->entityManager->persist($creditCard);
		$this->entityManager->flush();
		return $this->view($creditCard);
	} // "post_creditCards" [POST] /creditcards
	
	/**
	 * @Rest\View(serializerGroups={"creditCards"})
	 */
	public function putCreditCardAction(Request $request, CreditCard $creditCard)
	{
		if (null !== $request->get('name')) $creditCard->setName($request->get('name'));

		$this->entityManager->persist($creditCard);
		$this->entityManager->flush();

		return $this->view($creditCard);
	} // "put_creditCard" [PUT] /creditcards/{id}
	
	public function deleteCreditCardAction(CreditCard $creditCard)
	{
		$this->entityManager->remove($creditCard);
		$this->entityManager->flush();
	} // "delete_creditCard" [DELETE] /creditcards/{id}
}

?>