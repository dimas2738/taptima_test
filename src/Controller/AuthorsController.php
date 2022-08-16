<?php

namespace App\Controller;
use App\Entity\Authors;

use App\Form\AddAuthorFormType;

use App\Form\EditAuthorType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
class AuthorsController extends AbstractController
{
    public $entity;
    public function __construct(ManagerRegistry $doctrine)
    {
        return $this->entity=$doctrine->getRepository(Authors::class);
    }

    /**
    * @Route("/authors", name="authors")
    */

    public function index(ManagerRegistry $doctrine): Response
    {
        $entityManager=$this->entity->findAll();
        return $this->render('authors/authors.html.twig', [
            'data' => $entityManager,
        ]);
    }

    /**
     * @Route("/addAuthor", name="addAuthor")
     */
    public function addAuthor(Request $request, ManagerRegistry $doctrine): Response
    {

        $author = new Authors();
        $form = $this->createForm(AddAuthorFormType::class, $author);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $form->getData()->getName();
            $surname = $form->getData()->getSurname();
            $middlename = $form->getData()->getMiddlename();
            $bc=0;

            $entityManager = $doctrine->getManager();
            $author->setName($name)->setSurname($surname)
                ->setMiddlename($middlename)->setCount($bc);
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirect('/authors');
        }
        return $this->render('authors/add.html.twig', array(
            'form' => $form->createView()
        ));
    }

    /**
     * @Route("/authors/{id}", name="showAuthor")
     */
    public function showAuthor(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $this->entity->findOneBy(['id' => $id]);

        return
            $this->render('authors/show.html.twig', [
                'controller_name' => 'AuthorsController',
                'data' => $entityManager,
            ]);
    }

    /**
     * @Route("/delAuthor/{id}", name="deleteAuthor")
     */
    public function deleteAuthor(ManagerRegistry $doctrine, $id): Response
    {

            $authorToDel = $this->entity->findOneBy(['id' => $id]);
            $entityManager = $doctrine->getManager();
            $entityManager->remove($authorToDel);
            $entityManager->flush();
            return $this->redirect('/authors');
        }

    /**
     * @Route("/editAuthor/{id}", name="editAuthor")
     */
    public function editAuthor(Request $request, ManagerRegistry $doctrine, $id): Response
    {
        $author = $this->entity->findOneBy(['id' => $id]);
        $form = $this->createForm(EditAuthorType::class, $author);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            //get data from form
            $name_form = $form->getData()->getName();
            $surname_form = $form->getData()->getSurname();
            $middlename_form = $form->getData()->getMiddlename();

            //execute
            $entityManager = $doctrine->getManager();
            $author->setName($name_form)->setSurname($surname_form)->setMiddlename($middlename_form);
            $entityManager->persist($author);
            $entityManager->flush();
            return $this->redirect('/authors');
        }
        $data = $this->entity->findOneBy(['id' => $id]);
        return $this->render('authors/edit.html.twig',
            array(
            'form' => $form->createView(),
 'data' => $data
        )
        );
    }

}

