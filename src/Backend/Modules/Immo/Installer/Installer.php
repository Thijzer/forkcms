<?php

namespace Backend\Modules\Immo\Installer;

use Backend\Core\Installer\ModuleInstaller;
use Backend\Modules\Locale\Engine\Model;
use Common\ModuleExtraType;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Yaml\Yaml;
use Symfony\Component\Finder\Finder;

class Installer extends ModuleInstaller
{
    /**
     * Install the module
     */
    public function install()
    {
        //$this->importSQL(__DIR__ . '/Data/install.sql');

        $finder = new Finder();
        $finder->files()->in(__DIR__.'/Data/Translations/');
        foreach ($finder as $file) {
            $this->importYmlLocale($file);
        }


        //$this->addModule('Immo');


        exit;

        //$this->makeSearchable('Faq');
        $this->setModuleRights(1, 'Immo');

        $this->setActionRights(1, 'Immo', 'Index');
//        $this->setActionRights(1, 'Immo', 'Add');
//        $this->setActionRights(1, 'Immo', 'Edit');
//        $this->setActionRights(1, 'Immo', 'Delete');
//        $this->setActionRights(1, 'Immo', 'Sequence');
//        $this->setActionRights(1, 'Immo', 'Categories');
//        $this->setActionRights(1, 'Immo', 'AddCategory');
//        $this->setActionRights(1, 'Immo', 'EditCategory');
//        $this->setActionRights(1, 'Immo', 'DeleteCategory');
//        $this->setActionRights(1, 'Immo', 'SequenceQuestions');
//        $this->setActionRights(1, 'Immo', 'DeleteFeedback');
//        $this->setActionRights(1, 'Immo', 'Settings');

        $faqId = $this->insertExtra('Immo', ModuleExtraType::block(), 'Faq');

/*
        // Register widgets
        // Category faq widgets will be added on the fly
        $this->insertExtra('Immo', ModuleExtraType::widget(), 'MostReadQuestions', 'MostReadQuestions');
        $this->insertExtra('Immo', ModuleExtraType::widget(), 'AskOwnQuestion', 'AskOwnQuestion');
        $this->insertExtra('Immo', ModuleExtraType::widget(), 'Categories', 'Categories');

        $this->setSetting('Immo', 'overview_num_items_per_category', 0);
        $this->setSetting('Immo', 'most_read_num_items', 0);
        $this->setSetting('Immo', 'related_num_items', 0);
        $this->setSetting('Immo', 'spamfilter', false);
        $this->setSetting('Immo', 'allow_feedback', false);
        $this->setSetting('Immo', 'allow_own_question', false);
        $this->setSetting('Immo', 'allow_multiple_categories', true);
        $this->setSetting('Immo', 'send_email_on_new_feedback', false);
*/

       // $this->insertDashboardWidget('Faq', 'Feedback');

        // set navigation
        $navigationModulesId = $this->setNavigation(null, 'Modules');
        $navigationFaqId = $this->setNavigation($navigationModulesId, 'Immo');
        $this->setNavigation(
            $navigationFaqId,
            'Questions',
            'immo/index',
            array('immo/add', 'immo/edit')
        );
//        $this->setNavigation(
//            $navigationFaqId,
//            'Categories',
//            'faq/categories',
//            array('faq/add_category', 'faq/edit_category')
//        );
//        $navigationSettingsId = $this->setNavigation(null, 'Settings');
//        $navigationModulesId = $this->setNavigation($navigationSettingsId, 'Modules');
//        $this->setNavigation($navigationModulesId, 'Faq', 'faq/settings');
    }

    protected function importYmlLocale(\SplFileInfo $file, bool $overwriteConflicts = false)
    {
        $content = trim(file_get_contents($file->getRealPath()));

        if ($data = Yaml::parse($content)) {

            $fileInfo = array_combine(['application', 'module'], explode('_', $file->getBasename('.' . $file->getExtension())));
            $extensions = explode('.', $file->getExtension());
            $fileInfo['language'] = $extensions[0];
            $fileInfo['user_id'] = $this->getDefaultUserID();
            $fileInfo['edited_on'] = gmdate('Y-m-d H:i:s');

            foreach ($data as $key => $translations) {
                foreach ($translations as $translationName => $translationValue) {
                    $item['name'] = $translationName;
                    $item['value'] = $translationValue;
                    $item['type'] = $key;

                    dump(array_merge($fileInfo, $item));exit;

                    Model::update($item);
                }
            }
        }
    }
}
