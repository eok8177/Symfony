<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }

    /**
     * @Route("/create", name="create")
     */
    public function createAction()
    {
        $news = new News();
        $news->setName('A Foo Bar');
        $news->setDescription('Lorem ipsum dolor');

        $em = $this->getDoctrine()->getManager();

        $em->persist($news);
        $em->flush();

        return new Response('Created news id '.$news->getId());
    }

    /**
     * @Route("/show/{id}", name="showNews")
     */
    public function showAction($id)
    {
        $news = $this->getDoctrine()
            ->getRepository('AppBundle:News')
            ->find($id);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found for id '.$id
            );
        }

        // ... do something, like pass the $news object into a template
        return new Response('View news description '.$news->getDescription());
    }
}
