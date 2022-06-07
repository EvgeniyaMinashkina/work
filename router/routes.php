<?php

return [

    // Управление товарами
    'product/create' => 'product/create',
    'products/search' => 'product/search',
    'product/update/([0-9]+)' => 'product/update/$1',
    'product/delete/([0-9]+)' => 'product/delete/$1',
    'products/([0-9]+)' => 'product/view/$1', // actionView in ProductController
    'products' => 'product/index', // actionList in ProductController

    // Пользователь
    'register' => 'user/register', // actionRegister in UserController
    'login' => 'user/login', // actionLogin in UserController
    'logout' => 'user/logout',

    '' => 'product/index', // actionIndex in SiteController


];
