<?php
include_once('./PHP/classes/DVD.php');
include_once('./PHP/classes/Furniture.php'); 
include_once('./PHP/classes/Book.php');
$obj = [];

// Creating Objects and Inserting Them into the Database


if (isset($_POST['btn'])){
    $obj['sku'] = $_POST['sku'] ?? NULL;
    $obj['name'] = $_POST['name'] ?? NULL;
    $obj['price'] = $_POST['price'] ?? NULL;
    $obj['category'] = $_POST['productType'] ?? NULL;

    if(($obj['category'])=="Book" && $_POST['weight'] != Null){
        $num =2;
        $obj['weight'] = $_POST['weight'] ?? NULL;
        $book = new Book($obj['name'],$obj['price'],$obj['sku'],$obj['category'],$obj['weight']);
        $book->insert();
    }

    elseif(($obj['category'])=="DVD" && $_POST['size'] != Null){
        $num =3;
        $obj['size'] = $_POST['size'] ?? NULL;
        $dvd = new DVD($obj['name'],$obj['price'],$obj['sku'],$obj['category'],$obj['size']);
        $dvd->insert();
    }

    elseif(($obj['category'])=="Furniture" && $_POST['height'] != Null && $_POST['length'] != Null && $_POST['width'] != Null){
        $num =4;
        $obj['width'] = $_POST['width'] ?? NULL;
        $obj['length'] = $_POST['length'] ?? NULL;
        $obj['height'] = $_POST['height'] ?? NULL;
        $furniture= new Furniture($obj['name'],$obj['price'],$obj['sku'],$obj['category'],$obj['width'],$obj['length'],$obj['height']);
        $furniture->insert();
    }
    
    else{echo "All fields must be filled";}
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
    <button class="button1" type="submit" id="submit" name="btn" form='product_form'>Save</button>
    <a href = "index.php"><button class="button" type="submit" >Cancel</button></a>
  <div>
  <hr/>
    <form class = "objects" id="product_form" method="POST">
        <div>
            <label for="sku">SKU:</label>
            <input class = "input" type="text" id="sku" name="sku"><br>
            </p>
            <label for="name">Name:</label>
            <input class = "input" type="text" id="name" name="name"><br>
            </p>
            <label for="price">Price ($):</label>
            <input class = "input" type="number" step="0.010" id="price" name="price"><br>
            </p></p><br>
        </div>
        <label for="productType">Product type:</label>
        <select class = "selectbox" id="productType" name="productType">
            <option value="DVD" id="DVD">DVD</option>
            <option value="Furniture" id="Furniture">Furniture</option>
            <option value="Book" value="Book">Book</option>
        </select></p><br>

        <div id="productTypeSpecificAttributes">
            <div id="DVDAttributes" class="productAttributes">
                <label for="size">Size (MB):</label>
                <input class = "selectinput" type="number" step="0.010" id="size" name="size"><br></p>
                <p><div class = "description">A DVD is a digital optical disc that can store various types of data, such as movies, music, software, and more.</div>
            </div>

            <div id="BookAttributes" class="productAttributes">
                <label for="weight">Weight (Kg):</label>
                <input class = "selectinput" type="number" step="0.010" id="weight" name="weight"><br></p>
                <p><div class = "description">A book is a written or printed work that can contain a story, information, or other literary or artistic content.</div>
            </div>

            <div id="FurnitureAttributes" class="productAttributes">
                <label for="height">Height (CM):</label>
                <input class = "selectinput" type="number" step="0.010" id="height" name="height"><br></p>
                

                <label for="width">Width (CM):</label>
                <input class = "selectinput" type="number" step="0.010" id="width" name="width"><br></p>
                

                <label for="length">Length (CM):</label>
                <input class = "selectinput" type="number" step="0.010" id="length" name="length"><br></p>
                <p><div class = "description">Furniture refers to movable objects that are designed to support various human activities, such as seating, sleeping, and storage.</div>
                
            </div>
            <br></p>
            
        </div>
    </form>
    <script>
        const productTypeSelect = document.querySelector('#productType');
        const productTypeAttributes = document.querySelectorAll('.productAttributes');
    
        productTypeAttributes.forEach(attr => {
            attr.style.display = 'none';
        });
        
        productTypeAttributes[0].style.display = 'block';
        
        productTypeSelect.addEventListener('change', () => {
            const selectedProductType = productTypeSelect.value;
    
            productTypeAttributes.forEach(attr => {
            if (attr.id === `${selectedProductType}Attributes`) {
                attr.style.display = 'block';
            } else {
                attr.style.display = 'none';
            }
            });
        });
    </script>
    <div class="bottom">
    <hr/>
    <span>Scandiweb Test assingment</span>
    </div>
</body>

</html>
