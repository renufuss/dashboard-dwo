<?php

namespace App\Models;

use CodeIgniter\Model;

class SalesModel extends Model
{
    protected $table      = 'factsales';

    protected $useAutoIncrement = true;

    protected $returnType     = 'object';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['productID', 'addressID', 'timeID', 'salesPersonID', 'orderQty', 'unitPrice', 'lineTotal'];

    protected $useTimestamps = false;
    protected $createdField  = null;
    protected $updatedField  = null;
    protected $deletedField  = null;

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;


    public function totalTransaction()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('*');
        $data = $query->countAll();
        return $data;
    }

    public function showTopTransactionCountry()
    {
        $query = 'SELECT country, COUNT(*) as sales
        FROM factsales
        INNER JOIN dimaddress ON factsales.addressID = dimaddress.addressID 
        GROUP BY country order by sales DESC limit 5';
        $query = $this->db->query($query);

        return $query->getResultObject();
    }

    public function showCountry()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('distinct(country)')
            ->join('dimaddress', 'factsales.addressID=dimaddress.addressID', 'inner')
            ->orderBy('country', 'asc');

        return $query->get()->getResultObject();
    }

    public function showTransactionCity($country)
    {

        $table = $this->db->table($this->table);
        $query = $table->select('country, city, count(*) as sales')
            ->join('dimaddress', 'factsales.addressID=dimaddress.addressID', 'inner')
            ->where('country', $country)
            ->groupBy('city')
            ->orderBy('sales', 'desc');

        return $query->get()->getResultObject();
    }

    public function totalTransactionCity($country)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('country, count(*) as sales')
            ->join('dimaddress', 'factsales.addressID=dimaddress.addressID', 'inner')
            ->where('country', $country)
            ->groupBy('country')
            ->orderBy('sales', 'desc');

        return $query->get()->getFirstRow();
    }

    public function totalSales()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('sum(orderQty) as totalSales')
            ->join('dimproduct', 'factsales.productID=dimproduct.productID', 'inner');

        return $query->get()->getFirstRow();
    }

    public function totalSalesProduct()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('name, sum(orderQty) as sales')
            ->join('dimproduct', 'factsales.productID=dimproduct.productID', 'inner')
            ->groupBy('name')
            ->orderBy('sales', 'desc')->limit(5);

        return $query->get()->getResultObject();
    }

    public function showProduct()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('distinct(name)')
            ->join('dimproduct', 'factsales.productID=dimproduct.productID', 'inner')
            ->orderBy('name', 'asc');

        return $query->get()->getResultObject();
    }

    public function countrySalesProduct($country)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('name, country, sum(orderQty) as sales')
            ->join('dimproduct', 'factsales.productID=dimproduct.productID', 'inner')
            ->join('dimaddress', 'factsales.addressID=dimaddress.addressID', 'inner')
            ->groupBy('country, name')
            ->where('country', $country)
            ->orderBy('name', 'asc');

        return $query->get()->getResultObject();
    }

    public function showLineTotal()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('sum(lineTotal) as lineTotal');

        return $query->get()->getFirstRow();
    }

    public function showLineTotalDay()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('day, sum(lineTotal) as lineTotal')
            ->join('dimtime', 'factsales.timeID=dimtime.timeID', 'inner')
            ->groupBy('day')
            ->orderBy('lineTotal', 'desc');

        return $query->get()->getResultObject();
    }

    public function showDay()
    {
        $table = $this->db->table($this->table);
        $query = $table->select('distinct(day) as day')
            ->join('dimtime', 'factsales.timeID=dimtime.timeID', 'inner');

        return $query->get()->getResultObject();
    }

    public function daySalesProduct($day)
    {
        $table = $this->db->table($this->table);
        $query = $table->select('day, name, sum(orderQTY) as sales')
            ->join('dimtime', 'factsales.timeID=dimtime.timeID', 'inner')
            ->join('dimproduct', 'factsales.productID=dimproduct.productID', 'inner')
            ->groupBy('day, name')
            ->where('day', $day)
            ->orderBy('name', 'asc');

        return $query->get()->getResultObject();
    }
}
