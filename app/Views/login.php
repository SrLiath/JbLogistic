<!DOCTYPE html>
<html lang="pt-br">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="favicon.png" type="image/png">  
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>JB Logistica</title>
    

    <link rel="stylesheet" href="assets/css/lr.css">
        <!-- Additional CSS Files -->
        <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    </head>

<body>

     <!--header-->
     <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="<?= base_url(); ?>" class="external"><em>JB</em> Logistica</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars"></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="<?= base_Url(); ?>" class="external">Inicial</a></li>
        <li class="menu"><a href="<?= base_Url(); ?>" class="external">Sobre nós</a>
        </li>
        <li><a href="<?= base_Url(); ?>" >Contato</a></li>
        <li><a href="<?= base_Url('rastreio'); ?>" class="external">Rastreio</a></li>
        <li class="has-submenu"><a href="<?= base_Url('login'); ?>" class="external">Postar</a>
          <ul class="sub-menu">
            <li><a href="<?= base_Url('login'); ?>" class= "external">Login</a></li>
            <li><a href="<?= base_Url(); ?>" class="external">Como fazer?</a></li>
          </ul>
        </li>
      </ul>

    </nav>
  </header>

  <!-- ***** Main Banner Area Start ***** -->
  <section class="section main-banner" id="top" data-section="section1">
     
          <img src="assets/images/fundo.jpg" id="bg-video" />
      

      <div class="video-overlay header-text">
          <div class="caption">
          <div class="container" style="top:50px;">
    <input type="checkbox" id="flip">
    <div class="cover">
      <div class="front">
        <img src="assets/images/4c.jpg " alt="login">
        <div class="text">
          <span class="text-1">Sua melhor escolha</span>
          <span class="text-2">para uma entrega <em> rápida</em></span>
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Login</div>
        

            <form id="login">
  <div class="input-boxes">
    <div class="input-box">
      <i class="fas fa-envelope"></i>
      <input type="text" placeholder="Digite seu email" id="elogin" required>
    </div>
    <div class="input-box">
      <i class="fas fa-lock"></i>
      <input type="password" placeholder="Digite sua senha" id="password" required>
    </div>
   <!-- <div class="text"><a href="#">Esqueceu a senha?</a></div>-->
    <div class="button input-box">
      <input type="submit" value="Enviar">
    </div>
    <div class="text sign-up-text">Não tem uma conta? <label for="flip">Inscreva-se agora</label></div>
  </div>
</form>




      </div>
        <div class="signup-form">
          <div class="title">Inscrever-se</div>
        <form id="signup-form">
            <div class="input-boxes">
            <div class="input-box">
  <i class="fas fa-user"></i>
  <input type="text" placeholder="Digite seu CPF" id="cpf" onblur="formatarCPF()" required>
</div>

<script>
  function formatarCPF() {
    var cpf = document.getElementById("cpf").value;
    
    // Remover strings e caracteres especiais
    cpf = cpf.replace(/\D/g, '');
    
    // Verificar se o número já está formatado
    if (cpf.match(/^\d{3}\.\d{3}\.\d{3}-\d{2}$/)) {
      return; // Se já estiver formatado, não precisa formatar novamente
    }
    
    var cpfFormatado = cpf.substr(0, 3) + "." + cpf.substr(3, 3) + "." + cpf.substr(6, 3) + "-" + cpf.substr(9, 2);
    document.getElementById("cpf").value = cpfFormatado;
  }
</script>

              <div class="input-box">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Digite seu nome" id="nome" required>
              </div>
              <div class="input-box">
                <i class="fas fa-envelope"></i>
                <input type="text" placeholder="Digite seu email" id="email" required>
              </div>
              <div class="input-box">
  <i class="fas fa-phone"></i>
  <input type="tel" placeholder="Digite seu telefone" id="telefone" onblur="formatarTelefone()" required>
</div>

<script>
  function formatarTelefone() {
    var telefone = document.getElementById("telefone").value;
    
    // Remover strings e caracteres especiais
    telefone = telefone.replace(/\D/g, '');
    
    // Verificar se o número já está formatado
    if (telefone.match(/^\(\d{2}\)\s\d{5}-\d{4}$/)) {
      return; // Se já estiver formatado, não precisa formatar novamente
    }
    
    var telefoneFormatado = "(" + telefone.substr(0, 2) + ") " + telefone.substr(2, 5) + "-" + telefone.substr(7, 4);
    document.getElementById("telefone").value = telefoneFormatado;
  }
</script>


<div class="input-box">
  <i class="fas fa-lock"></i>
  <input type="password" placeholder="Digite sua senha" id="pass" required>
</div>

              <div class="button input-box">
                <input type="submit" value="Enviar">
              </div>
              <div class="text sign-up-text">Já tem uma conta? <label for="flip">Conecte-se agora</label></div>
            </div>
      </form>
    </div>
    </div>
    </div>
  </div>
          </div>
      </div>
  </section>


  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
             $(document).ready(function() {
  $('#login').submit(function(event) {
    event.preventDefault(); // impede a submissão do formulário
    var elogin = $('#elogin').val();
    var password = $('#password').val();
    $.ajax({
      type: 'POST',
      url: '<?= base_Url('apilc'); ?>',
      data: { elogin: elogin, password: password, conf: 2},
      success: function(response) {
        // coloque aqui o código a ser executado em caso de sucesso
        if(response == "logado"){
          window.location.href = "<?= base_Url('painel');?>";
        }else if(response == "entregador"){
          window.location.href = "<?= base_Url('entregador');?>";
        }else{alert(response);};
      },
      error: function(a) {
        // coloque aqui o código a ser executado em caso de erro
        alert("erro, contate um administrador");
      }
    });
  });
});
</script>
    <script>
      //first
      $(document).ready(function() {
  $('#signup-form').submit(function(event) {
    // Impedir que o formulário seja enviado por meio de uma solicitação padrão
    event.preventDefault();

    // Obter os valores dos campos de formulário
    var cpf = $('#cpf').val();
    var nome = $('#nome').val();
    var email = $('#email').val();
    var pass = $('#pass').val();
    var telefone = $('#telefone').val();
    // Enviar a solicitação AJAX
    $.ajax({
      type: 'POST',
      url: '<?= base_Url('apilc'); ?>',
      data: { cpf: cpf, nome: nome, email: email, pass: pass, telefone: telefone, conf: 1 },
      success: function(response) {
        alert(response);
      }
    });


 
});
  });



        //according to loftblog tut
        $('.nav li:first').addClass('active');

        var showSection = function showSection(section, isAnimate) {
          var
          direction = section.replace(/#/, ''),
          reqSection = $('.section').filter('[data-section="' + direction + '"]'),
          reqSectionPos = reqSection.offset().top - 0;

          if (isAnimate) {
            $('body, html').animate({
              scrollTop: reqSectionPos },
            800);
          } else {
            $('body, html').scrollTop(reqSectionPos);
          }

        };

        var checkSection = function checkSection() {
          $('.section').each(function () {
            var
            $this = $(this),
            topEdge = $this.offset().top - 80,
            bottomEdge = topEdge + $this.height(),
            wScroll = $(window).scrollTop();
            if (topEdge < wScroll && bottomEdge > wScroll) {
              var
              currentId = $this.data('section'),
              reqLink = $('a').filter('[href*=\\#' + currentId + ']');
              reqLink.closest('li').addClass('active').
              siblings().removeClass('active');
            }
          });
        };



        $(window).scroll(function () {
          checkSection();
        });
</script>
</body>
</html>

