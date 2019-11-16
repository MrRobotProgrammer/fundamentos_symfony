<?php


namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class TaskController extends AbstractController
{
    /**
     * Lista de tarefas do banco de dados
     *
     * @return Response
     */
    public function index(): Response
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(Task::class);
        $task = $repository->findAll();

        return $this->render('task\index.html.twig',[
            'task' => $task
        ]);
    }

    /**
     * Mostra uma tarefa especifica do banco de dados
     *
     * @param Task $task
     * @return Response
     */
    public function show(Task $task): Response
    {
        return $this->render('task\show.html.twig', [
            'task' => $task
        ]);
    }

    /**
     * Cria uma nova tarefa no banco de dados
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        if ($request->isMethod("POST")) {

            $task = new Task();
            $task->setName($request->request->get('name'));
            $task->setDescription($request->request->get('description'));
            $task->setScheduling(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }

        return $this->render('task/new.html.twig');
    }

    /**
     * Edita uma tarefa no banco de dados
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task): Response
    {
        if ($request->isMethod("POST")) {
            $task->setAll($request->request->all());

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }
        return $this->render('task\edit.html.twig', [
            'task' => $task
        ]);
    }

    /**
     * Apaga uma tarefa no banco de dados
     *
     * @param Task $task
     * @return Response
     */
    public function delete(Task $task): Response
    {
        $entityManege = $this->getDoctrine()->getManager();
        $entityManege->remove($task);
        $entityManege->flush();

        return $this->redirectToRoute('task_index');
    }
}
