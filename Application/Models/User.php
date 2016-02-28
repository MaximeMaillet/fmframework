<?php


namespace Application\Models;
use System\Core\Model;

/**
 * Created by PhpStorm.
 * User: maxime
 * Date: 26/02/2016
 * Time: 14:32
 */
class User extends Model
{
    public function __construct()
    {
        parent::__construct('member');
    }

    public function isi() {
        $this->DB()->query('SELECT * FROM fmdatabase')->setFetchMode(\PDO::FETCH_ASSOC);
        $result = $this->DB()->result();
        return $result[0];
    }
}