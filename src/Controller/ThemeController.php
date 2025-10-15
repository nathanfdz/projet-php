<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ThemeController extends AbstractController
{
    #[Route('/theme/set/{theme}', name: 'app_theme_set')]
    public function setTheme(string $theme, Request $request): RedirectResponse
    {
        $theme = in_array($theme, ['light', 'dark']) ? $theme : 'light';

        // durée : 1 year (ou ce que tu veux)
        $expires = new \DateTimeImmutable('+1 year');

        $cookie = new Cookie('theme', $theme, $expires);

        $referer = $request->headers->get('referer') ?? $this->generateUrl('app_home'); // adapte app_home
        $response = $this->redirect($referer);
        $response->headers->setCookie($cookie);

        return $response;
    }
}
