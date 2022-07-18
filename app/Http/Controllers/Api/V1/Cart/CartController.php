<?php

namespace App\Http\Controllers\Api\V1\Cart;

use App\Http\Controllers\Controller;
use App\Http\Requests\Cart\CreateRequest;
use App\Http\Requests\Cart\ListRequest;
use App\Http\Resources\CartResource;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class CartController extends Controller
{
    public float $total_price = 0;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(ListRequest $request)
    {
        $items = Cart::whereConsumerId(Auth::id())->latest()->get();

        foreach ($items as $item) {

            if ($item->product->vat_type == 0) $this->total_price += $item->product->price * $item->quantity;

            else if ($item->product->vat_type == 1) {

                $this->total_price += ($item->product->price + $this->calculateTaxValue($item)) * $item->quantity;
            }
        }

        return Response::success(CartResource::collection($items)->additional(['total_price' => $this->total_price]));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $item = Cart::whereConsumerId(Auth::id())->whereProductId($request['product_id'])->first();

        if ($item) $item->update(['quantity' => $request['quantity']]);

        else Cart::create(array_merge($request->validated(), ['consumer_id' => Auth::id()]));

        return Response::created('Cart updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Calculate tax value based on product price.
     * @param mixed $item
     * @return float|int
     */
    public function calculateTaxValue(mixed $item): int|float
    {
        return $item->product->price * $item->product->vat_amount;
    }
}
