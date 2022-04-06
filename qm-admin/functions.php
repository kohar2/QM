<?php

function search($table, $field, $value) {
    $sql = "SELECT * FROM $table WHERE $field = '$value'";
    $result = mysqli_query($sql);
    return $result;

}