<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    use ImageTrait;

    public function index()
    {
        //
        $events = Event::paginate(5);

        return view('events.index', compact('events'))->with('i');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('events.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'required',
            'introduction' => 'required',
            'location' => 'required',
            'start_time' => 'required',
            'image' =>  'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $eventData = $request->all();
        $eventData['host_id'] = Auth::user()->id;
        $randomCode = $this->getRandomString(8);
        $eventData['code'] = $randomCode;

        $eventData['image'] = $this->verifyAndUpload($request, 'image', 'public');

        Event::create($eventData);

        return redirect()->route('events.index')
           ->with('success', "Events created successfully!")
           ->with('code', $eventData['code']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show($uuid)
    {
        //
        $event = Event::where('uuid', '=', $uuid)->first();
        #dd($event);
        if ($event == null) {
            return redirect()->back();
        }
        return view('events.show', ['event'=>$event], compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit($uuid)
    {
        //
        $event = Event::where('uuid', '=', $uuid)->first();
        #dd($event);
        if (Auth::user()->id == $event->host_id)
            return view('events.edit', compact('event'));
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $uuid)
    {
        //
        $request->validate([
            'name' => 'required',
            'introduction' => 'required',
            'location' => 'required',
            'start_time' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $event = Event::where('uuid', '=', $uuid)->get()->first();
        if (Auth::user()->id != $event->host_id) {
            return redirect()->route('events.index')
            ->with('fail', 'Fail to update event!');
        }

        $editedEvent = request()->all();
        $editedEvent['image'] = $this->verifyAndUpload($request, 'image', 'public');
        #dd($editedEvent);
        $event->update($editedEvent);


        return redirect()->route('events.index')
            ->with('success', 'Event updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        //
        $event = Event::where('uuid', '=', $uuid)->first();

        if (Auth::user()->id == $event->host_id) {
            $event->delete();
            return redirect()->route('events.index')
            ->with('success', 'Events deleted successfully!');
        }

        return redirect()->route('events.index')
            ->with('fail', 'Fail to delete the event!');
    }

    public function join(Request $request)
    {
        $request->validate([
            'code' => 'required|max:8'
        ]);
        $code = $request->input('code');
        $event = Event::where('code', '=', $code)->get()->first();
        if($event == null){
            return redirect()->back()
            ->with('fail', 'Wrong Code!!!');
        }
        //need to be security
        return redirect()
            ->route('events.show',['uuid'=>$event->uuid,'host_name'=>$event->name])
            ->withCookie(cookie('event_code', $event->code, 5));

    }

    public function card($uuid) {

    }

    private function getRandomString($n) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';

        for ($i = 0; $i < $n; $i++) {
            $index = rand(0, strlen($characters) - 1);
            $randomString .= $characters[$index];
        }

        $eventCode = Event::where('code', $randomString)->get()->first();

        if ($eventCode == null) {
            return $randomString;
        }
        else {
            return getRandomString(8);
        }
    }
}
