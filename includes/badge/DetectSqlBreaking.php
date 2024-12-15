<?php


class DetectSqlBreaking {

     private static $operators = [
        'select * ',
        'select ',
        'union all ',
        'union ',
        ' all ',
        ' where ',
        ' and 1 ',
        ' and ',
        ' or ',
        ' 1=1 ',
        ' 2=2 ',
        ' -- ',
     ];


    public function detectSqlInjection(string $param, string $valueExpected): bool
    {
        foreach (self::$operators as $operator) {
            if (stripos($param, $operator) !== false) {
                return true;
            }
        }
        return false;
    }

    public function detectNotExpectedSqlTransaction(int $expectedRow, int $rowsInTransaction) : bool {

        return $expectedRow == $rowsInTransaction;
    }
}