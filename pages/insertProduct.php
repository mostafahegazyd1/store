<?php
// check if user is coming from post request
if ($_SERVER['REQUEST_METHOD'] === "POST"){
    $insertErrors = array();
    $values = [
        "product_name" => $_POST['product_name'],
        "product_info" => $_POST['product_info'],
        "product_price" => $_POST['product_price'],
        "image" => $_FILES['product_image'],
    ];
    $rules = [
        "product_name" => [
            "required" => '',
            "min" => 5,
            "max" => 40,
        ],
        "product_info" => [
            "required" => '',
            "min" => 10,
            "max" => 250,
        ],
        "product_price" => [
            "required" => '',
            "number" => '',
        ],
        "image" => [
            "upload" => '',
            "extension" => '',
            "size" => 3,
        ],
    ];
    $productData = Validation::validate($values, $rules);
    if (isset($productData['errors'])){
        $errorsValidation = $productData['errors'];
    }
    else{
        if (empty($errorsValidation)){
            $validationValues = $productData['data'];
            $productNameUnique = Validation::validateUnique($connection , "products" , "WHERE product_name = ?" , [$validationValues['product_name']] );
            if ($productNameUnique):
                $insertErrors[] = "The product name already exists";
            endif;
            if (empty($insertErrors)){
                $array = explode("." , $validationValues['image']['name']);
                $extension = strtolower(end($array));
                $imageName = rand(0,999999999999999999) . "." . $extension;
                $targetFile = "uploads/" . $imageName;
                $uploadStatus = $products->moveUploadedFile($validationValues['image']['tmp_name'] , $targetFile);
                if ($uploadStatus){
                    $data = ["product_name" , "product_info" , "product_price" , "product_img"];
                    $values = [$validationValues['product_name'] , $validationValues['product_info'] , $validationValues['product_price'] , $imageName];
                    $productInsertStatus = $products->insertData($connection , "products" , $data , $values);
                    if ($productInsertStatus){
                        echo "<div class='alert alert-success my-5'>Product added successfully</div>";
                    }
                }
                else{
                    echo "<div class='alert alert-danger my-5'>Something happened while uploading the file, please try again later</div>";
                }
            }
        }
        else{
            foreach($errorsValidation as $error){
                echo "<div class='alert alert-danger my-3'>".$error."</div>";
            }
        }
    }
    if (!empty($insertErrors)){
        foreach($insertErrors as $error){
            echo "<div class='alert alert-danger my-3'>".$error."</div>";
        }
    }
}
?>