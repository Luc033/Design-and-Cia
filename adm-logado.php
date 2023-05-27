<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- reset incluído-->
    <link rel="stylesheet" href="estilos/reset.css" />

    <!-- css -->
    <link rel="stylesheet" href="estilos/style.css" />

    <!-- BootStrap Css -->
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD"
      crossorigin="anonymous"
    />

    <!-- Bootstrap js -->
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"
    ></script>

    <!-- Bootstrap Icons -->
    <link
      rel="stylesheet"
      href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css"
    />

    <!-- FONT-FAMILY-->
    <!-- Poppins -->
    <link
      href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Roboto:wght@100&display=swap"
      rel="stylesheet"
    />

    <!-- Roboto -->
    <link
      href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap"
      rel="stylesheet"
    />

    <!-- Favicon -->
    <link rel="shortcut icon" href="imagens/favicon.png" type="image/x-icon" />

    <title>Hardware & CIA</title>
  </head>

  <body>
      <!--inicia sessão-->
   <?php
        session_start();
       
        // Verifica se o idCliente está presente na sessão
        if (!isset($_SESSION["idAdm"])) {
        // Redireciona para a página de login, pois o idCliente não está definido na sessão
        header("Location: login adm.html");
        exit();
        }    
        
        //conexão com bd
        require 'ConectBD.php';

        // Obtém o idCliente da sessão
        $idAdm = $_SESSION["idAdm"];

        // Consulta para obter o nome do cliente
        $sql = "SELECT nomeAdm FROM administrador WHERE idAdm = '$idAdm'";
        $resultado = $conn->query($sql);

        if ($resultado->num_rows === 1) {
            $row = $resultado->fetch_assoc();
            $nomeAdministrador = $row["nomeAdm"];
        } else {
            // O idCliente não foi encontrado no banco de dados
            $nomeAdministrador = "Nome não encontrado";
        }
   ?>
  
    <!-- NAVBAR-->

    <header class="header-principal">
        <nav class="nav-header">
            <div class="logo-img">
            <a href="adm-logado.html">
                <img
                class="logo-header"
                src="imagens/logo-sombra.png"
                alt="Logo E-commerce"
                />
            </a>
            </div>
            <ul class="dropd-logado">
            <li class="dropli">
                <i class="icon-navbar bi bi-person-circle"></i
                ><strong
                ><?php echo $nomeAdministrador;?><label
                    for=""
                    ></label
                ></strong
                >
            </li>
            <ul class="dropd-content">
                <li>
                <a href="relatorios-adm.html">
                    <button class="btn btn-default" id="btn-dropd-relatorio">
                    <i class="icon-subnavbar bi bi-table icon-list-header"></i
                    >Relatórios
                    </button>
                </a>
                </li>
                <li>
                <a href="index.html"
                    ><i
                    class="icon-subnavbar bi bi-x-circle-fill icon-list-header"
                    ></i
                    >Sair</a
                >
                </li>
            </ul>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container-fluid container-card">
            <div class="start-main container-fluid">
                <button class="btn-filter btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft">Filtrar</button>
                <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasLeftLabel">
                    <div class="offcanvas-header">
                        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                    </div>
                    <div class="offcanvas-body">
                        <div>
                            <h2 class="text-center">Preço do produto</h2>
                            <div class="wrapper">
                                <div class="values">
                                    <span id="range1">
                                        0
                                    </span>
                                    <span> &dash; </span>
                                    <span id="range2">
                                        100
                                    </span>
                                </div>
                                <div class="container-range">
                                    <div class="slider-track">
                                        <input type="range" min="20" max="7000" value="1500" id="slider-1" oninput="slideOne()">
                                        <input type="range" min="20" max="7000" value="5500" id="slider-2" oninput="slideTwo()">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div>
                            <h2 class="text-center">Ordenar por</h2>
                            <div class="ordenar">
                                <div>
                                    <label for="cresc">Preço Crescente</label>
                                    <input type="radio" name="ordenarPor" id="cresc" value="cresc">
                                </div>
                                <div>
                                    <label for="decresc">Preço Decrescente</label>
                                    <input type="radio" name="ordenarPor" id="decresc" value="decresc">
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="filtrar">
                                <button id="filter-btn" class="main-btn">
                                    Filtrar
                                </button>
                            </div>  
                        </div>
                        
                    </div>
                </div>
                <form class="form-search">
                    <input type="text" class="inp-search-nav inputSearch" id="inp-search-nav" placeholder="Buscar...">
                    <button class="main-btn btn-primary btn-inp-search-nav-header" id="inp-search-nav-submit" disabled>Buscar</button>
                </form>
            </div>
            <!-- Local para ficar os cards individuais -->
            <div class="linha-card"></div>
        </div>

        <div class="news-letter" id="news-area">
            <div class="container-fluid container-md">
                <div class="row">
                    <div class="col-md-6 news-text">
                        <h1>Se cadastre para receber as novidades</h1>
                        <p>Seja o primeiro a saber sobre as ofertas e novidades da empresa assinando nossa Newsletter
                        </p>
                    </div>

                    <div class="col-md-6 ">
                        <form action="get" class="needs-validation" novalidate>
                            <label for="news-name" class="form-label">Nome</label>
                            <input type="text" name="news-nam" id="news-nam" class="form-control"
                                placeholder="ex: João da Silva" required>
                            <label for="news-email" class="form-label">Seu melhor E-mail</label>
                            <input type="email" name="news-email" id="news-email" class="form-control"
                                placeholder="ex: joaosilva@gmail.com" required>
                            <button type="submit" class="btn ">Enviar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <footer>
      <div id="social-area" class="social">
        <div class="container">
          <h2>Nos acompanhe em nossas redes sociais</h2>
          <div class="logo">
            <a href="#">
              <i class="bi bi-github"></i>
            </a>
            <a href="#">
              <i class="bi bi-instagram"></i>
            </a>
            <a href="#">
              <i class="bi bi-facebook"></i>
            </a>
            <a href="#">
              <i class="bi bi-youtube"></i>
            </a>
          </div>
        </div>
      </div>

      <div class="footer" id="footer-area">
        <div class="container-md container-fluid logo-footer">
          <div class="logo-img">
            <img src="imagens/logo-sombra.png" alt="logo e-commerce" />
          </div>
          <div class="logo-text">
            <p>&copy 2023 - Hardware & Cia</p>
          </div>
          <div class="info-footer">
            <p><strong>CNPJ:</strong> xx.xxx.xxx/xxxx-xx</p>
            <p><strong>E-mail:</strong> Hardware&Cia@gmail.com</p>
          </div>
        </div>
      </div>
    </footer>

    <script src="js/func-logado.js"></script>
  </body>
</html>
