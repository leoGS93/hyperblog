
@extends('dashboard.master')

@section('content')

<div class="row">

    <div class="col-12">
        <ol class="breadcrumb-arrow">
            <li><a href="{{ route("dashboard.home") }}"><i class="fa fa-fw fa-home"></i></a></li>
            <li class=""><a href="{{ route("noticia.index") }}">Noticias</a></li>
            <li class="active"><span>{{$noticia->url_clean}}</span></li>
        </ol>
    </div>
</div>
<div class="card content_d">
    <div class="card-body">
        <div class="container">
        
            <div class="card mb-3">
                <div class="row no-gutters">
                  <div class="col-md-5">
                    <img src="https://recursossp.s3.us-east-2.amazonaws.com{{$noticia->url }}" class="card-img" alt="...">
                  </div>
                  <div class="col-md-7">
                    <div class="card-body">
                      <h5 class="card-title">{{$noticia->titNoticia}}</h5>
                      <p class="card-text">{{$noticia->desCorta}}</p>
                      <p class="card-text">{!! $noticia->desNoticia !!}</p>
                     

                      <p class="card-text"><small class="text-muted">PUBLICADO:  {{$noticia->updated_at->isoFormat('LLLL')}}</small></p>
                      <a href="{{ route('noticia.edit',$noticia->id_noticia) }}" class="btn btn-primary">Actualizar</a>
                    </div>
                  </div>
                </div>
              </div>
        </div>
        
    </div>
</div>

@endsection

