<?php

namespace App\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Services\Router;

//use App\models\Product;
include_once ROOT . '/app/models/Product.php';
include_once ROOT . '/app/models/User.php';


class ProductController
{
    /**
     * Describes the behavior for the products page
     * @return bool
     */
    public function actionIndex()
    {
        $userId = User::checkLogged();

        // Get user's data from the database
        $user = User::getUserById($userId);

        $productsList = [];
        $productsList = Product::getAll();

        require_once(ROOT . '/views/pages/products/index.php');

        return true;
    }

    /**
     * Describes the behavior for the single product page
     * @param $id
     * @return bool
     */
    public function actionView($id)
    {
        $userId = User::checkLogged();

        // Get user's data from the database
        $user = User::getUserById($userId);

        if ($id) {
            $productsItem = Product::get($id);

            require_once(ROOT . '/views/pages/products/view.php');

        }

        return true;
    }

    /**
     * Product create
     * @return bool
     */
    public function actionCreate()
    {
        // Access check
        User::checkAdmin();

        //Form processing
        if (isset($_POST['submit'])) {
            // If the form is submitted, get the data from the form
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['quantity'] = $_POST['quantity'];
            $options['manufacturer'] = $_POST['manufacturer'];
            $options['description'] = $_POST['description'];

            // Errors in the form
            $errors = false;

            // You can validate the required values ​​here
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Field Name is required. Please fill in the field';
            }
            if (!isset($options['manufacturer']) || empty($options['manufacturer'])) {
                $errors[] = 'Field Brand is required. Please fill in the field';
            }

            if ($errors == false) {
                // If there are no errors, add a new item
                $id = Product::create($options);

                // If an entry has been added
                if ($id) {
                    // Checking if an image was uploaded via the form
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // If loaded, transfer it to the desired folder, give a name
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/products/{$id}.jpg");
                    }
                }

                // Redirecting to the product management page
                Router::redirect('/products');
            }

        }

        // Connecting the View
        require_once(ROOT . '/views/pages/products/create.php');
        return true;
    }

    /**
     * Product update
     * @param $id
     * @return bool
     */
    public function actionUpdate($id)
    {
        // Access check
        User::checkAdmin();

        $product = Product::get($id);

        // Form processing
        if (isset($_POST['submit'])) {
            // If the form is submitted, get the data from the form
            $options['name'] = $_POST['name'];
            $options['price'] = $_POST['price'];
            $options['quantity'] = $_POST['quantity'];
            $options['manufacturer'] = $_POST['manufacturer'];
            $options['description'] = $_POST['description'];

            // Errors in the form
            $errors = false;

            // Errors in the form
            if (!isset($options['name']) || empty($options['name'])) {
                $errors[] = 'Field Name is required. Please fill in the field';
            }
            if (!isset($options['manufacturer']) || empty($options['manufacturer'])) {
                $errors[] = 'Field Brand is requared. Please fill in the field';
            }

            if ($errors == false) {
                //If there are no errors, save the changes

                if (Product::update($id, $options)) {
                    //Checking if an image was uploaded via the form
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // If loaded, transfer it to the desired folder, give a name
                        move_uploaded_file($_FILES["image"]["tmp_name"], $_SERVER['DOCUMENT_ROOT'] . "/uploads/products/{$id}.jpg");
                    }
                }

                //Redirecting to the product management page
                Router::redirect('/products');
            }
        }
        require_once(ROOT . '/views/pages/products/update.php');
        return true;
    }

    /**
     * Product delete
     * @param $id
     * @return bool
     */
    public function actionDelete($id)
    {
        // Access check
        User::checkAdmin();

        // Form processing
        if (isset ($_POST['submit'])) {
            // If the form is submitted
            // Deleting a product
            Product::delete($id);

            //Redirecting the user to the product management page
            Router::redirect('/products');
        }
        // Connecting the View
        require_once(ROOT . '/views/pages/products/delete.php'); //Возможно для delete не надо
        return true;
    }

    /**
     * Search products
     * @return bool
     */
    public static function actionSearch()
    {
        if (isset($_POST['query'])) {
            $search = Product::search($_POST['query']);
            $productsList = $search;
            $userId = $_SESSION['user'];
            $user[] = User::getUserById($userId);
            require_once(ROOT . '/views/pages/products/search.php');
        }

        return true;
    }

}
