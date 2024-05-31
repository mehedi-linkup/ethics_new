@extends("layouts.fronted_master")
@section("title", " - Membership Application")
@section("content")

<section id="membership-application" class="content-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 offset-lg-2">

                <div class="membership-application" style="text-align: justify;">
                    <div class="title-section">
                        <h1>Membership Application</h1>
                    </div>

                    <p>Here you can apply for membership by fill up the form bellow_</p>

                    <form class="personal-information" action="{{ route('membership.application.store') }}">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 mb-lg-3">
                                <div class="billing-info">
                                    <label>Name</label>
                                    <input type="text" value="" autocomplete="off" class="form-control" />
                                    <span class="text-danger error error-name"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-lg-3">
                                <div class="billing-info">
                                    <label>Mobile</label>
                                    <input type="text" value="" autocomplete="off" class="form-control" />
                                    <span class="text-danger error error-mobile"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-lg-3">
                                <div class="billing-info">
                                    <label>Email Address</label>
                                    <input type="text" value="" autocomplete="off" class="form-control" />
                                    <span class="text-danger error error-email"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-lg-3">
                                <div class="billing-info">
                                    <label>Postcode / ZIP</label>
                                    <input type="text" name="postcode" autocomplete="off" class="form-control" />
                                    <span class="text-danger error error-postcode"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 mb-lg-3">
                                <div class="billing-info">
                                    <label>Address</label>
                                    <input type="text" value="" name="address" placeholder="" autocomplete="off" class="form-control" />
                                    <span class="text-danger error error-address"></span>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-lg-3">
                                <div class="billing-info">
                                    <label>Write us something</label>
                                    <textarea value="" name="note" placeholder="" autocomplete="off" class="form-control"></textarea>
                                    <span class="text-danger error error-note"></span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 offset-lg-6 offset-md-6">
                                <div class="" style="float:right">
                                  <button type="submit" class="btn btn-danger">Submit</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection