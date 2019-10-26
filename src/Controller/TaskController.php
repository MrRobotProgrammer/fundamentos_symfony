<?php


namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends AbstractController
{
    public function index()
    {
        return $this->render('task\index.html.twig',[
            'curso' => 'Laravel',
            'cursos' => [
                0 => [
                    'name' => 'Laravel'
                ],
                1 => [
                    'name' => 'Symfony'
                ],
                2 => [
                    'name' => 'AWS'
                ]
            ]
        ]);
    }

    public function show($id)
    {
        return new Response(('Id de retorno ' . $id));
    }
}
