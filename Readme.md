1. Run docker compose file. Wait for Magento to be up & running.

```shell
docker-compose up -d
```

2. Install Coretava app

```shell
#composer config repositories.coretava '{"type": "path", "url": "/coretava-loyalty", "options": {"symlink": false}}'
composer config repositories.coretava vcs https://github.com/coretava/loyalty-station-magento
composer require coretava/core-loyalty:dev-main
```

3. Compile magento and cache clean up

```shell
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:clean
```

4. Enable developer mode to show errors

```shell
bin/magento deploy:mode:set developer
```

5. Now you can access magento store using the following URLs
    * Storefront: http://localhost
    * Admin: http://localhost/admin
