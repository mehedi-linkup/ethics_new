<?php

namespace App\Http\Controllers;

use App\Thana;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Slider;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Category;
use App\Models\Technician;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {
        // $newarrival_product = DB::select("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id where p.is_arrival = 1");
        // $feature_product    = DB::select("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id where p.is_feature = 1");
        // $popular_product    = DB::select("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id where p.is_popular = 1");
        // $topsold_product    = DB::select("SELECT p.*, c.name as category_name FROM products p LEFT JOIN categories c ON c.id = p.category_id where p.is_topsold = 1");
        // $banner             = DB::select("SELECT b.* FROM banners b ORDER BY b.id DESC");
        // $blog               = Blog::all();
        // $slider             = Slider::latest()->get();
        // $categories         = Category::with('product')->orderBy("name", "ASC")->get();
        // $brands             = Brand::with('product')->orderBy("name", "ASC")->get();
        // $technician         = Technician::where('status', '!=' ,'p')->orderBy('id', "DESC")->get();
        // $isWebsiteCategoryProduct = Category::with('subcategory')->get();
        return view('website');
    }

  
    public function ethicsWork() {
        return view('website.about.ethics-work');
    }

    public function organizationalOverview() {
        return view('website.about.organizational-overview');
    }

    public function guidingPrinciple() {
        return view('website.about.guiding-principle');
    }

    public function becomeMember() {
        return view('website.membership.become-member');
    }

    public function joinEthics() {
        return view('website.membership.join-ethics');
    }

    public function ethicsCountries() {
        return view('website.membership.ethics-countries');
    }

    public function membershipCancellation() {
        return view('website.membership.membership-cancellation');
    }
    public function membershipFee() {
        return view('website.membership.membership-fee');
    }
    public function memberResponsibilities() {
        return view('website.membership.member-responsibilities');
    }
    public function membershipApplication() {
        return view('website.membership.membership-application');
    }
    public function membershipDirectory() {
        return view('website.membership.membership-directory');
    }

    public function privacyPolicy() {
        return view('website.policy.privacy');
    }
    public function disclaimerPolicy() {
        return view('website.policy.disclaimer');
    }


    public function Publisher() {
        return view('website.code.publisher');
    }
    public function researcherMember() {
        return view('website.code.researcher-member');
    }
    public function researcherOverview() {
        return view('website.code.researcher-overview');
    }

    public function testimonialWrite() {
        return view('website.testimonial.write');
    }

    // Product
    public function ProductShow()
    {
        if (isset($_GET['sortBy']) && $_GET['sortBy'] == "ascending") {
            $product = Product::orderBy('name', 'ASC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "descending") {
            $product = Product::orderBy('name', 'DESC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "low-high") {
            $product = Product::orderBy('selling_rate', 'ASC')->paginate(25);
        } else if (isset($_GET['sortBy']) && $_GET['sortBy'] == "high-low") {
            $product = Product::orderBy('selling_rate', 'DESC')->paginate(25);
        } else {
            $product = Product::paginate(25);
        }

        $categories = Category::with('product')->get();
        $brands     = Brand::with('product')->get();
        return view("product", compact('product', 'brands', 'categories'));
    }

    // single product
    public function singleProductShow($slug = null)
    {
        $product = Product::where("slug", $slug)->first();
        return view("single-product", compact('product'));
    }

    public function blog()
    {
        $blog = Blog::orderBy('id', "DESC")->paginate(24);
        return view('blog', compact("blog"));
    }

    public function technician()
    {
        $technician = Technician::where('status', '!=' ,'p')->orderBy('id', "DESC")->paginate(24);
        return view('technician', compact("technician"));
    }

    public function technicianDetails($id)
    {
        $technician = Technician::with('district', 'upazila')->find($id);
        return view('technician-details', compact("technician"));
    }

    public function contact()
    {
        return view('contact');
    }


    public function getUpazila($id)
    {
        return Thana::where("district_id", $id)->orderBy("name", "ASC")->get();
    }

    public function fetch()
    {
        return Setting::first();
    }
}
