<?php
namespace App;
class helper{
    public static function formatDateForDB($date){
        return date("Y-m-d", strtotime($date));
    }

    public static function formatDate($date){
        return date('d.m.Y', strtotime($date));
    }
}
?>