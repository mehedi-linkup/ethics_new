<?php

namespace App\Http\Controllers;
use App\Models\MembershipApplication;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MembershipApplicationController extends Controller
{
    public function membershipApplicationStore() {
        $request->validate([
            "name" => "string",
            "email" => "string",
            "postal_code" => "number",
            "address" => "text",
            "phone" => "numeric"
        ]);

        $membershipApplication = new MembershipApplication();
        $membershipApplication->name = $request->name;
        $membershipApplication->email = $request->email;
        $membershipApplication->postal_code = $request->postal_code;
        $membershipApplication->address = $request->address;
        $membershipApplication->phone = $request->phone;
        $membershipApplication->save();

        // Mail::$membershipApplication->request();
    }
}
