<?php
namespace App\Models;

use CodeIgniter\Model;

class BlogModel extends Model{
    protected $table = 'blog';
    protected $primarykey = 'post_id';
    protected $allowFields = ['post_title', 'post_description'];
}