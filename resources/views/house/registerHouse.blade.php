<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="text-center">

    <div class="container text-center w-50 p-5 bg-danger">
        
        @if (Session::has("success"))
              <div class="alert-success">{{Session::get("success")}}</div>  
              @php
                   Session::forget('success') 
              @endphp
                 
        @endif

        <form action="{{ route('house.store') }}" method="post" class="text-center">
            @csrf 
              <div class="pt-2 text-center"><input class="form-control w-75" type="text" name="name" value="{{ old('name') }}">
                @if ($errors->has('name'))
                    <span class="text-white">{{$errors->first('name')  }}</span>
                @endif
            </div>
              <div class="pt-2 text-center"><input class="form-control w-75" type="tel" name="phone" value="{{ old('tel') }}">
                @if ($errors->has('phone'))
                <span class="text-white">{{$errors->first('phone')  }}</span>
                @endif
            </div>
              <div class="pt-2 text-center"><input class="form-control w-75" type="email" name="email" value="{{ old('email') }}">
                @if ($errors->has('email'))
                <span class="text-white">{{$errors->first('email')  }}</span>
                @endif
            </div>
             
              <button class="btn btn-primary" type="submit">Save</button>
                  
              </div>
        </form>
        <a class="nav-link" href="{{ asset("house/create") }}">create new house</a>
    </div>
    
</body>
</html>