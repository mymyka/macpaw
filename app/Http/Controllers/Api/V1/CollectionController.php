<?php

namespace App\Http\Controllers\Api\V1;

use App\Commands\V1\Collection\FilterCollectionCommand;
use App\Http\Requests\StoreCollectionRequest;
use App\Http\Requests\UpdateCollectionRequest;
use App\Http\Requests\FilterCollectionRequest;
use App\Models\Collection;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\CollectionCollection;
use App\Http\Resources\V1\CollectionResource;

class CollectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return new CollectionCollection(Collection::all());
    }

    public function filter(FilterCollectionRequest $request)
    {
        $result = FilterCollectionCommand::call($request);
        return $result->data;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCollectionRequest $request)
    {
        return new CollectionResource(Collection::create($request->all()));
    }

    /**
     * Display the specified resource.
     */
    public function show(Collection $collection)
    {
        return new CollectionResource($collection->loadMissing('contributors'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Collection $collection)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCollectionRequest $request, Collection $collection)
    {
        $collection->update($request->all());
        return new CollectionResource($collection);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Collection $collection)
    {
        $collection->delete();
        return response()->noContent();
    }
}
