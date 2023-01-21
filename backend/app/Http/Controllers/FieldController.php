<?php

namespace App\Http\Controllers;

use App\Http\Requests\FieldRequest;
use App\Models\Field;
use Illuminate\Http\Response;

class FieldController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Field::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FieldRequest  $request
     * @return Response
     */
    public function store(FieldRequest $request)
    {
        return response(Field::create($request->all()), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response(Field::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  FieldRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(FieldRequest $request, $id)
    {
        Field::find($id)->update($request->all());

        return response(Field::find($id), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Field::destroy($id);

        return response('Field deleted successfully', 200);
    }
}
