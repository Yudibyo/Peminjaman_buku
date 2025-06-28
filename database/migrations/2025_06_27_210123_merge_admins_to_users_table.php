<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Pindahkan data dari tabel admins ke users
        if (Schema::hasTable('admins')) {
            $admins = DB::table('admins')->get();
            
            foreach ($admins as $admin) {
                // Cek apakah email sudah ada di users
                $existingUser = DB::table('users')->where('email', $admin->email)->first();
                
                if (!$existingUser) {
                    DB::table('users')->insert([
                        'nama' => $admin->nama,
                        'email' => $admin->email,
                        'phone' => $admin->phone,
                        'password' => $admin->password,
                        'role' => 'admin',
                        'remember_token' => $admin->remember_token,
                        'created_at' => $admin->created_at,
                        'updated_at' => $admin->updated_at,
                    ]);
                }
            }
            
            // Hapus tabel admins
            Schema::dropIfExists('admins');
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Buat ulang tabel admins
        Schema::create('admins', function (Blueprint $table) {
            $table->id('id_admin');
            $table->string('nama', 100);
            $table->string('email', 100)->unique();
            $table->string('phone', 15)->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });
        
        // Pindahkan kembali data admin dari users ke admins
        $adminUsers = DB::table('users')->where('role', 'admin')->get();
        
        foreach ($adminUsers as $adminUser) {
            DB::table('admins')->insert([
                'nama' => $adminUser->nama,
                'email' => $adminUser->email,
                'phone' => $adminUser->phone,
                'password' => $adminUser->password,
                'remember_token' => $adminUser->remember_token,
                'created_at' => $adminUser->created_at,
                'updated_at' => $adminUser->updated_at,
            ]);
        }
        
        // Hapus data admin dari tabel users
        DB::table('users')->where('role', 'admin')->delete();
    }
};
