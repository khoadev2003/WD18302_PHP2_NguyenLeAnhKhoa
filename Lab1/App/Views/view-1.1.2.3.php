
<h1><?= $course_name ?></h1>

<form action="" method="get">
    <select class="form-control" style="width: 300px; height: 30px;" name="block" id="">
        <option value="">Chọn khóa học</option>
        <?php
            foreach ($courses as $key=> $value): 
        ?>
        <option value="<?=$key?>"><?=$value?></option>
        <?php endforeach; ?>
    </select>

    <button class="btn btn-primary" type="submit">Tìm khóa học</button>
</form>


<hr style="margin-top: 50px;">
<h3>Tim kiếm</h3>


<?php 
    if(is_array($user)){
?>
<h3>Họ tên: <?= $user['full_name'] ?></h3>
<h3>Email: <?= $user['email'] ?></h3>
<h3>Phone: <?= $user['phone'] ?></h3>
<?php 
    }elseif(isset($_POST['submit']) && !is_array($user)) {
        echo '<h3>Không tìm thấy</h3>';
    }
?>


<form action="" method="post">
    <input type="text" name="email" placeholder="Nhập email">
    <button type="submit" name="submit">SUBMIT</button>
</form>
