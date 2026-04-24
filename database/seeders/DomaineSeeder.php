<?php

namespace Database\Seeders;

use App\Models\Domaine;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DomaineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $domaines = [
            'Informatique & Développement',
            'Marketing & Communication',
            'Finance & Comptabilité',
            'Design & Créativité',
            'Ressources Humaines',
            'Commerce & Vente',
            'Juridique & Droit',
            'Santé & Médical',
            'Éducation & Formation',
            'Ingénierie & BTP',
        ];

        foreach ($domaines as $domaine){
            Domaine::firstOrCreate(['nomDomaine' => $domaine]);
        }
    }
}
