@extends('layouts.app', ['activePage' => 'partida', 'titlePage' => __('Cadastrar Partida')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/partida"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Cadastrar Partida</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="{{ url('/partida-update', ['id' => $partida[0]->id]) }}">
               
                {{csrf_field()}}
                <div class="form-group">
                  <label for="num_rodada">Nome da Guilda</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="num_rodada" 
                    name="num_rodada" 
                    value="{{$partida[0]->num_rodada}}"
                    required>
                </div>

                <div class="form-group">
                  <label for="nome_representante1">Nome Representante</label>
                  <input 
                    type="text" 
                    class="form-control" 
                    id="id_temporada" 
                    name="id_temporada" 
                    value="{{$partida[0]->id_temporada}}"
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