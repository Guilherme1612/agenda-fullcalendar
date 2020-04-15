<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8' />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

    <link href='packages/core/main.min.css' rel='stylesheet' />
    <link href='packages/daygrid/main.min.css' rel='stylesheet' />
    <link href='packages/timegrid/main.min.css' rel='stylesheet' />
    <link href='packages/list/main.min.css' rel='stylesheet' />
    <link href='css/style.css' rel='stylesheet' />

    <script src='packages/core/main.min.js'></script>
    <script src='packages/core/locales/pt-br.js'></script>
    <script src='packages/daygrid/main.min.js'></script>
    <script src='packages/timegrid/main.min.js'></script>
    <script src='packages/list/main.min.js'></script>
    <script src='packages/interaction/main.min.js'></script>
    <script src="js/script.js"></script>

</head>
<body>
    <div id='calendar'></div>
    <div class="modal fade" id="visualizar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Detalhes do Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body px-0">
                    <div class="visevent">
                        <dl class="row px-3">
                            <dt class="col-sm-6">Título do evento</dt>
                            <dd class="col-sm-6" id="title"></dd>
                    
                            <dt class="col-sm-6">Início do evento</dt>
                            <dd class="col-sm-6" id="start"></dd>
                            
                            <dt class="col-sm-6">Fim do evento</dt>
                            <dd class="col-sm-6" id="end"></dd>
                        </dl>
                        <div class="modal-footer pb-0">
                            <button class="btn btn-info btn-canc-vis text-white" style="width:120px">Editar</button>
                            <form action="proc_apagar_evento.php" class="d-inline-block" method="post">
                                <input type="hidden" name="id" id="id" >
                                <button style="width:120px" type="submit" class="btn btn-danger">Excluir</button>
                            </form>
                        </div>
                    </div>

                    <!-- Atualizando dados -->
                    <div class="formedit">
                        <form action="edit_event.php" method="post" enctype="multipart/form-data">
                            <div class="modal-body px-3">
                                <input type="hidden" name="id" id="id" >
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Título</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Cor</label>
                                    <div class="col-sm-8">
                                        <select name="color" class="form-control" id="color">
                                            <option value="">Selecione</option>			
                                            <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                            <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                            <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                            <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                            <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                            <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                            <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                            <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                            <option style="color:#228B22;" value="#228B22">Verde</option>
                                            <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Início do evento</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-sm-4 col-form-label">Final do evento</label>
                                    <div class="col-sm-8">
                                        <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer pb-0">           
                                <button type="submit" style="width:120px" class="btn btn-info">Atualizar</button> 
                                <button type="button" style="width:120px" class="btn btn-danger btn-canc-edit">Cancelar</button>                                  
                            </div>
                        </form>                            
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de cadastro -->
    <div class="modal fade" id="cadastrar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header align-items-center">
                    <h5 class="modal-title text-dark" id="exampleModalLabel">Cadastrar Evento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="addevent" action="cad_event.php" method="post" enctype="multipart/form-data">
                    <div class="modal-body px-3 py-4">
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Título</label>
                            <div class="col-sm-8">
                                <input type="text" name="title" class="form-control" id="title" placeholder="Título do evento">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Cor</label>
                            <div class="col-sm-8">
                                <select name="color" class="form-control" id="color">
                                    <option value="">Selecione</option>			
                                    <option style="color:#FFD700;" value="#FFD700">Amarelo</option>
                                    <option style="color:#0071c5;" value="#0071c5">Azul Turquesa</option>
                                    <option style="color:#FF4500;" value="#FF4500">Laranja</option>
                                    <option style="color:#8B4513;" value="#8B4513">Marrom</option>	
                                    <option style="color:#1C1C1C;" value="#1C1C1C">Preto</option>
                                    <option style="color:#436EEE;" value="#436EEE">Royal Blue</option>
                                    <option style="color:#A020F0;" value="#A020F0">Roxo</option>
                                    <option style="color:#40E0D0;" value="#40E0D0">Turquesa</option>
                                    <option style="color:#228B22;" value="#228B22">Verde</option>
                                    <option style="color:#8B0000;" value="#8B0000">Vermelho</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Início do evento</label>
                            <div class="col-sm-8">
                                <input type="text" name="start" class="form-control" id="start" onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Final do evento</label>
                            <div class="col-sm-8">
                                <input type="text" name="end" class="form-control" id="end"  onkeypress="DataHora(event, this)">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">   
                        <button type="submit" style="width:120px" class="btn btn-info">Cadastrar</button>
                        <button type="button" style="width:120px" class="btn btn-danger" class="close" data-dismiss="modal" aria-label="Close">Voltar</button>                                  
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
