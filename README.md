## Assignment #1 ##

Task is to build a small backend application using Laravel. The application will store and manage businesses.

### Installation ###

* `git clone https://github.com/kovalin/assignment_1.git`
* `cd assignment_1`
* `composer install`
* Create a database and inform *.env*
* `php artisan key:generate`
* `php artisan migrate --seed` to create and populate tables

### Include ###

* [Bootstrap](http://getbootstrap.com) for CSS and jQuery plugins
* [Font Awesome](http://fortawesome.github.io/Font-Awesome) for the nice icons

### Features ###

* get-businesses
* store-businesses
* get-business
* update-business
* delete-business

### Tests ###

* get businesses
* can create new business
* test_for_failed_create_business
* it checks for invalid name
* it checks for invalid price
* it checks for invalid city
* get business
* update business
* test_for_failed_update_business
* delete business
