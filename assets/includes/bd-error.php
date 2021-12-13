<style>
    body{
        background: #43cea2;
        background: -webkit-linear-gradient(to right, #2196fa, #43cea2);
        background: linear-gradient(to right, #2196fa, #43cea2); 
    }
    .d-block{
        display: block;
    }
    .text-primary{
        color: #2196fa;
    }
    .text-gray{
        color: gray;
    }
    .text-danger{
        color: tomato;
    }
    .content{
        width: 50%;
        margin: 80px auto;
        text-align: center;
        padding:60px;
        background-color: #fff;
        font-size: 16pt;
        border-radius: 4px;
    }
    .try-again-button{
        padding: 10px;
        border-radius: 10px;
        background-color: #fff;
        cursor: pointer;
        text-transform: none;
        text-decoration: none;
        color: #2196fa;
        transition: all .2s;
        -moz-transition: all .2s;
        -webkit-transition: all .2s;
    }
    .try-again-button:hover{
        background-color: #f5f5f5;
    }
</style>
<title>GTN - Game - Conexão não estabelecida</title>
<div class="content">
    <h1 class="text-gray">
        Oopss!!!
    </h1>
    <small class="text-primary">GTN - The Game</small>
    <h2 class="d-block text-danger">
        Conexão ao banco de dados não estabelecida.
    </h2>
    <span>
        <a class="try-again-button" href="<?php echo $_SERVER["PHP_SELF"]; ?>">Clique aqui para tentar novamente!</a>
    </span>
</div>