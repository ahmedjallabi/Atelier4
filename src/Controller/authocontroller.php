<?php
// src/Controller/AuthorController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorController extends AbstractController
{
    /**
     * @Route("/author/{name}", name="show_author")
     */
    public function showAuthor($name)
    {
        return $this->render('author/show.html.twig', [
            'name' => $name,
        ]);
    }
    #[Route('/author/get/all',name:'app_get_all')]
    public function getAll(authorRepository $repo)
    {
       $authors = $repo->findAll();
       return $this->render('author/listauthors.html.twig',[
        'a'=>$authors
       ]);
 

    }
    #[Route('/author/add',name:'app_add_author')]
    public function add(ManagerRegistry $manager){
        $author = new author();
        $author->setUsername('auther 1');
        $author->setEmail('author@esprit.tn');
        $manager->getManager()->persist($author);
        $manager->getManager()->flush();
        return $this->redirectToRooute('app_get_all_author');
    }
    #[Route('/author/delete/{id}',name:'app_delete_author')]
    public function delete($id, ManagerRegistry $manager , AuthorRepository $repo ){
        $author = $repo->find($id);
        $manager->getManager()->remove($author);
        $manager->getManager()->flush();
        return $this->redirectToRoute('app_get_all_author');
    }

}