<?php

use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        //Creation d'un compte bosse par defaut
        User::create([
            'email' => 'fadougbogautier@gmail.com',
            'password'=>Hash::make('Gautier2002@'),
            'first_name'=>'Gautier',
            'last_name'=>'FADONOUGBO',
            'email_verified_at'=>now('africa/porto-novo')->format('Y-m-d H:i:s'),
            'role'=>'boss'
        ]);

        User::create([
            'email' => 'radiortugbedokpo@gmail.com',
            'password'=>Hash::make('rtuservicenumeric95.3'),
            'first_name'=>'rtu',
            'last_name'=>'GBEDOKPO',
            'role'=>'boss',
            'email_verified_at'=>now('africa/porto-novo')->format('Y-m-d H:i:s')
        ]); 
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
       
    }
};
