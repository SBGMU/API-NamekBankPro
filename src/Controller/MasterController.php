<?php

namespace App\Controller;

use App\Entity\Master;
use App\Repository\MasterRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\ConstraintViolationListInterface;


class MasterController extends FOSRestController
{
	private $masterRepository;
	private $entityManager;
	
	public function __construct(MasterRepository $masterRepository, EntityManagerInterface $entityManager)
	{
		$this->masterRepository = $masterRepository;
		$this->entityManager = $entityManager;
	}
	
	/**
	 * @Rest\View(serializerGroups={"master"})
	 */
	public function getMastersAction()
	{
		$masters = $this->masterRepository->findAll();
		return $this->view($masters);
	} // "get_masters" [GET] /masters
	
	
	/**
	 * @Rest\View(serializerGroups={"master"})
	 */
	public function getMasterAction(Master $master)
	{
		return $this->view($master);
	} // "get_master" [GET] /master/{id}
	
	/**
	* @Rest\Post("/masters")
	* @ParamConverter("master", converter="fos_rest.request_body")
	*/
	public function postMastersAction(Master $master, ConstraintViolationListInterface $validationErrors)
	{
		if ($validationErrors->count() > 0) {
			/** @var ConstraintViolation $constraintViolation */
			foreach ($validationErrors as $constraintViolation){
				$message = $constraintViolation->getMessage(); // Returns the violation message. (Ex. This value should not be blank.)
				$propertyPath = $constraintViolation->getPropertyPath(); // Returns the property path from the root element to the violation. (Ex. lastname)
				// Handle validation errors

				echo $propertyPath . ' : ' . $message;
			}
		}
		else {
			$this->entityManager->persist($master);
			$this->entityManager->flush();
			return $this->view($master);
		}
	} // "post_masters" [POST] /masters
	
	/**
	 * @Rest\View(serializerGroups={"master"})
	 */
	public function putMasterAction(Request $request, Master $master)
	{
		if (null !== $request->get('firstname')) $master->setFirstname($request->get('firstname'));
		if (null !== $request->get('lastname')) $master->setLastname($request->get('lastname'));
		if (null !== $request->get('email')) $master->setEmail($request->get('email'));

		$this->entityManager->persist($master);
		$this->entityManager->flush();

		return $this->view($master);
	} // "put_master" [PUT] /masters/{id}
	
	public function deleteMasterAction(Master $master)
	{
		$this->entityManager->remove($master);
		$this->entityManager->flush();
	} // "delete_master" [DELETE] /masters/{id}
}

?>