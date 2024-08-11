<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventImage;
use App\Http\Requests\admin\StoreEventRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class AdminEventController extends Controller
{

    public function index()
    {
        //eventsターブルに対してクエリの実行　
        $events = DB::table('events')
            //eventsテーブルのidとevent_reservationsテーブルのevents_idを結合
            ->leftJoin('event_reservations', 'events.id', '=', 'event_reservations.event_id')
            //取得するカラム
            ->select(
                'events.id',
                'events.title',
                'events.description',
                'events.event_date',
                'events.participants_count',
                'events.created_at',
                'events.updated_at',
                //DB::raw()は生SQL文を使用するための方法
                DB::raw('
            SUM(
                        CASE 
                            WHEN event_reservations.status = "confirmed" THEN 1 
                            WHEN event_reservations.status = "cancelled" THEN -1 
                            ELSE 0 
                        END
                    ) as reserved_participants
            ')
            )
            ->groupBy('events.id', 'events.title', 'events.participants_count')
            ->get();

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

            //store()->ファイルの保存->保存先のパスを返す
            $imagePath = $request->file('event_image')->store('images', 'public');

            //event_imagesテーブルのモデル
            $eventImage = new EventImage;

            //$eventオブジェクトのidプロパティを$eventImageオブジェクトのevent_idプロパティに設定
            $eventImage->event_id = $event->id;

            //$imagePathを＄eventImageオブジェクトのimage_pathプロパティに設定
            $eventImage->image_path = $imagePath;

            $eventImage->location = $validated['location'];

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

                $event->eventImages()->create([
                    'image_path' => $path,
                    'location' => $request->location,
                ]);
            }
            $event->save();

            DB::commit();

            return redirect()->route('admin.events.edit', $event->id)->with('success', '農業体験イベントを更新しました');

        } catch (ModelNotFoundException $e) {

            DB::rollBack();

            return response()->json(['error' => 'ブログの更新中にエラーが発生しました'], 500);
        }
    }

    public function destroy(int $id)
    {
        $event = Event::find($id);

        if ($event) {

            $event->eventImages()->delete();

            $event->delete();

            return redirect()->route('admin.events.index')->with('success', 'イベントが削除されました。');
        }

        return redirect()->route('admin.events.index')->with('error', 'イベントが見つかりませんでした。');
    }

}