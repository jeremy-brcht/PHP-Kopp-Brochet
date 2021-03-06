<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\PostType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class PostController extends AbstractController
{
    /**
     * @Route("/post", name="post")
     * @return Response
     */

    public function display()
    {
        return $this->render('front/post/display.html.twig',
            [
                'articles' => [
                    'aricle1' => ['show'=> true, 'title' => 'mon titre', 'content' => 'monContent'],
                    'aricle2' => ['show'=> true, 'title' => 'mon titre', 'content' => 'monContent'],
                    'aricle3' => ['show'=> true, 'title' => 'mon titre', 'content' => 'monContent'],
                    'aricle4' => ['show'=> true, 'title' => 'mon titre', 'content' => 'monContent'],
                    'aricle5' => ['show'=> true, 'title' => 'mon titre', 'content' => 'monContent'],
                ]
            ]);
    }

    /**
     * @return void
     * @Route("/post/create", name="post.create")
     */
    public function create(Request $request){
        $post = new Post();

        $myform = $this->createForm(PostType::class, $post);

        $myform->handleRequest($request);

        if ($myform->isSubmitted() && $myform->isValid()){
            var_dump($post);
            $em =  $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();
        }

       /* $post = new Post();
        $post->setTitle('title');
        $post->setDescription('description');
        $post->setContent('content');
        $post->setSlug('slug');
        $post->setCreatedAt(new \DateTimeImmutable());
        $post->setUpdatedAt(new \DateTimeImmutable());
        $post->setPublishedAt(new \DateTimeImmutable());

      //  $this->getDoctrine()->getManager()->persist($post);
      //  $this->getDoctrine()->getManager()->flush($post);

      $em =  $this->getDoctrine()->getManager();
      $em->persist($post); // Quand on cr??e un nouvel objet.
      $em->flush(); // Pour ex??cuter les requ??tes*/

      return $this->render('front/post/create.html.twig', [
        'myForm' => $myform->createView()
    ]);
    }

    /**
     * @return void
     * @Route("/post/update", name="post.update")
     */
    public function update(){

        $em =  $this->getDoctrine()->getManager();  //le doctrine Manager
        $repo =  $this->getDoctrine()->getRepository(Post::class); //un Repository est associ?? ?? une classe Entity (comme le PostRepository avec l'Entity Post). Il est g??n??r?? par le make:entity

        $post = $repo->find(4); // r??cup??re le post num??ro 4

        $post2 = $repo->findOneBy(['title' => 'title2']); //On peut aussi r??cup??rer un des objets avec comme titre 'title2'. La m??thode renvoie soit un objet post, soit null si il n'a rien trouv??


        if($post2){ //si post2 est null, alors il ne modifie rien
            $post2->setTitle('title3');
        }

        $em->flush(); //Met ?? jour dans la base de donn??e tous les posts qui ont ??t?? modifi??s dans la fonction

        return new Response('ok');
    }

    /**
     * @return void
     * @Route("/post/delete", name="post.delete")
     */
    public function delete(){

        $em =  $this->getDoctrine()->getManager();  //le doctrine Manager
        $repo =  $this->getDoctrine()->getRepository(Post::class); //un Repository est associ?? ?? une classe Entity (comme le PostRepository avec l'Entity Post). Il est g??n??r?? par le make:entity

        $post = $repo->find(4); // r??cup??re le post num??ro 4



        if($post){ //si post est null, alors il ne fera rien
            $em->remove($post);
        }

        $em->flush();
        return new Response('ok');
    }
}
