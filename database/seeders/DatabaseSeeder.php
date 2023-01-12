<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Department;
use App\Models\User;
use App\Models\Vehicle;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        //User::factory(10)->create();

        User::factory()->create([
            'type' => 'cc',
            'cc' => '123456789',
            'name' => 'Admin',
            'job' => 'a',
            'email' => 'admin@gmail.com',
            'phone' => '123456789',
            'question' => 'pq',
            'answer' => 'pq zi',
            'password' => Hash::make('123456789'),
            'status' => '1',
        ]);

        Department::factory()->create(['id' => '05', 'name' => 'ANTIOQUIA']);
        Department::factory()->create(['id' => '08', 'name' => 'ATLÁNTICO']);
        Department::factory()->create(['id' => '11', 'name' => 'BOGOTÁ']);
        Department::factory()->create(['id' => '13', 'name' => 'BOLÍVAR']);
        Department::factory()->create(['id' => '15', 'name' => 'BOYACÁ']);
        Department::factory()->create(['id' => '17', 'name' => 'CALDAS']);
        Department::factory()->create(['id' => '18', 'name' => 'CAQUETÁ']);
        Department::factory()->create(['id' => '19', 'name' => 'CAUCA']);
        Department::factory()->create(['id' => '20', 'name' => 'CESAR']);
        Department::factory()->create(['id' => '23', 'name' => 'CÓRDOBA']);
        Department::factory()->create(['id' => '25', 'name' => 'CUNDINAMARCA']);
        Department::factory()->create(['id' => '27', 'name' => 'CHOCÓ']);
        Department::factory()->create(['id' => '41', 'name' => 'HUILA']);
        Department::factory()->create(['id' => '44', 'name' => 'LA GUAJIRA']);
        Department::factory()->create(['id' => '47', 'name' => 'MAGDALENA']);
        Department::factory()->create(['id' => '50', 'name' => 'META']);
        Department::factory()->create(['id' => '52', 'name' => 'NARIÑO']);
        Department::factory()->create(['id' => '54', 'name' => 'NORTE DE SANTANDER']);
        Department::factory()->create(['id' => '63', 'name' => 'QUINDIO']);
        Department::factory()->create(['id' => '66', 'name' => 'RISARALDA']);
        Department::factory()->create(['id' => '68', 'name' => 'SANTANDER']);
        Department::factory()->create(['id' => '70', 'name' => 'SUCRE']);
        Department::factory()->create(['id' => '73', 'name' => 'TOLIMA']);
        Department::factory()->create(['id' => '76', 'name' => 'VALLE DEL CAUCA']);
        Department::factory()->create(['id' => '81', 'name' => 'ARAUCA']);
        Department::factory()->create(['id' => '85', 'name' => 'CASANARE']);
        Department::factory()->create(['id' => '86', 'name' => 'PUTUMAYO']);
        Department::factory()->create(['id' => '88', 'name' => 'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA']);
        Department::factory()->create(['id' => '91', 'name' => 'AMAZONAS']);
        Department::factory()->create(['id' => '94', 'name' => 'GUAINÁ']);
        Department::factory()->create(['id' => '95', 'name' => 'GUAVIARE']);
        Department::factory()->create(['id' => '97', 'name' => 'VAUPÉS']);
        Department::factory()->create(['id' => '99', 'name' => 'VICHADA']);

        Vehicle::factory(1)->create();
    }
}
