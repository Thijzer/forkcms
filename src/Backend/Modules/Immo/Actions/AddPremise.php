<?php

namespace Backend\Modules\Immo\Actions;

use Backend\Core\Engine\Base\ActionAdd;
use Backend\Core\Engine\Model;
use Backend\Modules\Immo\DB\PremiseRepository;
use Backend\Modules\Immo\Form\PremiseForm;
use Backend\Modules\Immo\Model\Address;
use Backend\Modules\Immo\Model\AvailabilityType;
use Backend\Modules\Immo\Model\Contact;
use Backend\Modules\Immo\Model\Country;
use Backend\Modules\Immo\Model\EmailAddress;
use Backend\Modules\Immo\Model\MetaData;
use Backend\Modules\Immo\Model\Premise;
use Backend\Modules\Immo\Model\PremiseType;

class AddPremise extends ActionAdd
{
    use ActionTrait;

    public function load()
    {
        $template = $this->tpl;

        $url = Model::getURLForBlock($this->URL->getModule(), 'detail');
        $siteUrl = SITE_URL . $url;

        $form = new PremiseForm('add');
        $form->parse($template);

        $template->assign('detailURL', $siteUrl);

        if ($form->isValid()) {

            $fields = $form->getFields();

            //                 new MetaData($fields['title'], $fields['slug']),

            $contact = new Contact(
                $fields['firstName'],
                $fields['lastName'],
                new EmailAddress($fields['email']),
                $fields['phoneNumber'],
                $fields['language']
            );

            $address = new Address(
                $fields['street'],
                $fields['houseNumber'],
                $fields['zipCode'],
                $fields['city'],
                new Country($fields['country'])
            );

            $premise = new Premise(
                new AvailabilityType($fields['availabilityType']),
                new PremiseType($fields['premiseType']),
                $contact,
                $address,
                $fields['price']
            );

            $repository = new PremiseRepository();
            $id = $repository->add($premise);

            Model::triggerEvent($this->getModule(), 'premise_was_added', ['item' => $premise]);

            $this->redirectToRoute('Index', [
                'report' => 'added',
                'highlight' => $id,
            ]);
        }
    }
}
