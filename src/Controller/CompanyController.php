<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Component\HttpFoundation\Response;
//use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CompanyController extends Controller
{
    /**
     * Show companies list.
     *
     * @Route("/company", name="company_list")
     */
    public function index()
    {
        $companies = $this->getDoctrine()
            ->getRepository(Company::class)
            ->findAll();


        return $this->render('company/index.html.twig', compact('companies'));
    }

    /**
     * Edit a company
     *
     * @Route("/company/{id}/edit", name="company_edit")
     */
    public function edit($id)
    {
        return new Response("<span>Company:$id</span>");
    }


}
