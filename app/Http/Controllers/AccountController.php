<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mappers\AccountCatalogMapper;

class AccountController extends Controller
{
    public function clients()
    {
        $accountCatalog = new AccountCatalogMapper();
        return view('pages.clients', ['clients' => $accountCatalog->getAllAccounts()]);
    }
}
