<?php

namespace App\Http\Livewire;

use App\Models\Nationalities;
use App\Models\ParentAttachment;
use App\Models\Parents;
use App\Models\Religion;
use App\Models\TypeBlood;
use File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;


class PageParents extends Component
{
    use WithFileUploads;
    public $catchError , $updateMode = false , $photos , $parent_id;
    public $successMessage = '';
    public $parents_page = 1;
    public $currentStep = 1 , 

        // Father_INPUTS
        $Email, $Password,
        $Name_Father, $Name_Father_en,
        $National_ID_Father, $Passport_ID_Father,
        $Phone_Father, $Job_Father, $Job_Father_en,
        $Nationality_Father_id, $Blood_Type_Father_id,
        $Address_Father, $Religion_Father_id,

        // Mother_INPUTS
        $Name_Mother, $Name_Mother_en,
        $National_ID_Mother, $Passport_ID_Mother,
        $Phone_Mother, $Job_Mother, $Job_Mother_en,
        $Nationality_Mother_id, $Blood_Type_Mother_id,
        $Address_Mother, $Religion_Mother_id;

        public function go_to_add_parent(){
            $this->updateMode = false ;
            $this->parents_page = 2 ;
            $this->clearForm();
        }
        public function back_to_list_parents(){
            $this->parents_page = 1 ;
        }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName, [
            'Email' => 'required|email',
            'National_ID_Father' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Father' => 'min:10|max:10',
            'Phone_Father' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'National_ID_Mother' => 'required|string|min:10|max:10|regex:/[0-9]{9}/',
            'Passport_ID_Mother' => 'min:10|max:10',
            'Phone_Mother' => 'regex:/^([0-9\s\-\+\(\)]*)$/|min:10'
        ]);
    }
        
public function render()
{
    return view('livewire.page-parents' , [
        'Type_Bloods' => TypeBlood::all(),
        'Religions' => Religion::all(),
        'Nationalities' => Nationalities::all(),
        'Parents' => Parents::all(),
    ]);
}

    public function firstStepSubmit(){

        $this->validate([ 
            'Email' => 'required|unique:parents,Email,'.$this->parent_id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:parents,National_ID_Father,' . $this->parent_id,
            'Passport_ID_Father' => 'required|unique:parents,Passport_ID_Father,' . $this->parent_id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        $this->currentStep = 2 ;

    }

    public function back($step){
        $this->currentStep = $step ;
    }

    public function secondStepSubmit(){

        $this->validate([ 

            'Name_Mother' => 'required',
            'Name_Mother_en' => 'required',
            'Job_Mother' => 'required',
            'Job_Mother_en' => 'required',
            'National_ID_Mother' => 'required|unique:parents,National_ID_Mother,' . $this->id,
            'Passport_ID_Mother' => 'required|unique:parents,Passport_ID_Mother,' . $this->id,
            'Phone_Mother' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Mother_id' => 'required',
            'Blood_Type_Mother_id' => 'required',
            'Religion_Mother_id' => 'required',
            'Address_Mother' => 'required',
        ]);
        $this->currentStep = 3 ;
    }

    public function submitForm(){
        try{
        $parents = new Parents();
        // father_inputs
        $parents->email = $this->Email;
        $parents->password = Hash::make($this->Password);
        $parents->name_father = ['ar' => $this->Name_Father , 'en' => $this->Name_Father_en];
        $parents->national_id_father = $this->National_ID_Father;
        $parents->passport_id_father = $this->Passport_ID_Father;
        $parents->phone_father = $this->Phone_Father ;
        $parents->job_father = ['ar' => $this->Job_Father , 'en' => $this->Job_Father_en] ;
        $parents->nationality_father_id = $this->Nationality_Father_id;
        $parents->blood_father_id = $this->Blood_Type_Father_id;
        $parents->address_father = $this->Address_Father;
        $parents->religion_father_id = $this->Religion_Father_id;
        // mother_inputs
        $parents->name_mother = ['ar' => $this->Name_Mother , 'en' => $this->Name_Mother_en];
        $parents->national_id_mother = $this->National_ID_Mother;
        $parents->passport_id_mother = $this->Passport_ID_Mother;
        $parents->phone_mother = $this->Phone_Mother;
        $parents->job_mother = ['ar' => $this->Job_Mother , 'en' => $this->Job_Mother_en] ;
        $parents->nationality_mother_id = $this->Nationality_Mother_id;
        $parents->blood_mother_id = $this->Blood_Type_Mother_id;
        $parents->address_mother = $this->Address_Mother;
        $parents->religion_mother_id = $this->Religion_Mother_id;
        // save in database
        $parents->save();

        if(!empty($this->photos)){
            foreach($this->photos as $photo){
                $photo->storeAs($this->National_ID_Father , $photo->getClientOriginalName() , $disk = 'parent_attachments');
                ParentAttachment::create([
                    'file_name' => $photo->getClientOriginalName(),
                    'parent_id' => Parents::latest()->first()->id,
                ]);
            }
        }
        // $this->successMessage = trans('trans_school.Success');
        toastr()->success(message: trans('trans_school.Success'));
        $this->clearForm();
        $this->currentStep = 1 ;
    }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };


    }

    public function clearForm(){
        $this->Email = '';
        $this->Password = '';
        $this->Name_Father = '';
        $this->Name_Father_en = '';
        $this->National_ID_Father = '';
        $this->Passport_ID_Father = '';
        $this->Phone_Father = '';
        $this->Job_Father = '';
        $this->Job_Father_en = '';
        $this->Nationality_Father_id = '';
        $this->Blood_Type_Father_id = '';
        $this->Address_Father = '';
        $this->Religion_Father_id = '';
        $this->Name_Mother = '';
        $this->Name_Mother_en = '';
        $this->National_ID_Mother = '';
        $this->Passport_ID_Mother = '';
        $this->Phone_Mother = '';
        $this->Job_Mother = '';
        $this->Job_Mother_en = '';
        $this->Nationality_Mother_id = '';
        $this->Blood_Type_Mother_id = '';
        $this->Address_Mother = '';
        $this->Religion_Mother_id = '';
        $this->id = '';
    }
    public function edit($id){
        $this->parents_page = 2 ;
        $this->updateMode = true;
        $the_parent = Parents::where('id' , $id)->first();
        $this->parent_id = $id;

        $this->Email = $the_parent->email;
        $this->Password = $the_parent->password;
        $this->Name_Father = $the_parent->getTranslation('name_father', 'ar');
        $this->Name_Father_en = $the_parent->getTranslation('name_father', 'en');
        $this->Job_Father = $the_parent->getTranslation('job_father', 'ar');;
        $this->Job_Father_en = $the_parent->getTranslation('job_father', 'en');
        $this->National_ID_Father =$the_parent->national_id_father;
        $this->Passport_ID_Father = $the_parent->passport_id_father;
        $this->Phone_Father = $the_parent->phone_father;
        $this->Nationality_Father_id = $the_parent->nationality_father_id;
        $this->Blood_Type_Father_id = $the_parent->blood_father_id;
        $this->Address_Father =$the_parent->address_father;
        $this->Religion_Father_id =$the_parent->religion_father_id;

        $this->Name_Mother = $the_parent->getTranslation('name_mother', 'ar');
        $this->Name_Mother_en = $the_parent->getTranslation('name_mother', 'en');
        $this->Job_Mother = $the_parent->getTranslation('job_mother', 'ar');;
        $this->Job_Mother_en = $the_parent->getTranslation('job_mother', 'en');
        $this->National_ID_Mother =$the_parent->national_id_mother;
        $this->Passport_ID_Mother = $the_parent->passport_id_mother;
        $this->Phone_Mother = $the_parent->phone_mother;
        $this->Nationality_Mother_id = $the_parent->nationality_mother_id;
        $this->Blood_Type_Mother_id = $the_parent->blood_mother_id;
        $this->Address_Mother =$the_parent->address_mother;
        $this->Religion_Mother_id =$the_parent->religion_mother_id;

        $this->validate([ 
            'Email' => 'required|email|unique:parents,email,'.$this->parent_id,
            'Password' => 'required',
            'Name_Father' => 'required',
            'Name_Father_en' => 'required',
            'Job_Father' => 'required',
            'Job_Father_en' => 'required',
            'National_ID_Father' => 'required|unique:parents,National_ID_Father,' . $this->parent_id,
            'Passport_ID_Father' => 'required|unique:parents,Passport_ID_Father,' . $this->parent_id,
            'Phone_Father' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
            'Nationality_Father_id' => 'required',
            'Blood_Type_Father_id' => 'required',
            'Religion_Father_id' => 'required',
            'Address_Father' => 'required',
        ]);
        
    }
    public function firstStepSubmit_update(){
        $this->currentStep = 2 ;
    }
    public function secondStepSubmit_update(){
        $this->currentStep = 3 ;
    }

    public function submitForm_edit(){
        try{
            $update_parent = Parents::findOrFail($this->parent_id);

            if ($update_parent->password != $this->Password){
                $update_parent->update([
                    'password' => Hash::make($this->Password),
                ]);
            }
            $update_parent->update([
            'email' => $this->Email,
            'name_father' => ['ar' => $this->Name_Father , 'en' => $this->Name_Father_en],
            'national_id_father' => $this->National_ID_Father,
            'passport_id_father' => $this->Passport_ID_Father,
            'phone_father' => $this->Phone_Father ,
            'job_father' => ['ar' => $this->Job_Father , 'en' => $this->Job_Father_en] ,
            'nationality_father_id' => $this->Nationality_Father_id,
            'blood_father_id' => $this->Blood_Type_Father_id,
            'address_father' => $this->Address_Father,
            'religion_father_id' => $this->Religion_Father_id,
            'name_mother' => ['ar' => $this->Name_Mother , 'en' => $this->Name_Mother_en],
            'national_id_mother' => $this->National_ID_Mother,
            'passport_id_mother' => $this->Passport_ID_Mother,
            'phone_mother' => $this->Phone_Mother,
            'job_mother' => ['ar' => $this->Job_Mother , 'en' => $this->Job_Mother_en] ,
            'nationality_mother_id' => $this->Nationality_Mother_id,
            'blood_mother_id' => $this->Blood_Type_Mother_id,
            'address_mother' => $this->Address_Mother,
            'religion_mother_id' => $this->Religion_Mother_id,
            ]);

            if(!empty($this->photos)){
                foreach($this->photos as $photo){
                    $photo->storeAs($this->National_ID_Father , $photo->getClientOriginalName() , $disk = 'parent_attachments');
                    ParentAttachment::create([
                        'file_name' => $photo->getClientOriginalName(),
                        'parent_id' => Parents::latest()->first()->id,
                    ]);
                }
            }

            $this->back_to_list_parents(); 
            $this->currentStep = 1 ;
            toastr()->success(message: trans('trans_school.Success'));
            // return redirect()->to('/Parents');

        }
        catch (\Exception $e) {
            $this->catchError = $e->getMessage();
        };
    }

    public function delete($id){
        $delete_parent = Parents::findOrFail($id);
        // $attachment = ParentAttachment::find('parent_id' == $id);
        Storage::deleteDirectory('parent_attachments/'.$delete_parent->national_id_father);
        $delete_parent->delete();
        toastr()->success(message: trans('trans_school.Success'));
    }
}
