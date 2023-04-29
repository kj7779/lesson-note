<?php

namespace App\Controller;

use App\Entity\Pose;
use App\Form\PoseType;
use App\Repository\PoseRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/pose')]
class PoseController extends AbstractController
{
    #[Route('/', name: 'app_pose_index', methods: ['GET'])]
    public function index(PoseRepository $poseRepository): Response
    {
        return $this->render('pose/index.html.twig', [
            'poses' => $poseRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_pose_new', methods: ['GET', 'POST'])]
    public function new(Request $request, PoseRepository $poseRepository): Response
    {
        $pose = new Pose();
        $form = $this->createForm(PoseType::class, $pose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poseRepository->save($pose, true);

            return $this->redirectToRoute('app_pose_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pose/new.html.twig', [
            'pose' => $pose,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pose_show', methods: ['GET'])]
    public function show(Pose $pose): Response
    {
        return $this->render('pose/show.html.twig', [
            'pose' => $pose,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_pose_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Pose $pose, PoseRepository $poseRepository): Response
    {
        $form = $this->createForm(PoseType::class, $pose);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $poseRepository->save($pose, true);

            return $this->redirectToRoute('app_pose_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pose/edit.html.twig', [
            'pose' => $pose,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_pose_delete', methods: ['POST'])]
    public function delete(Request $request, Pose $pose, PoseRepository $poseRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pose->getId(), $request->request->get('_token'))) {
            $poseRepository->remove($pose, true);
        }

        return $this->redirectToRoute('app_pose_index', [], Response::HTTP_SEE_OTHER);
    }
}
