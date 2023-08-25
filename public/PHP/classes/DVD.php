<?php
include_once 'Product.php';
class DVD extends Product {
    private $property;
    public function __construct($name, $price, $sku, $category, $propriety) {
        parent::__construct($name, $price, $sku, $category);
        $this->propriety = $propriety;
    }

    // Function to insert a new DVD product into the database.

    public function insert(){
        try{
            $pdo = Mysql::connect();
            $pdo->beginTransaction();
            $sql = $pdo->prepare("INSERT INTO `product`(`id`, `name`, `SKU`, `PRICE`, `category`) VALUES (null,?,?,?,?)");
            $sql->execute(array($this->getName(),$this->getSku(),$this->getPrice(),$this->getCategory()));
            $lastInsertId = $pdo->lastInsertId();
            $sql = $pdo->prepare("UPDATE dvd d INNER JOIN product p ON d.product = p.id SET d.size = ? WHERE d.product = ?");
            $sql->execute(array($this->propriety,$lastInsertId));
            $pdo->commit();

        }
        
        catch (PDOException $e) {
            $pdo->rollback();
            if ($e->getCode() == 23000 && $e->errorInfo[1] == 1062) {
                echo "The SKU code is already in use.";
            } else {
                echo "Error" . $e->getMessage();
            }
        }
    }
}
?>