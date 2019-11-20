<?php


namespace App\Controller;

use App\Entity\Task;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as ORM;

/**
 * Class TaskController
 * @ORM("/task")
 * @package App\Controller
 */
class TaskController extends AbstractController
{
    /**
     * Lista todas as tarefas
     * @ORM("/", name="task_index", methods={"GET"})
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
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     * @throws \Exception
     */
    public function new(Request $request)
    {
        $task = new Task();
        $form = $this->createFormBuilder($task)
                ->add('name', TextType::class)
                ->add('description', TextareaType::class)
                ->add('Salvar', SubmitType::class)
                ->getForm();

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
     * Visualiza a tarefa de acordo com ID
     * @ORM("/{id}", name="task_show", methods={"GET"})
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
     * Altera a  tarefa de acordo ID
     * @ORM("/{id}/edit", name="task_edit", methods={"GET", "POST"})
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

    /**
     * Deletar tarefas de acordo ID
     * @ORM("/{id}/delete", name="task_delete", methods={"DELETE"})
     * @param Request $request
     * @param Task $task
     * @return Response
     */
    public function delete(Request $request, Task $task): Response
    {
        if ($this->tokenValidate($request, 'deletar_tarefa')) {
            $entityManeger = $this->getDoctrine()->getManager();
            $entityManeger->remove($task);
            $entityManeger->flush();

            return $this->redirectToRoute('task_index');
        }

        return new Response('Não foi possivel pagar a tarefa ' . $task->getName());
    }

    private function tokenValidate($request, $name)
    {
        return  $this->isCsrfTokenValid($name, $request->request->get('_token'));
    }
}
