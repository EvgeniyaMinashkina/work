
This application allows:
 - to get registered and authenticated,
 - list and manage products,
 - search products.

By default user is created without admin rights. 
Edit, addition and deletion is allowed only for admin user which has is_admin flag set. 

Use this admin user for test purposes:
 - Email: admin@gmail.com
 - Password: Qwerty

Run composer install to install bootstrap and jquery.

DB settings are stored in config/db.php

Routes are in router/routes.php

DB dump can be found in root directory named work.sql


Task:

Create product management using HTML, CSS3, Javascript and PHP. In the front-end part
you can (but don't have to) use a framework of your choice (Bootstrap, Tailwind, jQuery,
React, Vue, ...). It is important that the application is also functional on mobile devices.
We would like to see your application with an OOP approach without
using the framework.
Access to the application itself will be subject to login. After successful verification
login details we will have access to complete product management.
Structure:
- Login
- List of all products
- Product detail
- Listing of all product details
- Adding a new product
- Editing of existing products

You make us happy when:
- You will expand your application to search for products
- Displaying found results in real time without having to submit a form