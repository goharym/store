<?php

namespace App\Http\Controllers\Api\V1\Product;

use App\Http\Constants\ProductConstant;
use App\Http\Controllers\Controller;
use App\Http\Requests\Product\CreateRequest;
use App\Http\Resources\ProductResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class ProductController extends Controller
{

    /**
     *
     */
    public function __construct()
    {
        $this->middleware('auth.jwt');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Response::success(ProductResource::collection(Product::latest()->paginate(ProductConstant::PER_PAGE)));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRequest $request)
    {
        $product = Product::create($request->validated());

        foreach ($request->validated()['translations'] as $key => $trans) {

            $product->translateOrNew($key)->name = $trans['name'];

            $product->translateOrNew($key)->description = $trans['description'];
        }

        $product->save();

        return Response::created(new ProductResource($product));
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
}
