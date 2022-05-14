<?php

namespace App\Console\Commands;

use Github\AuthMethod;
use Github\Client;
use Illuminate\Console\Command;

class CreateRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:createrepo {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Creating Repository on Github';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Auth with Github client
        $client = new Client();
        $usernameOrToken = env('GIT_TOKEN');
        $method = AuthMethod::ACCESS_TOKEN;
        $client->authenticate($usernameOrToken, null, $method);
        // Repo name
        $repo = $this->argument('repo');
        try {
            $response = $client->api('repo')->create($repo, null, null, true);
            echo $response['html_url'];
        } catch (\Exception $e) {

            echo $e->getMessage();
        }


    }
}
