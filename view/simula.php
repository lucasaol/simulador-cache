<div class="col-md-6">
    <div class="card-box">
        <h4 class="m-t-0 header-title">Acesso aos blocos</h4>
        <?php
        if (isset($msg) && !empty($msg)) {
            echo $msg;
        }
        ?>
        <form id="acessaBloco" method="post">
            <div class="col-10">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="Bloco de nº " name="bloco">
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="acessar" value="Acessar">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
<div class="row">
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Memória Principal</h4>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Número</th>
                        <th>Bloco</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 0;
                    foreach ($blocosExistentes as $key => $value) {
                        ?>
                        <tr>
                            <th scope="row"><?= ++$i ?></th>
                            <td><?= $value['chave'] ?></td>
                            <td><?= $value['rotulo'] ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card-box">
            <h4 class="m-t-0 header-title">Memória Cache</h4>
            <?php
            if (isset($table) && !empty($table)) {
                echo $table;
            } else {
                ?>
                <p class="m-t-30">
                    <?= Alert::getAlertByTypeAndMsg('info', '<strong>A cache está inicialmente vazia</strong>'); ?>
                </p>
                <?php
            }
            ?>
        </div>
    </div>
</div>

<?php
echo (isset($log)) ? $log : '';
