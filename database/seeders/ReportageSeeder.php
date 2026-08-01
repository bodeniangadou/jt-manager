<?php

namespace Database\Seeders;

use App\Models\Reportage;
use App\Models\User;
use Illuminate\Database\Seeder;

class ReportageSeeder extends Seeder
{
    public function run(): void
    {
        $journalistes = User::where('role', 'journaliste')->get();
        
        $reportages = [
            [
                'titre' => 'Élections présidentielles : les candidats en campagne',
                'categorie' => 'Politique',
                'duree' => 15,
                'ordre_passage' => 1,
                'resume' => 'Tour d\'horizon des différents candidats et de leurs propositions.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Crise économique : le gouvernement prépare un plan de relance',
                'categorie' => 'Économie',
                'duree' => 10,
                'ordre_passage' => 2,
                'resume' => 'Les mesures envisagées pour soutenir les entreprises.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Tensions diplomatiques entre la France et la Russie',
                'categorie' => 'International',
                'duree' => 12,
                'ordre_passage' => 3,
                'resume' => 'Détails sur les dernières déclarations officielles.',
                'est_publie' => false,
            ],
            [
                'titre' => 'Finale de la Coupe du Monde : analyse des équipes',
                'categorie' => 'Sport',
                'duree' => 8,
                'ordre_passage' => 4,
                'resume' => 'Analyse des performances des équipes finalistes.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Réforme des retraites : les syndicats mobilisés',
                'categorie' => 'Politique',
                'duree' => 20,
                'ordre_passage' => 5,
                'resume' => 'Les grandes lignes de la réforme et les positions des syndicats.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Inflation record en Europe : quelles conséquences ?',
                'categorie' => 'Économie',
                'duree' => 18,
                'ordre_passage' => 6,
                'resume' => 'Analyse de l\'impact de l\'inflation sur le pouvoir d\'achat.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Conflit au Moyen-Orient : les efforts de médiation',
                'categorie' => 'International',
                'duree' => 25,
                'ordre_passage' => 7,
                'resume' => 'Les initiatives diplomatiques pour résoudre le conflit.',
                'est_publie' => false,
            ],
            [
                'titre' => 'Transfert de foot : les rumeurs du mercato',
                'categorie' => 'Sport',
                'duree' => 6,
                'ordre_passage' => 8,
                'resume' => 'Les dernières rumeurs et transferts confirmés.',
                'est_publie' => true,
            ],
            [
                'titre' => 'Le réchauffement climatique : l\'urgence d\'agir',
                'categorie' => 'International',
                'duree' => 30,
                'ordre_passage' => 9,
                'resume' => 'Les données scientifiques et les appels à l\'action.',
                'est_publie' => true,
            ],
            [
                'titre' => 'L\'IA révolutionne le journalisme',
                'categorie' => 'Économie',
                'duree' => 14,
                'ordre_passage' => 10,
                'resume' => 'Comment l\'intelligence artificielle transforme le journalisme.',
                'est_publie' => true,
            ],
        ];

        foreach ($reportages as $data) {
            $journaliste = $journalistes->random();
            $data['journaliste'] = $journaliste->name;
            $data['user_id'] = $journaliste->id;
            
            Reportage::create($data);
        }
    }
}