<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

#[IsGranted('ROLE_ADMIN', message: "Vous devez être administrateur pour accéder à ce contrôleur.")]
class DefaultController extends AbstractController
{
    #[Route('/admin', name: 'admin_index')]
    #[IsGranted('ROLE_SUPER_ADMIN', message: "Seuls les super admins peuvent accéder à cette page.")]
    public function index(): Response
    {
        return $this->render('admin/default/index.html.twig', [
            'controller_name' => 'DefaultController',
        ]);
    }

    // D’autres méthodes ici hériteront automatiquement de ROLE_ADMIN
}
