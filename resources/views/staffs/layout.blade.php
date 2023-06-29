<!DOCTYPE html>
<html>
<head>
    <title>Inventory Management App</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.css" rel="stylesheet">
    <style>
        ul {
          list-style-type: none;
          margin: 0;
          padding: 0;
          overflow: hidden;
          background-color: #333;
        }
        
        li {
          float: left;
        }
        
        li a {
          display: block;
          color: white;
          text-align: center;
          padding: 14px 16px;
          text-decoration: none;
        }
        
        li a:hover:not(.active) {
          background-color: #111;
        }
        
        .active {
          background-color: #04AA6D;
        }
        </style>
</head>
<body>
    <ul>
      <li><a class="active" href="{{ route('staffs.index') }}">Staff</a></li>
        <li><a href="{{ route('products.index') }}">Product</a></li>
        <li><a href="{{ route('merchandisers.index') }}">Merchandiser</a></li>
        <li><a href="{{ route('orders.index') }}">Order</a></li>
        <li><a href="{{ route('disposedproducts.index') }}">Disposed Product</a></li>
      </ul>

<div class="container">
    <br>
    @yield('content')
</div>

</body>
</html>