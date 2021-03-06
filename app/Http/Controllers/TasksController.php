<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Task;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザを取得
            // メッセージ一覧を取得
            $tasks = Task::all();
            
            // logger('これだよ。ログだよ');
            // それを表示
            return view ('tasks.index',[
                'tasks'=>$tasks,
                ]);            
            // $data = [
            //     'user' => $user,
            // ];
        }
        
        return view('welcome', $data);

        // // メッセージ一覧を取得
        // $tasks = Task::all();
        
        // // logger('これだよ。ログだよ');
        // // それを表示
        // return view ('tasks.index',[
        //     'tasks'=>$tasks,
        //     ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //メッセージ一覧を取得
        $task = new Task;
        //メッセージ作成ビューを表示
        return view ('tasks.create',[
            'task'=>$task,
            ]);
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // バリデーション追加
        $request->validate([
            'status'=>'required|max:10',
            'content'=>'required|max:10',
            ]);
        
        //タスクを作成
        $task = new Task;
        $task->status=$request->status;
        $task->content=$request->content;
        $task->save();
        
        //トップページへリダイレクト
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //idの値でメッセージを検索して取得
        $task= Task::findOrFail($id);
        
        //メッセージ詳細ビューでそれを表示
        return view('tasks.show',[
            'task'=>$task,
            ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //idの値でメッセージを検索して取得
        $task = Task::findOrFail($id);
        
        //メッセージ編集ビューでそれを表示
        return view('tasks.edit',[
            'task' => $task
            ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // バリデーション追加
        $request->validate([
            'status'=>'required|max:10',
            'content' => 'required|max:10',
            ]);
        
        //idの値を検索して取得
        $task=Task::findOrFail($id);
        //タスクを更新
        $task->status=$request->status;
        $task->content=$request->content;
        $task->save();
        
        //トップページへリダイレクトさせる
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //idの値で検索して取得
        $task=Task::findOrFail($id);
        //タスクを削除
        $task->delete();
        
        //トップページへリダイレクト
        return redirect('/');
    }
}
