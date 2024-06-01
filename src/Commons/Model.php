<?php 

namespace Ngogi\Xuongphp\Commons;

class Model 
{
    protected $conn;
    public function __construct(){
        //Thực hiện kết nối tự động khi kởi tạo bất kì 
        // class nào liên quan đến model 
    }

    public function __destruct(){
        $this->conn = null;
    } 
}