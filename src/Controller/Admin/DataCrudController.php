<?php

namespace App\Controller\Admin;

use App\Entity\Data;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DataCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Data::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('symbol'),
            TextField::new('name'),
            TextField::new('simple_native'),
            TextField::new('decimal_digits'),
            TextField::new('rounding'),
            TextField::new('code'),
            TextField::new('name_plural'),
            TextField::new('type'),
        ];
    }

}
