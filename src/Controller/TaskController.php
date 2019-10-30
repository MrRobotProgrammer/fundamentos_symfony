<?php


namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
{
    $this->entityManager = $entityManager;
}

    /**
     * @return Response
     */
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

    /**
     * @param $id
     * @return Response
     */
    public function show($id)
    {
        $repository = $this->entityManager->getRepository(Task::class);
        $task = $repository->findOneBy([
            'id' => $id
        ]);

        return new JsonResponse($task, Response::HTTP_OK);
    }

    public function create()
    {
        $task = new Task();
        $task->setName('Visitar o cliente');
        $task->setDescription('Visitar o cliente x por razão X');
        $task->setScheduling(new \DateTime());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('dados gravados com sucesso!! , novo regisrto ID ' . $task->getId());
    }
}
