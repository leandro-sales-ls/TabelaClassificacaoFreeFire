@extends('layouts.app', ['activePage' => 'classificacaoTemporada', 'titlePage' => __('Table List')])

@section('content')
<div class="content">
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header card-header-primary">
            <h4 class="card-title ">Temporada</h4>
            {{-- <p class="card-category"> Here is a subtitle for this table</p> --}}
          </div>
          <div class="card-body">

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

      <div class="card">
        <div class="card-header card-header-primary">
          <h4 class="card-title ">Classificação Temporada </h4>
          <p class="card-category"> Rodada atual: </p>
        </div>
      <div class="card-body">
        <div class="table-responsive">
          <div class="container-fluid">
            <table class="table table-striped">
              <thead class=" text-primary">
                <th>
                 
                </th>
                <th>

                </th>
                <th>
                  
                </th>
                {{-- <th>Pontos Kill </th>
                <th>Pontos Kill </th>
                <th> Pontos Kill</th>
                <th> Pontos Kill</th> --}}
                <th> Pontos Kill</th>
                @php
                  $i = 1; 
                @endphp
                @foreach ($classificacao as $item)
                    <tr>

                      <td>
                        
                        <span class="font-weight-bold">{{$i}}</span>
                   
                      </td>
                    
                      

                      <td> 
                      <img 
                        class="img-responsive img thumbnail" 
                        src="/storage/{{$item->logo}}" > 
                        <span class="font-weight-bold">{{$item->nome_time}}</span>
                      </td>

                      {{-- <td> </td>
                      <td> </td>
                      <td> </td>
                      <td> </td> --}}
                      <td> </td>

                      <td> 
                        <span class="font-weight-bold">{{$item->soma_pontos_kill}} </span>
                      </td>

                      
          
                      </tr>
                      
                      @php
                          $i++;
                      @endphp
                    @endforeach
                
               
              </thead>
              <tbody>
                <tr>
                  {{-- @foreach ($collection as $item)
                      
                  @endforeach --}}
                </tr>
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

<style>
  img{
  background-color: #ddd;
  border-radius: 100%;
  height: 3rem;
  object-fit: cover;
  width: 3rem;  
}
.text-primary {
    color: #171717 !important;
}
</style>
@endsection