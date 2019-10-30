<?php


namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends AbstractController
{

    /**
     * Lista tidas as tarefas
     *
     * @return Response
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Task::class);
        $task = $repository->findAll();

        return $this->render('task\index.html.twig',[
            'task' => $task
        ]);
    }

    /**
     * @param $id
     * @return Response
     */
    public function show(Task $task)
    {
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
        $task->setName('Controller de Tarefas');
        $task->setDescription('Organizando tarefas gerais');
        $task->setScheduling(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
    }
}
