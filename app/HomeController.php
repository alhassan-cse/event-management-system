<?php

class HomeController extends Connect{
    
    public function multipuleDisplay($sql)
    {
        $stmt = $this->pdo->query($sql);
        return $result = $stmt->fetchAll(); 
    }

    public function singleDisplay($sql, $id)
    {
        $sqls = $sql. " WHERE `id` = " . $id;
        $stmt = $this->pdo->query($sqls);
        return $result = $stmt->fetchAll();
    }
}

?>