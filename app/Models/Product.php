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
        $id = intval($id); //надо же это?

        //Запрос к БД
        if ($id) {

            $db = self::connection();

            $result = $db->query('SELECT * from products WHERE id=' . $id);
            $result->setFetchMode(\PDO::FETCH_ASSOC);

            $productsItem = $result->fetch();

            return $productsItem;

        }
    }

    public static function create($options)
    {
        // Соединение с БД
        $db = self::connection();

        $sql = 'INSERT INTO products '
                . '(name, price, quantity, manufacturer, description )'
                . 'VALUES '
                .'(:name, :price, :quantity, :manufacturer, :description )';

        //Получение и возврат результатов
        $result = $db->prepare($sql);
        $result->bindParam(':name', $options['name'], \PDO::PARAM_STR);
        $result->bindParam(':price', $options['price'], \PDO::PARAM_STR);
        $result->bindParam(':quantity', $options['quantity'], \PDO::PARAM_INT);
        $result->bindParam(':manufacturer', $options['manufacturer'], \PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], \PDO::PARAM_STR);

        if($result->execute()) {
            // Если запрос выполнен успешно, возвращаем id добавленого продукта
            return  $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

     public static function update($id, $options) {
         // Соединение с БД
         $db = self::connection();

         //Текст запроса в БД
         $sql = 'UPDATE products '
                . 'SET '
                . 'name = :name, 
                   price = :price,
                   quantity = :quantity,
                   manufacturer = :manufacturer,
                   description = :description '
                . 'WHERE id = :id';

         // Получение и возврат результатов
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
     * Удаляет товар с указанным id
     * @param $id
     * @return bool
     */
    public static function delete($id)
    {
        // Соединение с БД
        $db = self::connection();

        $sql = 'DELETE FROM products WHERE id = :id';

        //Получение и возврат результатов
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
        $db  = self::connection();

        $newList = [];

        // или проще SELECT *, но там мы create_at, update_at не выводим
        //DESC - в обратном порядке, чтоб последний добавленный выводился. так лучше или в обычном порядке
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

    public static function search($name)
    {
        $db = self::connection();


        $query = "SELECT * FROM `products` WHERE `name` LIKE ?";

        //Получение и возврат результатов
        $result = $db->prepare($query);
//        if ($result->fetchColumn()) {
             $result->execute(["%$name%"]);
             return $result->fetchAll();
//        }
        return false;

    }

    public static function getImage($id)
    {
        //Название изображения-заглушки
        $noImage = 'no-image.jpg';

        // Путь к папке с товарами
        $path = '/uploads/products/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if(file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)){
            //Если файл изображения для товара существует, возвращаем его путь
            return $pathToProductImage;
        }

        return $path . $noImage;
    }


}
