<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Article;
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

    /**
     * @Route("/articles/{id}")
     */
    public function showArticle(int $id, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($id);
        return $this->render('articles/show.html.twig', [
            'article' => $article,
        ]);
    }

    /**
     * @Route("/article/add")
     */
    public function addArticle(EntityManagerInterface $entityManager): Response
    {
        $article = new Article();
        $article->setDesignation("Article");
        $article->setDescription("Un Article");
        $article->setPrix(10);
        $entityManager->persist($article);
        $entityManager->flush();
        return $this->redirectToRoute('articles_route');
    }

    /**
     * @Route("/article/delete/{id}")
     */
    public function deleteArticle(Article $article,EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($article);
        $entityManager->flush();
        return $this->redirectToRoute('articles_route');
    }

    /**
     * @Route("/article/edit/{id}")
     */
    public function editArticle(Article $article,EntityManagerInterface $entityManager): Response
    {
        $article->setDesignation("Article Modifiée");
        $article->setDescription("Article Modifiée");
        $article->setPrix(15);
        $entityManager->flush();
        return $this->redirectToRoute('articles_route');
    }
}
