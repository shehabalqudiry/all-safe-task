<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use CodeInc\MsAccessReader\AccessReader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use MDB2;
use MDB2_Extended;
use PDO;

class HomeController extends Controller
{

    public function index()
    {
        $data = [
            'title' => "Home Page",
            'content' => "<p>This is the home page</p>"
        ];

        return view('home.index', $data);
    }

    public function handle(Request $request)
    {
    }
}
