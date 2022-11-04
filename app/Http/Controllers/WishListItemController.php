<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreWishListItemRequest;
use App\Http\Requests\UpdateWishListItemRequest;
use App\Models\WishListItem;

class WishListItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreWishListItemRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreWishListItemRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\WishListItem  $wishListItem
     * @return \Illuminate\Http\Response
     */
    public function show(WishListItem $wishListItem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\WishListItem  $wishListItem
     * @return \Illuminate\Http\Response
     */
    public function edit(WishListItem $wishListItem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateWishListItemRequest  $request
     * @param  \App\Models\WishListItem  $wishListItem
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateWishListItemRequest $request, WishListItem $wishListItem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\WishListItem  $wishListItem
     * @return \Illuminate\Http\Response
     */
    public function destroy(WishListItem $wishListItem)
    {
        //
    }
}
