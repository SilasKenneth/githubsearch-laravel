<?php
namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Cache;

class RepoController extends Controller
{
    public function index()
    {
        $url = 'https://api.github.com/users';
        if(!Cache::has('users')){
            $users = (new Client())->request('GET', $url)->getBody();
            Cache::put('users', (string)$users, 600);
        }

        return Cache::get('users', []);
    }

    public function search(string $query)
    {
        $url = 'https://api.github.com/search/users?q='.$query;
        return (new Client())->request('GET', $url)->getBody();
    }
}