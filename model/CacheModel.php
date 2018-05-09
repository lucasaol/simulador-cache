<?php

class CacheModel {

    private $tamPrincipal,
            $tamBloco,
            $qtdLinhas,
            $tecnica,
            $algoritmo,
            $qtdBlocos,
            $blocosExistentes = array(),
            $blocosNaCache = array(),
            $blocosAcessados = array();
    
    private $cont = 0;

    public function __construct() {
        
    }

    /* Encapsulamento dos Atributos (get; set; ) */

    public function getTamPrincipal() {
        return $this->tamPrincipal;
    }

    public function setTamPrincipal($val) {
        $this->tamPrincipal = $val;
    }

    public function getTamBloco() {
        return $this->tamBloco;
    }

    public function setTamBloco($val) {
        $this->tamBloco = $val;
    }

    public function getQtdLinhas() {
        return $this->qtdLinhas;
    }

    public function setQtdLinhas($val) {
        $this->qtdLinhas = $val;
    }

    public function getTecnica() {
        return $this->tecnica;
    }

    public function setTecnica($val) {
        $this->tecnica = $val;
    }

    public function getAlgoritmo() {
        return $this->algoritmo;
    }

    public function setAlgoritmo($val) {
        $this->algoritmo = $val;
    }

    public function getQtdBlocos() {
        return $this->qtdBlocos;
    }

    public function setQtdBlocos($val) {
        $this->qtdBlocos = $val;
    }

    public function getBlocosExistentes() {
        return $this->blocosExistentes;
    }

    public function setBlocosExistentes($arr) {
        $this->blocosExistentes = $arr;
    }

    public function getBlocosNaCache() {
        return $this->blocosNaCache;
    }

    public function setBlocosNaCache($arr) {
        $this->blocosNaCache = $arr;
    }

    public function existeBloco($b) {
        foreach ($this->blocosExistentes as $val) {
            if ($val['chave'] == (int)$b) {
                return true;
            }
        }
        return false;
    }

    public function isNaCache(int $b) {
        foreach ($this->blocosNaCache as $val) {            
            if ($val['chave'] == $b) {
                return true;
            }
        }
        return false;
    }

    public function getBlocoByChave($c) {
        foreach ($this->blocosExistentes as $val) {
            if ($val['chave'] == $c) {
                return $val;
            }
        }
        return null;
    }

    public function addInCache($l, $b) {
        echo 'anne'.$l.','.$b['chave'];
        $this->blocosNaCache[$l] = $b;
        $this->blocosAcessados[] = $b['chave'];
        //var_dump($this->blocosAcessados);die;
        $this->cont++;
    }

    public function isCacheCheia() {
        for ($i = 0; $i < $this->qtdLinhas; $i++) {
            if (empty($this->blocosNaCache[$i])) {
                return false;
            }
        }
        return true;
    }

    public function getFirstEmptyLine() {
        for ($i = 0; $i < $this->qtdLinhas; $i++) {
            if (empty($this->blocosNaCache[$i])) {
                return $i;
            }
        }
        return null;
    }

    public function getLastFrequentlyUsed() {
        //traz os blocos acessados e conta as ocorrências
        $values = array_count_values($this->blocosAcessados);
        //retorna a menor ocorrência
        $min = min($values);
        //retorna a chave do bloco menos usado
        return array_keys($values, $min)[0];
    }

    public function getLineByBloco($b) {
        for ($i = 0; $i < $this->qtdLinhas; $i++) {
            if (!empty($this->blocosNaCache[$i])) {
                if ($this->blocosNaCache[$i]['chave'] == $b['chave']) {
                    return $i;
                }
            }
        }
        return null;
    }

    public function removeDaCache($lin) {
        unset($this->blocosNaCache[$lin]);
    }

    public function removeAcesso($b) {
        foreach ($this->blocosAcessados as $key => $value) {
            if ($value == $b['chave']) {
                unset($this->blocosAcessados[$key]);
            }
        }
    }

    public function adicionaAcesso($b) {
        $this->blocosAcessados[] = $b;
    }
    
    public function getFirstAccess() {
        $linha = $this->cont % $this->getQtdLinhas();
        return $this->blocosAcessados[$linha];
    }

}
