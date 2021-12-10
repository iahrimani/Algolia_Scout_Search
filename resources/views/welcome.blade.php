<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Laravel Algolia Scout - пример полнотестового поиска</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
</head>

<body>


<div class="container mt-5">
    <h3 class="text-center">Laravel Algolia Scout - пример полнотестового поиска</h3>
    <br>
    <br>
    <form method="POST" action="{{ route('createProduct') }}" autocomplete="off">
        @if(count($errors))
            <div class="alert alert-danger">
                <strong>УПС !</strong> Ошибка
                <br/>
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


        <input type="hidden" name="_token" value="{{ csrf_token() }}">

        <div class="row">
            <div class="col-md-6">
                <div class="form-group {{ $errors->has('product_name') ? 'has-error' : '' }}">
                    <input type="text" id="product_name" name="product_name" class="form-control"
                           placeholder="Enter Name" value="{{ old('product_name') }}">
                    <span class="text-danger">{{ $errors->first('product_name') }}</span>
                </div>
            </div>
            <div class="col-md-6">
                <div class="form-group">
                    <button class="btn btn-outline-danger">Добавить продукт</button>
                </div>
            </div>
        </div>
    </form>

    <div class="panel panel-primary mt-4">
        <div class="panel-heading mb-2"><strong>Наименование продукта:</strong></div>
        <div class="panel-body">
            <form method="GET" action="{{ route('products') }}">


                <div class="row mb-5">
                    <div class="col-md-6">
                        <div class="form-group">
                            <input type="text" name="product_search" class="form-control"
                                   placeholder="Search by name" value="{{ old('product_search') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <button class="btn btn-success">Поиск</button>
                        </div>
                    </div>
                </div>
            </form>

            <table class="table text-center">
                <thead>
                <th>№</th>
                <th>Имя</th>
                <th>Дата создания</th>
                <th>Дата обновления</th>
                </thead>
                <tbody>
                @if($products->count())
                    @foreach($products as $key => $product)
                        <tr>
                            <td>{{ ++$key }}</td>
                            <td>{{ $product->product_name }}</td>
                            <td>{{ $product->created_at }}</td>
                            <td>{{ $product->updated_at }}</td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4">Продукты отсутствуют</td>
                    </tr>
                @endif
                </tbody>
            </table>
            {{ $products->links() }}
        </div>
    </div>


</div>
</body>

</html>
