<?php
namespace App\Models;

use CodeIgniter\Model;

class Users_model extends Model{
    protected $table      = 'tblusers';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $allowedFields = [
        'username',
        'password',
        'email',
        'fullname',
        'datecreated',
        'activationcode',
        'active',
        'role',
        'reset_code',
        'reset_expiry',
    ];
}
?>