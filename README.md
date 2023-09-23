# Magento 2 Module DansMultiPro LOM

    ``dansmultipro/module-lom``

 - [Main Functionalities](#markdown-header-main-functionalities)
 - [Installation](#markdown-header-installation) 


## Main Functionalities
This is for interview test

## Installation
\* = in production please use the `--keep-generated` option

### Type 1: Zip file

 - Unzip the zip file in `app/code/DansMultiPro`
 - Enable the module by running `php bin/magento module:enable DansMultiPro_LOM`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`

### Type 2: Composer

 - Make the module available in a composer repository for example:
    - private repository `repo.magento.com`
    - public repository `packagist.org`
    - public github repository as vcs
 - Add the composer repository to the configuration by running `composer config repositories.repo.magento.com composer https://repo.magento.com/`
 - Install the module composer by running `composer require dansmultipro/module-lom`
 - enable the module by running `php bin/magento module:enable DansMultiPro_LOM`
 - apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`



