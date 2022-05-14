<?php

namespace App\Console\Commands;

use Github\AuthMethod;
use Github\Client;
use Illuminate\Console\Command;

class DeleteRepo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'test:deleterepo {repo}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete Repository';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        //Auth with Github client
        $client = new Client();
        $token = env('GIT_TOKEN');
        $username = env('GIT_USERNAME');
        $method = AuthMethod::ACCESS_TOKEN;
        $client->authenticate($token, null, $method);
        // Repo name
        $repo = $this->argument('repo');
        try {
            $response = $client->api('repo')->remove($username, $repo);
            echo 'Success';
        } catch (\Exception $e) {

            echo $e->getMessage();
        }
    }
}
