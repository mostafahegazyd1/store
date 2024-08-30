<div class="edit-product my-5">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=update&id=<?php echo $id; ?>" method="POST" enctype="multipart/form-data"> 
        <h2 class="text-center fw-bold text-light my-4"><i class="bi bi-gear-fill me-1"></i><?php echo $productData['product_name']; ?></h2>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-text-left me-1"></i>Product name</label>
            <input type="text" name="product_name" value="<?php echo $productData['product_name'];?>" placeholder="product name...." class="form-control btn-sm">
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-text-left me-1"></i>Product info</label>
            <input type="text" name="product_info" value="<?php echo $productData['product_info']; ?>" placeholder="product info...." class="form-control btn-sm">
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-coin me-1"></i>Product price</label>
            <input type="number" name="product_price" value="<?php echo $productData['product_price']; ?>" placeholder="product price...." class="form-control btn-sm">
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-image-fill me-1"></i>Product image</label>
            <input type="file" name="product_image" class="form-control btn-sm">
        </div>
        <div class="text-center">
            <img src="uploads/<?php echo $productData['product_img']; ?>" class="img-fluid text-center" width="300px">
        </div>
        <input type="submit" name="update" value="Update" class="btn btn-primary btn-sm w-100 mt-2">
    </form>
</div>