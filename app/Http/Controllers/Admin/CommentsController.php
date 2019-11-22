<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Model\Comment;

class CommentsController extends Controller
{
     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($id,Request $request)
    {   
        if(Auth::check()){

            if(empty($request->txtContent)){
                $status = 2; // Phân biệt để append html vào chưa điền comment
                $html = view('pages.comment')->with(compact('status'))->render();
                return response()->json(['success' => 0, 'html' => $html]);
            }else{
                $comment = new Comment();
                $comment->users_id = Auth::user()->id;
                $comment->products_id = $request->productId;
                $comment->content = $request->txtContent;
                $comment->save();

                $status = 1;
                $comments = Comment::Where('products_id',$id)->orderBy('id', 'DESC')->get();
                $countCmt = count($comments);     
                $html = view('pages.comment')->with(compact('comments','status'))->render();
                return response()->json(['success' => 1, 'html' => $html,'countCmt'=>$countCmt ]);
            }
            
        }else{
            $status = 0;
            $html = view('pages.comment')->with(compact('status'))->render();
            return response()->json(['success' => 0, 'html' => $html]);
        }
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$productId)
    {
        $comment= Comment::find($id);
        $comment->delete();

        return redirect()->back()->with('notification','Bạn đã xóa comment thành công');
    }
}
