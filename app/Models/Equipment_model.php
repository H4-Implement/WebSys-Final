<?php

namespace App\Models;

use CodeIgniter\Model;

class Equipment_Model extends Model
{
    protected $table = 'item'; // Name of the table
    protected $primaryKey = 'UNIQUEID'; // Primary key of the table

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'ID',
        'NAME', 
        'CATEGORY', 
        'STATUS', 
        'RESERVEDBY',
        'RESERVE_STATUS', 
        'DATE_RESERVED', 
        'DATE_BORROWED', 
        'DATE_RETURNED',
        'USEDBY',
        'IMAGE',
        'DATE_RESERVED_END',
        'UNIQUEID',
    ]; 

}

?>