<?php

namespace App\Http\Controllers;

use App\Models\Card;
use App\Models\Event;
use App\Traits\ImageTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Auth;
use Image;

class CardController extends Controller
{
    //
    use ImageTrait;
    public function index(){
        $cards = Card::all();
        return view('cards.card', compact('cards'));
    }

    public function create() {
        return view('cards.create');
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'thumbnail' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'card' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' => 'required|max:100',
            'description' => 'required|max:255',
            'x' => 'required|min:1,max:1',
            'y' => 'required|min:1,max:1',
            'color_name' => "required|max:7",
            'color_introduction' => "required|max:7",
            'color_location' => "required|max:7",
            'color_time' => "required|max:7",
        ]);

        $cardData = $request->all();

        $cardData['card'] = $this->verifyAndUpload($request, 'card', 'public');

        Card::create($cardData);

        return redirect()->route('cards.index')
           ->with('success', "Card created successfully!");
    }

    public function card($uuid, Event $event) {
        $card = Card::where('uuid', '=', $uuid)->first();
        #dd($event);
        if ($card == null) {
            return redirect()->back();
        }
        return view('events.show', ['card'=>$card, 'event'=>$event]);
    }

    public function destroy($uuid)
    {
        //
        $card = Card::where('uuid', '=', $uuid)->first();

        if($card->delete());
            return redirect()->route('cards.index')
                ->with('success', 'Events deleted successfully!');
        return redirect()->back()
            ->with('fail', 'Fail to delete the event!');
    }

    public function generate(Event $event){
        if ($event == null) {
            return redirect()->back();
        }
        return view('cards.index', compact('event'));
    }

    public function show($uuid)
    {
        //
        $card = Event::where('uuid', '=', $uuid)->first();
        #dd($event);
        if ($event == null) {
            return redirect()->back();
        }
        return view('events.show', ['event'=>$event], compact('event'));
    }

    public function generateStore(Event $event){
        if($event != null) {
            $text = $event['name'];
            //public_path('card/default.png')
            $file = Image::make(asset('storage/card/default.png'));

            $height = $file->height();
            $width = $file->width();

            $editedHeight = $height / 4;
            $editedWidth = $width / 2;
            $size = 50;


            $file_name = time().'_'.$event->name;
            $img = Image::make($file);
            $img->text($text, $editedWidth, $editedHeight, function($font) {
                $font->file(public_path("font/OpenSans-Bold.ttf"));
                $font->size(40);
                $font->color("#000000");
                $font->align("center");
                $font->valign("middle");

            });

            $img->save(public_path("card".$file_name));

            return $img->response("jpg");
        }

        return back()->with('status', 'Failed to generate card!');
    }
}
