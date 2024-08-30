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

        $events = DB::table('events as e')
            ->leftJoin('event_reservations as er', function ($join) {
                $join->on('e.id', '=', 'er.event_id')
                    ->where('er.status', '=', 'confirmed');
            })
            ->select('e.title', 'e.event_date as event_date', DB::raw('COUNT(er.id) as participants_count'))
            ->groupBy('e.id', 'e.title', 'e.event_date')
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