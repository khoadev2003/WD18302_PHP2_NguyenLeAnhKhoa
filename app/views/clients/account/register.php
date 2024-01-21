<h1>Đăng ký</h1>
<?php

?>
<form action="<?php echo _WEB_ROOT?>/post" method="post">
    <div>
        <input name="fullname" type="text" placeholder="Họ tên" value="<?php echo !empty($old['fullname'])?$old['fullname']:false?>">
        <span style="color: red"><?php echo !empty($errors['fullname'])?$errors['fullname']:false?></span>
    </div>
    <div>
        <input name="email" type="text" placeholder="email" value="<?php echo !empty($old['email'])?$old['email']:false?>">
        <span style="color: red"><?php echo !empty($errors['email'])?$errors['email']:false?></span>
    </div>
    <input name="password" type="text" placeholder="Mật khẩu">
    <span style="color: red"><?php echo !empty($errors['password'])?$errors['password']:false?></span>

    <input name="confirm_password" type="text" placeholder="Nhậ lại Mật khẩu">
    <span style="color: red"><?php echo !empty($errors['confirm_password'])?$errors['confirm_password']:false?></span>

    <button type="submit">Submit</button>
</form>
