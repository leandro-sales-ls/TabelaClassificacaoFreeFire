@extends('layouts.app', ['activePage' => 'classificacaoPartida', 'titlePage' => __('Classificação Partida')])

@section('content')

  
{{-- _____________________________________________________________________ --}}

<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Classificação do Time</h4>
          </div>
        <div class="card-body">
          <div class="table-responsive">
            <div class="container-fluid">

              
                <div class="form-group">
                  <label for="id_temporara">Temporada</label> 
                  <div class="container">
                    <div class="row">
                      <div class="col-8">
                        <select name="id_temporara" class="custom-select" required>
                          <option 
                            disabled 
                            selected 
                            value="{{$temporada->id}}">{{$temporada->nome_temporada}}
                          </option>
                        </select>
                      </div>
                    </div>

                   
                    <br>

                    <div class="row">
                        <div class="col-8">
                          <label for="id_partida">Partida</label> 
                          <select name="id_partida" class="custom-select" required>
                            <option 
                              disabled selected 
                              value="{{$partidas->id}}">
                              {{"Rodada nº ".$partidas->num_rodada}}
                            </option>
                          </select>
                        </div>

                      <div class="col-4">
                        <br>
                        {{-- <button type="submit" class="btn btn-primary">Proseguir</button> --}}
                      </div>
                    </div>
                  </div>
                </div>
           
              </div>
              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">
              Times participantes da temporada <b>{{$temporada->nome_temporada}}
            </b></h4>
              <p class="card-category"> RODADA Nº {{$partidas->num_rodada}}</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table">
                
                <thead class=" text-primary">
                  <th>
                    Nome da Guilda
                  </th>
                  <th>
                    Nome do Representante
                  </th>
                  <th>
                    Posição da rodada nº  <b>{{$partidas->num_rodada}}<b>
                  </th>
                  <th>
                    Quantidade de Kill
                  </th>
                  {{-- <th>
                    Ações
                  </th> --}}
                </thead>

                <tbody>
                    @foreach ($temporadaTime as $temp)
                      <tr>
                        <td> <img 
                          class="img-responsive img thumbnail" 
                          src="/storage/{{$temp->logo}}" > 
                          <span class="font-weight-bold">{{$temp->nome_time}}</span> 
                        </td>
                        <td> 
                          <span class="font-weight-bold">{{$temp->nome_representante}} </span>
                        </td>
                        
                        <td>
                          <select name="id_posicao" class="custom-select" required>
                            <option disabled selected>Posição do time</option>
                              @foreach ($pontoPosicao as $ponto)
                                <option value="{{$ponto->id}}">{{$ponto->posicao}}</option>
                              @endforeach
                          </select>
                        </td>
  
                        <td>
                          
                            <select name="qtd_kill" class="custom-select" required>
                              <option disabled selected>Quantidade de Kill</option>
                                @foreach ($qtd_kill as $qtd)
                                  <option value="{{$qtd}}">{{$qtd}}</option>
                                @endforeach
                            </select>
                          
                        </td>
  
                        {{-- <td> 
  
                            <input type="hidden" name="id_temporada_time" value="{{$temp->id}}">
                            <input type="hidden" name="id_partida" value="{{$partidas->id}}">
                            <input type="hidden" name="pontoPosicao" 
                              value="{{$txtpontoPosicao ? $txtpontoPosicao : $pontoPosicao}}">
  
                            <button type="submit" class="btn btn-success btn-sm">
                              <span class="material-icons">note_add</span>
                            </button> 

                        </td> --}}
                      </tr>                      
                    @endforeach 
                </tbody>
              </table>

              <br>

              <div class="form-group">
                <form action="classificacao-times" method="POST" enctype="multipart/form-data">
                  {{csrf_field()}}


                  <div class="form-group">
                    <button type="submit" class="btn btn-success ">
                      Salvar
                      <span class="material-icons">note_add</span>
                    </button> 
                  </div>
                </form> 
              </div>

            </div>
          </div>
        </div>
     
      

<style>
  img{
  background-color: #ddd;
  border-radius: 100%;
  height: 3rem;
  object-fit: cover;
  width: 3rem;  
}

</style>


@endsection

