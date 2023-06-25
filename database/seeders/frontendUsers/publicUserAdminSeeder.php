<?php

namespace Database\Seeders\frontendUsers;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class publicUserAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array=[];
        $array['full_name']='Donatepur';
        $array['username']='donatepur';
        $array['email']='donatepur@gmail.com';
        $array['country']='nepal';
        $array['is_email_verified']=1;
        $array['is_kyc_verified']=1;
        $array['mobile_number']='9702236623';
        $array['password']=Hash::make('123DonatepurAdmin@');

        
        
        
    }
}
