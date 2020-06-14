@extends('layouts.app', ['activePage' => 'classificacaoPartida', 'titlePage' => __('Classificação Partida')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/classificacao"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="form-group">

        </div>
        <div class="card">

          <div class="card-header card-header-primary">
            <h4 class="card-title ">Classificação do Time</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">

                <form action="classificacao-partida-times" method="POST">

                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="id_temporada">Temporada</label> 
                    <div class="container">
                      <div class="row">
                        <div class="col-8">
                          <select name="id_temporada" class="custom-select" required>
                            <option 
                              disabled 
                              selected 
                              value="{{$temporada->id}}">{{$temporada->nome_temporada}}
                            </option>
                          </select>
                        </div>
                      </div>

                      <input type="hidden" name="id_temporada" value="{{$temporada->id}}">
                      <br>

                      <div class="row">
                          <div class="col-8">
                            <label for="id_partida">Partida</label> 
                            <select name="id_partida" class="custom-select" required>
                              <option disabled selected>Selecione um Time</option>
                              @foreach ($partidas as $partida)
                                <option value="{{$partida->id}}">{{"Rodada nº ".$partida->num_rodada}}</option>
                              @endforeach
                            </select>
                          </div>

                        <div class="col-4">
                          <br>
                          <button type="submit" class="btn btn-primary">Proseguir</button>
                        </div>
                      </div>
                    </div>
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


@endsection
