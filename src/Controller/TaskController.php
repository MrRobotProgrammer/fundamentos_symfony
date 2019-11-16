<?php


namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $isTokenValid = $this->isCsrfTokenValid('cadastro_tarefas', $request->request->get('_token'));

        if ($request->isMethod("POST") && $isTokenValid) {
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
     * Editar tarefa
     *
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task): Response
    {
        $isTokenValid = $this->isCsrfTokenValid('cadastro_tarefas', $request->request->get('_token'));

        if ($request->isMethod("POST") && $isTokenValid) {
            $task->setName($request->request->get('name'));
            $task->setDescription($request->request->get('description'));
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }
        $em = $this->getDoctrine()->getManager();
        return $this->render('task\edit.html.twig', [
            'task' => $task
        ]);
    }

    public function delete(Request $request, Task $task): Response
    {
        $isTokenValid = $this->isCsrfTokenValid('deletar_cadastro', $request->request->get('_token'));

        if ($isTokenValid) {
            $entityManeger = $this->getDoctrine()->getManager();
            $entityManeger->remove($task);
            $entityManeger->flush();

            return $this->redirectToRoute('task');
        }

        return new Response('Não foi possível deletar seu cadastro');

    }
}
