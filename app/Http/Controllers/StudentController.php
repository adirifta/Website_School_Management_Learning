<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\ClassModel;
use Hash;
use Auth;
use Str;

class StudentController extends Controller
{
    public function list()
    {
        $data['getRecord'] = User::getStudent();
        $data['header_title'] = "List Siswa";
        return view('admin.student.list', $data);
    }

    public function add()
    {
        $data['getClass'] = ClassModel::getClass();
        $data['header_title'] = "Add New Siswa";
        return view('admin.student.add', $data);
    }

    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'berat' => 'max:10',
            'golongan_darah' => 'max:10',
            'no_telepon' => 'max:15|min:8',
            'nomor_pendaftaran' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'agama' => 'max:50',
            'tinggi' => 'max:10',
        ]);



        $student = new User;
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->nomor_pendaftaran = trim($request->nomor_pendaftaran);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->jenis_kelamin = trim($request->jenis_kelamin);

        if(!empty($request->tanggal_lahir))
        {
            $student->tanggal_lahir = trim($request->tanggal_lahir);
        }

        if(!empty($request->file('profile_pic')))
        {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->agama = trim($request->agama);
        $student->no_telepon = trim($request->no_telepon);

        if(!empty($request->tanggal_masuk))
        {
            $student->tanggal_masuk = trim($request->tanggal_masuk);
        }
       
        $student->golongan_darah = trim($request->golongan_darah);
        $student->tinggi = trim($request->tinggi);
        $student->berat = trim($request->berat);
        $student->status = trim($request->status);
        $student->email = trim($request->email);
        $student->password = Hash::make($request->password);
        $student->user_type = 3;
        $student->save();

        return redirect('admin/student/list')->with('success', "Student Successfully Created");
    }

    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if(!empty($data['getRecord']))
        {
            $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = "Add New Siswa";
            return view('admin.student.edit', $data);
        }
        else
        {
            abort(404);
        }
    }

    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' .$id,
            'berat' => 'max:10',
            'golongan_darah' => 'max:10',
            'no_telepon' => 'max:15|min:8',
            'nomor_pendaftaran' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max:50',
            'agama' => 'max:50',
            'tinggi' => 'max:10',
        ]);



        $student = User::getSingle($id);
        $student->name = trim($request->name);
        $student->last_name = trim($request->last_name);
        $student->nomor_pendaftaran = trim($request->nomor_pendaftaran);
        $student->roll_number = trim($request->roll_number);
        $student->class_id = trim($request->class_id);
        $student->jenis_kelamin = trim($request->jenis_kelamin);

        if(!empty($request->tanggal_lahir))
        {
            $student->tanggal_lahir = trim($request->tanggal_lahir);
        }

        if(!empty($request->file('profile_pic')))
        {
            if(!empty($student->getProfile()))
            {
                unlink('upload/profile/'.$student->profile_pic);
            }
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis').Str::random(20);
            $filename = strtolower($randomStr).'.'.$ext;
            $file->move('upload/profile/', $filename);

            $student->profile_pic = $filename;
        }

        $student->caste = trim($request->caste);
        $student->agama = trim($request->agama);
        $student->no_telepon = trim($request->no_telepon);

        if(!empty($request->tanggal_masuk))
        {
            $student->tanggal_masuk = trim($request->tanggal_masuk);
        }
       
        $student->golongan_darah = trim($request->golongan_darah);
        $student->tinggi = trim($request->tinggi);
        $student->berat = trim($request->berat);
        $student->status = trim($request->status);
        $student->email = trim($request->email);

        if(!empty($request->password))
        {
            $student->password = Hash::make($request->password);
        }

        $student->save();

        return redirect('admin/student/list')->with('success', "Student Successfully Updated");
    }

    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if(!empty($getRecord))
        {
            $getRecord->is_delete = 1;
            $getRecord->save();

            return redirect()->back()->with('success', "Student Successfully Deleted");
        }
        else
        {
            abort(404);
        }
    }
}
