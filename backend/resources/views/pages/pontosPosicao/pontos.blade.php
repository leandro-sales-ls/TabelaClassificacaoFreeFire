@extends('layouts.app', ['activePage' => 'pontoPosicao', 'titlePage' => __('Pontos por Posicao')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/ponto-posicao-create"><button class="btn btn-primary">Cadastrar</button></a>
          
        </div>
        <div class="card">
          
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Pontos por Posicao</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">
                <table class="table table-hover table-sm">
                  <thead class=" text-primary"> 
                    <th>
                      Temporada
                     </th>
                    <th>
                      Posição
                    </th>
                    <th>
                      Pontos
                    </th>
                    <th>
                      Ações
                    </th>
                  </thead>
                  <tbody>
                    @foreach ($pontoPosicao as $item)
                      <tr>
                        <td> {{$item->nome_temporada}} </td>
                        <td> {{$item->posicao}} </td>
                        <td> {{$item->pontos_posicao}} </td>
                        <td> 

                          <a href="{{ url('/ponto-posicao-edit', ['id' => $item->id]) }}">
                            <button class="btn btn-warning btn-sm">
                              <span class="material-icons">edit</span>
                            </button> 
                          </a>

                          <a href="{{ url('/ponto-posicao-delete', ['id' => $item->id]) }}">
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