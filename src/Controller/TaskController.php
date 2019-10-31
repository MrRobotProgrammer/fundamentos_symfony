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


    public function new(Request $request)
    {

        if ($request->isMethod("POST")) {
            var_dump($request->attributes->all());
            $request->headers->all();
            $request->server->all();
            $request->attributes->all();
            return new Response('');
            /*
            $task = new Task();
            $task->setName($request->request->get('name'));
            $task->setDescription($request->request->get('description'));
            $task->setScheduling(new \DateTime());

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($task);
            $entityManager->flush();

            return $this->redirectToRoute('task_show', ['id' => $task->getId()]);*/
        }

        return $this->render('task/form.html.twig');
    }
}
