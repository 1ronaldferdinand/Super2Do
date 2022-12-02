<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Template • Todo</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="css/base.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" href="css/app.css">
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <section class="todoapp">
        <header class="header">
            <h1>Super2Do</h1>
            <form method="POST" action="/create" autocomplete="off">
                @csrf
                <div class="input-group">
                    <input type="text" class="new-todo" name="todo_name" placeholder="What needs to be done?" autofocus>
                </div>
            </form>
        </header>

        <section class="main">
            <input id="toggle-all" class="toggle-all" type="checkbox">
            <label for="toggle-all">Mark all as complete</label>
            <ul class="todo-list">
                @foreach ($data as $item)
                    <li id="{{$item['id']}}" class="{{ $item['todo_status'] }}">
                        <form id="form-todo">
                            <div class="view">
                                @method('PUT')
                                @csrf
                                @if ($item['todo_status'] == 'completed')
                                    <input onclick="mark({{$item['id']}})" class="toggle" type="checkbox" name="id" data-id="{{$item['id']}}" checked>
                                @else
                                    <input onclick="mark({{$item['id']}})" class="toggle" type="checkbox" name="id" data-id="{{$item['id']}}">
                                @endif
                                <label>{{ $item['todo_name'] }}</label>
                            </div>
                            <input class="edit" value="Create a TodoMVC template">
                        </form>
                        <form method="POST" action="/delete/{{$item['id']}}">
                            @csrf
                            <button data-id="{{$item['id']}}" class="destroy"></button>
                        </form>
                    </li>
                @endforeach
            </ul>
        </section>
        <footer class="footer">
				<span class="todo-count"><strong>0</strong> item left</span>
				<ul class="filters">
					<li>
						<a class="selected" href="#/">All</a>
					</li>
					<li>
						<a href="#/active">Active</a>
					</li>
					<li>
						<a href="#/completed">Completed</a>
					</li>
				</ul>
			    <button onclick="destroyall()" class="clear-completed">Clear completed</button>
			</footer>
    </section>
    
    <script src="js/app.js"></script>
    <script>
        function gethome(){
            window.location = '/';
        }

        // Fungsi Marking Todo
        function mark(id_todo){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'PUT',
                url: '/mark/' + id_todo,
                dataType: 'json',
                success: function(response){
                    gethome();
                }
            });
        }

        function destroyall(){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: '/destroyall',
                dataType: 'json',
                success: function(response){
                    gethome();
                }
            });
        }
    </script>
</body>
</html>