<!DOCTYPE html>
<html lang="en">

  <head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>JB Logistica</title>
    <link rel="icon" href="favicon.png" type="image/png">    
    <!-- Bootstrap core CSS -->
    <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Additional CSS Files -->
    <link rel="stylesheet" href="assets/css/fontawesome.css">
    <link rel="stylesheet" href="assets/css/template.css">
    <link rel="stylesheet" href="assets/css/owl.css">
    <link rel="stylesheet" href="assets/css/lightbox.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900" rel="stylesheet">
  </head>

<body bgcolor='#394357'>

   
  <!--header-->
  <header class="main-header clearfix" role="header">
    <div class="logo">
      <a href="<?= base_url(); ?>"><em>JB</em> Logistica</a>
    </div>
    <a href="#menu" class="menu-link"><i class="fa fa-bars" style='  position:absolute;top: 3.4vh;'></i></a>
    <nav id="menu" class="main-nav" role="navigation">
      <ul class="main-menu">
        <li><a href="<?= base_Url(); ?>" class="external">Inicial</a></li>
        <li class="menu"><a href="#section2">Sobre nós</a>
        </li>
        <li><a href="#section6" >Contato</a></li>
        <li><a href="<?= base_Url('rastreio'); ?>" class="external">Rastreio</a></li>
        <li class="has-submenu"><a href="<?= base_Url('login'); ?>" class="external">Postar</a>
          <ul class="sub-menu">
            <li><a href="<?= base_Url('login'); ?>" class= "external">Login</a></li>
            <li><a href="#section2" >Como fazer?</a></li>
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
              <h6>Transporte seus produtos</h6>
              <h2><em>Você</em> é nossa prioridade</h2>
              <div class="main-button">
                  <div class="scroll-to-section"><a href="#section2">Contrate</a></div>
              </div>
          </div>
      </div>
  </section>
  <!-- ***** Main Banner Area End ***** -->


  <section class="features">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-12">
          <div class="features-post">
            <div class="features-content">
              <div class="content-show">
                <h4><center>Trabalhe conosco</center></h4>
              </div>
              <div class="content-hide">
                <p>Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet. Donec maximus elementum ex. Cras convallis ex rhoncus, laoreet libero eu, vehicula libero.</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
                <a href="login.php"><div class="scroll-to-section" align="center">Trabalhe conosco</div></a>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post second-features">
            <div class="features-content">
              <div class="content-show">
                <h4><center>Rastreio</center></h4>
              </div>
              <div class="content-hide">
                <p>Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet. Donec maximus elementum ex. Cras convallis ex rhoncus, laoreet libero eu, vehicula libero.</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
                <a href="rastreio.php"><div class="scroll-to-section">Rastreio</div></a>
            </div>
            </div>
          </div>
        </div>
        <div class="col-lg-4 col-12">
          <div class="features-post third-features">
            <div class="features-content">
              <div class="content-show">
                <h4><center>Poste</center></h4>
              </div>
              <div class="content-hide">
                <p>Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet. Donec maximus elementum ex. Cras convallis ex rhoncus, laoreet libero eu, vehicula libero.</p>
                <p class="hidden-sm">Curabitur id eros vehicula, tincidunt libero eu, lobortis mi. In mollis eros a posuere imperdiet.</p>
                <a href="rastreio.php"><div class="scroll-to-section">Poste</div></a>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section why-us" data-section="section2">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
            <h2>Nos oferecemos:</h2>
          </div>
        </div>
        <div class="col-md-12">
          <div id='tabs'>
            <ul>
              <li><a href='#tabs-1'>Transporte seguro</a></li>
              <li><a href='#tabs-2'>velocidade e eficiencia</a></li>
              <li><a href='#tabs-3'>Segurança de suas informações</a></li>
            </ul>
            <section class='tabs-content'>
              <article id='tabs-1'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/1c.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Segurança</h4>
                    <p>teste.</p>
                    <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Contratar</a>
                  </div>
                </div>
              </article>
              <article id='tabs-2'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/2c.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Velocidade</h4>
                    <p>teste</p>
                    <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Contratar</a>
                  </div>
                </div>
              </article>
              <article id='tabs-3'>
                <div class="row">
                  <div class="col-md-6">
                    <img src="assets/images/3c.jpg" alt="">
                  </div>
                  <div class="col-md-6">
                    <h4>Informações</h4>
                    <p>teste </p>
                    <a href="#" class="btn btn-primary btn-lg active" role="button" aria-pressed="true">Contratar</a>
                  </div>
                </div>
              </article>
            </section>
          </div>
        </div>
      </div>
    </div>
  </section>

  <section class="section video" data-section="section5">
    <div class="container">
      <div class="row">
        <div class="col-md-6 align-self-center">
          <div class="left-content">
            <h4>Se você vai entregar ou buscar <em>um pacote na mesma região</em></bold></h4>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean vel sapien ultricies, eleifend neque ut, finibus sapien. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Pellentesque consectetur vitae nunc et consequat. Vestibulum bibendum, purus sed tincidunt finibus, leo quam tincidunt justo, quis lobortis lacus magna eu urna. Maecenas id lobortis nisl. Integer sit amet nibh non ante elementum fermentum. Quisque eu enim ante.</p>
            <br><br>Suspendisse tincidunt, magna ut finibus rutrum, libero dolor euismod odio, nec interdum quam felis non ante.</p>
            <div class="main-button"><a rel="nofollow" href="https://google.com" target="_parent">External URL</a></div>
          </div>
        </div>
        <div class="col-md-6">
          <article class="video-item">
            <div class="video-caption">
              <h4>imagem de teste</h4>
            </div>
            <figure>
              <a href="https://www.youtube.com/watch?v=jfKfPfyJRdk" class="play"><img src="assets/images/estrada.jpg"></a>
            </figure>
          </article>
        </div>
      </div>
    </div>
  </section>

  <section class="section contact" data-section="section6">
    <div class="container">
      <div class="row">
        <div class="col-md-12">
          <div class="section-heading">
          <hr color="black">
            <h2>Fale conosco</h2>
          </div>
        </div>
        <div class="col-md-6">
        
          <form id="contact" action="" method="post">
            <div class="row">
              <div class="col-md-6">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="name" placeholder="Seu nome" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="email" type="text" class="form-control" id="email" placeholder="Seu email" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="cpf" placeholder="CPF" required="">
                  </fieldset>
                </div>
                <div class="col-md-6">
                  <fieldset>
                    <input name="name" type="text" class="form-control" id="motivo" placeholder="Telefone de contato" required="">
                  </fieldset>
                </div>
              <div class="col-md-12">
                <fieldset>
                  <textarea name="message" rows="6" class="form-control" id="message" placeholder="Sua mensagem.." required=""></textarea>
                </fieldset>
              </div>
              <div class="col-md-12">
                <fieldset>
                  <button type="submit" id="form-submit" class="button">Enviar</button>
                </fieldset>
              </div>
            </div>
          </form>
        </div>
        <div class="col-md-6">
          <div id="map">
            <iframe src="https://www.google.com/maps/d/embed?mid=1NJoQ9tmYuv17gyBckxuX7Jidyw4&hl=en&ehbc=2E312F" width="100%" height="422px" frameborder="0" style="border:0" allowfullscreen></iframe>
          </div>
        </div>
      </div>
    </div>
  </section>

  <!-- Scripts -->
  <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/isotope.min.js"></script>
    <script src="assets/js/owl-carousel.js"></script>
    <script src="assets/js/lightbox.js"></script>
    <script src="assets/js/tabs.js"></script>
    <script src="assets/js/video.js"></script>
    <script src="assets/js/slick-slider.js"></script>
    <script src="assets/js/custom.js"></script>
    <script>
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

        $('.main-menu, .scroll-to-section').on('click', 'a', function (e) {
          if($(e.target).hasClass('external')) {
            return;
          }
          e.preventDefault();
          $('#menu').removeClass('active');
          showSection($(this).attr('href'), true);
        });

        $(window).scroll(function () {
          checkSection();
        });
    </script>
</body>
</html>

