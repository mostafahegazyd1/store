<div class="add-product-page">
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>?page=insert_product" method="POST" enctype="multipart/form-data">
        <h1 class="text-center fw-bold my-3 text-light"><i class="bi bi-plus me-1"></i>Add product</h1>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-text-left me-1"></i>Product name</label>
            <input type="text" name="product_name" placeholder="product name...." class="form-control btn-sm">
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-text-left me-1"></i>Product info</label>
            <textarea class="form-control" name="product_info" placeholder="product info..." ></textarea>
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-coin me-1"></i>Price</label>
            <input type="number" name="product_price" placeholder="product price...." class="form-control btn-sm">
        </div>
        <div class="input-group my-2">
            <label class="input-group-text"><i class="bi bi-image-fill me-1"></i>Product image</label>
            <input type="file" name="product_image" class="form-control btn-sm">
        </div>
        <input type="submit" name="addProduct" value="Add product" class="btn btn-warning btn-sm form-control">
    </form>
</div>