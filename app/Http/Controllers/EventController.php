<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends AuthController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Event::get(['id', 'title', 'start', 'end', 'color']);

        $events = 'null';
       return view('event.index',[
            'page_title' => 'Events', 
            'events' => $data,
        ]);
        return Response()->json($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->title = $request->title;
        $event->start = $request->date_start . ' ' . $request->time_start;
        $event->end = $request->date_end;
        $event->color = $request->color;
        $event->save();
        return redirect('/event.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $event = Event::find($id);
        $event->title = $request->title;
        $event->start = $request->date_start . ' ' . $request->time_start;
        $event->end = $request->date_end;
        $event->color = $request->color;
        if($event->save())
            return response()->json([
                'status'    =>  201,
                'message'   =>  'EVENTO ACTUALIZADO EXITOSAMENTE'
            ]);
        return response()->json([
            'status'    =>  503, 
            'message'   =>  'SE PRODUJO UN ERROR AL ACTUALIZAR EVENTO'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $event = Event::find($id);
        if($event == null)
            return Response()->json([
                'message'   =>  'ERROR AL ELIMINAR EVENTO'
            ]);
        $event->delete();
        return Response()->json([
            'message'   =>  'EVENTO ELIMINADO EXITOSAMENTE.'
        ]);
    }
}
