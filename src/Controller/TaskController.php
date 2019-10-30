<?php


namespace App\Controller;

use App\Entity\Task;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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
    public function show($id)
    {
        $repository = $this->getDoctrine()->getRepository(Task::class);
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
        $task->setName('Distribuicao');
        $task->setDescription('Distribuicao do cliente x por razão X');
        $task->setScheduling(new \DateTime());

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($task);
        $entityManager->flush();

        return new Response('dados gravados com sucesso!! , novo regisrto ID ' . $task->getId());
    }
}
