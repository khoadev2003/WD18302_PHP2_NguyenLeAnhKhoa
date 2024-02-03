<h1>Danh sách sp</h1>

<?php


?>



<div class="container">
    <div class="row">
        <?php
        foreach ($list_product as $value) {
            extract($value);

        ?>
        <div class="col-4">
            <div class="card" style="width: 100%;">
                <a href=""><?=$image?></a>
                <img class="card-img-top" src="..." alt="Card image cap">
                <div class="card-body">
                    <h5 class="card-title"><?=$name?></h5>
                    <p class="card-text"></p>
                    <a href="<?=_WEB_ROOT?>/chi-tiet-san-pham/<?=$product_id?>" class="btn btn-primary">Chi tiết</a>
                </div>
            </div>
        </div>
        <?php

        }
        ?>
    </div>

</div>



