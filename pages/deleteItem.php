<?php
if (isset($_GET['id'])){
    if ($_SESSION['group_name'] == "admin"){
        $id = htmlspecialchars(($_GET['id']));
        $deleteStatus = $products -> deleteData($connection , "products" , "id = ?" , $id);
        if ($deleteStatus){
            echo "<div class='alert alert-success my-5'>Product deleted successfully</div>";
        }
        else{
            echo "<div class='alert alert-warning my-5'>Failed to delete product</div>";
        }
    }
    else {
        header("Location: home.php?page=show_items");
        exit();
    }
}
else{
    header("Location: home.php?page=show_items");
    exit();
}
?>