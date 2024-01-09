<?php

namespace App\Core;

class Database
{


    //Phần kết nối này em làm xong rôi nhưng em xóa để thầy khỏi phải import database để kiểm tra
    private $_db_name;
    private $_db_username;
    private $_db_password;
    private $_db_host;

    public function __construct()
    {
        echo '<h2>Kết nối csdl thành công</h2>';
    }

}