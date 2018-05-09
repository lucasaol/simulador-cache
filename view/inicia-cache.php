<div class="col-lg-12">
    <div class="card-box">
        <h4 class="header-title m-t-0">Informações da Cache</h4>
        <form method="post" id="infoCache">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="userName">Tamanho da MP (Em bytes)<span class="text-danger">*</span></label>
                        <select class="form-control" name="tamPrincipal">
                            <option value="2">2 Bytes</option>
                            <option value="4">4 Bytes</option>
                            <option value="8">8 Bytes</option>
                            <option value="16">16 Bytes</option>
                            <option value="32">32 Bytes</option>
                            <option value="64">64 Bytes</option>
                            <option value="128">128 Bytes</option>
                            <option value="256">256 Bytes</option>
                            <option value="512">512 Bytes</option>
                            <option value="1024" selected>1024 Bytes</option>
                            <option value="2048">2048 Bytes</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress">Tamanho do Bloco (Em bytes)<span class="text-danger">*</span></label>
                        <select class="form-control" name="tamBloco">
                            <option value="2">2 Bytes</option>
                            <option value="4">4 Bytes</option>
                            <option value="8">8 Bytes</option>
                            <option value="16">16 Bytes</option>
                            <option value="32">32 Bytes</option>
                            <option value="64" selected>64 Bytes</option>
                            <option value="128">128 Bytes</option>
                            <option value="256">256 Bytes</option>
                            <option value="512">512 Bytes</option>
                            <option value="1024">1024 Bytes</option>
                            <option value="2048">2048 Bytes</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="emailAddress">Qtd de Linhas da MC<span class="text-danger">*</span></label>
                        <select class="form-control" name="qtdLinhas">
                            <option value="2">2 </option>
                            <option value="4" selected>4 </option>
                            <option value="8">8 </option>
                            <option value="16">16 </option>
                            <option value="32">32 </option>
                            <option value="64">64 </option>
                            <option value="128">128 </option>
                            <option value="256">256 </option>
                            <option value="512">512 </option>
                            <option value="1024">1024 </option>
                            <option value="2048">2048 </option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="tecnica">Técnica<span class="text-danger">*</span></label>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tecnica" name="tecnica" checked value="D" class="custom-control-input radioTecnica">
                                    <label class="custom-control-label" for="tecnica">Direta</label>
                                </div>
                                <div class="custom-control custom-radio">
                                    <input type="radio" id="tecnica2" name="tecnica" value="A" class="custom-control-input radioTecnica">
                                    <label class="custom-control-label" for="tecnica2">Associativa</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                    <div class="form-group">
                        <label for="algoritmo">Algoritmo<span class="text-danger">*</span></label>
                        <select class="form-control" id="algoritmo" name="algoritmo" disabled="">
                            <option value="Lru">LRU</option>
                            <option value="Lfu">LFU</option>
                            <option value="Fifo" selected="">FIFO</option>
                        </select>
                    </div>

                        </div>
                    </div>

                </div>
            </div>
            <div class="row">
                <div class="col-md-6">

                    <div class="form-group m-b-0">
                        <input type="submit" name="salvar" class="btn btn-primary" value="Salvar Dados">
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>