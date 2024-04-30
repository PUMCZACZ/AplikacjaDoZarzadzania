<?php

namespace App\Domains\Release\Controllers;

use App\Domains\Order\Models\Order;
use App\Domains\Release\Repositories\ReleaseRepository;
use App\Domains\Release\Requests\ReleaseRequest;
use App\Domains\Release\Services\ReleaseService;
use App\Http\Controllers\Controller;

class ReleaseController extends Controller
{
    public function __construct(
        protected ReleaseRepository $releaseRepository,
        protected ReleaseService $releaseService,
    )
    {
    }

    public function create(Order $order)
    {
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        return view('release.create', compact('order', 'releaseInfo'));
    }

    public function store(ReleaseRequest $request, Order $order)
    {
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        if ($releaseInfo['forRelease'] === 0) {
            return redirect()->back()->withErrors('Zamówienie zostało już wydane');
        }

        try {
            $this->releaseService->insertRelease($order, $request->quantity);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('orders.show', $order);
    }

    public function fullRelease(Order $order)
    {
        $releaseInfo = $this->releaseRepository->getOrderReleaseInfo($order);

        if ($releaseInfo['forRelease'] === 0) {
            return redirect()->back()->withErrors('Zamówienie zostało już wydane');
        }

        try {
            $this->releaseService->insertFullRelease($order);
        } catch (\Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }

        return redirect()->route('orders.show', $order);
    }
}
