<?php

namespace App\Controller;

use App\Entity\Article;
use App\Form\ArticleType;
use App\Repository\ArticleRepository;
use DateTimeImmutable;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArticleController extends AbstractController
{
    #[Route('/', name: 'app_article')]
    public function index(ArticleRepository $articleRepository): Response
    {
        return $this->render('article/index.html.twig', [
            'articles' => $articleRepository->findAll(),
        ]);
    }

    //public function show(Article $article, $id, ArticleRepository $articleRepository)
    #[Route('/article/{id}', name: 'app_article_show')]
    public function show(Article $article){
        return $this->render("article/show.html.twig", ["article" => $article]);
    } 
    
    #[Route('/new/article', name: 'app_article_new')]
    public function new(Request $request, ArticleRepository $articleRepository){

        $article = new Article();
        $form = $this->createForm(ArticleType::class, $article);

        //reception du formulaire
        $form->handleRequest($request);
        if( $form->isSubmitted() && $form->isValid() ){
            $article->setCreatedAt(new \DateTimeImmutable());

            $articleRepository->save($article, true);   

            $this->addFlash("success", "L'article est bien ajouté ! ");
       
            return $this->redirectToRoute('app_article');
        }

        return $this->render("article/new.html.twig", [
            "form" => $form->createView()
        ]);
    }
}
