@extends('layouts.app', ['activePage' => 'time', 'titlePage' => __('Cadastrar Time')])

@php
$errors
@endphp

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/time"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Time</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              
              <br>
              <form action="time-create" method="POST">
               
                {{csrf_field()}}
                <div class="form-group">
                  <label for="nome_time">Nome da Guilda</label>
                  <input type="text" class="form-control" id="nome_time" name="nome_time"  required>
                </div>

                <div class="form-group">
                  <input type="file" class="custom-file-input" id="logo" name="logo" lang="es">
                  <label class="custom-file-label" for="customFileLang">Selecionar a logo</label>
                </div>

                <br>
                <hr>
                <br>

                <div class="form-group">
                  <label for="nome_representante1">Nome Representante</label>
                  <input type="text" class="form-control" id="nome_representante" name="nome_representante" required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
                <div onLoad="md.showNotification('top','left')"></div>
              </form>

              

              @if ($errors == null)
              <div class="col-md-4">
                <div onchange="md.showNotification('top','left')">error</div>
              </div>
              @else
                <div onload="md.showNotification('top','right')"></div>
              @endif
              
            </div>
          </div>
        </div>
      </div>
      
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection