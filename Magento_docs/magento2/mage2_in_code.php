-The Magento framework uses the ObjectManager to generate and inject the classes declared in your constructor.
You do not call the object manager directly because the framework handles this automatically


-Dependency Injection is a design pattern that allows an object A to declare its dependencies to an external object B that supplies those dependencies.



-What is magento 2.0

Maganto it is a ecommemce place form 

Magento 2 Community Edition (CE) was named into Magento 2 Open Source.

Magento 2 Enterprise Edition (EE) was named into Magento 2 Commerce.

#Magento 2 Enterprise Cloud Edition

Enterprise Cloud Edition, is a managed and automated hosting platform for Magento specifically. 
This version combines Magento Commerce, Cloud infrastructure hosting, with a few differences and added features including Git integration and key environments for development, staging, and live production.



-Define Magento with its architecture?

Magento is an e-commerce platform created on open source technology, which provides online business with flexibility and control over the content, appearance, and functionality of their e-commerce store. Its architecture is a PHP MVC (Model-View-Controller)

There are various versions of Magento which includes:

 Magento Enterprise
 go
 Magento Community


 -Which technology is used by Magento?

 There are multiple technologies used by Magento, with its web server and Database components. Its web server is being created using PHP scripting language whereas Database part is taken care of by MySQL. Data model being utilized by MySQL is based on the EAV i.e. 

 it would store data objects in a tree structure

 A key benefit of EAV technique is that it allows a developer to add unlimited columns to table virtually, one table would hold all the attribute data and other tables would hold the entity and value against every attribute mentioned.


Database schema for EAV entities:

eav_entity – (E) The Entity table.
eav_entity_attribute (A) The Attrubute table
eav_entity_{type} (V) – The Value table. {type} – datetime, decimals, int, text and varchar.

Which EAV entities are there in Magento 2:

customer_entity(customer table)
eav_attribute
customer_entity_{type}(attr value) – datetime, decimals, int, text and varchar.


The list of entities can be found in the eav_entity_type table:

customer-
customer_address
catalog_category
catalog_product

Which EAV entity types are there in Magento 2:

eav_entity_int
eav_entity_varchar
eav_entity_text
eav_entity_decimal
eav_entity_datetime



-what are the different deploy modes and what are their differences?

Developer-
In this mode, all the files in pub/static/ are symlinks to the original file. Exceptions are thrown and errors are displayed in the front end. This mode makes pages load very slowly, but makes it easier to debug, as it compiles and loads static files every time. Cache can still be enabled.

Default-
This default is enabled out-of-the-box. It is a state in between production and developer, as the files are generated when they are needed. I.e. CSS files are generated using several LESS files in several locations. These files will be generated only when they are needed by the front end, and will not be generated again the next time they are needed.

Production-
This mode should be enabled for all Magento 2 websites in production, as all the required files are generated and placed in the pub/static folder.



-what is dependency injection and what are its advantages?
Dependency injection is a design pattern strategy that relegates the responsibility of injecting the right dependency to the calling module or framework.

Its main advantages are that it makes code:

Easier to test
Easier to re-use
Easier to maintain

-what is a factory class and how does it work?
Factory classes are generated when code generation happens. They are created automatically for models that represent database entities.

Factory classes are used to create, get, or change entity records without using the ObjectManager directly, as its direct usage is discouraged by Magento. (This is because it goes against the principles of dependency injection.)

These classes do not need to be manually defined, but they can be, in case you need to define a specific behavior.


-What is the difference between a store and a website?
For example, if you need to define different base currencies, you will need two different websites.


-What is the best way to count the items in a collection? Explain the differences with other method(s).

The best way is to use the method getSize(). This function will not load the collection each time to count the items but store it. So every time you need this value you will not have to recalculate it. Moreover, it uses the SQL COUNT() function in order to speed up the counting process. However, if the collection has been modified, this value can become inconsistent.

In contrast, the count() method will load the collection and count its items every time it is called. This can become very resource demanding.

