<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;

class EventController extends Controller
{
    /**
     * 全イベントの取得
     * @param Request $request
     * @return mixed
     */
    public function getAllEvents (Request $request)
    {
        try {
            Log::info('イベント一覧取得 --開始');
            $events = Event::all();
            return $events;
            Log::info('イベント一覧取得 --成功');
        } catch (\Exception $e) { 
            dump($e);
            Log::info('イベント一覧取得 --失敗');
            Log::info($e);
            return $e;
        }
        Log::info('イベント一覧取得 --終了');
    }

    /**
     * イベントの取得（ID指定）
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function getEventById (Request $request, $id)
    {
        DB::beginTransaction();
        try {
            Log::info('イベント単体取得 --開始');
            $event = Event::where('id', $id)->first();
            $comments = Comment::where('event_id', $id)->get();

            $info = (object) [
                'event'   => $event,
                'comments' => $comments
            ];

            return $info;
            DB::commit();
            Log::info('イベント単体取得 --成功');
        } catch (\Exception $e) {
            Log::info('イベント単体取得 --失敗');
            DB::rollback();
            Log::info($e);
        }
        Log::info('イベント単体取得 --終了');
    }

    /*
    * コメントの取得（ID指定）
    * @param Request $request
    * @return mixed
    */
    public function getCommentById (Request $request, $event_id)
    {
        DB::beginTransaction();
        try {
            Log::info('イベント単体取得 --開始');
            $comments = Comment::where('event_id', $event_id)->get();

            return $comments;
            DB::commit();
            Log::info('イベント単体取得 --成功');
        } catch (\Exception $e) {
            Log::info('イベント単体取得 --失敗');
            DB::rollback();
            Log::info($e);
        }
        Log::info('イベント単体取得 --終了');
    }

    /**
     * イベントの新規作成
     * @param Request $request
     */
    public function createEvent (Request $request)
    {
        DB::beginTransaction();
        try {
            Log::info('イベント登録 --開始');
            Event::insert([
                'event_name' => $request->event_name,
                'is_official' => $request->is_official,
                'deadline' => $request->deadline,
                'event_start' => $request->event_start,
                'event_end' => $request->event_end,
                'event_place_name' => $request->event_place_name,
                'event_place_address' => $request->event_place_address,
                'owner' => $request->owner,
                'event_description' => $request->event_description,
                'attendees' => $request->attendees,
                'memo' => $request->memo,
                'created_at' => $request->created_at,
                'updated_at' => $request->updated_at
            ]);
            DB::commit();
            Log::info('イベント登録 --成功');
        } catch (\Exception $e) {
            Log::info('イベント登録 --失敗');
            DB::rollBack();
            Log::info($e);
            throw $e;
        }
        Log::info('イベント登録 --終了');
    }

    /**
     * イベントの更新
     * @param Request $request
     * @param $id
     */
    public function updateEvent (Request $request, $id)
    {
        $event = Event::where('id', $id)->first();
        if(isset($event)){
            DB::beginTransaction();
            try {
                Log::info('イベント更新 --開始');
                Event::where('id', $id)->update([
                    'event_name' => $request->event_name,
                    'is_official' => $request->is_official,
                    'deadline' => $request->deadline,
                    'event_start' => $request->event_start,
                    'event_end' => $request->event_end,
                    'event_place_name' => $request->event_place_name,
                    'event_place_address' => $request->event_place_address,
                    'owner' => $request->owner,
                    'event_description' => $request->event_description,
                    'attendees' => $request->attendees,
                    'memo' => $request->memo,
                    'created_at' => $request->created_at,
                    'updated_at' => $request->updated_at
                ]);
                DB::commit();
                Log::info('イベント更新 --成功');
            } catch (\Exception $e) {
                Log::info('イベント更新 --失敗');
                DB::rollBack();
                Log::info($e);
                throw $e;
            }
            Log::info('イベント更新 --終了');
        }else{
            Log::info('Error: イベントが見つかりませんでした');
            throw new \Exception('イベントが存在しません');
        }
    }

    /**
     * イベントの削除
     * @param Request $request
     * @param $id
     */
    public function deleteEvent (Request $request, $id)
    {
        $event = Event::where('id', $id)->first();
        if(isset($event)){
            DB::beginTransaction();
            try {
                Log::info('イベント削除 --開始');
                Event::where('id', $id)->delete();
                DB::commit();
                Log::info('イベント削除 --成功');
            } catch (\Exception $e) {
                Log::info('イベント削除 --失敗');
                DB::rollBack();
                Log::info($e);
                throw $e;
            }
            Log::info('イベント削除 --終了');
        }else{
            Log::info('Error: イベントが見つかりませんでした');
            throw new \Exception('イベントが存在しません');
        }
    }

    /**
     * コメントの新規追加
     * @param Request $request
     * @param $event_id
     */
    public function createComment (Request $request, $event_id)
    {
        $event = Event::where('id', $event_id)->first();

        if(isset($event)){
            DB::beginTransaction();
            try {
                Log::info('コメント追加 --開始');
                Comment::insert([
                    'event_id' => $event_id,
                    'user_name' => $request->user_name,
                    'comment' => $request->comment,
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now()
                ]);
                DB::commit();
                Log::info('コメント追加 --成功');
            } catch (\Exception $e) {
                Log::info('コメント追加 --失敗');
                DB::rollBack();
                Log::info($e);
                throw $e;
            }
            Log::info('コメント追加 --終了');
        }else{
            Log::info('Error: イベントが見つかりませんでした');
            throw new \Exception('イベントが存在しません');
        }
    }

    /**
     * コメントの更新
     * @param Request $request
     * @param $id
     */
    public function updateComment (Request $request, $id)
    {
        $comment = Comment::where('id', $id)->first();
        if(isset($comment)){
            DB::beginTransaction();
            try {
                Log::info('コメント更新 --開始');
                Comment::where('id', $id)->update([
                    'comment' => $request->comment,
                    'updated_at' => Carbon::now()
                ]);
                DB::commit();
                Log::info('コメント更新 --成功');
            } catch (\Exception $e) {
                Log::info('コメント更新 --失敗');
                DB::rollBack();
                Log::info($e);
                throw $e;
            }
            Log::info('コメント更新 --終了');
        }else{
            Log::info('Error: コメントが見つかりませんでした');
            throw new \Exception('コメントが存在しません');
        }
    }

    /**
     * コメントの削除
     * @param Request $request
     * @param $id
     */
    public function deleteComment (Request $request, $id)
    {
        $comment = Comment::where('id', $id)->first();
        if(isset($comment)){
            DB::beginTransaction();
            try {
                Log::info('コメント削除 --開始');
                Comment::where('id', $id)->delete();
                DB::commit();
                Log::info('コメント削除 --成功');
            } catch (\Exception $e) {
                Log::info('コメント削除 --失敗');
                DB::rollBack();
                Log::info($e);
                throw $e;
            }
            Log::info('コメント削除 --終了');
        }else{
            Log::info('Error: コメントが見つかりませんでした');
            throw new \Exception('コメントが存在しません');
        }
    }
}
