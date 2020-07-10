<?php

namespace App\Controller;

use App\Entity\EffectOrigin;
use App\Form\EffectOriginType;
use App\Repository\EffectOriginRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/effectorigin")
 */
class EffectOriginController extends AbstractController
{
    /**
     * @Route("/", name="effect_origin_index", methods={"GET"})
     */
    public function index(EffectOriginRepository $effectOriginRepository): Response
    {
        return $this->render('effect_origin/index.html.twig', [
            'effect_origins' => $effectOriginRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="effect_origin_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $effectOrigin = new EffectOrigin();
        $form = $this->createForm(EffectOriginType::class, $effectOrigin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($effectOrigin);
            $entityManager->flush();

            return $this->redirectToRoute('effect_origin_index');
        }

        return $this->render('effect_origin/new.html.twig', [
            'effect_origin' => $effectOrigin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="effect_origin_show", methods={"GET"})
     */
    public function show(EffectOrigin $effectOrigin): Response
    {
        return $this->render('effect_origin/show.html.twig', [
            'effect_origin' => $effectOrigin,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="effect_origin_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EffectOrigin $effectOrigin): Response
    {
        $form = $this->createForm(EffectOriginType::class, $effectOrigin);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('effect_origin_index');
        }

        return $this->render('effect_origin/edit.html.twig', [
            'effect_origin' => $effectOrigin,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="effect_origin_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EffectOrigin $effectOrigin): Response
    {
        if ($this->isCsrfTokenValid('delete'.$effectOrigin->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($effectOrigin);
            $entityManager->flush();
        }

        return $this->redirectToRoute('effect_origin_index');
    }
}
