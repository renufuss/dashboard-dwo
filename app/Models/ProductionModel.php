<?php

namespace App\Models;

use CodeIgniter\Model;

class ProductionModel extends Model
{
    protected $table      = 'factproduction';


    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['productID', 'timeID', 'totalQty'];

    protected $useTimestamps = false;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    function showProductTotalQTY()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('name, sum(totalQty) as totalQTY')
            ->join('dimproduct', 'factproduction.productID=dimproduct.productID', 'inner')
            ->groupBy('factproduction.productID')
            ->orderBy('totalQTY', 'DESC')
            ->limit(5);

        $data = $query->get()->getResultObject();
        return $data;
    }

    function showTotalQTY()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('sum(totalQty) as totalQTY');
        $data = $query->get()->getFirstRow();
        return $data;
    }

    function showDay()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('distinct(day) as day')
            ->join('dimtime', 'factproduction.timeID=dimtime.timeID', 'inner')
            ->orderBy('day', 'ASC');

        return $query->get()->getResultObject();
    }

    function showDayProduction($day)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('day, name, totalQTY')
            ->join('dimproduct', 'factproduction.productID=dimproduct.productID', 'inner')
            ->join('dimtime', 'factproduction.timeID=dimtime.timeID', 'inner')
            ->where('day', $day)
            ->groupBy('name');

        return $query->get()->getResultObject();
    }

    function showDayQTY()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('day, sum(totalQTY) as totalQTY')
            ->join('dimtime', 'factproduction.timeID=dimtime.timeID', 'inner')
            ->groupBy('day')
            ->orderBy('totalQTY', 'DESC');

        return $query->get()->getResultObject();
    }

    function showProduct()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('distinct(name) as name')
            ->join('dimproduct', 'factproduction.productID=dimproduct.productID', 'inner')
            ->orderBy('name', 'ASC')
            ->groupBy('factproduction.productID');

        return $query->get()->getResultObject();
    }

    function showProductDay($name)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('day, sum(totalQty) as totalQty')
            ->join('dimproduct', 'factproduction.productID=dimproduct.productID', 'inner')
            ->join('dimtime', 'factproduction.timeID=dimtime.timeID', 'inner')
            ->where('name', $name)
            ->orderBy('day', 'ASC')
            ->groupBy('factproduction.productID');

        return $query->get()->getResultObject();
    }
}
