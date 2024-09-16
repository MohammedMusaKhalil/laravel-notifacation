@extends('Admin.layouts.admin')
@section('content')
    <form action="{{route('admin.login')}}" method="POST">
        @csrf
        <h1 class="h3 mb-3 fw-normal">Admin Login</h1>

        <div class="form-floating">
            <input type="email" name="email" :value="old('email')" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email address</label>
            <x-input-error :messages="$errors->get('email')" class="mt-2 text-start text-denger small" />
        </div>
        <div class="form-floating">
            <input type="password" name="password" class="form-control" id="floatingPassword" placeholder="Password">
            <label for="floatingPassword">Password</label>
            <x-input-error :messages="$errors->get('password')" class="mt-2  text-start text-denger small" />
        </div>

        <div class="checkbox mb-3">
            <label>
                <input type="checkbox" name="remember-me" value="remember-me"> Remember me
            </label>
        </div>
        <button class="w-100 btn btn-md btn-primary" type="submit">Sign in</button>
        <p class="mt-5 mb-3 text-muted">&copy; 2017–2022</p>
    </form>
@endsection  
   