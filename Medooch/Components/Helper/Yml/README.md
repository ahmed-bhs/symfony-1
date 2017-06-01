# yaml-manipulator

This Helper provide some static methods to manipulate yaml files.

Install:
----

    composer require "medooch/yaml-manipulator:1.0.x-dev"

Usage:
----

    use Medooch\Components\Helper\Yml\YamlManipulator;
    use Symfony\Bundle\FrameworkBundle\Controller\Controller;
    
    class test extends Controller{
        public function getConfigYml(){
            $filename = $this->get('kernel')->getRootDir() . '/config/config.yml';
            var_dump(YamlManipulator::getFileContents($filename));
        }
    }