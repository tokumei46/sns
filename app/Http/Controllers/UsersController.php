<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Post;
use Rule;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        // ユーザー一覧をページネートで取得
        $users = User::paginate(20);
        // 検索フォームで入力された値を取得する
        $search = $request->input('search');
        // クエリビルダ
        $query = User::query();
        // もし検索フォームにキーワードが入力されたら
        if ($search !== null) {
            // 全角スペースを半角に変換
            $spaceConversion = mb_convert_kana($search, 's');
            // 単語を半角スペースで区切り、配列にする（例："山田 翔" → ["山田", "翔"]）
            $wordArraySearched = preg_split('/[\s,]+/', $spaceConversion, -1, PREG_SPLIT_NO_EMPTY);
            foreach ($wordArraySearched as $value) {
                $query->where('name', 'like', '%' . $value . '%');
            }
            // 上記で取得した$queryをページネートにし、変数$usersに代入
            $users = $query->paginate(20);
        }
        // ビューにusersとsearchを変数として渡す
        return view('users.index')
            ->with([
                'users' => $users,
                'search' => $search,
            ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        $user->loadRelationshipCounts();

        $posts = $user->posts()->orderBy('created_at', 'desc')->paginate(5);
        return view('users.show', [
            'user' => $user,
            'posts' => $posts,
        ]);
    }

    public function followings($id)
    {
        $user = User::findOrfail($id);

        $user->loadRelationshipCounts();

        $followings = $user->followings()->paginate(10);
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    public function followers($id)
    {
        $user = User::findOrfail($id);

        $user->loadRelationshipCounts();

        $followers = $user->followers()->paginate(10);

        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }

    public function favorites($post)
    {
        $user = user::findOrfail($post);

        $user->loadRelationshipCounts();

        $favorites = $user->favorites()->paginate(10);

        return view('users.favorite', [
            'user' => $user,
            'posts' => $favorites,
        ]);
    }

    public function showPro()
    {
        $user = \Auth::user();
        return view('users.profile', ['user' => $user]);
    }

    public function profileUpdate(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'string', 'email', 'max:255'],
            'comment' => 'string|max:500',
        ]);
        try {
            $user =  \Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->comment = $request->input('comment');
            $user->save();
        } catch (\Exception $e) {
            return back()->with('msg_error', 'プロフィールの更新に失敗しました')->withInput();
        }
        return redirect()->route('users.show', \Auth::user())->with('msg_success', 'プロフィールの更新が完了しました');
    }

    public function passwordUpdate(Request $request, User $user)
    {
        $user = \Auth::user();
            $user->password = bcrypt($request->get('password'));
            $user->save();
        return redirect()->route('users.show',\Auth::user())->with('msg_success', 'パスワードの更新が完了しました');
    }

    public function profile() {
        $user = Auth::user();
        return view('users.profile', ['user' => $user]);
    }
}
