<div class="show-items-page my-5">
    <h1 class="text-center my-5 fw-bold text-light">Products page</h1>
    <div class="row">
    <?php
        foreach($productsData as $data){
            ?>
            
                <div class="col-3">
                    <div class="card bg-dark p-2" style="width: 18rem;">
                        <img src="uploads/<?php echo $data['product_img']; ?>" class="card-img-top img-fluid bg-secondary rounded p-1" alt="...">
                        <div class="card-body">
                            <h5 class="card-title text-light"><?php echo $data['product_name']; ?></h5>
                            <p class="card-text text-light"><i class="bi bi-text-left me-1"></i><span class="fw-bold">Product info: </span><?php echo $data['product_info']; ?></p>
                            <p class="card-text text-light"><i class="bi bi-coin me-1"></i><?php echo $data['product_price']; ?></p>
                            <?php
                                if ($_SESSION['group_name'] == "admin"){
                                    ?>
                                    <div class="text-center">
                                        <a href="home.php?page=edit&id=<?php echo $data['id']; ?>" class="rounded p-2 bg-primary text-light" style="text-decoration: none;padding-right:10px !important;"><i class="bi bi-gear-fill me-1"></i>Edit</a>
                                        <a href="home.php?page=delete&id=<?php echo $data['id']; ?>" class="rounded p-2 bg-danger text-light" style="text-decoration: none;padding-right:10px !important;"><i class="bi bi-trash-fill me-1"></i>Delete</a>
                                        <a href="home.php?page=show&id=<?php echo $data['id']; ?>" class="rounded p-2 bg-warning text-dark" style="text-decoration: none;padding-right:10px !important;"><i class="bi bi-eye-fill me-1"></i>View</a>
                                    </div>
                                    <?php
                                }
                                else{
                                    ?>
                                    <a href="home.php?page=show&id=<?= $data['id']; ?>" class="p-2 bg-warning text-dark form-control text-center" style="text-decoration: none;padding-right:10px !important;"><i class="bi bi-eye-fill me-1"></i>View</a>
                                    <?php
                                }
                            ?>
                        </div>
                    </div>
                </div>
           
            <?php
        }
    ?>
     </div>
</div>