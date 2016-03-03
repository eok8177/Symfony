<?php
namespace AppBundle\Controller\Backend;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

use Symfony\Component\HttpFoundation\Request;

class BackendController extends Controller
{
	/**
	 * @Route("/admin", name="admin")
	 */
    public function indexAction()
    {
        return $this->render('backend/dashboard.html.twig', [
            
        ]);
    }
}