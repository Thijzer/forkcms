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
use Backend\Modules\Immo\Model\PremiseType;

class EditPremise extends ActionAdd
{
    use ActionTrait;

    public function load()
    {
        $id = $this->getParameter('id', 'int');
        $template = $this->tpl;

        $repository = new PremiseRepository();

        $premise = $repository->find($id);
        if (!$premise) {
            throw new \HttpUrlException();
        }

        $url = Model::getURLForBlock($this->URL->getModule(), 'detail');
        $siteUrl = SITE_URL . $url;

        $form = new PremiseForm('edit', $premise);
        $form->parse($template);

        $template->assign('detailURL', $siteUrl);

        if ($form->isValid()) {

            $fields = $form->getFields();

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

            $premise->setAvailabilityType(new AvailabilityType($fields['availabilityType']));
            $premise->setPremiseType(new PremiseType($fields['premiseType']));
            $premise->setPrice($fields['price']);
            $premise->setAddress($address);
            $premise->setContact($contact);

            // new MetaData($fields['title'], $fields['slug']),

            $repository->update($premise);

            Model::triggerEvent($this->getModule(), 'premise_was_updated', ['item' => $premise]);
        }
    }
}
