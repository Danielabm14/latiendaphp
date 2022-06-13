@extends('layouts.principal')

@section('contenido')
    <form class="col s8" method="POST" action="{{ route('productos.store') }}"
    enctype="multipart/form-data">
      @csrf
      @if(session('mensajito'))
      <div class="row">
        <Strong>{{session('mensajito')}}</Strong>
      </div>
      @endif
        <div class="row">
            <div class="col s8">
                <h1 class="pink-text text-darken-2">Nuevo Producto</h1>
            </div>
        </div>
      <div class="row">
        <div class="input-field col s6">
          <input placeholder="Nombre del producto" 
             id="nombre" 
            type="text"
            class="validate"
            name="nombre">
            <label for="nombre">
             Nombre Del Producto</label>
             <strong>{{ $errors->first('nombre') }}</strong>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input id="descripcion" 
          type="text" 
          class="validate"
          name="desc">
          <label for="desc">
            descripcion</label>
            <strong class="purple-text text-darken">{{ $errors->first('desc') }}</strong>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s8">
          <input id="Precio"
           type="number"
            class="validate"
            name="precio">
          <label for="Precio">
              Precio</label>
              <strong class="cyan-text text-darken">{{ $errors->first('precio') }}</strong>
        </div>
      </div>
     <div class="row">
      <div class="col s8 input-field">
        <select name="marca" id="marca">
          <option value="">
            Elija la marca del producto
          </option>
          @foreach($marcas as $marca)
          <option value="{{ $marca->id }}">
            {{ $marca->nombre }}
          </option>
          @endforeach
        </select>
    <label>Elija Marca</label>
    <strong class="pink-text text-darken">{{ $errors->first('marca') }}</strong>
      </div>

     </div>
    <div class="row">
  <div class="col s8 input-field">
    <select name="categoria" id="categoria">
    <option value="">
            Elija la Categoria del producto
          </option>
      @foreach($categorias as $categoria)
      <option value="{{ $categoria->id }}">
        {{$categoria->nombre}}
      </option>
      @endforeach
    </select>
    <label>Elija Categoria</label>
    <strong class="purple-text text-darken-">{{ $errors->first('categoria') }}</strong>
  </div>
    </div>
    <div class="file-field input-field">
      <div class="btn">
        <span>Imagen</span>
        <input type="file" name="imagen" multiple>
      </div>
      <div class="file-path-wrapper">
        <input class="file-path validate" type="text" placeholder="Upload one or more files">
      </div>
    </div>
    <strong class="blue-text text-darken-">{{ $errors->first('imagen') }}</strong>
        </div>
        </div>
      
      <div class="row">
          <button class="btn waves-effect waves-light" type="" name="action">Guardar
            <i class="material-icons right"></i>
          </button>
        </div>
      </div>
    </form>
 
  @endsection