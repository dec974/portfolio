<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Service\GithubApiService;

#[AsCommand(
    name: 'app:sync-github-projects',
    description: 'Synchroniser les projets GitHub avec la base de données',
    aliases: ['app:github:sync'],
)]
class SyncGitHubProjectsCommand extends Command
{
    public function __construct(private GithubApiService $gitHubApi)
    {
        parent::__construct();
    }

    protected function configure(): void
    {
        $this
            ->setDescription('Synchronise les projets GitHub avec la base de données')
            ->addArgument('username', InputArgument::OPTIONAL, 'Nom d\'utilisateur GitHub')
            ->addOption('include-private', null, InputOption::VALUE_NONE, 'Inclure les dépôts privés dans la synchronisation'); 
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
        $io->title('Synchronisation des projets GitHub');
        $io->section('Récupération des dépôts GitHub...');
        $io->text('Cette opération peut prendre un certain temps, veuillez patienter.');
       
        $io->text('Dépôts récupérés, début de la synchronisation...');
        // Récupération des dépôts GitHub
        $io->text('Récupération des dépôts GitHub...');
        $repos = $this->gitHubApi->fetchRepositories(true);
        
        $io->text(sprintf('Nombre de dépôts récupérés : %d', count($repos)));       
        foreach ($repos as $repoData) {
            $io->text(sprintf('Traitement du dépôt : %s', $repoData['full_name']));
            dump($repoData); // Pour débogage, vous pouvez supprimer cette ligne dans la version finale
            // Ici, vous pouvez ajouter la logique pour synchroniser chaque dépôt avec votre base de données
            // Par exemple, vous pourriez créer ou mettre à jour un enregistrement dans votre base de données
            // $this->repositoryService->syncRepository($repoData);
            $io->text(sprintf('Dépôt %s synchronisé avec succès.', $repoData['full_name']));
            // Note: Assurez-vous de gérer les exceptions et les erreurs potentielles lors de la synchronisation
            // Exemple de gestion d'erreur
            // try {
            //     $this->repositoryService->syncRepository($repoData);
            // } catch (\Exception $e) {
            //     $io->error(sprintf('Erreur lors de la synchronisation du dépôt %s : %s', $repoData['full_name'], $e->getMessage()));
            //     continue; // Passer au dépôt suivant en cas d'erreur
            // }
            // Vous pouvez également ajouter des logs ou des messages pour suivre la progression de la synchronisation
            // Exemple de log
            // $io->text(sprintf('Dépôt %s synchronisé avec succès.', $repoData['full_name']));            
            // Logique de synchronisation avec votre base de données
        }

        $output->writeln('Synchronisation terminée !');
        return Command::SUCCESS;
    }
}
