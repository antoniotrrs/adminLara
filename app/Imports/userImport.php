<?php

namespace App\Imports;

use App\userModel;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Crypt;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Maatwebsite\Excel\Concerns\WithValidation;
use Mail;

class userImport implements ToModel, SkipsOnError
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
      $emailto = $row[0];
      $randomPass = substr(str_shuffle("0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 8);
      $password = Crypt::encryptString($randomPass);

      if($emailto != ""){

      Mail::send(['html'=>'emailregistro'], ["email" => $emailto,"contrasena" => $randomPass], function($message) use ($emailto) {
         $message->to($emailto)->subject('Activacion de Cuenta');
         $message->from('comefaenl@gmail.com',"COMEFAENL");
         });
     $mail =Mail::failures();
      }

        return new userModel([
            'email' => $emailto,
            'contrasena' => $password,
        ]);
    }

    public function onError(\Throwable $e)
    {
        // Handle the exception how you'd like.
    }
}
