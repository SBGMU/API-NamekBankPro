<?php

namespace App\Controller;

use App\Entity\Company;
use App\Repository\CompanyRepository;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;


class CompanyController extends FOSRestController
{
	private $companyRepository;
	private $entityManager;
	
	public function __construct(CompanyRepository $companyRepository, EntityManagerInterface $entityManager)
	{
		$this->companyRepository = $companyRepository;
		$this->entityManager = $entityManager;
	}
	
	/**
	 * @Rest\View(serializerGroups={"company"})
	 */
	public function getCompaniesAction()
	{
		$companies = $this->companyRepository->findAll();
		return $this->view($companies);
	} // "get_companies" [GET] /companies
	
	/**
	 * @Rest\View(serializerGroups={"company"})
	 */
	public function getCompanyAction(Company $company)
	{
		return $this->view($company);
	} // "get_company" [GET] /companies/{id}
	
	/**
	* @Rest\Post("/companies")
	* @ParamConverter("company", converter="fos_rest.request_body")
	*/
	public function postCompaniesAction(Company $company)
	{
		$this->entityManager->persist($company);
		$this->entityManager->flush();
		return $this->view($company);
	} // "post_companies" [POST] /companies
	
	/**
	 * @Rest\View(serializerGroups={"company"})
	 */
	public function putCompanyAction(Request $request, Company $company)
	{
		if (null !== $request->get('name')) $company->setName($request->get('name'));
		if (null !== $request->get('slogan')) $company->setSlogan($request->get('slogan'));
		if (null !== $request->get('phoneNumber')) $company->setPhoneNumber($request->get('phoneNumber'));
		if (null !== $request->get('address')) $company->setAddress($request->get('address'));

		$this->entityManager->persist($company);
		$this->entityManager->flush();

		return $this->view($company);
	} // "put_company" [PUT] /companies/{id}
	
	public function deleteCompanyAction(Company $company)
	{
		$this->entityManager->remove($company);
		$this->entityManager->flush();
	} // "delete_company" [DELETE] /companies/{id}
}

?>