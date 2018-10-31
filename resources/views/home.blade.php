@extends('template')

@section('content')
    <div class="banner-container" id="banner">
        <div class="banner-image">
            <h2>Sismolog&iacute;a</h2>
            <img src="/img/baner.jpg" alt="">
        </div>
    </div>

    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand">Sismolog&iacute;a</a>
            </div>

            <div class="collapse navbar-collapse">
                <form class="navbar-form navbar-left" id="form-search" action="/search.php" method="get">
                    <div class="form-group form-group-sm">
                        <input class="form-control" name="minmagnitude" placeholder="Magnitud" value="5.5">
                    </div>
                    <div class="form-group form-group-sm">
                        <input class="form-control" name="starttime" placeholder="Fecha inicial"
                               value="2014-02-01">
                    </div>
                    al
                    <div class="form-group form-group-sm">
                        <input class="form-control" name="endtime" placeholder="Fecha final"
                               value="2014-01-01">
                    </div>
                    <button type="submit" class="btn btn-default btn-sm">Buscar</button>
                </form>
            </div>
        </div>
    </nav>

    <div class="container">
        <div class="panel panel-default">
            <table class="table table-condensed">
                <thead>
                <tr>
                    <th></th>
                    <th>Lugar</th>
                    <th>Magnitud</th>
                    <th>Fecha</th>
                </tr>
                </thead>
                <tbody id="table-search"></tbody>
            </table>
        </div>
    </div>

@endsection