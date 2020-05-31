@extends('layouts.app', ['activePage' => 'temporada', 'titlePage' => __('Temporada')])

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
            <h4 class="card-title ">Cadastrar Times na Temporada</h4>
            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">

              {{-- <h5>{{$temporada->nome_temporada}}</h5> --}}

              <form method="POST" action="{{ url('/temporada-time') }}">

                {{csrf_field()}}

                <input 
                  name="id_temporada" 
                  type="hidden" 
                  name="id_temporada" 
                  value="{{$temporada->id}}">

                <div class="form-group">
                  <select name="id_time" class="custom-select col-md-6" required>
                    <option disabled selected>Selecione um Time</option>

                    @foreach ($times as $time)
                      <option value="{{$time->id}}">{{$time->nome_time}}</option>
                    @endforeach

                  </select>
                  <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>

              </form>

              </div>
            </div>
          </div>
        </div>

        <div class="card">
          <div class="card-header card-header-primary">
          <h4 class="card-title ">Times participantes da temporada <b>{{$temporada->nome_temporada}}</b></h4>
            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">
                <table class="table table-hover table-sm">
                  <thead class=" text-primary"> 
                    <th>
                      Nome da Guilda
                    </th>
                    <th>
                      Nome do Representante
                    </th>
                    <th>
                      Ações
                    </th>
                  </thead>
                  <tbody>
                    @foreach ($temporadaTime as $item)
                      <tr>
                        <td> {{$item->logo.'-'.$item->nome_time}} </td>
                        <td> {{$item->nome_representante}} </td>
                        <td> 
                          <a href="{{ url('/temporada-time-delete', array('id' => $item->id, 'id_temporada' => $temporada->id)) }}">
                            <button class="btn btn-danger btn-sm">
                              <span class="material-icons">delete</span>
                            </button> 
                          </a>
                        </td>
                      </tr>                      
                    @endforeach
                  </tbody>
                </table>
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
</div>
@endsection