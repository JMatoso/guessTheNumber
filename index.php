<?php require_once("assets/includes/header.php"); ?>
<?php $info = getSingleData("content", "LIMIT 1", $con); ?>
    <div class="container">
        <div class="text-center mt-5">
            <h1 class="text-white game-text">
                GetTheNumber - Game
            </h1>
        </div>
        <div class="content text-center">
            <form action="game.php" method="get">
                <button type="submit" class="btn btn-opt btn-lg btn-primary w-50">
                    <i class="fa fa-play"></i>
                    Jogar
                </button>
                <button type="button" class="mt-2 btn-opt btn-lg btn-success text-white w-50" data-toggle="modal" data-target="#myModal">
                    <i class="fa fa-list"></i>
                    Score
                </button>
                <button type="button" class="mt-2 btn-opt btn-lg btn-info w-50" data-toggle="modal" data-target="#infoModal">
                    <i class="fa fa-info"></i>
                    Sobre
                </button>
                <hr>
                <label class="text-muted text-center d-block" for="dificuldade">Selecione a dificuldade</label>
                <select name="dd" id="dificuldade" class="mt-2 btn-opt btn-lg btn-white w-50 form-control" style="display: inline-block !important; cursor: pointer;">
                    <option value="0">Fácil</option>
                    <option value="1" selected>Normal</option>
                    <option value="2">Difícil</option>
                </select>
            </form>
        </div>
        <div class="text-center mt-2 text-white">
            <span>
                Copyright &copy; <?php echo date("Y"); ?>
            </span>
            <span class="d-block">             
                    Todos os direitos reservados!
            </span>
            <h4 class="d-block">             
                <?php echo clrOutput($info["Empresa"]); ?>
            </h4>
        </div>
    </div>
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">Scores</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" style="padding: 0px !important;">
                    <table class="table table-striped">
                        <tr class="text-center">
                            <td>Nome</td>
                            <td>Pontos</td>
                            <td>Ação</td>
                        <?php
                            $scores = getData("scores", "ORDER BY pontos DESC", $con);
                            while($score = $scores->fetch_assoc()): ?>
                                <tr class="text-center">
                                    <td><?php echo clrOutput($score["Nome"]); ?></td>
                                    <td><?php echo clrOutput($score["Pontos"]); ?></td>
                                    <td>
                                        <a class="btn btn-danger" href="delete-score.php?id=<?php echo clrOutput($score["id"]); ?>">
                                            <i class="fa fa-trash-o"></i>
                                        </a>
                                    </td>
                                </tr>
                            <?php endwhile; 
                        ?>
                        </tr>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="infoModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="infoModalLabel">Sobre</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">                 
                    <div class="border-bottom py-2">
                        <h4 class="text-info">Sobre o Jogo</h4>
                        <span class="text-dark">
                            <?php echo clrOutput($info["GTN"]); ?>
                        </span>
                    </div>
                    <div class="border-bottom py-2 mt-1">
                        <h4 class="text-info">Como Jogar</h4>
                        <span class="text-dark">
                            <?php echo clrOutput($info["ComoJogar"]); ?>
                        </span>
                    </div>
                    <div class="mt-2">
                        <span class="text-muted">
                            Visitar o site
                        </span>
                        <?php echo clrOutput($info["Site"]); ?>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
<?php require_once("assets/includes/footer.php"); ?>