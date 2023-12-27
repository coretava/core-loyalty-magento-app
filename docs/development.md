# Local Development

## Select different environment

You can select the environment by changing the store name (general/store_information/name) as follows:

* Dev: store name should include `coretava_dev`
* Staging: store name should include `coretava_staging`
* Production: If none of the above is matching

## Connect local files

You can install the extension and connect to docker using the following commands

```shell
composer config repositories.coretava '{"type": "path", "url": "/coretava-loyalty", "options": {"symlink": false}}'
composer require coretava/core-loyalty
```
