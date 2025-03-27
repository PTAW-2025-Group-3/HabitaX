@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1 class="display-4 text-center">Sobre Nós</h1>
                <p class="lead text-center">Somos uma empresa apaixonada por tecnologia e inovação. Acreditamos que podemos transformar o futuro com soluções criativas e eficazes.</p>
                <p class="text-center">Nossa missão é fornecer serviços de alta qualidade, sempre com um compromisso com a satisfação do cliente. Estamos aqui para resolver problemas e oferecer as melhores soluções!</p>

                <!-- Botão centralizado -->
                <div class="text-center mt-4">
                    <a href="{{ url('/') }}" class="btn btn-primary btn-lg">Voltar</a>
                </div>
            </div>
        </div>
    </div>
@endsection
