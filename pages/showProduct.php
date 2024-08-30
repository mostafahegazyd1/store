<div class="show-product-page my-5">
    <h1 class="my-5 text-center fw-bold text-light"><?php echo ucfirst($productData['product_name']); ?></h1>
    <div class="row">
        <div class="col-4">
            <img src="uploads/<?php echo $productData['product_img']; ?>" class="img-fluid rounded p-2 bg-secondary">
        </div>
        <div class="col-8">
            <h2 class="text-center fw-bold shadow-sm text-light"><?= ucfirst($productData['product_name']); ?></h2>
            <h3 class="text-light"><span class="fw-bold h2">Product info: </span><?= $productData['product_info']; ?></h3>
            <h4 class="text-center text-light fw-bold bg-dark p-2 rounded"><i class="bi bi-coin me-1"></i><?= $productData['product_price']; ?></h4>
            
        </div>
    </div>
    <?php
        if ($_SESSION['group_name'] == "admin"){
            echo "<a href='home.php?page=edit&id=". $productData['id']. "' class='btn btn-sm btn-primary me-1 my-2'><i class='bi bi-gear-fill me-1'></i>Edit</a>";
            echo "<a href='home.php?page=delete&id=". $productData['id']. "' class='btn btn-sm btn-danger me-1 my-2'><i class='bi bi-trash-fill me-1'></i>Delete</a>";
        }
    ?>
    <a href="home.php?page=show_items" class="btn btn-sm btn-warning text-dark my-2"><i class="bi bi-arrow-left me-1"></i>Get back to items page</a>
</div>