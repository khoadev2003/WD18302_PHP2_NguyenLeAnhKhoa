<?php

class ProductModel
{
    public function getListProducts() {
        $list = [
            'SP 1',
            'SP 2',
            'SP 3'

        ];

        return $list;
    }

    public function getDetail($id) {
        $list = [
            'SP 1',
            'SP 2',
            'SP 3',
            'SP 1',


        ];

        return $list[$id];
    }
}