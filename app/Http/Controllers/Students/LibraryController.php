<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Http\Traits\AttachFilesTrait;
use App\Models\Grade;
use App\Models\Library;
use Illuminate\Http\Request;

class LibraryController extends Controller
{
    use AttachFilesTrait;

    public function index()
    {
        $books = Library::all();
        return view('Pages.Library.index' , compact('books'));
    }


    public function create()
    {
        $grades = Grade::all();
        return view('Pages.Library.add' , compact('grades'));
    }


    public function store(Request $request)
    {
        try {
        $books = new Library();
        $books->title = $request->title;
        $books->file_name = $request->file('file_name')->getClientOriginalName();
        $books->grade_id = $request->Grade_id;
        $books->classroom_id = $request->Classroom_id;
        $books->section_id = $request->section_id;
        $books->teacher_id = 1;
        $books->save();
        $this->uploadFile($request,'library' ,'file_name');

        toastr()->success(trans('messages.success'));
        return redirect()->route('Library.index');
        }
        catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $book = Library::findOrFail($id);
        $grades = Grade::all();
        return view('Pages.Library.edit', compact('book' , 'grades'));
    }


    public function update(Request $request)
    {
        try {
            $book = Library::findOrFail($request->id);
            $book->title = $request->title;

            if($request->hasFile('file_name')){
                $this->deleteFile($book->file_name);
                $this->uploadFile($request, 'library' , 'file_name');

                $file_name_new = $request->file('file_name')->getClientOriginalName();
                $book->file_name = $book->file_name !== $file_name_new ? $file_name_new : $book->file_name;
            }
            $book->grade_id = $request->Grade_id;
            $book->classroom_id = $request->Classroom_id;
            $book->section_id = $request->section_id;
            $book->teacher_id = 1;
            $book->save();

    
            toastr()->success(trans('messages.success'));
            return redirect()->route('Library.index');
            }
            catch (\Exception $e) {
                return redirect()->back()->with(['error' => $e->getMessage()]);
            }
    }

    public function destroy(Request $request)
    {
        try {
            $this->deleteFile($request->file_name);
            library::destroy($request->id);

            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('Library.index');

        }catch (\Exception $e) {
            return redirect()->back()->with(['error' => $e->getMessage()]);
        }
    }

    public function downloadAttachment($filename)
    {
        return response()->download(public_path('Attachments/library/'.$filename));
    }
}
