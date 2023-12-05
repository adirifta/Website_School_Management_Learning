<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Request;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    static public function getSingle($id)
    {
        return self::find($id);
    }

    static public function getAdmin()
    {
        $return = self::select('users.*')
                        ->where('user_type','=',1)
                        ->where('is_delete','=',0);
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('name','like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('email','like', '%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('created_at','-', Request::get('date'));
                        }

        $return = $return->orderBy('id', 'desc')
                        ->paginate(10);
        return $return;
    }

    static public function getTeacher()
    {
        $return = self::select('users.*')
                        ->where('users.user_type','=',2)
                        ->where('users.is_delete','=',0);

                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('users.name','like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name','like', '%'.Request::get('last_name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email','like', '%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('jenis_kelamin')))
                        {
                            $return = $return->where('users.jenis_kelamin','=', Request::get('jenis_kelamin'));
                        }
                        if(!empty(Request::get('no_telepon')))
                        {
                            $return = $return->where('users.no_telepon','like', '%'.Request::get('no_telepon').'%');
                        }
                        if(!empty(Request::get('marital_status')))
                        {
                            $return = $return->where('users.marital_status','like', '%'.Request::get('marital_status').'%');
                        }
                        if(!empty(Request::get('address')))
                        {
                            $return = $return->where('users.address','like', '%'.Request::get('address').'%');
                        }
                        if(!empty(Request::get('tanggal_masuk')))
                        {
                            $return = $return->whereDate('users.tanggal_masuk','=', Request::get('tanggal_masuk'));
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at','=', Request::get('date'));
                        }
                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->whereDate('users.status','=', $return);
                        }

    $return = $return->orderBy('users.id', 'desc')
            ->paginate(20);
            
    return $return;

    }

    static public function getOrangtua()
    {
        $return = self::select('users.*')
                        ->where('user_type','=',4)
                        ->where('is_delete','=',0);

                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('users.name','like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name','like', '%'.Request::get('last_name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email','like', '%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('jenis_kelamin')))
                        {
                            $return = $return->where('users.jenis_kelamin','=', Request::get('jenis_kelamin'));
                        }
                        if(!empty(Request::get('no_telepon')))
                        {
                            $return = $return->where('users.no_telepon','like', '%'.Request::get('no_telepon').'%');
                        }
                        if(!empty(Request::get('alamat')))
                        {
                            $return = $return->where('users.alamat','like', '%'.Request::get('alamat').'%');
                        }
                        if(!empty(Request::get('pekerjaan')))
                        {
                            $return = $return->where('users.pekerjaan','like', '%'.Request::get('pekerjaan').'%');
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at','=', Request::get('date'));
                        }
                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->whereDate('users.status','=', $return);
                        }

        $return = $return->orderBy('id', 'desc')
                        ->paginate(10);
        return $return;
    }

    static public function getStudent()
    {
        $return = self::select('users.*', 'class.name as class_name', 'orangtua.name as orangtua_name', 'orangtua.last_name as orangtua_last_name')
                        ->join('users as orangtua','orangtua.id', '=', 'users.orangtua_id', 'left')
                        ->join('class', 'class.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type','=',3)
                        ->where('users.is_delete','=',0);

                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('users.name','like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name','like', '%'.Request::get('last_name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email','like', '%'.Request::get('email').'%');
                        }
                        if(!empty(Request::get('nomor_pendaftaran')))
                        {
                            $return = $return->where('users.nomor_pendaftaran','like', '%'.Request::get('nomor_pendaftaran').'%');
                        }
                        if(!empty(Request::get('roll_number')))
                        {
                            $return = $return->where('users.roll_number','like', '%'.Request::get('roll_number').'%');
                        }
                        if(!empty(Request::get('class')))
                        {
                            $return = $return->where('class.name','like', '%'.Request::get('class').'%');
                        }
                        if(!empty(Request::get('jenis_kelamin')))
                        {
                            $return = $return->where('users.jenis_kelamin','=', Request::get('jenis_kelamin'));
                        }
                        if(!empty(Request::get('caste')))
                        {
                            $return = $return->where('users.caste','like', '%'.Request::get('caste').'%');
                        }
                        if(!empty(Request::get('agama')))
                        {
                            $return = $return->where('users.agama','like', '%'.Request::get('agama').'%');
                        }
                        if(!empty(Request::get('no_telepon')))
                        {
                            $return = $return->where('users.no_telepon','like', '%'.Request::get('no_telepon').'%');
                        }
                        if(!empty(Request::get('golongan_darah')))
                        {
                            $return = $return->where('users.golongan_darah','like', '%'.Request::get('golongan_darah').'%');
                        }
                        if(!empty(Request::get('tanggal_masuk')))
                        {
                            $return = $return->whereDate('users.tanggal_masuk','=', Request::get('tanggal_masuk'));
                        }
                        if(!empty(Request::get('date')))
                        {
                            $return = $return->whereDate('users.created_at','=', Request::get('date'));
                        }
                        if(!empty(Request::get('status')))
                        {
                            $status = (Request::get('status') == 100) ? 0 : 1;
                            $return = $return->whereDate('users.status','=', $return);
                        }

        $return = $return->orderBy('users.id', 'desc')
                        ->paginate(20);
        return $return;
    }

    static public function getSearchStudent()
    {
        if(!empty(Request::get('id')) || !empty(Request::get('name')) || !empty(Request::get('last_name')) || !empty(Request::get('email')))
        {
            $return = self::select('users.*', 'class.name as class_name','orangtua.name as orangtua_name')
                        ->join('users as orangtua','orangtua.id', '=', 'users.orangtua_id', 'left')
                        ->join('class', 'class.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type','=',3)
                        ->where('users.is_delete','=',0);

                        if(!empty(Request::get('id')))
                        {
                            $return = $return->where('users.id','=', Request::get('id'));
                        }
                        if(!empty(Request::get('name')))
                        {
                            $return = $return->where('users.name','like', '%'.Request::get('name').'%');
                        }
                        if(!empty(Request::get('last_name')))
                        {
                            $return = $return->where('users.last_name','like', '%'.Request::get('last_name').'%');
                        }
                        if(!empty(Request::get('email')))
                        {
                            $return = $return->where('users.email','like', '%'.Request::get('email').'%');
                        }
        $return = $return->orderBy('users.id', 'desc')
                        ->limit(50)
                        ->get();
        return $return;
        }
    }

    static public function getMyStudent($orangtua_id)
    {
        $return = self::select('users.*', 'class.name as class_name','orangtua.name as orangtua_name')
                        ->join('users as orangtua','orangtua.id', '=', 'users.orangtua_id', 'left')
                        ->join('class', 'class.id', '=', 'users.class_id', 'left')
                        ->where('users.user_type','=',3)
                        ->where('users.orangtua_id','=',$orangtua_id)
                        ->where('users.is_delete','=',0)
                        ->orderBy('users.id', 'desc')
                        ->get();
        return $return;
    }

    static public function getEmailSingle($email)
    {
        return User::where('email', '=', $email)->first();
    }

    static public function getTokenSingle($remember_token)
    {
        return User::where('remember_token', '=', $remember_token)->first();
    }

    public function getProfile()
    {
        if(!empty($this->profile_pic) && file_exists('upload/profile/'.$this->profile_pic))
        {
            return url('upload/profile/'.$this->profile_pic);
        }
        else
        {
            return "";
        }
    }
}
