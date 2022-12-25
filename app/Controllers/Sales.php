<?php

namespace App\Controllers;

use App\Models\SalesModel;

class Sales extends BaseController
{
    protected $SalesModel;

    public function __construct()
    {
        $this->SalesModel = new SalesModel();
    }


    public function address()
    {
        $topSalesCountry = $this->SalesModel->showTopTransactionCountry();
        $country = [];
        $totalSalesCountry = [];

        foreach ($topSalesCountry as $row) {
            array_push($country, $row->country);
            array_push($totalSalesCountry, $row->sales);
        }

        $data = [
            'title' => 'Address',
            'totalSales' => $this->SalesModel->totalTransaction(),
            'country' => json_encode($country),
            'totalSalesCountry' => json_encode($totalSalesCountry),
            'showCountry' => $this->SalesModel->showCountry(),
        ];
        return view('Sales/Address/index', $data);
    }

    public function salesCityChart()
    {
        if ($this->request->isAJAX()) {
            $country = $this->request->getPost('country');
            $salesCity = $this->SalesModel->showTransactionCity($country);
            $sales = [];
            $city = [];
            foreach ($salesCity as $row) {
                array_push($sales, $row->sales);
                array_push($city, $row->city);
            }

            $data = [
                'sales' => json_encode($sales),
                'city' => json_encode($city),
            ];

            $response['totalSalesCity'] = $this->SalesModel->totalTransactionCity($country)->sales;
            $response['salesCityChart'] = view('Sales/Address/Chart/salesCityChart', $data);
            return json_encode($response);
        }
    }

    public function product()
    {
        $totalSalesProduct = $this->SalesModel->totalSalesProduct();
        $name = [];
        $sales = [];

        foreach ($totalSalesProduct as $row) {
            array_push($name, $row->name);
            array_push($sales, $row->sales);
        }

        $data = [
            'title' => 'Product',
            'name' => json_encode($name),
            'sales' => json_encode($sales),
            'showCountry' => $this->SalesModel->showCountry(),
            'totalSales' => $this->SalesModel->totalSales()->totalSales,
        ];
        return view('Sales/Product/index', $data);
    }

    public function countrySalesProductChart()
    {
        if ($this->request->isAJAX()) {
            $country = $this->request->getPost('country');
            $salesProduct = $this->SalesModel->countrySalesProduct($country);
            $product = [];
            $sales = [];

            foreach ($salesProduct as $row) {
                array_push($product, $row->name);
                array_push($sales, $row->sales);
            }

            $data = [
                'product' => json_encode($product),
                'sales' => json_encode($sales),
            ];

            $response['countrySalesProductChart'] = view('Sales/Product/Chart/countrySalesProduct', $data);
            return json_encode($response);
        }
    }

    public function time()
    {
        $dayLineTotal = $this->SalesModel->showLineTotalDay();
        $day = [];
        $lineTotal = [];

        foreach ($dayLineTotal as $row) {
            array_push($day, $row->day);
            array_push($lineTotal, $row->lineTotal);
        }


        $data = [
            'title' => 'Time',
            'day' => json_encode($day),
            'lineTotal' => json_encode($lineTotal),
            'showLineTotal' => $this->SalesModel->showLineTotal()->lineTotal,
            'showDay' => $this->SalesModel->showDay(),
        ];
        return view('Sales/Time/index', $data);
    }

    public function daySalesProduct()
    {
        if ($this->request->isAJAX()) {
            $day = $this->request->getPost('day');
            $daySalesProduct = $this->SalesModel->daySalesProduct($day);
            $product = [];
            $sales = [];

            foreach ($daySalesProduct as $row) {
                array_push($product, $row->name);
                array_push($sales, $row->sales);
            }

            $data = [
                'product' => json_encode($product),
                'sales' => json_encode($sales),
            ];

            $response['daySalesProduct'] = view('Sales/Time/Chart/daySalesProduct', $data);
            return json_encode($response);
        }
    }
}
