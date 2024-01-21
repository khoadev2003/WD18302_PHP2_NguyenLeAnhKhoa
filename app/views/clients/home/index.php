<h1>Test GET POST</h1>
<form action="<?php echo _WEB_ROOT?>/client/product/test_method_get_post" method="post">
    <input name="cate" type="text" placeholder="Name"><br>
    <input name="status" type="text" placeholder="status"><br>
    <button type="submit">Submit</button>
</form>


<h2>Thong báo là:::: <?=old('msg', 'hello mr.nam')?></h2>


