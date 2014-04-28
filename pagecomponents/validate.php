<?php
class validate{
    public function post(){
        $result = array();
        foreach($_POST as $key=>$value){
            $new_value = str_replace("'", "", $value);
            $result[$key] = $new_value;
        } 
        return $result;        
    }
    public function get(){
        $result = array();
        foreach($_GET as $key=>$value){
            $new_value = str_replace("'", "", $value);
            $result[$key] = $new_value;
        } 
        return $result;        
    }
}
?>