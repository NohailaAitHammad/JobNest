<?php

namespace Database\Seeders;

use App\Enums\StatusUser;
use App\Models\Certification;
use App\Models\Competence;
use App\Models\Entreprise;
use App\Models\Experience;
use App\Models\ProfileCandidat;
use App\Models\ProfileRecruteur;
use App\Models\Proposition;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class TestUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminRole = Role::where('role', 'admin')->first();

        $admin = User::firstOrCreate(
            ["email" => "admin@jobnest.com"],
            [
                "firstName" => "Admin",
                "lastName" => "JobNest",
                "password" => Hash::make("password"),
                "status" => StatusUser::active,
                "role_id" => $adminRole->id
            ]
        );


        $candidatRole = Role::where('role', 'candidat')->first();
        $candidat = User::firstOrCreate(
            ['email' => 'candidat@jobnest.com'],
            [
                'firstName' => 'Youssef',
                'lastName'  => 'Alami',
                'password'  => Hash::make('password'),
                'status'    => StatusUser::active,
                "role_id" => $candidatRole->id
            ]
        );



        // Créer ProfileCandidat
        $profileCandidat = ProfileCandidat::firstOrCreate(
            ['user_id' => $candidat->id],
            [
                'ville'         => 'Casablanca',
                'telephone'     => '0612345678',
                'est_visible'   => true,
                'cv_url'        => null,
                'portfolio_url' => null,
            ]
        );

        // Ajouter Expériences
        if ($profileCandidat->experiences()->count() === 0) {
            Experience::insert([
                [
                    'profile_candidat_id' => $profileCandidat->id,
                    'poste'               => 'Développeur Web Junior',
                    'entreprise'          => 'TechMaroc',
                    'description'         => 'Développement d\'applications web avec Laravel et Vue.js',
                    'dateDebut'           => '2023-01-01',
                    'dateFin'             => '2023-12-31',
                ],
                [
                    'profile_candidat_id' => $profileCandidat->id,
                    'poste'               => 'Stagiaire Développeur',
                    'entreprise'          => 'StartupDev',
                    'description'         => 'Stage de fin d\'études en développement PHP',
                    'dateDebut'           => '2022-06-01',
                    'dateFin'             => '2022-08-31',
                ],
            ]);
        }

        // Ajouter Certifications
        if ($profileCandidat->certifications()->count() === 0) {
            Certification::insert([
                [
                    'profile_candidat_id' => $profileCandidat->id,
                    'titre'               => 'AWS Cloud Practitioner',
                    'organisme'           => 'Amazon Web Services',
                    'dateObtention'       => '2023-06-15',
                ],
                [
                    'profile_candidat_id' => $profileCandidat->id,
                    'titre'               => 'Laravel Certification',
                    'organisme'           => 'Laravel LLC',
                    'dateObtention'       => '2023-09-20',
                ],
            ]);
        }

        // Ajouter Compétences
        $competenceIds = Competence::whereIn('libelle', [
            'PHP', 'Laravel', 'JavaScript',
            'MySQL', 'Git', 'HTML & CSS'
        ])->pluck('id');

        foreach ($competenceIds as $index => $id) {
            $niveaux = ['expert', 'expert', 'intermediaire',
                'intermediaire', 'expert', 'expert'];
            $profileCandidat->competences()->syncWithoutDetaching([
                $id => ['niveau' => $niveaux[$index] ?? 'debutant']
            ]);


            $recruteurRole = Role::where('role', 'recruteur')->first();

            $recruteur = User::firstOrCreate(
                ['email' => 'recruteur@jobnest.com'],
                [
                    'firstName' => 'Sara',
                    'lastName' => 'Bennani',
                    'password' => Hash::make('password'),
                    'status' => StatusUser::active,
                    "role_id" => $recruteurRole->id,
                ]
            );


            // Créer ProfileRecruteur
            ProfileRecruteur::firstOrCreate(
                ['user_id' => $recruteur->id],
                [
                    'ville' => 'Rabat',
                    'telephone' => '0698765432',
                    'poste' => 'Responsable RH',
                ]
            );

            // Créer Entreprise
            $entreprise = Entreprise::firstOrCreate(
                ['user_id' => $recruteur->id],
                [
                    'nom' => 'TechMaroc Solutions',
                    'ville' => 'Rabat',
                    'dateCreation' => '2015-03-10',
                    'nombreEmployees' => 150,
                    'description' => 'Entreprise spécialisée dans le développement de solutions digitales pour les entreprises marocaines.',
                ]
            );

            // Attacher Domaines à l'Entreprise
            $domaineIds = \App\Models\Domaine::whereIn('nomDomaine', [
                'Informatique & Développement',
                'Marketing & Communication'
            ])->pluck('id');

            $entreprise->domaines()->syncWithoutDetaching(
                $domaineIds->toArray()
            );

            // ─────────────────────────────────────
            // 4. PROPOSITION TEST
            // ─────────────────────────────────────
            if (Proposition::count() === 0) {
                Proposition::insert([
                    [
                        'recruteur_id' => $recruteur->id,
                        'candidat_id' => $candidat->id,
                        'titre' => 'Stage Développeur Laravel',
                        'description' => 'Nous recherchons un développeur Laravel motivé pour rejoindre notre équipe technique.',
                        'type' => 'stage',
                        'duree' => '3 mois',
                        'status' => 'pending',
                        'created_at' => now(),
                        'updated_at' => now(),
                    ],
                    [
                        'recruteur_id' => $recruteur->id,
                        'candidat_id' => $candidat->id,
                        'titre' => 'Développeur Full Stack',
                        'description' => 'Poste de développeur full stack avec Laravel et Vue.js.',
                        'type' => 'emploi',
                        'duree' => '1 an renouvelable',
                        'status' => 'accepter',
                        'created_at' => now()->subDays(5),
                        'updated_at' => now()->subDays(5),
                    ],
                    [
                        'recruteur_id' => $recruteur->id,
                        'candidat_id' => $candidat->id,
                        'titre' => 'Alternance Web Developer',
                        'description' => 'Contrat d\'alternance pour profil junior.',
                        'type' => 'alternance',
                        'duree' => '6 mois',
                        'status' => 'refuser',
                        'created_at' => now()->subDays(10),
                        'updated_at' => now()->subDays(10),
                    ],
                ]);
            }
        }
        }

}
