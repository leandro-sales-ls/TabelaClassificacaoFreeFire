@extends('layouts.app', ['activePage' => 'temporada', 'titlePage' => __('Editar Temporada')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/temporada"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Editar Temporada</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="{{ url('/temporada-update', ['id' => $temporada->id]) }}">
               
                {{csrf_field()}}
                <div class="form-group">
                  <label for="nome_temporada">Nome da Temporada</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="nome_temporada" 
                    name="nome_temporada" 
                    value="{{$temporada->nome_temporada}}"
                    required>
                </div>

                <div class="form-group">
                  <label for="num_max_partida">Número Máximo de Partidas</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="num_max_partida" 
                    name="num_max_partida" 
                    value="{{$temporada->num_max_partida}}"
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
@endsection