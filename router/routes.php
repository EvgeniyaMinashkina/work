<?php

return [

    // Products management
    'product/create' => 'product/create', //actionCreate in ProductController
    'products/search' => 'product/search', //actionSearch in ProductController
    'product/update/([0-9]+)' => 'product/update/$1', //actionUpdate in ProductController
    'product/delete/([0-9]+)' => 'product/delete/$1', //actionDelete in ProductController
    'products/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'products' => 'product/index', // actionList in ProductController

    //User
    'register' => 'user/register', // actionRegister in UserController
    'login' => 'user/login', // actionLogin in UserController
    'logout' => 'user/logout', // actionLogout in UserController

    '' => 'product/index', // actionIndex in SiteController




];
