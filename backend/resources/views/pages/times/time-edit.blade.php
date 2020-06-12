@extends('layouts.app', ['activePage' => 'time', 'titlePage' => __('Editar Time')])


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
            <h4 class="card-title ">Editar Time</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <br>
              <form method="POST" action="/time-update/{{$time->id}}"  enctype="multipart/form-data">
               
                {{csrf_field()}}
                <input type="hidden" name="_method" value="PUT">
                <div class="form-group">
                  <label for="nome_time">Nome da Guilda</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="nome_time" 
                    name="nome_time" 
                    value="{{$time->nome_time}}"
                    required>
                </div>

                <div class="form-group">

                  {{-- <div class="custom-file"> --}}
                    <div class="container">

                      <div class="row">
                        <div class="col col-lg-2">
                          <img 
                          class="img-responsive img thumbnail" 
                          src="/storage/{{$time->logo}}" > 
                        </div>
                        <div class="col col-lg-8">
                          <div class="custom-file">
                            <input type="file" class="custom-file-input" id="logo" name="logo" required>
                            <label class="custom-file-label" for="logo">Selecione</label>
                          </div>
                        </div>
                      </div>   
                 
                    </div>
   
                  </div>
                {{-- </div> --}}

                {{-- <br> --}}
                <hr>
                <br>

                <div class="form-group">
                  <label for="nome_representante1">Nome Representante</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="nome_representante" 
                    name="nome_representante" 
                    value="{{$time->nome_representante}}"
                    required>
                </div>

                <div class="form-group">
                  <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
      
              </form>

              
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

<style>
  img{
  background-color: #ddd;
  border-radius: 100%;
  height: 4rem;
  object-fit: cover;
  width: 4rem;  
}
</style>

@endsection