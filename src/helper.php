<?php
namespace App;
class helper{
    public static function formatDateForDB($date){
        return date("Y-m-d H:i:s", strtotime($date));
    }

    public static function formatDate($date){
        return date('H:i:s d.m.Y', strtotime($date));
    }

    public static function checkOverdue($value): int{
        if($value === 0){
            return False;
        }
        return True;
    }

}
?>