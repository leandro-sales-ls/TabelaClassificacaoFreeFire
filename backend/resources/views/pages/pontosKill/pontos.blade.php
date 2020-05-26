@extends('layouts.app', ['activePage' => 'pontoKill', 'titlePage' => __('Pontos por Kill')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/ponto-kill-create"><button class="btn btn-primary">Cadastrar</button></a>
          
        </div>
        <div class="card">
          
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Pontos por Kill</h4>
            <p class="card-category"> Here is a subtitle for this table</p>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <div class="container-fluid">
                <table class="table table-hover table-sm">
                  <thead class=" text-primary"> 
                    <th>
                      Número de Kill
                    </th>
                    <th>
                      Pontos
                    </th>
                    <th>
                      Ações
                    </th>
                  </thead>
                  <tbody>
                    @foreach ($pontoKill as $item)
                      <tr>
                        <td> {{$item->num_kill}} </td>
                        <td> {{$item->ponto_kill}} </td>
                        <td> 

                          <a href="{{ url('/ponto-kill-edit', ['id' => $item->id]) }}">
                            <button class="btn btn-warning btn-sm">
                              <span class="material-icons">edit</span>
                            </button> 
                          </a>

                          <a href="{{ url('/ponto-kill-delete', ['id' => $item->id]) }}">
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