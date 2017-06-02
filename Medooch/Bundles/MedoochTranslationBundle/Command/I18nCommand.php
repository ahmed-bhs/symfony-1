<?php
/**
 * Copyright (c) 2017.
 */

namespace Medooch\Bundles\MedoochTranslationBundle\Command;

use Medooch\Components\Helper\Yml\YamlManipulator;
use Sensio\Bundle\GeneratorBundle\Command\Helper\QuestionHelper;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;

/**
 * Class I18nCommand
 * @package Medooch\Bundles\MedoochTranslationBundle\Command
 */
abstract class I18nCommand extends ContainerAwareCommand
{
    /**
     * ---------------------------------------
     * @author: Trimech Mehdi <trimechmehdi11@gmail.com> // url : http://trimech-mahdi.fr/
     * ---------------------------------------
     * **************** Function documentation: ****************
     * Find Resources Translations for $bundle
     * ---------------------------------------
     * **************** Function input: ****************
     * @param string $bundle
     * @param string $method
     * ---------------------------------------
     */
    protected function bundleDetectTranslations(string $bundle, string $method)
    {
        if ($bundle === 'translations') {
            $resource = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/' . $bundle;
        } else {
            $resource = $this->getContainer()->get('kernel')->getRootDir() . '/Resources/' . $bundle . '/translations';
        }
        if (is_dir($resource)) {
            $files = scandir($resource);
            if (count($files)) {
                $this->$method($resource, $files);
            }
        }
    }

    protected function getFileContents($filename)
    {
        return YamlManipulator::getFileContents($filename);
    }

    protected function setFileContents($filename, array $contents = [])
    {
        YamlManipulator::updateParameters($filename, $contents);
    }

    protected function getQuestionHelper()
    {
        $question = $this->getHelperSet()->get('question');
        if (!$question || get_class($question) !== 'Sensio\Bundle\GeneratorBundle\Command\Helper\QuestionHelper') {
            $this->getHelperSet()->set($question = new QuestionHelper());
        }

        return $question;
    }
}
