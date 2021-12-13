<?php require_once("assets/includes/header.php"); ?>
<?php 
    if(!isset($_GET["dd"]))
        sendto("index.php");

    $dd = $_GET["dd"];

    if(isset($_POST["name"])){
        $name = clrInput($_POST["name"], $con);
        $points = clrInput($_POST["points"], $con);
        if($name > 0 || $points > 10){
            $query = "INSERT INTO scores (Nome, Pontos) VALUES ('{$name}', {$points})";
            if($con->query($query) === true){
               sendto("index.php");
            }else{
                sendto("query-error.php?returnUrl=game.php");
            }
        }else{
            sendto("index.php");
        }
    }
?>
<div class="dialog dialog-pause invisible">
    <div class="message-box bg-white p-3 rounded box-shadow">
        <div class="row">
            <div class="col-4">
                <span class="text-warning">
                    <i class="fa fa-coins"></i>
                </span>
                <h6 class="ml-2 bd bd-points text-white" id="cpoints2"></h6>
            </div>
            <div class="col-4 text-center">
                <small class="text-muted">
                    <?php
                        if($dd == 0)
                            echo "Fácil";
                        elseif($dd == 1)
                            echo "Normal";
                        elseif($dd == 2)
                            echo "Difícil";
                    ?>
                </small>
            </div>
            <div class="col-4 text-right">
                <span class="text-tomato">
                    <i class="fa fa-heart-o"></i>
                </span>
                <h6 class="ml-2 bd bd-lives text-white" id="clives2"></h6>
            </div>
        </div>
        <h2 class="text-success text-center">Pausado!</h2>
        <div class="text-center">
            <h5>Clique em retomar para continuar o jogo!</h5>
        </div>
        <hr>
        <div class="text-center">
            <button type="submit" class="btn btn-success" onclick="Continue()">Retomar jogo</button>
            <button type="submit" class="btn btn-warning text-white" onclick="Restart()">Recomecar jogo</button>
            <button type="submit" class="btn btn-danger" onclick="Exit()">Sair do jogo</button>
        </div>
        <div class="text-right mt-2">
            <button type="submit" class="btn btn-white" onclick="Sound(this)">Som: Desativado</button>
        </div>
    </div>
</div>
<div class="dialog lost-dialog invisible">
    <div class="message-box bg-white p-3 rounded box-shadow">
        <h2 class="text-success text-center">Terminou o Jogo!</h2>
        <div>
            <form action="<?php $_SERVER["PHP_SELF"]; ?>" method="post">
                <div class="text-center">
                    <label for="nome">
                        <h5>Insira o seu nome para guardar a sua pontuação!</h5> 
                    </label>
                    <input type="text" name="name" class="form-control" placeholder="Nome" required>
                    <input type="hidden" name="points" id="lost">
                </div>
                <hr>
                <div>
                    <button class="btn btn-success" type="submit">Salvar</button>
                    <button class="btn btn-danger" type="reset" onclick="Exit()">Sair sem salvar</button>
                </div>
            </form>
           
        </div>
    </div>
</div>
<div class="dialog start-dialog invisible">
    <div class="message-box bg-white p-3 rounded box-shadow text-center">
        <h1 id="rd">4</h1>
        <h5>Preparado para começar?</h5> 
    </div>
</div>
<div class="container">
    <div class=" game-content box-shadow">
        <div class="row">
            <div class="col-4">
                <span class="text-warning">
                    <i class="fa fa-coins"></i>
                </span>
                <h6 class="ml-2 bd bd-points text-white" id="cpoints"></h6>
            </div>
            <div class="col-4 text-center">
                <small class="text-muted">
                    <?php
                        if($dd == 0)
                            echo "Fácil";
                        elseif($dd == 1)
                            echo "Normal";
                        elseif($dd == 2)
                            echo "Difícil";
                    ?>
                </small>
            </div>
            <div class="col-4 text-right">
                <span class="text-tomato">
                    <i class="fa fa-heart-o"></i>
                </span>
                <h6 class="ml-2 bd bd-lives text-white" id="clives"></h6>
            </div>
        </div>
        <div class="p-3 text-center">
            <h4 class="text-primary" id="hint"></h4>
        </div>
        <div class="row text-center m-3">
            <div class="number-set rounded col-3" id="sFirst">
                <h1 class="text-success" id="nFirst">0</h1>
            </div>
            <div class="number-set rounded col-3" id="sSecond">
                <h1 class="text-primary" id="nSecond">0</h1>
            </div>
            <div class="number-set rounded col-3" id="sThird">
                <h1 class="text-warning" id="nThird">0</h1>
            </div>
            <div class="number-set rounded col-3 btn" id="sFourth">
                <h1 class="text-danger" id="nFourth">0</h1>
            </div>
        </div>
        <div class="timer">&nbsp;</div>
    </div>
    <div class="row game-content rounded-bottom mt-1">
        <div class="col-6">
            <a type="button" class="btn btn-danger text-white" onclick="Exit()">Sair</a>
            <a type="button" class="btn btn-info text-white" onclick="Pause()">Pausar</a>
        </div>
        <div class="col-6 text-right">
            <a type="button" class="btn btn-primary text-white" onclick="Change(this)">Trocar</a>
            <a type="button" class="btn btn-success text-white" onclick="Answer(this)">Responder</a>
            <a type="button" class="btn btn-warning text-white" onclick="TwoByTwo(this)">2/2</a>
        </div>
    </div>
</div>
</body>
<script src="assets/js/jquery-1.9.1.min.js"></script>
<script src="assets/js/popper.min.js"></script>
<script src="assets/js/util.js"></script>
<script src="assets/js/modal.js"></script>
<script src="assets/js/tooltip.js"></script>
<script src="assets/js/popover.js"></script>
<script src="assets/fontawesome/js/all.min.js"></script>
<script src="assets/fontawesome/js/v4-shims.min.js"></script>
<script src="assets/js/config.js"></script>
<script src="assets/js/app.js"></script>
<script>
    Ready('<?php echo $dd; ?>')
</script>
</html>