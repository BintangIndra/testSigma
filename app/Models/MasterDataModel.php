<?php

namespace App\Models;

use CodeIgniter\Model;

class MasterDataModel extends Model
{
    protected $table = 'master_data';
    protected $primaryKey = 'id';
    protected $allowedFields = ['namaBarang', 'harga'];

}
