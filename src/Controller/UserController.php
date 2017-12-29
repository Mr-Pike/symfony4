<?php

namespace App\Controller;

use App\Entity\Company;
use App\Entity\User;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserController extends Controller
{
    /**
     * Show users list.
     *
     * @Route("/user/{page}", requirements={"page" = "\d+"}, name="user.list")
     */
    public function index($page = 1)
    {
        $userRepository = $this->getDoctrine()
            ->getRepository(User::class);

        $users = $userRepository->list(($page - 1) * 20);
        $totalUsers = $userRepository->count([]);
        $totalPages = ceil($totalUsers / 20);

        return $this->render('user/index.html.twig', compact('users', 'totalUsers', 'totalPages', 'page'));
    }

    /**
     * Create a new user.
     *
     * @Route("/user/create", name="user.create")
     */
    public function create(Request $request)
    {
        return $this->form(new User(), $request);
    }

    /**
     * Edit an user.
     *
     * @Route("/user/{id}/edit", name="user.edit")
     */
    public function edit($id, Request $request)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        return $this->form($user, $request);
    }

    /**
     * @param $id
     * @Route("/user/{id}/remove", name="user.remove")
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function remove($id)
    {
        $user = $this->getDoctrine()
            ->getRepository(User::class)
            ->find($id);

        if (!$user) {
            throw $this->createNotFoundException(
                'No user found for id '.$id
            );
        }

        $this->getDoctrine()
            ->getRepository(User::class)
            ->remove($user);

        return $this->redirectToRoute('user.list');
    }

    /**
     * Return create or edit form.
     *
     * @param User $user
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function form(User $user, Request $request)
    {
        $form = $this->createFormBuilder($user)
            ->add('firstname', TextType::class, ['attr' => ['placeholder' => 'Firstname']])
            ->add('lastname', TextType::class, ['attr' => ['placeholder' => 'Lastname']])
            ->add('mail', TextType::class, ['required' => false, 'attr' => ['placeholder' => 'Mail']])
            ->add('company', EntityType::class, [
                'class' => Company::class,
                'choice_label' => 'name',
                'multiple' => false,
                'expanded' => false
            ])
            ->add('manager', EntityType::class, [
                'placeholder' => '-- Manager --',
                'empty_data'  => null,
                'class' => User::class,
                'choice_label' => function ($user) {
                    return mb_strtoupper($user->getLastName()) . ' ' .$user->getFirstName();
                },
                'multiple' => false,
                'expanded' => false
            ])
            ->add('save', SubmitType::class, ['label' => is_null($user->getID()) ? 'Create user' : 'Update user', 'attr' => ['class' => 'btn btn-success']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()
                ->getRepository(User::class)
                ->save($form->getData());

            return $this->redirectToRoute('user.list');
        }


        return $this->render('user/create-edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
