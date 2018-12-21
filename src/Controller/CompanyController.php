<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
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
     * @Route("/company/{page}", requirements={"page" = "\d+"}, name="company.list")
     */
    public function index($page = 1)
    {
        $companyRepository = $this->getDoctrine()
            ->getRepository(Company::class);

        $companies = $companyRepository->list(($page - 1) * 20);
        $totalCompanies = $companyRepository->count([]);
        $totalPages = ceil($totalCompanies / 20);

        return $this->render('company/index.html.twig', compact('companies', 'totalCompanies', 'totalPages', 'page'));
    }

    /**
     * Create a new company.
     *
     * @Route("/company/create", name="company.create")
     */
    public function create(Request $request)
    {
        return $this->form(new Company(), $request);
    }

    /**
     * Edit a company.
     *
     * @Route("/company/{id}/edit", name="company.edit")
     */
    public function edit($id, Request $request)
    {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($id);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$id
            );
        }

        return $this->form($company, $request);
    }

    /**
     * @param $id
     * @Route("/company/{id}/remove", name="company.remove")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id)
    {
        $company = $this->getDoctrine()
            ->getRepository(Company::class)
            ->find($id);

        if (!$company) {
            throw $this->createNotFoundException(
                'No company found for id '.$id
            );
        }

        $this->getDoctrine()
            ->getRepository(Company::class)
            ->remove($company);

        return $this->redirectToRoute('company.list');
    }

    /**
     * Show tree of users'company.
     *
     * @param $id
     * @Route("/company/{id}/tree", name="company.tree")
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function tree($id)
    {
        $usersTree = $this->getDoctrine()
            ->getRepository(User::class)
            ->getTree($id);

        return $this->render('company/tree.html.twig', compact('usersTree'));
    }

    /**
     * Return create or edit form.
     *
     * @param Company $company
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function form(Company $company, Request $request)
    {
        $form = $this->createFormBuilder($company)
           ->add('name', TextType::class, ['attr' => ['placeholder' => 'Name']])
           ->add('address1', TextType::class, ['label' => 'Address line 1', 'attr' => ['placeholder' => 'Address line 1']])
           ->add('address2', TextType::class, ['label' => 'Address line 2', 'required' => false, 'attr' => ['placeholder' => 'Address line 2']])
           ->add('zip_code', TextType::class, ['empty_data' => 'zip_code', 'attr' => ['placeholder' => 'Zip Code']])
           ->add('city', TextType::class, ['empty_data' => 'city', 'attr' => ['placeholder' => 'City']])
           ->add('phone', TelType::class, ['required' => false, 'attr' => ['placeholder' => 'Phone']])
           ->add('mail', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Mail']])
           ->add('turnover', NumberType::class, ['required' => false, 'attr' => ['placeholder' => 'Turnover']])
           ->add('save', SubmitType::class, ['label' => is_null($company->getID()) ? 'Create company' : 'Update company', 'attr' => ['class' => 'btn btn-success']])
           ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getRepository(Company::class)
                ->save($form->getData());

            return $this->redirectToRoute('company.list');
        }


        return $this->render('company/create-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
