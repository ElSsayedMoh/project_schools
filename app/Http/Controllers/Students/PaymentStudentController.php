<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use App\Models\FundAccounts;
use App\Models\PaymentStudents;
use App\Models\StudentAccount;
use App\Models\Students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payment_students = PaymentStudents::all();
        return view('Pages.Payment.index' , compact('payment_students'));
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
        $date = date('Y-m-d H:i:s');
        try{

            $payment_student = new PaymentStudents();
            $payment_student->date = $date;
            $payment_student->student_id = $request->student_id;
            $payment_student->amount = $request->Debit;
            $payment_student->description = $request->description;
            $payment_student->save();

            $student_account = new StudentAccount();
            $student_account->date = $date;
            $student_account->type = 'payment';
            $student_account->payment_id  = $payment_student->id;
            $student_account->student_id  = $request->student_id;
            $student_account->credit = 0.00;
            $student_account->Debit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();

            $fund_account = new FundAccounts();
            $fund_account->date = $date;
            $fund_account->payment_id  = $payment_student->id;
            $fund_account->Debit = 0.00;
            $fund_account->credit = $request->Debit;
            $fund_account->description = $request->description;
            $fund_account->save();
            
            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Payment_student.index');
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
        return view('Pages.Payment.add' , compact('student'));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $payment_student = PaymentStudents::findOrFail($id);
        return view('Pages.Payment.edit', compact('payment_student'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::beginTransaction();
        $date = date('Y-m-d H:i:s');
        try{

            $payment_student = PaymentStudents::findOrFail($request->id);
            $payment_student->date = $date;
            $payment_student->amount = $request->Debit;
            $payment_student->description = $request->description;
            $payment_student->save();

            $student_account = StudentAccount::where('payment_id' , $request->id)->first();
            $student_account->date = $date;
            $student_account->credit = 0.00;
            $student_account->Debit = $request->Debit;
            $student_account->description = $request->description;
            $student_account->save();

            $fund_account = FundAccounts::where('payment_id' , $request->id)->first();
            $fund_account->date = $date;
            $fund_account->Debit = 0.00;
            $fund_account->credit = $request->Debit;
            $fund_account->description = $request->description;
            $fund_account->save();
            
            DB::commit();
            toastr()->success(trans('trans_school.Success'));
            return redirect()->route('Payment_student.index');
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
            PaymentStudents::destroy($request->id);
            toastr()->error(trans('trans_school.Deleted_successfully'));
            return redirect()->route('Payment_student.index');
        }
        catch(\Exception $e){
            DB::rollback();
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}
