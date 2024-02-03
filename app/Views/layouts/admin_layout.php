<?php
$this->render('blocks/admin/head');
$this->render('blocks/admin/topbar');
$this->render('blocks/admin/sidebar');


$this->render($main, $content);


$this->render('blocks/admin/scripts');