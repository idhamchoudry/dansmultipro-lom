# Magento 2 Module DansMultiPro LOM
Upload file data in CMS and retrieve data via webrest api

## Installation
\* = in production please use the `--keep-generated` option

### From terminal
 - Enable the module by running `php bin/magento module:enable DansMultiPro_LOM`
 - Apply database updates by running `php bin/magento setup:upgrade`\*
 - Flush the cache by running `php bin/magento cache:flush`
 - Make sure Magento has sufficient perimission to write, insert, delete file in Magento media repository, in order to have file upload functionality works properly

## CMS
Navigate to DansMultiPro > Material > Choose one of the record to edit, or click  `Add new Material` button to create a new record

## Rest API
Postman collection is included `DansMultiPro_Lom.postman_collection_v2-1.json` , you can use this as a guidance on how to access the webrest api





