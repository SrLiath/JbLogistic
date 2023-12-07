<!DOCTYPE html>
<html lang="pt-br">

<head>

<meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <html lang="en" dir="ltr">
    <meta charset="UTF-8">
    <link rel="icon" href="favicon.png" type="image/png">  
    <!-- Fontawesome CDN Link -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>JB Logistica</title>
    
 	<!-- Link para Bootstrap -->
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<!-- Link para jQuery -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
	<!-- Link para Bootstrap JS -->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
</head>

  <body style="background-color: #394357;">

   
     <!--header-->
     <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="<?= base_url(); ?>" style="text-decoration:none"><em>JB</em> Logistica</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="<?= base_Url(); ?>" class="external">Inicial</a></li>
        <li class="menu"><a href="<?= base_Url(); ?>">Sobre nós</a>
        </li>
        <li><a href="<?= base_Url(); ?>" >Contato</a></li>
        <li><a href="<?= base_Url('rastreio'); ?>" class="external">Rastreio</a></li>
        <li class="has-submenu"><a href="<?= base_Url('login'); ?>" class="external">Postar</a>
          <ul class="sub-menu">
            <li><a href="<?= base_Url('login'); ?>" class= "external">Login</a></li>
            <li><a href="<?= base_Url(); ?>" >Como fazer?</a></li>
          </ul>
        </li>
      </ul>

    </nav>
  </header>

  <!-- ***** Main Banner Area Start ***** -->
             
<!-- Popup -->
<div class="modal fade" id="myModal" role="dialog">
  <div class="modal-dialog">

    <!-- Conteúdo do Popup -->
    <div class="modal-content" style="top: 30vh;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="left: 3vh;position: absolute;">Pedidos</h4>
      </div>
      <div class="modal-body">
        <table class="table">
          <thead>
            <tr>
              <th>Status</th>
            </tr>
          </thead>
          <tbody id="pedidos">
          </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>
<center>
<!-- Formulário e botão de envio -->
<div class="input-group mb-3" style="left: -5vw;width: 65%;top: 46vh;">
  <form id="formCodigo">
    <input type="text" class="form-control" placeholder="Insira o código" aria-label="Insira o código" aria-describedby="basic-addon2" id="codigo" required="">
    <div class="input-group-append">
      <button class="btn" type="submit" onclick="abrirPopup()" style="position: absolute;left: 65vw;bottom: 0vh; ">Confirmar</button>
    </div>
  </form>
</div><
</center>
<script src="assets/js/rastreio.js">
    </script>
</body>
</html>
