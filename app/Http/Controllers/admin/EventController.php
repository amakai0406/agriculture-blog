<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Http\Requests\admin\StoreEventRequest;
use App\Models\EventImage;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class EventController extends Controller
{

    public function index()
    {
        $events = Event::all();

        //compactで$eventsに格納されたデータをビューで使えるようにする
        return view('admin.events.index', compact('events'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(StoreEventRequest $request)
    {
        $validated = $request->validated();

        $event = new Event;

        //$eventオブジェクトの各プロパティにデータに設定
        //例) バリデーションされたtitleデータを$eventオブジェクトのtitleプロパティーに設定し、ビューで$event->titleとすることで取得できる
        $event->title = $validated['title'];

        $event->description = $validated['description'];

        $event->start_date = $validated['start_date'];

        $event->end_date = $validated['end_date'];

        $event->participants_count = $validated['participants_count'];

        $event->save();

        //hasFile()->リクエストの中にフェイルがあるかチェック
        if ($request->hasFile('event_image')) {

            Log::info('ファイルアップロード開始');

            //store()->ファイルの保存->保存先のパスを返す
            $imagePath = $request->file('event_image')->store('images', 'public');

            Log::info('保存されたファイルパス: ' . $imagePath);

            //event_imagesテーブルのモデル
            $eventImage = new EventImage;

            //$eventオブジェクトのidプロパティを$eventImageオブジェクトのevent_idプロパティに設定
            $eventImage->event_id = $event->id;

            //$imagePathを＄eventImageオブジェクトのimage_pathプロパティに設定
            $eventImage->image_path = $imagePath;

            $eventImage->save();
        }

        return redirect()->route('admin.events.index')->with('success', '新しいイベントを追加しました');
    }

    public function edit(int $id)
    {
        $event = Event::findOrFail($id);

        return view('admin.events.edit', compact('event'));
    }

    public function update(StoreEventRequest $request, int $id)
    {

        $validated = $request->validated();

        DB::beginTransaction();

        try {

            $event = Event::findOrFail($id);

            $event->title = $validated['title'];

            $event->description = $validated['description'];

            $event->start_date = $validated['start_date'];

            $event->end_date = $validated['end_date'];

            $event->participants_count = $validated['participants_count'];


            if ($request->hasFile('event_image')) {

                if ($event->eventImages->isNotEmpty()) {

                    foreach ($event->eventImages as $eventImage) {

                        Storage::delete('public/' . $eventImage->image_path);

                        $eventImage->delete();
                    }
                }

                $path = $request->file('event_image')->store('images', 'public');

                $event->eventImage->create([
                    'image_path' => $path,
                    'location' => $request->location,
                ]);

                $event->save();

                DB::commit();

                return redirect()->route('admin.events.edit', $event->id)->with('success', '農業体験イベントを更新しました');
            }
        } catch (ModelNotFoundException $e) {

            DB::rollBack();

            return response()->json(['error' => 'ブログの更新中にエラーが発生しました'], 500);
        }
    }


}

