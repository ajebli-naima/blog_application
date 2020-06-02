@extends('layouts.app')

@section('content')
    <h1>Edit {{ $user->name }} Profile </h1>
   
    
    {!! Form::open(['action' => ['Admin\UserController@update', $user->id], 'method' => 'POST']) !!}
    <div class="form-group">
        {{Form::label('name', 'Name')}}
        {{Form::text('name', $user->name, ['class' => 'form-control', 'placeholder' => 'Text'])}}
    </div>
    <div class="form-group">
        {{Form::label('email', 'Email')}}
        {{Form::text('email', $user->email, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Text'])}}
    </div>
   
    <div class="form-group">
        {{Form::label('roles', 'Roles')}}
             @foreach($roles as $role)
                <div class="form-check">
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"
                    @if($user->roles->pluck('id')->contains($role->id)) checked @endif>
                    <label>{{ $role->name }}</label>
                </div>
            @endforeach
   
        </div>
    {{Form::hidden('_method','PUT')}}
    {{Form::submit('Submit', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
  

@endsection
