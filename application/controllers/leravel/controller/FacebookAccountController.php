<?php
// app/Http/Controllers/FacebookAccountController.php
namespace App\Http\Controllers;

use App\Models\FacebookAccount;
use App\Models\FacebookPage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class FacebookAccountController extends Controller
{
    public function index()
    {
        // ... similar logic to the original CodeIgniter code, using Eloquent queries
        $facebookAccounts = FacebookAccount::where('user_id', Auth::id())->get();
        // ...
        return view('facebook_accounts', compact('facebookAccounts'));
    }

    public function deleteAccount(Request $request)
    {
        $accountId = $request->input('accountId');
        FacebookAccount::where('id', $accountId)->where('user_id', Auth::id())->delete();
        // ... delete associated pages and other data
        return redirect()->back()->with('success', 'Account deleted successfully.');
    }

  

    // ... other methods for managing pages, groups, webhooks, etc.
}





php?>
