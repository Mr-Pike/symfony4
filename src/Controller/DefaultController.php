<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class DefaultController extends Controller
{
    public function index()
    {
        return new Response('<span>Bonjour !</span>');
    }

    public function monTest()
    {
        return new Response('<span>test !</span>');
    }


}