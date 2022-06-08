<?php

namespace App\Models;

use App\Core\Model;

class Product extends Model
{
    /**
     * Return single products item with specified id
     * @param $id
     * @return mixed|void
     */
    public static function get($id)
    {
        $id = intval($id);

        //Запрос к БД
        if ($id) {

            $db = self::connection();

            $result = $db->query('SELECT * from products WHERE id=' . $id);
            $result->setFetchMode(\PDO::FETCH_ASSOC);

            $productsItem = $result->fetch();

            return $productsItem;

        }
    }

    /**
     * Saving a new product to the database
     * @param $options
     * @return false|int|string
     */
    public static function create($options)
    {
        // Database connection
        $db = self::connection();

        $sql = 'INSERT INTO products '
            . '(name, price, quantity, manufacturer, description )'
            . 'VALUES '
            . '(:name, :price, :quantity, :manufacturer, :description )';

        // Getting and returning results
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], \PDO::PARAM_STR);
        $result->bindParam(':quantity', $options['quantity'], \PDO::PARAM_INT);
        $result->bindParam(':manufacturer', $options['manufacturer'], \PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], \PDO::PARAM_STR);

        if ($result->execute()) {
            // If the request is successful, return the id of the added product
            return $db->lastInsertId();
        }
        // Otherwise return 0
        return 0;
    }

    /**
     * Changing a product with the specified id in the database
     * @param $id
     * @param $options
     * @return bool
     */
    public static function update($id, $options)
    {
        // Database connection
        $db = self::connection();

        // Query text
        $sql = 'UPDATE products '
            . 'SET '
            . 'name = :name, 
                   price = :price,
                   quantity = :quantity,
                   manufacturer = :manufacturer,
                   description = :description '
            . 'WHERE id = :id';

        // Getting and returning results
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], \PDO::PARAM_STR);
        $result->bindParam(':quantity', $options['quantity'], \PDO::PARAM_INT);
        $result->bindParam(':manufacturer', $options['manufacturer'], \PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], \PDO::PARAM_STR);

        return $result->execute();
    }

    /**
     * Deletes the product with the specified id
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        // Database connection
        $db = self::connection();

        $sql = 'DELETE FROM products WHERE id = :id';

        // Getting and returning results
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, \PDO::PARAM_INT);
        return $result->execute();
    }

    /**
     * Return an array of products items
     * @return array
     */
    public static function getAll()
    {
        $db = self::connection();

        $newList = [];

        $result = $db->query('SELECT id, name, description, image, price, quantity, manufacturer '
            . 'FROM products '
            . 'ORDER BY id ASC');

        $i = 0;
        while ($row = $result->fetch()) {
            $productsList[$i]['id'] = $row['id'];
            $productsList[$i]['name'] = $row['name'];
            $productsList[$i]['description'] = $row['description'];
            $productsList[$i]['image'] = $row['image'];
            $productsList[$i]['price'] = $row['price'];
            $productsList[$i]['quantity'] = $row['quantity'];
            $productsList[$i]['manufacturer'] = $row['manufacturer'];
            $i++;
        }

        return $productsList;

    }

    /**
     * Search for a product in the database by name
     * @param $name
     * @return array|false
     */
    public static function search($name)
    {
        $db = self::connection();


        $query = "SELECT * FROM `products` WHERE `name` LIKE ?";

        //Getting and returning results
        $result = $db->prepare($query);
//        if ($result->fetchColumn()) {
        $result->execute(["%$name%"]);
        return $result->fetchAll(\PDO::FETCH_ASSOC);
//        }
        return false;

    }

    /**
     * Getting an image by id
     * @param $id
     * @return string
     */
    public static function getImage($id)
    {
        //Name of dummy image
        $noImage = 'no-image.jpg';

        // Path to product folder
        $path = '/uploads/products/';

        // Path to product image
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // If the image file for the product exists, return its path
            return $pathToProductImage;
        }

        return $path . $noImage;
    }


}
