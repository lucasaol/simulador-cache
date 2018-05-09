<?php

/**
 * Description of Model
 *
 * @author lucas
 */
class Model {

    protected $conn;
    private $dbHost = DB_HOST,
            $dbUser = DB_USER,
            $dbPass = DB_PASS,
            $dbName = DB_NAME;

    public function __construct() {
        //$this->Connect();
    }

    private function Connect() {
        try {
            $this->conn = mysqli_connect($this->dbHost, $this->dbUser, $this->dbPass, $this->dbName);
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage());
            }
            return false;
        }
    }

    public function Select($sql) {
        try {
            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                $array = $query->fetch_all(MYSQLI_ASSOC);
                return $array;
            }
            return null;
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

    public function Insert($obj, $table, $sufix) {
        try {
            foreach ($obj as $ind => $val) {
                $campos[] = '`' . $ind . '_' . $sufix . '`';
            }
            $sql = 'INSERT INTO ' . $table . ' (' . implode(', ', $campos) . ') VALUES ("' . implode('", "', array_values((array) $obj)) . '")';

            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                return array('success' => true, 'feedback' => 'Inserido com Sucesso', 'codigo' => $this->Last($table, $sufix));
            }
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

    public function Update($obj, $condition, $table, $sufix) {
        try {
            foreach ($obj as $ind => $val) {
                $dados[] = '`' . $ind . '_' . $sufix . '` = ' . (is_null($val) ? ' NULL ' : ' "' . $val . '" ');
            }
            foreach ($condition as $ind => $val) {
                $where[] = '`' . $ind . '_' . $sufix . '` ' . (is_null($val) ? ' IS NULL ' : ' =  "' . $val . '" ');
            }
            $sql = 'UPDATE ' . $table . ' SET ' . implode(',  ', $dados) . ' WHERE ' . implode(' AND ', $where);

            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                return array('success' => true, 'feedback' => 'Alterado com Sucesso');
            }
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

    public function Delete($table, $sufix, $condition) {
        try {
            foreach ($condition as $ind => $val) {
                $where[] = '`' . $ind . '_' . $sufix . '` ' . (is_null($val) ? ' IS NULL ' : ' = ' . $val . ' ');
            }
            $sql = 'DELETE FROM ' . $table . ' WHERE ' . implode(' AND ', $where);
            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                return array('success' => true, 'feedback' => 'Excluido com Sucesso');
            }
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

    public function Last($table, $sufix) {
        try {
            $sql = 'SELECT * FROM ' . $table . ' ORDER BY id_' . $sufix . ' DESC LIMIT 1';
            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                $array = $query->fetch_all(MYSQLI_ASSOC);
                return $array[0];
            }
            return null;
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

    public function First($obj) {
        if (isset($obj[0])) {
            return $obj[0];
        } else {
            return null;
        }
    }

    public function execQuery($sql) {
        try {
            $query = mysqli_query($this->conn, $sql);
            if ($query) {
                return array('success' => true, 'feedback' => 'Execução Completa');
            }
            return null;
        } catch (\mysqli_sql_exception $ex) {
            if (AMBIENTE == 'development') {
                die($ex->getMessage() . ' ' . $sql);
            }
            return false;
        }
    }

}
