<?php

namespace App\Controller\Admin;

use App\Entity\Song;
use Vich\UploaderBundle\Entity\File;
use Vich\UploaderBundle\Form\Type\VichFileType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class SongCrudController extends AbstractCrudController
{
    // on ajoute les propriétés de filePathFile


    public static function getEntityFqcn(): string
    {
        return Song::class;
    }
    

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre de la chanson'),
            TextEditorField::new('filePathFile', 'Chosir un fichier mp3')
                ->setFormType(VichFileType::class)
                ->hideOnDetail()
                ->hideOnIndex(),
            TextField::new('filePath', 'Nom du fichier mp3')
                ->hideOnForm()
                ->hideOnIndex(),
            ImageField::new('filePath', 'Choisir un fichier mp3')
                ->setBasePath('/upload/files/music')
                ->hideOnForm()
                ->hideOnIndex()
                ->hideOnDetail()
            ->addHtmlContentsToBody('<p>Hello</p>'),
            NumberField::new('duration', 'Duree de la chanson'),
            AssociationField::new('album', 'Album associé'),
        ];
    }

    public function configureActions(Actions $actions): Actions
    {
        return $actions
        // Permet de customister les champs de la page index
        -> update(Crud::PAGE_INDEX, Action::NEW,
        fn(Action $action) => $action->setIcon('fa fa-add')->setLabel('Ajouter')->setCssClass('btn btn-success'))
        ->update(Crud::PAGE_INDEX, Action::EDIT,
        fn(Action $action) => $action->setIcon('icon fa fa-pen')->setLabel('Modifier'))
        ->update(Crud::PAGE_INDEX, Action::DELETE,
        fn(Action $action) => $action->setIcon('fa fa-trash')->setLabel('Supprimer'))
        ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ->update(Crud::PAGE_INDEX, Action::DETAIL,
        fn(Action $action) => $action->setIcon('icon fa fa-info')->setLabel('Informations'))

        // Page édition
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_RETURN,
        fn(Action $action) => $action->setLabel(label: 'Enregistrer et quitter'))
        ->update(Crud::PAGE_EDIT, Action::SAVE_AND_CONTINUE,
        fn(Action $action) => $action->setLabel(label: 'Enregistrer et continuer'))

        // Page création
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_RETURN,
        fn(Action $action) => $action->setLabel('Enregistrer'))
        ->update(Crud::PAGE_NEW, Action::SAVE_AND_ADD_ANOTHER,
        fn(Action $action) => $action->setLabel('Enregistrer et ajouter un nouveau'));
    }
}
