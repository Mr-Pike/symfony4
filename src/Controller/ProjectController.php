<?php

namespace App\Controller;

use App\Entity\Company;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProjectController extends Controller
{
    /**
     * Show projects list.
     *
     * @Route("/project", name="project.list")
     */
    public function index()
    {
        throw new Exception('Not implemented');
    }

    /**
     * Create a new project.
     *
     * @Route("/project/create", name="project.create")
     */
    public function create(Request $request)
    {
        throw new Exception('Not implemented');
    }

    /**
     * Edit a project.
     *
     * @Route("/project/{id}/edit", name="project.edit")
     */
    public function edit($id, Request $request)
    {
        throw new Exception('Not implemented');
    }

    /**
     * @param $id
     * @Route("/project/{id}/remove", name="project.remove")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id)
    {
        throw new Exception('Not implemented');
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
        throw new Exception('Not implemented');
    }
}
