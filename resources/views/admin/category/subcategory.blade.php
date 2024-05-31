@extends("layouts.backend_master")

@section("title", "Admin Subcategory")
@section("breadcrumb_title", "Subcategory")
@section("breadcrumb_item", "Subcategory Create")

@section("content")
<div class="col-12 col-lg-4">
    <div class="card">
        <div class="card-body">
            <form onsubmit="Store(event)">
                <input type="hidden" id="id" name="id">
                <div class="form-group">
                    <label for="name">Subcategory Name</label>
                    <input type="text" name="name" id="name" autocomplete="off" class="form-control shadow-none">
                    <span class="text-danger error error-name"></span>
                </div>
                <div class="form-group">
                    <label for="name">Category</label>
                    <select name="category_id" id="category_id" autocomplete="off" class="form-select shadow-none">
                        <option value="">Select Category</option>
                        @php
                        $category = App\Models\Category::get();
                        @endphp
                        @foreach($category as $d)
                        <option value="{{$d->id}}">{{$d->name}}</option>
                        @endforeach
                    </select>
                    <span class="text-danger error error-category_id"></span>
                </div>
                <div class="form-group">
                    <label for="image">Image</label>
                    <input type="file" name="image" autocomplete="off" class="form-control shadow-none" onchange="document.querySelector('.img').src = window.URL.createObjectURL(this.files[0])">
                    <span class="text-danger error error-image"></span>
                    <div class="text-left">
                        <img src="{{asset('noImage.jpg')}}" class="img" style="width: 30%;height: 85px;border: 1px solid #c1c1c1;margin-top: 5px;">
                    </div>
                </div>

                <div class="form-group text-center">
                    <button type="submit" class="btn btn-success shadow-none px-4 text-white changeBtn">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="col-12 col-lg-8">
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Category List</h5>
            <div class="table-responsive">
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Subcategory Name</th>
                            <th>Slug</th>
                            <th>Category</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push("js")
<script>
    //get Data
    var table = $('#datatable').DataTable({
        ajax: location.origin + "/admin/subcategory/fetch",
        order: [[ 0, "desc" ]],
        columns: [{
                data: 'id',
            },
            {
                data: 'name',
            },
            {
                data: 'slug',
            },
            {
                data: null,
                render: data => {
                    return data.category.name;
                }
            },
            {
                data: null,
                render: data => {
                    return `<img src='${data.image ? location.origin+'/'+data.image:location.origin+"/noImage.jpg"}' width='50' />`
                }
            },
            {
                data: null,
                render: data => {
                    return `
                            ${'<button type="button" onclick="Edit('+data.id+')" class="btn btn-primary shadow-none btn-sm">Edit</button>'}            
                            ${'<button type="button" onclick="Delete('+data.id+')" class="btn btn-danger shadow-none btn-sm">Delete</button>'}
                        `;
                }
            }
        ],
    });

    function Store(event) {
        event.preventDefault();
        var formdata = new FormData(event.target)
        $.ajax({
            url: location.origin + "/admin/subcategory",
            method: "POST",
            data: formdata,
            processData: false,
            contentType: false,
            beforeSend: () => {
                $(".error").text("")
            },
            success: res => {
                if (!res.error) {
                    $.notify(res, "success");
                    $("form").trigger("reset")
                    $("#id").val("");
                    $(".changeBtn").text("Save").addClass("btn-success").removeClass("btn-primary");
                    document.querySelector('.img').src = location.origin + "/noImage.jpg"
                    table.ajax.reload()
                } else {
                    $.each(res.error, (index, value) => {
                        $(".error-" + index).text(value);
                    })
                }
            }

        })
    }

    function Edit(id) {
        $(".changeBtn").text("Update").removeClass("btn-success").addClass("btn-primary");
        $.ajax({
            url: location.origin + "/admin/subcategory/fetch/" + id,
            method: "GET",
            dataType: "JSON",
            success: res => {
                $.each(res.data, (index, value) => {
                    $("form").find("#" + index).val(value);
                })
                if (res.data.image != null) {
                    document.querySelector('.img').src = location.origin + "/" + res.data.image
                } else {
                    document.querySelector('.img').src = location.origin + "/noImage.jpg"
                }
            }
        })
    }

    function Delete(id) {
        if (confirm("Are you sure want delete this !")) {
            $.ajax({
                url: location.origin + "/admin/subcategory/delete/",
                method: "POST",
                data: {
                    id: id
                },
                success: res => {
                    $.notify(res, "success");
                    table.ajax.reload()
                }
            })
        }
    }
</script>
@endpush