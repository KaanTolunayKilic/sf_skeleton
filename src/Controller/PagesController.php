<?php


namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PagesController extends AbstractController
{
    /**
     * @Route("", name="page_home")
     */
    public function home()
    {
        return $this->render('pages/home.html.twig');
    }

    /**
     * @Route("/services", name="page_services")
     */
    public function services()
    {
        return $this->render('pages/services.html.twig');
    }

    /**
     * @Route({"en" : "/about-us", "de" : "/ueber-uns"}, name="page_about")
     */
    public function about()
    {
        return $this->render('pages/about.html.twig');
    }

    /**
     * @Route({"en" : "/contact", "de" : "/kontakt"}, name="page_contact")
     */
    public function contact()
    {
        return $this->render('pages/contact.html.twig');
    }

    /**
     * @Route({"en" : "/imprint", "de" : "/impressum"}, name="page_imprint")
     */
    public function imprint()
    {
        return $this->render('pages/imprint.html.twig');
    }

    /**
     * @Route({"en" : "/privacy", "de" : "/datenschutz"}, name="page_privacy")
     */
    public function privacy()
    {
        return $this->render('pages/privacy.html.twig');
    }
}