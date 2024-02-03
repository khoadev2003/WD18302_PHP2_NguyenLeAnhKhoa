
<?php
    echo '<pre>';
    echo $title;
    echo $action;
    if(is_array($one_product) > 0) {
        extract($one_product);
        echo '<h2>'.$name.'</h2>';
        echo '<span>ID danh mục: </span>'.$id_category;
    }else {
        echo '<h2>Sản phẩm không tồn tại</h2>';
    }

?>



