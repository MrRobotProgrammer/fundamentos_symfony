<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ClientController extends AbstractController
{
    /**
     * @Route("/client", name="client")
     */
    public function index(Request $request)
    {
        var_dump(
            ## retorna todos os valores enviados para request
            $request->query->all(),
            ## Retorna valor de uma chave especificar enviado para request
            $request->query->get('nome'),
            ## Retornar um item especifico no formato de Array enviado Request
            $request->query->get('pessoa')['nome']
        );

        return $this->render('client/index.html.twig', [
            'controller_name' => 'ClientController',
        ]);
    }
}
