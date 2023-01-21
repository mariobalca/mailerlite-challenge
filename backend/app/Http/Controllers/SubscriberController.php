<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriberRequest;
use App\Models\Field;
use App\Models\Subscriber;
use Illuminate\Http\Response;

class SubscriberController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return response(Subscriber::all(), 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SubscriberRequest  $request
     * @return Response
     */
    public function store(SubscriberRequest $request)
    {
        $subscriber = Subscriber::create($request->all());
        $subscriber->syncFields($request->get('fields'));

        return response($subscriber, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return response(Subscriber::find($id), 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SubscriberRequest  $request
     * @param  int  $id
     * @return Response
     */
    public function update(SubscriberRequest $request, $id)
    {
        $subscriber = Subscriber::find($id);
        $subscriber->update($request->all());
        $subscriber->syncFields($request->get('fields'));

        return response(Subscriber::find($id), 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        Subscriber::destroy($id);

        return response('Subscriber deleted successfully', 200);
    }
}
