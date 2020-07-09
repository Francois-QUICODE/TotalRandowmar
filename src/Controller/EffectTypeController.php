<?php

namespace App\Controller;

use App\Entity\EffectType;
use App\Form\EffectTypeType;
use App\Repository\EffectTypeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/effecttype")
 */
class EffectTypeController extends AbstractController
{
    /**
     * @Route("/", name="effect_type_index", methods={"GET"})
     */
    public function index(EffectTypeRepository $effectTypeRepository): Response
    {
        return $this->render('effect_type/index.html.twig', [
            'effect_types' => $effectTypeRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="effect_type_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $effectType = new EffectType();
        $form = $this->createForm(EffectTypeType::class, $effectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($effectType);
            $entityManager->flush();

            return $this->redirectToRoute('effect_type_index');
        }

        return $this->render('effect_type/new.html.twig', [
            'effect_type' => $effectType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="effect_type_show", methods={"GET"})
     */
    public function show(EffectType $effectType): Response
    {
        return $this->render('effect_type/show.html.twig', [
            'effect_type' => $effectType,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="effect_type_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, EffectType $effectType): Response
    {
        $form = $this->createForm(EffectTypeType::class, $effectType);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('effect_type_index');
        }

        return $this->render('effect_type/edit.html.twig', [
            'effect_type' => $effectType,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="effect_type_delete", methods={"DELETE"})
     */
    public function delete(Request $request, EffectType $effectType): Response
    {
        if ($this->isCsrfTokenValid('delete' . $effectType->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($effectType);
            $entityManager->flush();
        }

        return $this->redirectToRoute('effect_type_index');
    }
}
