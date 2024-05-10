@extends('layouts.app')

@section('content')
    {{-- register section start --}}
    <div class="card mb-3">

        <div class="card-body">

            <div class="pt-4 pb-2">
                <h5 class="card-title text-center pb-0 fs-4">Create an Account</h5>
                <p class="text-center small">Enter your personal details to create account</p>
            </div>

            <form method="POST" action="{{ url('register_post') }}" enctype="multipart/form-data">
                {{ csrf_field() }}


                <div class="col-12">
                    <label for="yourName" class="form-label">First Name</label>
                    <input type="text" name="name" class="form-control" id="yourName" required
                        value="{{ old('name') }}">
                    <div class="invalid-feedback">Please, enter your First Name!</div>
                </div>

                <div class="col-12">
                    <label for="yourLast" class="form-label">Last name</label>
                    <input type="text" name="last_name" class="form-control" id="yourLast" required
                        value="{{ old('last_name') }}">
                    <div class="invalid-feedback">Please enter your Last Name!</div>
                </div>

                <div class="col-12">
                    <label for="yourUsername" class="form-label">Email</label>
                    <div class="input-group has-validation">
                        <span class="input-group-text" id="inputGroupPrepend">@</span>
                        <input type="email" name="email" class="form-control" id="yourUsername" required
                            value="{{ old('email') }}">
                        <div class="invalid-feedback">Please Enter a valid email Address!</div>
                    </div>
                    <span style="color: red;">{{ $errors->first('email') }}</span>
                </div>

                <div class="col-12">
                    <label for="yourPassword" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="yourPassword" required>
                    <span style="color: red;">{{ $errors->first('password') }}</span>
                    <div class="invalid-feedback">Please enter your password!</div>
                </div>



                <div class="col-12">
                    <label for="yourPhoto" class="form-label">Upload Photo</label>
                    <input type="file" name="photo" class="form-control" id="yourPhoto" required>
                    <div class="invalid-feedback">Please upload your photo!</div>
                </div>

                <div class="col-12">
                    <label for="cardInfo" class="form-label">Card Information</label>
                    <input type="text" name="card_info" class="form-control" id="cardInfo" required
                        placeholder="Enter card details">
                    <div class="invalid-feedback">Please enter your card information!</div>
                </div>
                <br>
                <div class="col-12">
                    <button class="btn btn-primary w-100" type="submit">Create Account</button>
                </div>
                <div class="col-12">
                    <p class="small mb-0">Already have an account? <a href="{{ url('/') }}">Log in</a></p>
                </div>
            </form>

        </div>
    </div>
    {{-- register section end --}}
@endsection
