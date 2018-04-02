<?php
/**
 * Created by PhpStorm.
 * User: eruyan
 * Date: 2018/4/1
 * Time: 下午5:35
 */

//namespace JYSql;
//
class mysql
{
    var $_servername = "localhost";
    var $_username = "root";
    var $_password = "123456";
    var $_dbname = "dudulvyou";
    var $_tbname = "uuid";
    var $_port = 5333;
    var $conn;
//    连接
    function connect() {
        $this->conn = new mysqli($this->_servername, $this->_username, $this->_password, $this->_dbname,$this->_port);
        if ($this->conn) {
            return true;
        } else {
            echo $this->conn->connect_error;
            return false;
        }
    }

    // MAKR: - 不需要进行调用
    /// 创建数据库
    function create() {
        $sql = "";
        if (mysqli_query($this->conn,$sql)) {
            echo "创建数据库成功";
            return true;
        } else {
            echo "创建数据库失败";
            return false;
        }
    }

//    插入数据 - 新增数据
    function insert($uuid){
        $sql = "INSERT INTO $this->_tbname (uuid, staus) VALUES ($uuid, 0)";
        if (mysqli_query($this->conn, $sql)) {
            echo "提交数据成功";
            return true;
        } else {
            return false;
        }
    }

//    查询数据
    function select($uuid) {
        $sql = "SELECT * FROM $this->_tbname WHERE uuid = $uuid;";
        if ( $result = mysqli_query($this->conn, $sql)) {
            echo "查询数据成功";
            if ( $result->num_rows > 0) {
                while ($row = $result->fetch_row()){
                    echo  $row["id"] + $row["status"] + $row["uuid"];
                }
            }
            return true;
        } else {
            return false;
        }
    }

    function updata($uuid, $status) {
        $sql="UPDATE $this->_tbname SET STATUS = $status WHERE UUID = $uuid;";
        if ( mysqli_query($this->conn, $sql)) {
            echo "数据更新成功";
            return true;
        } else {
            echo "数据更新失败";
            return false;
        }
    }

    function close() {
        if ($this->conn) {
            return treu;
        }
        return mysqli_close($this->conn);
    }
}