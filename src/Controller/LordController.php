<?php

namespace App\Controller;

use App\Entity\Lord;
use App\Form\LordType;
use App\Repository\LordRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/lord")
 */
class LordController extends AbstractController
{
    /**
     * @Route("/", name="lord_index", methods={"GET"})
     */
    public function index(LordRepository $lordRepository): Response
    {
        return $this->render('lord/index.html.twig', [
            'lords' => $lordRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="lord_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $lord = new Lord();
        $form = $this->createForm(LordType::class, $lord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($lord);
            $entityManager->flush();

            return $this->redirectToRoute('lord_index');
        }

        return $this->render('lord/new.html.twig', [
            'lord' => $lord,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lord_show", methods={"GET"})
     */
    public function show(Lord $lord): Response
    {
        return $this->render('lord/show.html.twig', [
            'lord' => $lord,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="lord_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Lord $lord): Response
    {
        $form = $this->createForm(LordType::class, $lord);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('lord_index');
        }

        return $this->render('lord/edit.html.twig', [
            'lord' => $lord,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="lord_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Lord $lord): Response
    {
        if ($this->isCsrfTokenValid('delete'.$lord->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($lord);
            $entityManager->flush();
        }

        return $this->redirectToRoute('lord_index');
    }
}
