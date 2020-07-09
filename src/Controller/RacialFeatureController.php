<?php

namespace App\Controller;

use App\Entity\RacialFeature;
use App\Form\RacialFeatureType;
use App\Repository\RacialFeatureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/racial/feature")
 */
class RacialFeatureController extends AbstractController
{
    /**
     * @Route("/", name="racial_feature_index", methods={"GET"})
     */
    public function index(RacialFeatureRepository $racialFeatureRepository): Response
    {
        return $this->render('racial_feature/index.html.twig', [
            'racial_features' => $racialFeatureRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="racial_feature_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $racialFeature = new RacialFeature();
        $form = $this->createForm(RacialFeatureType::class, $racialFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($racialFeature);
            $entityManager->flush();

            return $this->redirectToRoute('racial_feature_index');
        }

        return $this->render('racial_feature/new.html.twig', [
            'racial_feature' => $racialFeature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="racial_feature_show", methods={"GET"})
     */
    public function show(RacialFeature $racialFeature): Response
    {
        return $this->render('racial_feature/show.html.twig', [
            'racial_feature' => $racialFeature,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="racial_feature_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, RacialFeature $racialFeature): Response
    {
        $form = $this->createForm(RacialFeatureType::class, $racialFeature);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('racial_feature_index');
        }

        return $this->render('racial_feature/edit.html.twig', [
            'racial_feature' => $racialFeature,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="racial_feature_delete", methods={"DELETE"})
     */
    public function delete(Request $request, RacialFeature $racialFeature): Response
    {
        if ($this->isCsrfTokenValid('delete'.$racialFeature->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($racialFeature);
            $entityManager->flush();
        }

        return $this->redirectToRoute('racial_feature_index');
    }
}
