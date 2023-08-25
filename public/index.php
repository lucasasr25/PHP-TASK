<?php

include_once('./PHP/classes/Product.php'); 
$products = Product::select_all();
if (isset($_POST['btn']) && isset($_POST['checkbox'])){
  foreach($_POST['checkbox'] as $selectedSKU){
    Product::delete_by_sku($selectedSKU);
  }
  header("Location: index.php");
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Product List</title>
  <link href="CSS/style.css" rel="stylesheet">
</head>
<body>
  <div class="up">
    <h1 style="font-family:Arial;">Product List</h1>
    <a href = "addproduct.php"><button class="button1" type="button">ADD</button></a>
    <button class='button' type='submit' name='btn' id='btn' form='delete'>MASS DELETE</button>
  <div>
  <hr/>
  <ul class="product_list">
  <form id='delete' method='POST'>
    <?php
    //Display all products that are registered in the database
    foreach($products as $product){
      echo"
      <li class='product'>
        <input class='delete-checkbox' type='checkbox' name='checkbox[]' value='".$product->SKU."'></p>
        <span>".$product->SKU."</span></p>
        <span>".$product->name."</span></p>
        <span class='price'>".$product->price." $</span></p>
    
        <span>".($product->category == 'Book' ? 'Weight: ' . $product->weight . ' KG' : ($product->category == 'DVD' ? 'Size: ' . $product->size . ' MB' :
        ($product->category == 'Furniture' ? 'Dimension: ' . $product->Height .' x '. $product->Widht .' x '. $product->Lenght : '' )))."</span></p>
      </li>";
    }
    ?>
  </form>
  </ul>
  <div class="bottom">
    <hr/>
    <span>Scandiweb Test assingment</span>
  <div>
</body>
</html>
