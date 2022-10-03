Installation

Clone the git repo.
Place it inside app/code folder.
Run "php bin/magento setup:upgrade" at project route to install modules.
If you want the homepage advert image to show without errors (George/CustomGridFrontend/view/frontend/templates/widget/homepage_advert.phtml) do this
    Stores > Configuration > Content Management > "Use Static URLs for Media content in WYSWIWYG -> Yes".
Run "php bin/magento setup:di:compile && php bin/magento setup:static-content:deploy" at project route.


What is it

This code adds 2 Magento modules.
George_CustomGridAdmin- Adds a new Magento grid w full CRUD capabilities (Update is via inline-editing by double-clicking on a grid record), much like the Products grid + another widget for showing a 'Homepage Advert'.
George_CustomGridFrontend- Adds a frontend page to display the Magento grid items nicely at <PROJECT_ROOT>/custom-grid/griditems/home


Setup & Viewing

To add a new grid item login to Magento admin.
Click CUSTOM GRID > Custom Grid Items > Add New Item > Enter into fields & save
Go to your store's homepage, scroll to footer & you will see the "Custom Grid" link there.
If you want to add an advert that links to your new grid...
    Login to admin, CONTENT > Widgets > Add Widget > Type -> "Homepage Advert" & enter into fields (I recommend positioning it on Page -> CMS Home Page & Container -> Main Content Bottom)


Problems

Styles not loading for frontend
    Run "rm -rf var/view_preprocessed pub/static/frontend/george/george-theme/en_US/css && bin/magento cache:flush" at project route.

Newly added grid item not showing
    Run "php bin/magento cache:flush" at project route.
