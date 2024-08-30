<?php
// check if user is admin
if ($_SESSION['group_name'] == 'admin'){
    if (isset($_GET['id'])){
        $id = htmlspecialchars($_GET['id']);
        if ($_SERVER['REQUEST_METHOD'] === "POST"){
            // fetch data of the product
            $getProductData = $products->getData($connection , "*" , "products" , "WHERE id = ?" , [$id] , "fetch" , "");
            $values = [
                "product_name" => $_POST['product_name'],
                "product_info" => $_POST['product_info'],
                "product_price" => $_POST['product_price'],
                "image" => !empty($_FILES['product_image']) ? $_FILES['product_image'] : $getProductData['product_img'],
            ];
            $rules = [
                "product_name" => [
                    'required' => true,
                    'min' => 5,
                    'max' => 100,
                ],
                "product_info" => [
                    "required" => true,
                    "min" => 10,
                    "max" => 250,
                ],
                "product_price" => [
                    "required" => true,
                    "number" => '',
                ],
            ];
            $validationValues = Validation::validate($values , $rules);

            if (isset($validationValues['data'])){
                if (isset($validationValues['data'])){
                    $validationValues = $validationValues['data'];
                    // Handle image upload and validation
                    if (!empty($values['image'])) {
                        // Add image validation rules
                        $imageRules = [
                            "upload" => '',
                            "extension" => '',
                            "size" => 3,
                        ];
                        $imageValidation = Validation::validate(['image' => $values['image']], ['image' => $imageRules]);
                        if (isset($imageValidation['data'])){
                            $imageData = $imageValidation['data']['image'];
                            $array = explode(".", $imageData['name']);
                            $extension = strtolower(end($array));
                            $imageName = rand(0,999999999999999999) . "." . $extension;
                            $targetFile = "uploads/" . $imageName;
                            $finalImageName = $imageName;
                            $image_tmp_name = $imageData['tmp_name'];
                            $uploadStatus = $products->moveUploadedFile($image_tmp_name, $targetFile);
                            if ($uploadStatus){
                                $finalImageName = $imageName;
                                $data = [
                                    "product_name" => $validationValues['product_name'],
                                    "product_info" => $validationValues['product_info'],
                                    "product_price" => $validationValues['product_price'],
                                    "product_img" => $finalImageName,
                                ];
                                $updateData = $products->updateData($connection , "products" , $data , "id = ?" , $id);
                                if ($updateData){
                                    echo "<div class='alert alert-success my-5'>Product updated successfully</div>";
                                }
                                else{
                                    echo "<div class='alert alert-warning my-5'>Failed to update product</div>";
                                }
                            }
                        } else {
                            $finalImageName = $getProductData['product_img'];
                            $data = [
                                "product_name" => $validationValues['product_name'],
                                "product_info" => $validationValues['product_info'],
                                "product_price" => $validationValues['product_price'],
                                "product_img" => $finalImageName,
                            ];
                            $updateData = $products->updateData($connection , "products" , $data , "id = ?" , $id);
                                if ($updateData){
                                    echo "<div class='alert alert-success my-5'>Product updated successfully</div>";
                                }
                                else{
                                    echo "<div class='alert alert-warning my-5'>Failed to update product</div>";
                            }
                        }
                    } 
                    else {
                        $finalImageName = $getProductData['product_img'];
                        $data = [
                            "product_name" => $validationValues['product_name'],
                            "product_info" => $validationValues['product_info'],
                            "product_price" => $validationValues['product_price'],
                            "product_img" => $finalImageName,
                        ];
                        $updateData = $products->updateData($connection , "products" , $data , "id = ?" , $id);
                            if ($updateData){
                                echo "<div class='alert alert-success my-5'>Product updated successfully</div>";
                            }
                            else{
                                echo "<div class='alert alert-warning my-5'>Failed to update product</div>";
                        }
                    }
                }
                if (isset($validationValues['errors'])){
                    foreach($validationValues['errors'] as $error){
                        echo "<div class='alert alert-danger my-5'>".$error."</div>";
                    }
                }
            }
            if (isset($validationValues['errors'])){
                foreach($validationValues['errors'] as $error){
                    echo "<div class='alert alert-danger my-5'>".$error."</div>";
                }
            }
        }
        // if user is not coming from post request, redirect him to show items page
        else{
            header("Location:home.php?page=show_items");
            exit();
        }
    }
    else {
        header("Location:home.php?page=show_items");
        exit();
    }
}
// if user not an admin redirect home to show items page
else{
    header("Location:home.php?page=show_items");
    exit();
}
?>