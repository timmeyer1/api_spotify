<?php

namespace App\Controller\Admin;

use App\Entity\Album;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class AlbumCrudController extends AbstractCrudController
{

    // on créé nos constantes
    public const ALBUM_BASE_PATH = '/uploads/images/albums';

    public const ALNBUM_UPLOAD_DIR = 'public/uploads/images/albums';

    public static function getEntityFqcn(): string
    {
        return Album::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            TextField::new('title', 'Titre de l\'album'),
            // TextEditorField::new('description', 'Description de l\'album'),

            // Champs d'association avec une autre table
            AssociationField::new('genre', 'Catégorie de l\'album'),
            AssociationField::new('artist', 'Nom de l\'artiste'),
            ImageField::new('imagePath', 'Choisir une image de couverture')
                ->setBasePath(self::ALBUM_BASE_PATH)
                ->setUploadDir(self::ALNBUM_UPLOAD_DIR)
                ->setUploadedFileNamePattern(
                    // on donne un nom de fichier unique pour éviter de venir écraszer une image en  cas de même nom
                    fn (UploadedFile $file): string => sprintf(
                        'upload_%d_%s.%s',
                        random_int(1, 999),
                        $file->getFilename(),
                        $file->guessExtension()
                    )
                ),
            DateField::new('releaseDate', 'Date de sortie'),
            // ici on cache createdAt et updatedAt on passera les données grace au persister
            DateField::new('createAt')->hideOnForm(),
            DateField::new('updatedAt')->hideOnForm(),
        ];
    }

    // persister lors de la creation d'un album, on génère la date
    public function persistEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Album) return;
        $entityInstance->setCreatedAt(new \DateTimeImmutable());
        parent::persistEntity($em, $entityInstance);
    }

    // persister lors de la modification d'un album, on génère la date
    public function updateEntity(EntityManagerInterface $em, $entityInstance): void
    {
        if (!$entityInstance instanceof Album) return;
        $entityInstance->setUpdatedAt(new \DateTimeImmutable());
        parent::updateEntity($em, $entityInstance);
    }
}
