<?php
namespace App\Controller;

use App\Entity\Task;
use App\Form\TaskType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as ORM;

/**
 * Class TaskController
 * @package App\Controller
 * @ORM("/task")
 */
class TaskController extends AbstractController
{
    /**
     * Lista todas as tarefas
     * @ORM("/index", name="task", methods={"GET", "POST"})
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
     * Criar nova tarefa
     * @ORM("/new", name="task_new", methods={"GET", "POST"})
     * @param Request $request
     * @return Response
     * @throws \Exception
     */
    public function new(Request $request): Response
    {
        $form = $this->createForm(TaskType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $task = $form->getData();
            $task->setScheduling(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);
        }

        return $this->render('task/new.html.twig', [
            "form" => $form->createView()
        ]);
    }

    /**
     * Retorna tarefa especificca de acordo com ID
     * @ORM("/{id}", name="task_show", methods={"GET"})
     * @param Task $task
     * @return Response
     */
    public function show(Task $task)
    {
        return $this->render('task\show.html.twig', [
            'task' => $task
        ]);
    }

    /**
     * Editar tarefa de acordo com ID
     * @ORM("/{id}/edit", name="task_edit", methods={"GET", "POST"})
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function edit(Request $request, Task $task): Response
    {
        if ($request->isMethod("POST") && $this->validToken($_SERVER['CREATE_TASK'], $request)) {
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

    /**
     * Deletar tarefa de acordo com ID
     * @ORM("/{id}", name="task_delete", methods={"DELETE"})
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function delete(Request $request, Task $task): Response
    {
        if ($this->validToken($_SERVER['DELETE_TASK'], $request)) {
            $entityManeger = $this->getDoctrine()->getManager();
            $entityManeger->remove($task);
            $entityManeger->flush();

            return $this->redirectToRoute('task');
        }

        return new Response('Não foi possível deletar seu cadastro');
    }

    public function validToken($name, $request)
    {
        return $this->isCsrfTokenValid($name, $request->request->get('_token'));
    }
}
