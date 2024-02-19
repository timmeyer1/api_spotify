<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use App\Entity\Album;
use App\Entity\Genre;
use App\Entity\Artist;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{

    public function __construct(
        private AdminUrlGenerator $adminUrlGenerator
    )
    {
    }
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        $url = $this->adminUrlGenerator
            ->setController(GenreCrudController::class)
            ->generateUrl();

        return $this->redirect($url);


        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/logo2.png" style="width:30px; height:30px"><span class="text-small"> Spotify</span>')
            ->setFaviconPath('/images/logo2.png');
    }

    public function configureMenuItems(): iterable
    {
        // Section principale
        yield MenuItem::section('Gestion Discographie');
        
        // Liste des sous-menu pour la gestion des catégories
        yield MenuItem::subMenu('Gestion Catégories', 'fa fa-star')->setSubItems([
            MenuItem::linkToCrud('Ajouter une catégorie', 'fa fa-plus', Genre::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les catégories', 'fa fa-eye', Genre::class)
        ]);
    
        // Liste des sous-menu pour la gestion des albums
        yield MenuItem::subMenu('Gestion Albums', 'fa fa-music')->setSubItems([
            MenuItem::linkToCrud('Ajouter un album', 'fa fa-plus', Album::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les albums', 'fa fa-eye', Album::class)
        ]);
    
        // Liste des sous-menu pour la gestion des chansons
        yield MenuItem::subMenu('Gestion Chansons', 'fa fa-play')->setSubItems([
            MenuItem::linkToCrud('Ajouter une chanson', 'fa fa-plus', Song::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les chansons', 'fa fa-eye', Song::class)
        ]);
    
        // Liste des sous-menu pour la gestion des artistes
        yield MenuItem::subMenu('Gestion Artistes', 'fa fa-user')->setSubItems([
            MenuItem::linkToCrud('Ajouter un artiste', 'fa fa-plus', Artist::class)->setAction(Crud::PAGE_NEW),
            MenuItem::linkToCrud('Voir les artistes', 'fa fa-eye', Artist::class)
        ]);
    }
    
}
