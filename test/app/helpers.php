<?php

require_once("connection.php");

function redirect($page)
{
    ob_start();
    header("location:".$page);
    exit;
    
    
}

function excute($sql)
{
    global $con;
   return mysqli_query($con , $sql);
}

function findData($sql)
{
    $query = excute($sql);
    return $result = mysqli_fetch_assoc($query);
}

function allData($sql)
{
    $result = excute($sql);
    $alldata=[];

    while($row = mysqli_fetch_assoc($result) )
    {
        $alldata[] = $row;
    }
    return $alldata;
}



function countData($sql)
{
    
   $result =  excute($sql);
  return $caunter = mysqli_num_rows($result);
   
}

