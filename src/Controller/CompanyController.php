<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

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
     * Create a new company.
     *
     * @Route("/company/create", name="company_create")
     */
    public function create()
    {
        $form = $this->form(new Company());

        return $this->render('company/create-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Edit a company.
     *
     * @Route("/company/{id}/edit", name="company_edit")
     */
    public function edit($id)
    {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($id);

        $form = $this->form($company);

        return $this->render('company/create-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * Create company form.
     *
     * @param Company $company
     * @return \Symfony\Component\Form\FormInterface
     */
    public function form(Company $company)
    {
       $form = $this->createFormBuilder($company)
           ->add('name', TextType::class, ['attr' => ['placeholder' => 'Name']])
           ->add('address1', TextType::class, ['empty_data' => 'address1', 'attr' => ['placeholder' => 'Address line 1']])
           ->add('address2', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Address line 2']])
           ->add('zip_code', TextType::class, ['empty_data' => 'zip_code', 'attr' => ['placeholder' => 'Zip Code']])
           ->add('city', TextType::class, ['empty_data' => 'city', 'attr' => ['placeholder' => 'City']])
           ->add('phone', TelType::class, ['required' => false, 'attr' => ['placeholder' => 'Phone']])
           ->add('mail', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Mail']])
           ->add('turnover', NumberType::class, ['required' => false, 'attr' => ['placeholder' => 'Turnover']])
           ->add('save', SubmitType::class, ['label' => 'Create company'])
           ->getForm();

       return $form;
    }
}
