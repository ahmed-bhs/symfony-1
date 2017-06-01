# symfony

Symfony 3.3 optionals plugins and bundles

This package provides symfony developers with some functionality ready for use.
Before starting using this package, please make sure that these requirements are respected in your symfony application.

###### Requirements:
        - Php 7.1.1
        - Symfony 3.3

Packages structure and features:
----

1. Bundles
    1. ExportBundle
        - Export entities Data to CSV Files.
    2. I18nBundle
        - (Spelling Checker for frensh language)
        - (I18n files generator)
2. Components
    1. Helper
        - Image
        - Mailer
        - Request
        - Router
        - Security
        - [Yml :](https://github.com/medooch/symfony/blob/master/Medooch/Components/Helper/Yml/README.md) (Yaml Manipulator: Static methods that allow developers to Reading/Dumping yaml files)
    2. Traits
        - IsActive (Add entity doctrine attribute isActive)
        - TreeLeftRightNested
        - SimpleSortable (Rank column)
        - General RepositoryMethods
        - Token (add token autogenerated by the helper for entities)
    3. Extensions
        - Accessing container parameters from twig files
        - Accessing session parameters from twig files
        - treeStructure: Build an tree structure : see https://dbushell.com/Nestable/
    4. Lib
        - Google:
            - Translator
        - Reverso:
            - Frensh Spelling Checker
    
    5. extras:
        - [Validator :](https://github.com/medooch/symfony/tree/master/Medooch/Components/Validator/README.md) Validate Class to simply call symfony validator
        


Installation:
----

> using composer
    add "medooch/symfony:dev-master" to your composer.json and execute composer update or open your terminal and execute
    
    composer require medooch/symfony:dev-master
    
1- Enabling services:

// app/config/services.yml

    imports:
        resource: '%kernel.project_dir%/src/Medooch/Components/services.yml'
     
Usage
----

To start using this package, please check the readme file for each components/bundles or click check our summary.