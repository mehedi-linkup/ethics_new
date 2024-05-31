<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.dashboard");
    }

    public function getProfit()
    {
        $month = date("m");
        $year = date("Y");
        $dayNumber = date('t', mktime(0, 0, 0, $month, 1, $year));

        $todayOrder = DB::select("SELECT sm.*
        FROM orders sm
        WHERE sm.date = date('Y-m-d') AND sm.status = 'pending'
        ");
        $monthOrder = DB::select("SELECT sm.*
        FROM orders sm
        WHERE MONTH(sm.date) = '$month' AND sm.status = 'pending'
        ");
        $yearOrder = DB::select("SELECT sm.*
        FROM orders sm
        WHERE YEAR(sm.date) = '$year' AND sm.status = 'pending'
        ");

        $dayRecord = DB::select("SELECT 
        IFNULL(SUM(sm.total), 0 ) AS sales_amount
        FROM orders sm
        WHERE sm.date = ?
        AND sm.status = 'delivery'", [date('Y-m-d')]);

        $monthRecord = DB::select("SELECT 
        IFNULL(SUM(sm.total), 0 ) AS sales_amount
        FROM orders sm
        WHERE MONTH(sm.date) = '$month'
        AND sm.status = 'delivery'");

        $yearRecord = DB::select("SELECT 
        IFNULL(SUM(sm.total), 0 ) AS sales_amount
        FROM orders sm
        WHERE YEAR(sm.date) = '$year'
        AND sm.status = 'delivery'");

        // monthly record
        $monthlyRecord = [];
        for ($i = 1; $i <= $dayNumber; $i++) {
            $date = $year . '-' . $month . '-' . sprintf("%02d", $i);
            $query = DB::select("SELECT 
            IFNULL(SUM(sm.total), 0 ) AS sales_amount
            FROM orders sm
            WHERE sm.date = ?
            AND sm.status = 'delivery'", [$date]);

            $amount = (float)$query[0]->sales_amount;

            $sale = [sprintf("%02d", $i), $amount];
            array_push($monthlyRecord, $sale);
        }

        // yearly record
        $yearlyRecord = [];
        for ($i = 1; $i <= 12; $i++) {
            $yearMonth = $year . sprintf("%02d", $i);
            $query = DB::select("SELECT 
                    IFNULL(SUM(sm.total), 0 ) AS sales_amount
                    FROM orders sm
                    WHERE extract(year_month from sm.date) = ?
                    AND sm.status = 'delivery'", [$yearMonth]);


            $amount = (float)$query[0]->sales_amount;
            $monthName = date("M", mktime(0, 0, 0, $i, 10));

            $sale = [$monthName, $amount];
            array_push($yearlyRecord, $sale);
        }

        // top sold product
        $topSold = DB::select("SELECT
                        p.name AS product_name,
                        SUM(od.quantity) as qty
                    FROM order_details od
                    JOIN products p ON p.id = od.product_id
                    JOIN orders o ON o.id = od.order_id
                    WHERE o.status != 'cancel' AND o.status != 'pending'
                    GROUP BY product_name LIMIT 5");
        // top sold product
        $topCustomer = DB::select("SELECT
                            c.name,
                            ifnull(SUM(o.total), 0) as total_amount
                            FROM orders o
                            JOIN users c ON c.id = o.customer_id
                            WHERE c.customer_type = 'wholesale' 
                            AND o.status != 'pending' 
                            AND o.status != 'cancel'
                            GROUP BY name LIMIT 5");

        return response()->json([
            'today_order'       => $todayOrder,
            'month_order'       => $monthOrder,
            'year_order'        => $yearOrder,
            'today_sale_record' => $dayRecord,
            'month_sale_record' => $monthRecord,
            'year_sale_record'  => $yearRecord,
            'monthly_record'    => $monthlyRecord,
            'yearly_record'     => $yearlyRecord,
            'topSold'           => $topSold,
            'topCustomer'       => $topCustomer,
        ]);
    }


    // admin profile updated
    public function profileIndex()
    {
        $data = Auth::guard('admin')->user();
        return view("admin.profile", compact('data'));
    }

    public function profileUpdate(Request $request)
    {
        try {
            $admin = Auth::guard('admin')->user();
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                $validator = Validator::make($request->all(), [
                    "name"             => "required",
                    "username"         => "required|unique:admins,username," . $admin->id,
                    "email"            => "required|unique:admins,email," . $admin->id,
                    "old_password"     => "required",
                    "new_password"     => "required",
                    'confirm_password' => 'required_with:new_password|same:new_password'
                ]);
            } else {
                $validator = Validator::make($request->all(), [
                    "name"     => "required",
                    "username" => "required|unique:admins,username," . $admin->id,
                    "email"    => "required|unique:admins,email," . $admin->id,
                ]);
            }

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            $data = Admin::find($admin->id);
            if (!empty($request->old_password) || !empty($request->new_password) || !empty($request->confrim_password)) {
                if (Hash::check($request->old_password, $admin->password)) {
                    $data->password = Hash::make($request->new_password);
                } else {
                    return response()->json(["errors" => "Old password does not match"]);
                }
            }
            $data->name = $request->name;
            $data->username = $request->username;
            $data->email = $request->email;
            $data->save();
            return "Admin Profile Updated";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function imageUpdate(Request $request)
    {
        try {

            $admin = Auth::guard('admin')->user();

            $validator = Validator::make($request->all(), [
                "image" => "mimes:jpg,png,jpeg|dimensions:width=200,height=200"
            ], ["image.dimensions" => "Image dimension must be (200 x 200)"]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }
            $data = Admin::find($admin->id);
            $old = $data->image;

            if (!empty($old) && isset($old)) {
                if (File::exists($old)) {
                    File::delete($old);
                }
            }
            $data->image = $this->imageUpload($request, 'image', 'uploads/admins') ?? '';

            $data->save();
            return "Image Upload successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function AdminLogout()
    {
        Auth::guard("admin")->logout();
        return redirect("/");
    }
}
