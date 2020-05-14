<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Book;

class BookController extends Controller
{
    public function index(){
        $result = Book::all();
        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function show($id)
    {
        $result = Book::find($id);

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function search($title)
    {
        $result = Book::where('title', 'like', '%'. $title.'%')->get();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response()->json($data);
    }

    public function create(request $request){
        $book = new Book;
        $book->title = $request->title;
        $book->author = $request->author;
        $book->publisher= $request->publisher;
        $book->image_url = $request->image_url;
        $book->save();

        if($book){
            $data['code'] = 200;
            $data['result'] = $book;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function update(request $request, $id){
        $result = Book::where('id',$id)->first();
        $result->title = $request->title;
        $result->author = $request->author;
        $result->publisher = $request->publisher;
        $result->image_url = $request->image_url;
        $result->save();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }

    public function delete($id){
        $result = Book::find($id);
        $result->delete();

        if($result){
            $data['code'] = 200;
            $data['result'] = $result;
        } else {
            $data['code'] = 500;
            $data['result'] = 'Error';
        }
        return response($data);
    }
}
