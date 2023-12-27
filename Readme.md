![Coretava](https://coretava.com/_next/image?url=https%3A%2F%2Fstatic.coretava.com%2Fcms%2Fthumbnail_Layer_2_13eb55038f_b00cee250d.png&w=256&q=100)

# Coretava - Core Loyalty

Coretava is an all-inclusive smart loyalty solution tailored for e-commerce and retailers.

It encompasses a range of features, including data-driven analytics and insights, cashback rewards, enticing welcome
coupons, customizable points value, engaging referral and promotions popups, multi-tiered loyalty levels with versatile
settings, and a dedicated customizable loyalty page.

The platform encourages customer participation through diverse points-earning avenues like purchases, and interactive
missions. Moreover, Coretava injects excitement into the loyalty experience with gamification elements and keeps
customers informed via transactional emails. This solution empowers businesses to cultivate loyal customer relationships
while leveraging a comprehensive set of loyalty-enhancing tools.

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

### Enabling Coretava Integration

After completing the previous part, the next step is to enable our integrations from the admin panel, which can be done
by following these steps.

* Navigate to your store’s admin panel.
* From the sidebar, select System → Integrations.
* You will find that a new integration is created by the name CoretavaIntegration.
* Click on the activate button, then on allow button.
* A screen with the integration credentials will show up
* Save the shown values (`Consumer Key`, `Consumer Secret`, `Access Token`, `Access Token Secret`) for the next steps.

### Creating Coretava Recourses

After finishing the two previous steps, please share the following details with Coretava team:

#### Store Info

* Domain: Store website domain/url
* Country: Store base country
* Currency: Store base currency
* Timezone: Store timezone difference in hours
* Language: Store default language

#### Business Info

* Email: Business email
* Phone: Business phone
* Name: Business name
* Company: Business company

#### Admin info

* Name: Admin name
* Email: Admin email
* Password: Admin initial password

#### Integration info (Retrieved from Enabling Coretava Integration step)

* Consumer Key
* Consumer Secret
* Access Token
* Access Token Secret

### Configuring Coretava App

After giving our team the previous information, our team will provide you with the following:

* App ID
* App Key

The customer can follow these steps to configure our app:

1. From the admin panel, navigate to Store → Configuration
2. From the left side menu, find Coretava, then click on Core loyalty
3. Insert the app id and app key given in the appropriate fields.
4. Set `Allow customer's data gathering` value to `No` if you don't want Coretava app to collect customer's data.
5. Click save.

### Access Coretava Dashboard

Navigate to [Coretava Dashboard](https://dashboard.coretava.com/) and use the admin email provided in `Admin info` and
the
password we provide you to access the dashboard.

## Support

For support, email support@coretava.com.
