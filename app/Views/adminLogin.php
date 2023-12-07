<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <title>Login</title>
    <style>
        body {
            background-color: #f0f5f9; /* Cor de fundo pastel */
        }

        .login-container {
            max-width: 400px;
            margin: auto;
            margin-top: 100px;
            padding: 20px;
            background-color: #fff; /* Cor de fundo da caixa de login */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .login-container h2 {
            text-align: center;
            color: #3498db; /* Cor do cabeçalho pastel */
        }

        .login-container form {
            margin-top: 20px;
        }

        .login-container button {
            background-color: #3498db; /* Cor do botão pastel */
            color: #fff; /* Cor do texto do botão */
        }
    </style>
</head>
<body>

    <div class="login-container">
        <h2>JB</h2>
            <div class="form-group">
                <label for="username">Usuario:</label>
                <input type="text" class="form-control" id="username" placeholder="Usuario">
            </div>
            <div class="form-group">
                <label for="password">Senha:</label>
                <input type="password" class="form-control" id="password" placeholder="Senha">
            </div>
            <button type="submit" id="confirm" class="btn btn-primary btn-block">Login</button>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $('#confirm').click(function(){
            $.ajax({
            url: "<?= base_Url('admin/login'); ?>",
            type: 'POST',
            data: {
              user : $('#username').val(),
              password : $('#password').val()
            },
            success: function(response) {
                if(response == '1'){
                    location.reload()
                }else{
                    alert('usuario e senha invalida')
                }
            },
            error: function(xhr, status, error) {
                console.error("Erro na solicitação AJAX. Status: " + xhr.responseText);

            }
            })
        })
    </script>
</body>
</html>
