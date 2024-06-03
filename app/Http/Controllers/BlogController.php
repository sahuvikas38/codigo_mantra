<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use App\Models\Blog;
use App\Models\User;

class BlogController extends Controller
{
    public function addBlog(){
        return view('add-blog');
    }

    public function getEditBlog($id){
        $blog = Blog::where('id', $id)->first();
        return view('edit-blog', compact('blog'));
    }

    public function addBlogPost(Request $request){
        $inputValidation = Validator::make($request->all(), [
            "title" => 'required',
            "tags" => 'required',
            "content" => 'required',
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->withErrors($inputValidation)->withInput();
        }
        $user = Blog::create([
            "user_id" => Auth::user()->id,
            "title" => $request->title,
            "tags" => $request->tags,
            "blog" => $request->content,
        ]);

        return redirect('/add-blog')->with('success', 'Successfully Registered.');
    }

    public function editBlog($id, Request $request){
        $inputValidation = Validator::make($request->all(), [
            "title" => 'required',
            "tags" => 'required',
            "content" => 'required',
        ]);
        if($inputValidation->fails()){
            return redirect()->back()->withErrors($inputValidation)->withInput();
        }
        $user = Blog::where('id', $id)->update([
            "title" => $request->title,
            "tags" => $request->tags,
            "blog" => $request->content,
        ]);

        return redirect("/edit-blog/{$id}")->with('success', 'Successfully Edited.');
    }

    public function viewBlog($id){
        $blog = Blog::where('id', $id)->first();
        $user = User::where('id', $blog->user_id)->first();
        $name = $user->name;
        return view("view-blog", compact('blog', 'name'));
    }

    public function deleteBlog($id){
        $user = Blog::where('id', $id)->delete();
        return redirect("/dashboard")->with('success', 'Successfully Deleted.');
    }

    public function shareBlog($id, Request $request){
        $useremail = $request->email;
        $comment = $request->comment;
        $blog = Blog::find($id);
        $user = User::find($blog->user_id);
        $title = $blog->title;
        $sharedBy = $request->name;
        $data = [
            "written_by" => $user->name,
            "link_to_blog" => env('APP_URL')."/view-blog/{$id}",
            "to" => $request->receiverName,
            "title" => $title,
            "comment" => $comment,
        ];
        try{ 
            Mail::send('Auth.share-blog-template', ['data' => $data], function ($message) use ($useremail, $sharedBy){
                $message->from('sahuvikas38@gmail.com', 'CODIGO_MANTRA');
                $message->to($useremail)->subject("CODIGO MANTRA - Have a look at this blog. Shared By - {$sharedBy}"); 
            });
        } catch(\Exception $e){
        }
        return redirect("/view-blog/{$id}");
    }
}
