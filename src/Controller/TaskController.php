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
     * Lista tidas as tarefas
     *
     * @return Response
     */
    public function index()
    {
        $repository = $this->entityManager->getRepository(Task::class);
        $task = $repository->findAll();

        return $this->render('task\index.html.twig',[
            'task' => $task
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

        return $this->render('task\show.html.twig', [
            'task' => $task
        ]);
    }

    /**
     * @return Response
     * @throws \Exception
     */
    public function create()
    {
        $task = new Task();
        $task->setName('Agendamento');
        $task->setDescription('Agendamento do cliente x por razão X');
        $task->setScheduling(new \DateTime());

        $this->entityManager->persist($task);
        $this->entityManager->flush();

        return new Response('dados gravados com sucesso!! , novo regisrto ID ' . $task->getId());
    }
}
