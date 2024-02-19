<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ArtistCrudController extends AbstractCrudController
{

    public function configureCrud(Crud $crud): Crud
    {
        // permet de renommer les différentes pages
        return $crud
            ->setPageTitle(Crud::PAGE_INDEX, 'Artistes')
            ->setPageTitle(Crud::PAGE_EDIT, 'Modifier un artiste')
            ->setPageTitle(Crud::PAGE_NEW, 'Ajouter un artiste');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('name', 'Nom de l\'artiste'),
            TextEditorField::new('biography', 'Biographie de l\'artiste'),
        ];
    }

    public static function getEntityFqcn(): string
    {
        return Artist::class;
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
