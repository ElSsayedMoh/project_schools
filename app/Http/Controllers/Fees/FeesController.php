<?php

namespace App\Http\Controllers\Fees;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repository\FeesRepositoryInterface;

class FeesController extends Controller
{
    public $fees;
    public function __construct(FeesRepositoryInterface $fees){
        $this->fees = $fees;
    }
    public function index()
    {
        return $this->fees->index();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return $this->fees->create();
    }

    public function store(Request $request)
    {
        return $this->fees->store($request);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return $this->fees->edit($id);
        
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
        return $this->fees->update($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        return $this->fees->destroy($request);
    }
}
