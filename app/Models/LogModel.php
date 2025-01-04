<?php

namespace App\Models;

use CodeIgniter\Model;

class LogModel extends Model
{
    protected $table = 'logs'; // Table name
    protected $primaryKey = 'id'; // Primary key
    protected $allowedFields = ['action', 'item_id', 'user', 'timestamp']; // Editable fields
}

?>