<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\News;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * @Route("/admin/news", name="backend.news")
     */
    public function indexAction(Request $request)
    {
        $news = $this->getDoctrine()
            ->getRepository('AppBundle:News')
            ->findAll();

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found '
            );
        }

        return $this->render('backend/news/index.html.twig', [
            'news' => $news,
        ]);
    }

    /**
     * @Route("/admin/create", name="backend.news.create")
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
     * @Route("/admin/edit/{id}", name="backend.news.edit")
     */
    public function editAction($id)
    {
        $news = $this->getDoctrine()
            ->getRepository('AppBundle:News')
            ->find($id);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found for id '.$id
            );
        }

        return $this->render('backend/news/edit.html.twig', [
            'post' => $news,
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="backend.news.delete")
     */
    public function deleteAction($id)
    {

    }

}
