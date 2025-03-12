<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aplicação Simples</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h3>Cadastro de Usuários</h3>
            </div>
            
            <div class="card-body">
                <form id="userForm" class="mb-4">
                    <div class="row">
                        <div class="col-md-5">
                            <input type="text" id="name" class="form-control" placeholder="Nome" required>
                        </div>
                        <div class="col-md-5">
                            <input type="email" id="email" class="form-control" placeholder="E-mail" required>
                        </div>
                        <div class="col-md-2">
                            <button type="submit" class="btn btn-success w-100">Adicionar</button>
                        </div>
                    </div>
                </form>

                <div id="userList">
                    <!-- Lista de usuários será carregada aqui -->
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        // Carrega usuários ao carregar a página
        $(document).ready(function(){
            loadUsers();
        });

        // Envia formulário via AJAX
        $('#userForm').submit(function(e){
            e.preventDefault();
            $.post('users.php', {
                action: 'create',
                name: $('#name').val(),
                email: $('#email').val()
            }, function(){
                loadUsers();
                $('#name, #email').val('');
            });
        });

        // Função para carregar usuários
        function loadUsers(){
            $.get('users.php?action=read', function(data){
                $('#userList').html(data);
            });
        }
    </script>
</body>
</html>