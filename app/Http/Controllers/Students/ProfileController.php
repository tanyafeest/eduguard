<?php

namespace App\Http\Controllers\Students;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Student;

class ProfileController extends Controller
{
    public function index()
    {
        $student_info=Student::find(currentUserId());
        return view('students.profile',compact('student_info'));
    }

    public function save_profile(Request $request)
    {
        try {
            $data=Student::find(currentUserId());
            $data->name_en = $request->fullName_en;
            $data->contact_en = $request->contactNumber_en;
            $data->email = $request->emailAddress;
            $data->date_of_birth = $request->dob;
            $data->gender = $request->gender;
            $data->bio = $request->bio;
            $data->profession = $request->profession;
            $data->nationality = $request->nationality;
            // $data->status = $request->status;
            // $data->password = Hash::make($request->fullName_bn);
            $data->language = 'en';

            if ($request->hasFile('image')) {
                $imageName = rand(111, 999) . time() . '.' . $request->image->extension();
                $request->image->move(public_path('uploads/students'), $imageName);
                $data->image = $imageName;
            }
            if ($data->save())
                return redirect()->back()->with('success', 'Data Saved');
            else
                return redirect()->back()->withInput()->with('error', 'Please try again');
        } catch (Exception $e) {
            // dd($e);
            return redirect()->back()->withInput()->with('error', 'Please try again');
        }
    }
}
