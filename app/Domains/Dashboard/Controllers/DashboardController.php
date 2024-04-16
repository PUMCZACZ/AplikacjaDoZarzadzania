<?php

namespace App\Domains\Dashboard\Controllers;

use App\Domains\Dashboard\Helpers\TransformKiloToTonsHelper;
use App\Domains\Order\Repository\OrderDemandRepository;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function __construct(public OrderDemandRepository $demandRepository)
    {
    }

    public function index()
    {
        $nextMonthDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->getNextMonthOrdersDemandSum());
        $nextTwoMonthDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->getNextTwoMonthOrdersDemandSum());
        $materialDemand = TransformKiloToTonsHelper::toTons($this->demandRepository->materialDemand());

        return view('dashboard.index', compact(['nextMonthDemand', 'nextTwoMonthDemand', 'materialDemand']));
    }
}
