<?php

namespace App\Models;

use CodeIgniter\Model;

class TransactionHeaderModel extends Model
{
    protected $table = 'transaction_header';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'user_id',
        'document_code',
        'document_number',
        'total',
        'date',
    ];

}