<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return view('calendar', compact('events'));
    }
 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(Event::$rules);

        $event = new Event;
        $event->name = $request->input('name');
        $event->description = $request->input('description');
        $event->color = $request->input('color');
        $event->start = $request->input('start');
        $event->end = $request->input('end');
        $event->save();

        return redirect()->route('calendar')->with('success', 'Evento creado con éxito');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name' => 'required',
            'description' => 'nullable',
            'color' => 'nullable',
            'start' => 'required|date_format:Y-m-d\TH:i',
            'end' => 'required|date_format:Y-m-d\TH:i|after:start',
        ];

        $request->validate($rules);

        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('calendar')->with('error', 'Evento no encontrado');
        }

        if ($request->input('color') == null) {

            $event->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
            ]);
        } else {
            $event->update([
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'color' => $request->input('color'),
                'start' => $request->input('start'),
                'end' => $request->input('end'),
            ]);
        }

        return redirect()->route('calendar')->with('success', 'Evento actualizado con éxito');
    }
    

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $event = Event::find($id);

        if (!$event) {
            return redirect()->route('calendar')->with('error', 'Evento no encontrado');
        }

        $event->delete();

        return redirect()->route('calendar')->with('success', 'Evento eliminado con éxito');
    }
}
