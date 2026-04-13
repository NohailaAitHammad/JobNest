<?php

namespace Database\Seeders;

use App\Models\Competence;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CompetenceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $competences = [
            // Développement
            'PHP',
            'Laravel',
            'JavaScript',
            'Vue.js',
            'React.js',
            'Node.js',
            'Python',
            'Java',
            'MySQL',
            'PostgreSQL',
            'MongoDB',
            'Docker',
            'Git',
            'REST API',
            'HTML & CSS',
            'Tailwind CSS',

            // Design
            'Figma',
            'Adobe XD',
            'Photoshop',
            'Illustrator',

            // Marketing
            'SEO',
            'Google Ads',
            'Social Media',
            'Content Writing',

            // Soft Skills
            'Communication',
            'Travail en équipe',
            'Gestion de projet',
            'Leadership',
        ];

        foreach ($competences as $competence){
            Competence::firstOrCreate(['libelle' => $competence]);
        }
    }
}
