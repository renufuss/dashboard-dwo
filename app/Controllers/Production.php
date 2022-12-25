<?php

namespace App\Controllers;

use App\Models\ProductionModel;

class Production extends BaseController
{
    protected $ProductionModel;

    public function __construct()
    {
        $this->ProductionModel = new ProductionModel();
    }

    public function product()
    {

        $showProductTotalQTY = $this->ProductionModel->showProductTotalQTY();
        $name = [];
        $totalQTY = [];

        foreach ($showProductTotalQTY as $row) {
            array_push($name, $row->name);
            array_push($totalQTY, $row->totalQTY);
        }
        $data = [
            'title' => 'Product',
            'name' => json_encode($name),
            'totalQTY' => json_encode($totalQTY),
            'showTotalQTY' => $this->ProductionModel->showTotalQTY()->totalQTY,
            'showDay' => $this->ProductionModel->showDay(),

        ];
        return view('Production/Product/index', $data);
    }

    public function showDayProduction()
    {
        if ($this->request->isAJAX()) {
            $day = $this->request->getPost('day');
            $showDayProduction = $this->ProductionModel->showDayProduction($day);
            $product = [];
            $totalQTY = [];

            foreach ($showDayProduction as $row) {
                array_push($product, $row->name);
                array_push($totalQTY, $row->totalQTY);
            }

            $data = [
                'product' => json_encode($product),
                'totalQTY' => json_encode($totalQTY),
            ];

            $response['showDayProduction'] = view('Production/Product/Chart/showDayProduction', $data);
            return json_encode($response);
        }
    }

    public function time()
    {
        $showDayQTY = $this->ProductionModel->showDayQTY();
        $day = [];
        $totalQTY = [];

        foreach ($showDayQTY as $row) {
            array_push($day, $row->day);
            array_push($totalQTY, $row->totalQTY);
        }

        $data = [
            'title' => 'Product',
            'day' => json_encode($day),
            'totalQTY' => json_encode($totalQTY),
            'showTotalQTY' => $this->ProductionModel->showTotalQTY()->totalQTY,
            'showProduct' => $this->ProductionModel->showProduct(),
        ];
        return view('Production/Time/index', $data);
    }

    public function showProductDay()
    {
        if ($this->request->isAJAX()) {
            $name = $this->request->getPost('name');
            $showProductDay = $this->ProductionModel->showProductDay($name);
            $day = [];
            $totalQty = [];

            foreach ($showProductDay as $row) {
                array_push($day, $row->day);
                array_push($totalQty, $row->totalQty);
            }

            $data = [
                'day' => json_encode($day),
                'totalQty' => json_encode($totalQty),
            ];

            $response['showProductDay'] = view('Production/Time/Chart/showProductDay', $data);
            return json_encode($response);
        }
    }
}
