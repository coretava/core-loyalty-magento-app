# Coretava - Core Loyalty

Coretava is an all-inclusive smart loyalty solution tailored for e-commerce and retailers.

It encompasses a range of features, including data-driven analytics and insights, cashback rewards, enticing welcome
coupons, customizable points value, engaging referral and promotions popups, multi-tiered loyalty levels with versatile
settings, and a dedicated customizable loyalty page.

The platform encourages customer participation through diverse points-earning avenues like purchases, and interactive
missions. Moreover, Coretava injects excitement into the loyalty experience with gamification elements and keeps
customers informed via transactional emails. This solution empowers businesses to cultivate loyal customer relationships
while leveraging a comprehensive set of loyalty-enhancing tools.

![Coretava](https://coretava.com/_next/image?url=https%3A%2F%2Fstatic.coretava.com%2Fcms%2Fthumbnail_Layer_2_13eb55038f_b00cee250d.png&w=256&q=100)

## How to install

To install the extension, you need to use Composer. To learn more about Composer, click here: https://getcomposer.org.

### Add extension to your project

```shell
composer require coretava/core-loyalty
```

### Compile Magento and clean cache

```shell
bin/magento setup:upgrade
bin/magento setup:di:compile
bin/magento cache:clean
```

## Contribution

New tag will be created on code merge, package will be published
to [Packagist](https://packagist.org/packages/coretava/core-loyalty)

## Support

For support, email support@coretava.com.

## Local Development

### Select different environment

You can select the environment by changing the store name (general/store_information/name) as follows:

* Dev: store name should include `coretava_dev`
* Staging: store name should include `coretava_staging`
* Production: If none of the above is matching

### Connect local files

You can install the extension and connect to docker using the following commands

```shell
composer config repositories.coretava '{"type": "path", "url": "/coretava-loyalty", "options": {"symlink": false}}'
composer require coretava/core-loyalty
```
