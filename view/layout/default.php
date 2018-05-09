<!DOCTYPE html>
<html>
    <head>
        <meta charset="windows-1252" />
        <base href="<?= URL_BASE ?>">
        <title>Simulador de Memória Cache</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
        <meta name="description" content="Simulador de memória cache feita pelos alunos do 4º Período de SI da Faculdade Cotemig."/>
        <meta name="author" content="Lucas Andrade"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />

        <link rel="shortcut icon" href="view/images/favicon.ico">

        <link href="view/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="view/css/style.css" rel="stylesheet" type="text/css" />
    </head>

    <body>
        <header id="topnav">
            <div class="topbar-main">
                <div class="container-fluid">
                    <div class="logo">
                        <a href="" class="logo">
                            <span class="logo-small"><i class="mdi mdi-radar"></i></span>
                            <span class="logo-large"><i class="mdi mdi-radar"></i> Simulador de Memória Cache</span>
                        </a>
                    </div>

                    <div class="menu-extras topbar-custom">
                        <ul class="list-inline float-right mb-0">
                            <li class="menu-item list-inline-item">
                                <a class="navbar-toggle nav-link">
                                    <div class="lines">
                                        <span></span>
                                        <span></span>
                                        <span></span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>

            <div class="navbar-custom">
                <div class="container-fluid">
                    <div id="navigation">
                        <ul class="navigation-menu">
                            <li class="has-submenu">
                                <a href="inicia-cache"><i class="ti-home"></i>Início</a>
                            </li>
                            <li class="has-submenu">
                                <a href="#custom-modal" data-animation="blur" data-plugin="custommodal"
                                   data-overlaySpeed="100" data-overlayColor="#36404a">
                                    <i class="ti-home"></i>Informações
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </header>

        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="page-title-box">
                            <h4 class="page-title">Simulador</h4>
                        </div>
                    </div>
                </div>
                <div>
                    <?= $this->render(); ?>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <?= date('Y') ?> ©
                    </div>
                </div>
            </div>
        </footer>

        <div id="custom-modal" class="modal-demo" style="">
            <button type="button" class="close" onclick="Custombox.close();">
                <span>×</span><span class="sr-only">Fechar</span>
            </button>
            <h4 class="custom-modal-title">Informações</h4>
            <div class="custom-modal-text">
                Desenvolvido pelos alunos do 4º Período do curso de Sistemas da Informação da Faculdade Cotemig,
                esté é um trabalho focado em simular o funcionamento da memória Cache de um computador.
                <br><br>
                Disciplinas: AED II / AOC
                <br>
                Autores:
                <br>Lucas Andrade
                <br>Anne Caroline
                <br>Luana D'Assumpção
                
            </div>
        </div>

        <script src="view/js/jquery.min.js"></script>
        <script src="view/js/bootstrap.min.js"></script>        
        <script src="view/js/geral.js"></script>
    </body>
</html>