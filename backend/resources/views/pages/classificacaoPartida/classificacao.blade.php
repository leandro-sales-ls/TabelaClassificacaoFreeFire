@push('head')
  <script src="{{ asset('/classificacaoPartida.js') }}" type="text/javascript" async="true" defer></script>
@endpush

@extends('layouts.app', ['activePage' => 'classificacaoPartida', 'titlePage' => __('Classificação Partida')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">

        </div>
        <div class="card">

          <div class="card-header card-header-primary">
            <h4 class="card-title ">Classificação do Time</h4>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">

                <form action="classificacao-partida" method="POST">
                
                  
                  {{csrf_field()}}
                  <div class="form-group">
                    <label for="id_temporada">Temporada</label> 
                    <div class="row">
                      <div class="col-8">
                        <select name="id_temporada" class="custom-select" required>
                          <option disabled selected>Selecione um Time</option>

                          @foreach ($temporadas as $temporada)
                            <option value="{{$temporada->id}}">{{$temporada->nome_temporada}}</option>
                          @endforeach

                        </select>
                      </div>
                      <div class="col">
                    
                        <button id="teste" name="teste" type="submit" class="btn btn-primary">Proseguir</button>
                  
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



