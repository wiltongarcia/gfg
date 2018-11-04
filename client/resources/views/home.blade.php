<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>GFG Store</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!-- Custom styles for this template -->
    <link href="css/dashboard.css" rel="stylesheet">
  </head>

  <body>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
      <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="/">GFG Store</a>
      <form method="get" class="w-100" accept-charset="utf-8">
        <input class="form-control form-control-dark w-100" type="text" name="q" placeholder="Search" aria-label="Search">
        
      </form>
      <ul class="navbar-nav px-3">
        <li class="nav-item text-nowrap">
          <a class="nav-link" href="#">Sign out</a>
        </li>
      </ul>
    </nav>

    <div class="container-fluid">
      <div class="row">
        <nav class="col-md-2 d-none d-md-block bg-light sidebar">
          <div class="sidebar-sticky">
            <ul class="nav flex-column">
              <li class="nav-item">
                <a class="nav-link active" href="/">
                  <span data-feather="home"></span>
                  Home <span class="sr-only">(current)</span>
                </a>
              </li>
            </ul>
          </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
          <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2">Products - {{$response->total}} Items</h1>
            <div class="btn-toolbar mb-2 mb-md-0">
              <div class="btn-group mr-2">
                @if (empty($query['orderDir']) || $query['orderDir'] != 'desc')
                <a class="btn btn-sm btn-secondary" href="{{route('home', array_merge($query, ['orderDir' => 'asc']))}}">ASC</a>
                <a class="btn btn-sm btn-outline-secondary" href="{{route('home', array_merge($query, ['orderDir' => 'desc']))}}">DESC</a>
                @else 
                <a class="btn btn-sm btn-outline-secondary" href="{{route('home', array_merge($query, ['orderDir' => 'asc']))}}">ASC</a>
                <a class="btn btn-sm btn-secondary" href="{{route('home', array_merge($query, ['orderDir' => 'desc']))}}">DESC</a>
                @endif
              </div>
              <button class="btn btn-sm btn-outline-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Sorting
              </button>
              <div class="dropdown-menu">
                <a class="dropdown-item" href="{{route('home', array_merge($query, ['order' => '_score']))}}">Most Relevant</a>
                <a class="dropdown-item" href="{{route('home', array_merge($query, ['order' => 'brand']))}}">Brand</a>
                <a class="dropdown-item" href="{{route('home', array_merge($query, ['order' => 'price']))}}">Price</a>
                <a class="dropdown-item" href="{{route('home', array_merge($query, ['order' => 'stock']))}}">Stock</a>
              </div>
            </div>
          </div>

          <div class="table-responsive">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Title</th>
                  <th>Brand</th>
                  <th>Price</th>
                  <th>Stock</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($response->data as $product)
                <tr>
                  <td>{{$product->title}}</td>
                  <td><a href="{{route('home', array_merge($query, ['filter' => 'brand:'.$product->brand]))}}">{{$product->brand}}</a></td>
                  <td>{{$product->price}}</td>
                  <td>{{$product->stock}}</td>
                </tr> 
                @endforeach
              </tbody>
            </table>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li class="page-item{{$response->current_page == 1 ? ' disabled' : ''}}">
                        <a class="page-link"
                            href="{{$response->prev_page_url}}">Previous</a>
                    </li>
                    <li class="page-item">
                        <a class="page-link" href="#">{{$response->current_page}}</a>
                    </li>
                    <li class="page-item{{$response->current_page == $response->last_page ? ' disabled' : ''}}">
                        <a class="page-link" href="{{$response->next_page_url}}">Next</a>
                    </li>
                    <li>
                      <button class="page-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Per Page
                      </button>
                      <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('home', array_merge($query, ['perPage' => '10']))}}">10</a>
                        <a class="dropdown-item" href="{{route('home', array_merge($query, ['perPage' => '50']))}}">50</a>
                        <a class="dropdown-item" href="{{route('home', array_merge($query, ['perPage' => '100']))}}">100</a>
                      </div>
                    </li>
                </ul>
            </nav>
          </div>
        </main>
      </div>
    </div>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <!-- Icons -->
    <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
    <script>
      feather.replace()
    </script>

    <script>
    </script>
  </body>
</html>
