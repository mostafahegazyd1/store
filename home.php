<?php
ob_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
$navbar = "";
include 'ini.php';
$session::startSession();
if (!$session::checkSession()){
    header("Location:index.php");
    exit();
}
include $classes . 'products.php';
$products = new Products();
?>
<div class="container">
    <?php
        // check if page request is set
        if(isset($_GET['page'])){
            // if page request is set, store the value
            $page = htmlspecialchars($_GET['page']);
            ###########################################################
            // if page request valie is show_items => show items page
            ###########################################################
            if ($page == "show_items"){
                // fetch all products data
                $productsData = $products -> getData($connection , "*" , "products" , "" , NULL , "fetchAll" , ""); // query to fetch all products data
                if ($productsData){ // if the result
                    // check if the productData array not empty
                    if (!empty($productsData) > 0){
                        // include show items page with product data
                        include $pages . "showItems.php";
                    }
                    else{
                        // if the productData array is empty, show this message
                        echo "<div class='alert alert-warning my-5'>No products exist</div>";
                    }
                }
                // if no products exist, show this alert
                else{
                    echo "<div class='alert alert-warning my-5'>No products exist</div>";
                }
                ?>
                    <!-- Add new product button -->
                    <a href="home.php?page=add" class="btn btn-sm btn-danger"><i class='bi bi-plus me-1'></i>Add new product</a>
                    <!-- end of add new product button -->
                <?php
            }
            ########################################################################
            // if page rqeuset value is add, show add product page
            ########################################################################
            else if ($page == "add"){
                // check if user is admin or not 
                if ($_SESSION['group_name'] == 'admin'){
                    // if user is an admin, show add product page
                    include $pages . "addProduct.php";
                }
                // if user not an admin redirect him show products page
                else{
                    header("Location:home.php?page=show_items");
                    exit();
                }
            }
            ########################################################################
            // if page request value is insert_product, insert the new product data
            ########################################################################
            else if ($page == "insert_product"){
                // check if user is admin or not 
                if ($_SESSION['group_name'] == "admin"){
                    include $pages . 'insertProduct.php';
                }
                else{
                    header("Location:home.php?page=show_items");
                    exit();
                }
            }
            ###########################################################
            // if page request value is edit, show edit item page
            ###########################################################
            else if ($page == "edit"){
                // check if user is admin
                if ($_SESSION['group_name'] == 'admin'){
                    // check if id is set in the request
                    if (isset($_GET['id'])){
                        // convert id to integer and store it in a variable
                        $id = intval($_GET['id']);
                        $productData = $products -> getData($connection, "*" , "products" , "WHERE id = ?" , [$id] , "fetch" , "");
                        if ($productData){
                            include $pages . "editItem.php";
                        }
                        else{
                            echo "<div class='alert alert-warning my-5'>Product not found</div>";
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
            }
            ###########################################################
            // if page request value is update => update the product
            ###########################################################
            else if ($page == "update"){
                include $pages . "update.php";
            }
            ###########################################################
            // if page request value is show => show product data
            ###########################################################
            else if ($page == "show"){
                // check if id is set in the request
                if (isset($_GET['id'])){
                    // convert id to integer and store it in a variable
                    $id = intval($_GET['id']);
                    $productData = $products -> getData($connection, "*" , "products" , "WHERE id =?" , [$id] , "fetch" , "");
                    if ($productData){
                        include $pages. "showProduct.php";
                    }
                    else{
                        echo "<div class='alert alert-warning my-5'>Product not found</div>";
                    }
                }
            }
            ###########################################################
            // if page request value is delete => delete the product
            ###########################################################
            else if ($page == "delete"){
                // include deleteItem page
                include $pages . "deleteItem.php";
            }
            ########################################################################
            // if page request value not handled, redirect user to show items page 
            ########################################################################
            else {
                header("Location: home.php?page=show_items"); // redirect user to show items page
                exit();
            }
        }
        
    ?>
</div>
<?php include $template . 'footer.php'; ob_end_flush(); ?>