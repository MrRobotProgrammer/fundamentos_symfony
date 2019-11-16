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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function new(Request $request)
    {
        if ($request->isMethod("POST") && $this->tokenValidate($request, 'cadastrar_tarefas')) {

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
        if ($request->isMethod("POST") && $this->tokenValidate($request, 'cadastrar_tarefas')) {
            $task->setAll($request->request->all());
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
        if ($this->tokenValidate($request, 'deletar_tarefa')) {
            $entityManeger = $this->getDoctrine()->getManager();
            $entityManeger->remove($task);
            $entityManeger->flush();

            return $this->redirectToRoute('task');
        }

        return new Response('Não foi possivel pagar a tarefa ' . $task->getName());
    }

    private function tokenValidate($request, $name)
    {
        return  $this->isCsrfTokenValid($name, $request->request->get('_token'));
    }
}
