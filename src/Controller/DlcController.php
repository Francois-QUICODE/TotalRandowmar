<?php

namespace App\Controller;

use App\Entity\Dlc;
use App\Form\DlcType;
use App\Repository\DlcRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/dlc")
 */
class DlcController extends AbstractController
{
    /**
     * @Route("/", name="dlc_index", methods={"GET"})
     */
    public function index(DlcRepository $dlcRepository): Response
    {
        return $this->render('dlc/index.html.twig', [
            'dlcs' => $dlcRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="dlc_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $dlc = new Dlc();
        $form = $this->createForm(DlcType::class, $dlc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($dlc);
            $entityManager->flush();

            return $this->redirectToRoute('dlc_index');
        }

        return $this->render('dlc/new.html.twig', [
            'dlc' => $dlc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dlc_show", methods={"GET"})
     */
    public function show(Dlc $dlc): Response
    {
        return $this->render('dlc/show.html.twig', [
            'dlc' => $dlc,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="dlc_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Dlc $dlc): Response
    {
        $form = $this->createForm(DlcType::class, $dlc);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('dlc_index');
        }

        return $this->render('dlc/edit.html.twig', [
            'dlc' => $dlc,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="dlc_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Dlc $dlc): Response
    {
        if ($this->isCsrfTokenValid('delete'.$dlc->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($dlc);
            $entityManager->flush();
        }

        return $this->redirectToRoute('dlc_index');
    }
}
