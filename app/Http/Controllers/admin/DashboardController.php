<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Event;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function index()
    {
        $admin = Auth::guard('admin')->user();

        $events = DB::table('events')
            //eventsテーブルのidとevent_reservationsテーブルのevents_idを結合
            ->leftJoin('event_reservations', 'events.id', '=', 'event_reservations.event_id')
            //取得するカラム
            ->select(
                'events.id',
                'events.title',
                'events.description',
                'events.event_date',
                'participants_count',
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
            ->groupBy('events.id', 'events.title')
            ->get();

        $blogCounts = DB::table('blogs')
            //selectメソッドは、データベースから取得したい列を指定
            ->select(
                //created_atを年月としてmothという名前の列として選択
                DB::raw("DATE_FORMAT(created_at, '%Y-%m') as month"),
                //各月のブログ数を数えblog_countという名前の列として選択
                DB::raw("COUNT(*) as blog_count")
            )
            //groupByメソッドは、結果をどのようにグループ化するかを指定
            //同じ月に作成されたブログ投稿を1つのグループにまとめる
            ->groupBy(DB::raw("DATE_FORMAT(created_at, '%Y-%m')"))
            //orderByメソッド並び替えで降順
            ->orderBy('month', 'desc')
            ->get();

        return view('admin.layouts.index', compact('admin', 'events', 'blogCounts'));
    }
}