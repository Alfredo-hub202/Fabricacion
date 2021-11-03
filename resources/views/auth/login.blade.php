@extends('layout.app')

@section('content')


<div class="row justify-content-center pt-5">
    <div class="col-auto border">
      <form method="POST" action= {{ route('login')}}>
        {{-- <form action=""> --}}
          {{ csrf_field() }}
      <div class="form-group {{$errors->has('email' ? 'has-error' : '')}}">
        <label for="exampleInputEmail1">Correo</label>
        <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Ingrese su Correo" value="{{old('email')}}" >
        {!! $errors->first('email', '<span class=" help-block alert alert-danger">:message</span>') !!}    

        <small id="emailHelp" class="form-text text-muted">Nunca compartiremos su correo electrónico con nadie más.
        </small>
      </div>
      <div class="form-group {{$errors->has('password' ? 'has-error' : '')}}">
        <label for="exampleInputPassword1">Constraseña</label>
        <input type="password" name="password" class="form-control" id="exampleInputPassword1" placeholder="Constraseña" >
        {!! $errors->first('password', '<span class="help-block">:message</span>') !!}
        
      </div>
      
      <div class="row justify-content-center py-5">

      <button type="submit" class="btn btn-primary ">Entrar</button>
  </div>
      
    </form>
    </div>
  
  </div>
</div>


@endsection
