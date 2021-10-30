<?php
class routine
{
    public $base_url = '';
    public $connect;
    public $query;
    public $statement;
    public $pdo;
    function rms()
    {
        $this->connect = new PDO("mysql:host=localhost;dbname=routine", "root", "");
        session_start();
    }
    function execute($data = null)
    {
        $this->statement = $this->connect->prepare($this->query);
        if ($data) {
            $this->statement->execute($data);
        } else {
            $this->statement->execute();
        }
    }
    function getDBResult($params = array())
    {
        $sql_statement = $this->connect->prepare($this->query);
        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
        $result = $sql_statement->get_result();

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $resultset[] = $row;
            }
        }

        if (!empty($resultset)) {
            return $resultset;
        }
    }
    function updateDB($params = array())
    {
        $sql_statement = $this->conn->prepare($this->query);
        if (!empty($params)) {
            $this->bindParams($sql_statement, $params);
        }
        $sql_statement->execute();
    }

    function bindParams($params)
    {
        $param_type = "";
        foreach ($params as $query_param) {
            $param_type .= $query_param["param_type"];
        }

        $bind_params[] = &$param_type;
        foreach ($params as $k => $query_param) {
            $bind_params[] = &$params[$k]["param_value"];
        }

        call_user_func_array(array(
            $this->statement,
            'bind_param'
        ), $bind_params);
    }

    function row_count()
    {
        return $this->statement->rowCount();
    }
    function statement_result()
    {
        return $this->statement->fetchAll();
    }
    function get_result()
    {

        return $this->connect->query($this->query, PDO::FETCH_ASSOC);
    }
    function is_login()
    {
        if (isset($_SESSION['user_id'])) {
            return true;
        }
        return false;
    }
    function is_admin()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION["user_type"] == 'Master') {
                return true;
            }
            return false;
        }
        return false;
    }
    function is_teacher()
    {
        if (isset($_SESSION['user_type'])) {
            if ($_SESSION["user_type"] == 'Waiter') {
                return true;
            }
            return false;
        }
        return false;
    }
    function freeAllotment()
    {
    }
    function onLeave()
    {
    }
}
