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
            <form method="POST" autocomplete="off">
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
                        <form id="form-todo" action="POST">
                            <div class="view">
                                @method('PUT')
                                @csrf
                                <input class="toggle" type="checkbox" name="id" data-id="{{$item['id']}}">
                                <label>{{ $item['todo_name'] }}</label>
                                @method('DELETE')
                                @csrf
                                <button data-id="{{$item['id']}}" class="destroy"></button>
                            </div>
                            @method('PUT')
                            @csrf
                            <input class="edit" value="Create a TodoMVC template">
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
				<button class="clear-completed">Clear completed</button>
			</footer>
    </section>
    
    <script src="js/app.js"></script>
    <script>
        function gethome(){
            window.location = 'todo';
        }

        // Fungsi Create todo
        function create(){
            let todo_name = $('#todo_name').val();

            var data = {
                'todo_name': todo_name,
            }

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: 'create',
                dataType: 'json',
                data: data,
                success: function(data){
                    if(data.status == 200){
                        $('#todo_name').val('');
                        gethome();
                    }
                }
            });
        }

        // Fungsi Marking Todo
        function mark(id_todo){
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: 'POST',
                url: "{{ route('mark', "+id_todo+") }}",
                dataType: 'json',
                success: function(response){
                    if(response == 200){
                        console.log(data);
                        gethome();
                    }
                }
            });
        }

        //Fungsi Destroy todo
        $('body').on('click', '.destroy', function(e) {
            if(confirm('Are you sure?')){
                var id = $(this).data('id');
                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    type: 'DELETE',
                    url: 'destroy/' + id,
                });
                gethome();
            }
        });
    </script>
</body>
</html>