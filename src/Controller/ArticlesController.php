<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ArticleRepository;

class ArticlesController extends AbstractController
{
    /**
     * @Route("/articles", name="articles_route")
     */
    public function showArticles(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findAll();
        return $this->render('articles/index.html.twig', [
            'articles' => $articles,
        ]);
    }
}
