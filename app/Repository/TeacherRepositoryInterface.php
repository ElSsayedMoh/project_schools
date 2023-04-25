<?php

namespace App\Repository;

interface TeacherRepositoryInterface {
    
    public function getAllTeachers();

    public function getGender();

    public function getSpecialization();

    public function storeTeacher($request);

    public function EditTeacher($id);

    public function UpdateTeacher($request);
}