<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 5/14/22
 * Time: 1:04 PM
 */

namespace App\Http\Controllers;


use App\Http\Resources\RepositoryResource;
use Github\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class ApiController extends Controller
{
    /**
     * List public repositories for the specified user.
     *
     * @link https://developer.github.com/v3/repos/#list-user-repositories
     *
     * @param string $data  search query for repository name
     *
     */
    public function searchRepositories(Request $request)
    {
        //connect to Github
        $client = new Client();
        //$data for
        $data = array_filter($request->all());

        $username = env('GIT_USERNAME');
        $response = [];
        $response['username'] = $username;
        $response['repositories'] = [];
        $repos = $client->api('user')->repositories($username);
        foreach ($repos as $key => $repo) {
            if (Arr::has($data, 'name')) {
                if($repo['name'] === Arr::get($data, 'name')){
                    $response['repositories'][$key]['full_name'] = $repo['full_name'];
                    $response['repositories'][$key]['url'] = $repo['html_url'];
                }

            }else{

                $response['repositories'][$key]['full_name'] = $repo['full_name'];
                $response['repositories'][$key]['url'] = $repo['html_url'];
            }
        }

        return new RepositoryResource($response);
    }
}