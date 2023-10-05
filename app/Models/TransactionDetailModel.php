<?php

namespace App\Models;

use Codeigniter\Model;

class TransactionDetailModel extends Model
{
    protected $table = 'transaction_detail';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'document_code',
        'document_number',
        'product_code',
        'price',
        'quantity',
        'unit',
        'sub_total'
    ];
}