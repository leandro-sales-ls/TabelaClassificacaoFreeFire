@extends('layouts.app', ['activePage' => 'pontoPosicao', 'titlePage' => __('Editar Pontos por Posicao')])


@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="form-group">
          <a href="/ponto-posicao"><button class="btn btn-secondary">Voltar</button></a>
        </div>
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Editar Pontos por Posicao</h4>
            <p class="card-category"></p>
          </div>
          <div class="card-body">
            <div class="table-responsive">

              <br>
              <form action="{{ url('/ponto-posicao-update', ['id' => $pontoPosicao->id]) }}">
               
                {{csrf_field()}}
                <div class="form-group">
                  <label for="posicao">Posição</label>
                  <input type="text" class="form-control" id="posicao" name="posicao"
                  value="{{$pontoPosicao->posicao}}" required>
                </div>

                <div class="form-group">
                  <label for="pontos_posicao">Pontos</label>
                  <input type="text" class="form-control" id="pontos_posicao" name="pontos_posicao"
                value="{{$pontoPosicao->pontos_posicao}}" required>
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