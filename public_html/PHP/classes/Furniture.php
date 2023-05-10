<?php
include_once 'Product.php';
class Furniture extends Product {
    public function __construct($name, $price, $sku, $category, $widht, $lenght, $height) {
        parent::__construct($name, $price, $sku, $category);
        $this->widht = $widht;
        $this->lenght = $lenght;
        $this->height = $height;
    }
    
    // Function to insert a new Furniture product into the database.

    
    public function insert(){
        try{
            $pdo = Mysql::connect();
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO `product`(`id`, `name`, `SKU`, `PRICE`, `category`) VALUES (null,?,?,?,?)");
            $sql->execute(array($this->getName(),$this->getSku(),$this->getPrice(),$this->getCategory()));
            $lastInsertId = $pdo->lastInsertId();
            $sql = $pdo->prepare("UPDATE furniture f INNER JOIN product p ON f.product = p.id SET f.Height = ?, f.Widht = ?, f.Lenght = ? WHERE f.product = ?");
            $sql->execute(array($this->height,$this->widht,$this->lenght,$lastInsertId));
            $pdo->commit();
        }

        catch (PDOException $e) {
            $pdo->rollback();
            if ($e->getCode() == 23000 && $e->errorInfo[1] == 1062) {
                echo "The SKU code is already in use.";
            } else {
                echo "Error " . $e->getMessage();
            }
        }
        
        
      }
}
?>