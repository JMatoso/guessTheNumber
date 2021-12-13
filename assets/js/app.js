/**Variáveis**/
/**DOM**/
var timer = $('.timer'),
    hint = $("#hint"),
    cPoints = $("#cpoints"),
    cLives = $("#clives"),
    dialog = $(".dialog-pause"),
    lost = $("#lost"),
    rd = $("#rd"),
    interval = null,
    number = 0,
    dd = 0,
    points = 0,
    lives = 6,
    pause = false,
    sound = true,
    numberControls = {
        First: $("#nFirst"), 
        Second: $("#nSecond"),
        Third: $("#nThird"),
        Fourth: $("#nFourth")
    },
    setControls = {
        First: $("#sFirst"), 
        Second: $("#sSecond"),
        Third: $("#sThird"),
        Fourth: $("#sFourth")
    }
    
const gameTime = [400, 300, 200]

function removeClasses(){
    for(let control in numberControls){
        let ctlr = numberControls[control]
        ctlr.removeClass("wrong")
        ctlr.removeClass("right")
    }
}
function Ready(dd){
    $(".start-dialog").removeClass("invisible")
    let c = 3
    setInterval(function(){
        rd.text(c)
        if(c == 0){
            Jogar(dd)
            $(".start-dialog").addClass("invisible")
        }

        c--;
    }, 1000)
}
function Jogar(dificuldade){
    removeClasses()
    dd = dificuldade
    number = Math.floor(Math.random() * 501)
    hint.text(setHint(number))
    setNumbers(number)
    Timer(dificuldade)
}
function Lost(){
    clearInterval(interval)
    if(points > 10){
        $(".lost-dialog").removeClass("invisible")
        lost.val(points)
    }else{
        if(confirm("Jogar novamente?")){
            points = 0
            lives = 6
            Jogar(dd)
        }else{
            location .href="index.php"
        }
    }
}
function Timer(dificuldade){
    let pp = 100
    timer.css("width", pp + "%")
    if(interval != null)
        clearInterval(interval)

    interval = setInterval(function(){
        cPoints.text(points)
        cLives.text(lives)
        if(pause == false){
            pp = pp - 2
            timer.css('width', pp + "%")
            if(pp == 0)
                WrongNumber()
        }

        if(lives < 1 || lives == 0)
            Lost()
    }, gameTime[dificuldade])
}
function setHint(x){
    let yo
    if(dd == 0)
        yo = 10
    else if(dd == 1)
        yo = 16
    else if(dd == 2)
        yo = 21

    let rnd = Math.floor(Math.random() * 7);
    let z = 0;
    switch(rnd){
        case 0: 
            if(x % 2 == 0){
                switch(Math.floor(Math.random() * 2)){
                    case 0: return "Sou par, não te digo mais nada!"
                    case 1: return "Sou par, a minha raíz é " + Math.sqrt(x)
                    default: return "Sem pista! Que má sorte!";
                }
            }else
                return "Sou ímpar, ache-me!!" 
        case 1: 
            z = x / 2
            if(x % 2 == 0)
                return "Sou par e o dobro de " + z
            else{
                let d = new Date()
                return "Sou ímpar, ache-me somando " + (x - d.getDate()) + " pelo dia de hoje!"
            }   
        case 2:
            z = x * 2
            return "Essa é fácil sou a divisão de " + z + " por 2"
        case 3: return "O mundo nem sempre é justo..."
        case 4: return "Você acredita em sorte?"
        case 5: 
            z = new Date()
            if(x == z.getDate())
                return "Eu sou o dia de hoje!"
            else if(x == z.getHours())
                return "Sou a hora atual!"
            else if(x == z.getDay())
                return "Sou o dia em semana, de hoje!"
            else if(x == z.getMinutes())
                return "Seja rápido sou o minuto atual!!"
            else {
                if(x => 250)
                    return "Não sou nem o dia, nem a hora, nem o minuto, nem o mês e muito menos o ano..., estou entre 250 e 500"
                else
                    return "Não sou nem o dia, nem a hora, nem o minuto, nem o mês e muito menos o ano..., estou entre 0 e 250"
            }
        case 6:
            let txt = "Diminuí a lista para esses números: "
            x += 5
            for (let index = x - 5; index < x; index++) {
                txt += " " + index
            }
            return txt
    }
    //To be continued
}
function setNumbers(x){
    let numbersToSet = [x]
    for (let index = 0; index != 3; index++) {
        let z =  Math.floor(Math.random() * 501)
        if(z != x && !numbersToSet.includes(z))
            numbersToSet.push(z)
        
        let y = 0
        numbersToSet.sort(function(a, b){return 0.5 - Math.random()})
        for(let control in numberControls){
            let ctlr = numberControls[control]
            ctlr.text(numbersToSet[y])
            y++
        }
    }
}
function More(){
    if(confirm("Jogar novamente?")){
        points = 0
        lives = 6
        Jogar(dd)
    }else{
        location .href="index.php#myModal"
    }
}
function RightNumber(){
    Jogar(dd)
    points += 2
}
function WrongNumber(){
    lives -= 1
    Jogar(dd)
}
setControls.First.click(function(){
    let comp = numberControls.First.text()
    removeClasses()
    if(comp == number)
        RightNumber()
    else
        WrongNumber()
})
setControls.Second.click(function(){
    let comp = numberControls.Second.text()
    removeClasses()
    if(comp == number)
        RightNumber()
    else
        WrongNumber()
})
setControls.Third.click(function(){
    let comp = numberControls.Third.text()
    removeClasses()
    if(comp == number)
        RightNumber()
    else
        WrongNumber()
})
setControls.Fourth.click(function(){
    let comp = numberControls.Fourth.text()
    removeClasses()
    if(comp == number)
        RightNumber()
    else
        WrongNumber()
})
function Exit(){
    if(confirm("Tem certeza que pretende abandonar o jogo?"))
        location .href="index.php" 
}
function Restart(){
    if(confirm("Tem certeza que pretende recomeçar o jogo?")){
        points = 0
        lives = 6
        location .href=""
    }
}
function Continue(){
    dialog.addClass("invisible")
    pause = false
}
function Pause(){
    $("#cpoints2").text(points)
    $("#clives2").text(lives)
    dialog.removeClass("invisible")
    pause = true
}
function Change(id){
    id.classList.add("disabled")
    Jogar(dd)
    setTimeout(function(){
        id.classList.remove("disabled")
    }, 100000)
}
function TwoByTwo(id){
    id.classList.add("disabled")
    let c = 0
    for(let control in numberControls){
        if(c < 3){
            let ctlr = numberControls[control]
            if(ctlr.text() != number){
                ctlr.addClass("wrong")
                setTimeout(function(){
                    ctlr.removeClass("wrong")
                }, 20000)
            }
        }

        c++;
    }
    setTimeout(function(){
        id.classList.remove("disabled")
    }, 100000)
}
function Answer(id){
    id.classList.add("disabled")
    for(let control in numberControls){
        let ctlr = numberControls[control]
        if(ctlr.text() == number){
            ctlr.addClass("right")
            setTimeout(function(){
                ctlr.removeClass("right")
            }, 2000)
        }
    }
    setTimeout(function(){ Jogar(dd) }, 2000)
    setTimeout(function(){
        id.classList.remove("disabled")
    }, 100000)
}
function Sound(id){
    if(sound){
        sound = false
        id.innerText = "Som: Desativado"
    }else{
        sound = true
        id.innerText = "Som: Ativado"
    }
}