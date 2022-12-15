<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        404 Error Page
    </h1>
    <ol class="breadcrumb">
        <li><a href="<?= $patch ?>">Inicio</a></li>
        <li class="active">404 error</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="error-page">
        <h2 class="headline text-yellow"> 404</h2>
        <div class="error-content">
            <!--<h3><i class="fa fa-warning text-yellow"></i> Oops! Page not found.</h3>-->
            <h3><i class="fa fa-warning text-yellow"></i> Upps! Página no encontrada.</h3>
            <p>
                No pudimos encontrar la página que estabas buscando.
                Mientras tanto, es posible <a href="<?= $patch ?>">volver a la vista principal</a>.
                <!--
                We could not find the page you were looking for.
                Meanwhile, you may <a href="<?//= $patch ?>">return to dashboard</a> or try using the search form.
                -->
            </p>
        </div><!-- /.error-content -->
    </div><!-- /.error-page -->
</section><!-- /.content -->
