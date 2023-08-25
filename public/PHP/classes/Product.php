<?php
include_once ("./PHP/private/Mysql.php");
class Product {
  // Properties
  private $name;
  private $price;
  private $sku;
  private $category;
  private $products;
  
  // Constructor
  public function __construct($name, $price, $sku, $category) {
    $this->name = $name;
    $this->price = $price;
    $this->sku = $sku;
    $this->category = $category;
  }
  
  
// Method to select all products from the database
  public static function select_all() {
    $sql = Mysql::connect()->prepare("SELECT * FROM `product` LEFT JOIN dvd ON product.id = dvd.product LEFT JOIN book ON product.id = book.product LEFT JOIN furniture ON product.id = furniture.product");
    $sql->execute();
    $result = $sql->fetchAll(PDO::FETCH_OBJ);
    return $result;
  }

  public static function delete_by_sku($selectedSKU){
    $sql = Mysql::connect()->prepare("DELETE FROM `product` WHERE product.SKU = ?");
    $sql->execute(array($selectedSKU));
  }
  
// Getter and Setter methods for each property

  public function getName() {
    return $this->name;
  }

  public function getSku() {
    return $this->sku;
  }

  public function getPrice() {
    return $this->price;
  }

  public function getCategory() {
    return $this->category;
  }

}

?>