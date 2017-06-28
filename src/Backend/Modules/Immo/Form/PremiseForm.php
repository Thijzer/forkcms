<?php

namespace Backend\Modules\Immo\Form;

use Backend\Core\Engine\Form;
use Backend\Modules\Immo\Model\AvailabilityType;
use Backend\Core\Language\Language;
use Backend\Modules\Immo\Model\PremiseType;

class PremiseForm extends Form
{
    use FormTrait;

    public function load(Form $form)
    {
        $form->addText('title', null, null, 'form-control title', 'form-control danger title');

        $form->addEditor('description');
        $form->addDropdown('premiseType', PremiseType::getAllTypes());
        $form->addDropdown('availabilityType', AvailabilityType::getAllTypes());
        $form->addText('price');
    }

    public function processFields(Form $form)
    {
        $form->getField('title')->isFilled(Language::err('TitleIsRequired'));
        $form->getField('description')->isFilled(Language::err('FieldIsRequired'));
        $form->getField('premiseType')->isFilled(Language::err('FieldIsRequired'));
        $form->getField('availabilityType')->isFilled(Language::err('FieldIsRequired'));
        $form->getField('price');
    }
}

