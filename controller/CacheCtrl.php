<?php

/**
 * Description of CacheCtrl
 *
 * @author lucas
 */
class CacheCtrl extends Controller {

    protected $model;
    private $validMethods = array('simulacaoLru', 'simulacaoLfu', 'simulacaoFifo');

    public function __construct() {
        parent::__construct();
    }

    private function validaMethod($met) {
        if (in_array($met, $this->validMethods) && method_exists($this, $met)) {
            return true;
        }
        die('Exception: Método ' . $met . '() inválido ou inexistente!');
    }

    public function getInicio() {
        if (isset($_POST['salvar'])) {
            $this->model = new CacheModel();

            $this->model->setTamPrincipal($_POST['tamPrincipal']);
            $this->model->setTamBloco($_POST['tamBloco']);
            $this->model->setQtdLinhas($_POST['qtdLinhas']);

            $this->model->setTecnica($_POST['tecnica']);
            $this->model->setAlgoritmo($_POST['algoritmo']);

            $qtd = $this->model->getTamPrincipal() / $this->model->getTamBloco();

            for ($i = 0; $i < $qtd; $i++) {
                $blocos[] = array(
                    'chave' => $i, 'rotulo' => 'Bloco nº ' . $i,
                    'cont' => 0
                );
            }

            $this->model->setQtdBlocos($qtd);
            $this->model->setBlocosExistentes($blocos);

            $_SESSION['model'] = $this->model;
            header('location: simulacao');
        }
        $this->view();
    }

    public function getSimulacao() {
        $this->model = $_SESSION['model'];

        $this->dados['blocosExistentes'] = $this->model->getBlocosExistentes();
        $this->dados['qtdBlocos'] = $this->model->getTamPrincipal() / $this->model->getTamBloco();
        $this->dados['qtdLinhas'] = $this->model->getQtdLinhas();

        if (isset($_POST['acessar'])) {
            $num = filter_input(INPUT_POST, 'bloco');

            if (!$this->model->existeBloco($num)) {
                $this->dados['msg'] = Alert::getAlertByTypeAndMsg('danger', 'Não existe o bloco de nº ' . $num);
            } else if ($this->model->isNaCache($num)) {
                $this->dados['msg'] = Alert::getAlertByTypeAndMsg('warning', 'Cache Hit! O bloco de nº ' . $num . ' já está na cache!');
            }

            if ($this->model->getTecnica() == 'D') {
                $this->simulacaoDireta($num);
            } else {
                $this->simulacaoAssociativa($num, $this->model->getAlgoritmo());
                $this->model->adicionaAcesso($num);
            }
        }
        $this->view();
    }

    private function simulacaoDireta($n) {
        $blocosCache = $this->model->getBlocosNaCache();
        $b = $this->model->getBlocoByChave($n);

        if ($this->model->existeBloco($n)) {
            $lin = $n % $this->model->getQtdLinhas();

            $log = '';
            if (empty($blocosCache[$lin])) {
                $log = Log::insertLog($b['rotulo'] . ' entrou na linha ' . $lin);
            } else if ($blocosCache[$lin]['chave'] != $n) {
                $log = Log::insertLog($blocosCache[$lin]['rotulo'] . ' saiu para entrar ' . $b['rotulo']);
            }

            $this->model->addInCache($lin, $b);
            $this->dados['log'] = $log;
        }

        $this->dados['table'] = $this->geraHtmlTable();
    }

    public function geraHtmlTable() {
        $data = $this->model->getBlocosNaCache();
        $qtd = $this->model->getQtdLinhas();

        $html = '<table class="table table-hover">
            <thead>
                <tr>
                    <th>Linha</th>
                    <th>Bloco</th>
                </tr>
            </thead>
            <tbody>';

        for ($i = 0; $i < $qtd; $i++) {
            $bloco = '';
            if (!empty($data[$i])) {
                $bloco = $data[$i]['rotulo'];
            }
            $html .= '<tr>
                        <td>' . $i . '</td>
                        <td>' . $bloco . '</td>
                    </tr>';
        }
        $html .= '</tbody>
            </table>';

        return $html;
    }

    private function simulacaoAssociativa($num, $alg) {
        $methodSimulacao = 'simulacao' . $alg;
        if ($this->validaMethod($methodSimulacao)) {
            $this->$methodSimulacao($num);
        }
    }

    private function simulacaoLru($n) {
        
    }

    private function simulacaoFifo($n) {
        $b = $this->model->getBlocoByChave($n);
        if ($this->model->existeBloco($b) && !$this->model->isNaCache($b['chave'])) {
            $log = '';

            if (!$this->model->isCacheCheia()) {
                $lin = $this->model->getFirstEmptyLine();
                $log = Log::insertLog($b['rotulo'] . ' entrou na linha ' . $lin);
            } else {
                $primeiro = $this->model->getFirstAccess();
                $bPrimeiro = $this->model->getBlocoByChave($primeiro);
                $lin = $this->model->getLineByBloco($bPrimeiro);

                $log = Log::insertLog($bPrimeiro['rotulo'] . ' saiu para entrar o ' . $b['rotulo']);
                $this->model->removeAcesso($bPrimeiro);
            }

            $this->model->removeDaCache($lin);
            $this->model->addInCache($lin, $b);

            $this->dados['log'] = $log;
        }
        $this->dados['table'] = $this->geraHtmlTable();
    }

    private function simulacaoLfu($n) {
        $b = $this->model->getBlocoByChave($n);
        if ($this->model->existeBloco($b) && !$this->model->isNaCache($b['chave'])) {

            $log = '';
            if (!$this->model->isCacheCheia()) {
                $lin = $this->model->getFirstEmptyLine();
                $log = Log::insertLog($b['rotulo'] . ' entrou na linha ' . $lin);
            } else {
                $menosUsado = $this->model->getLastFrequentlyUsed();
                $bMenos = $this->model->getBlocoByChave($menosUsado);
                $lin = $this->model->getLineByBloco($bMenos);

                $log = Log::insertLog($bMenos['rotulo'] . ' saiu para entrar o ' . $b['rotulo']);

                $this->model->removeAcesso($bMenos);
            }

            $this->model->removeDaCache($lin);
            $this->model->addInCache($lin, $b);

            $this->dados['log'] = $log;
        }
        $this->dados['table'] = $this->geraHtmlTable();
    }

}
