<?php

namespace AppBundle\Controller\Backend;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use AppBundle\Entity\News;
use AppBundle\Form\NewsType;
use Symfony\Component\HttpFoundation\Response;

class NewsController extends Controller
{
    /**
     * @Route("/admin/news", name="backend_news_list")
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
     * @Route("/admin/create", name="backend_news_create")
     */
    public function createAction(Request $request)
    {
        $news = new News();
        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            return $this->redirectToRoute('backend_news_list');
        }

        return $this->render('backend/news/edit.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/admin/edit/{id}", name="backend_news_edit")
     */
    public function editAction($id, Request $request)
    {

        $news = $this->getDoctrine()
            ->getRepository('AppBundle:News')
            ->find($id);

        if (!$news) {
            throw $this->createNotFoundException(
                'No news found for id '.$id
            );
        }

        $form = $this->createForm(NewsType::class, $news);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($news);
            $em->flush();

            // if ($form->get('saveAndStay')->isClicked()){
            //     return $this->redirect($this->generateUrl(
            //         'backend_news_edit',
            //         array('id' => $news->getId())
            //     ));
            // } else {
                return $this->redirectToRoute('backend_news_list');
            // }
        }

        return $this->render('backend/news/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/admin/delete/{id}", name="backend_news_delete")
     */
    public function deleteAction($id)
    {

    }

}
