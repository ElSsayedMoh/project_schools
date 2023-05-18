<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\FundAccounts;
use App\Models\ReceiptStudents;
use App\Models\StudentAccount;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReceiptStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receipt_students = ReceiptStudents::all();
        return view('Pages.Receipt.index', compact('receipt_students'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::beginTransaction();
        $date = date(format: "Y-m-d");
        try{

            // Save in Table Receipt Students
            $receipt_students = new ReceiptStudents();
            $receipt_students->date = $date;
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->discription = $request->description;
            $receipt_students->save();

            // Save in Table Fund Accounts
            $found_account = new FundAccounts();
            $found_account->date = $date;
            $found_account->receipt_id = $receipt_students->id;
            $found_account->Debit = $request->Debit;
            $found_account->credit = 0.00;
            $found_account->description = $request->description;
            $found_account->save();

            // Save in Table Student Account
            $student_account = new StudentAccount();
            $student_account->date = $date;
            $student_account->type = 'receipt';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $receipt_students->id;
            $student_account->Debit = 0.00;
            $student_account->credit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();
            
            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('receipt_students.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Students::findOrFail($id);
        return view('Pages.Receipt.add', compact('student'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $receipt_student = ReceiptStudents::findOrFail($id);
        return view('Pages.Receipt.edit', compact('receipt_student'));
    }

    public function update(Request $request)
    {
        DB::beginTransaction();
        $date = date(format: "Y-m-d");
        try{

            // Save in Table Receipt Students
            $receipt_students = ReceiptStudents::findOrFail($request->id);
            $receipt_students->date = $date;
            $receipt_students->student_id = $request->student_id;
            $receipt_students->Debit = $request->Debit;
            $receipt_students->discription = $request->description;
            $receipt_students->save();

            // Save in Table Fund Accounts
            $found_account = FundAccounts::where('receipt_id', $request->id)->first();
            $found_account->date = $date;
            $found_account->receipt_id = $receipt_students->id;
            $found_account->Debit = $request->Debit;
            $found_account->credit = 0.00;
            $found_account->description = $request->description;
            $found_account->save();

            // Save in Table Student Account
            $student_account = StudentAccount::where('receipt_id', $request->id)->first();
            $student_account->date = $date;
            $student_account->type = 'receipt';
            $student_account->student_id = $request->student_id;
            $student_account->receipt_id = $receipt_students->id;
            $student_account->Debit = 0.00;
            $student_account->credit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();
            
            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('receipt_students.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        try{
            ReceiptStudents::destroy($request->id);
            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('receipt_students.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }

    
    }
}
