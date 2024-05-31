<?php

namespace App\Http\Controllers\Admin;

use Carbon\Carbon;
use App\Models\Slider;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view("admin.slider.index");
    }

    public function fetch($id = null)
    {
        if ($id != null) {
            $data = Slider::find($id);
        } else {
            $data = Slider::get();
        }
        return response()->json(["data" => $data]);
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                "title" => "required",
            ]);

            if ($validator->fails()) {
                return response()->json(["error" => $validator->errors()]);
            }

            if (!empty($request->id)) {
                $data             = Slider::find($request->id);
                $old              = $data->image;
                $data->updated_at = Carbon::now();
            } else {
                $data = new Slider();
                $data->created_at = Carbon::now();
            }

            $data->title       = $request->title;
            $data->description = $request->description;
            $data->using_by    = $request->using_by;
            if ($request->hasFile("image")) {
                if (isset($old) && $old != "") {
                    if (File::exists($old)) {
                        File::delete($old);
                    }
                }
                $data->image = $this->imageUpload($request, 'image', 'uploads/sliders') ?? '';
            }
            $data->save();

            if (!empty($request->id)) {
                return "Slider updated successfully";
            } else {
                return "Slider insert successfully";
            }
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }

    public function destroy(Request $request)
    {
        try {
            $data = Slider::find($request->id);
            $old  = $data->image;
            if (File::exists($old)) {
                File::delete($old);
            }
            $data->delete();
            return "Slider Delete successfully";
        } catch (\Throwable $e) {
            return "Something went wrong";
        }
    }
}
