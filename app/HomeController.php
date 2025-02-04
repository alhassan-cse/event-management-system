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
    
    function RemoveSpecialChar($str)
    {
        $cleaned = preg_replace('/[^A-Za-z0-9 ]/', '', $str);
        // Step 2: Replace multiple spaces with a single space
        $cleaned = preg_replace('/\s+/', ' ', $cleaned);
        // Step 3: Trim leading and trailing spaces
        $cleaned = trim($cleaned);
        return $cleaned;
    }
}

?>