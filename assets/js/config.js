var _xhttp
var blob

//Ler ficheiro
function readFile(path) {
    _xhttp = new XMLHttpRequest()
    _xhttp.open("GET", path, false)
    _xhttp.send()
    return _xhttp.responseText;
}

//Salvar ficheiro
function saveFile(path, content) {
    blob = new Blob([content], {
            type: "text/plain;charset=utf-8"
        })
        //saveAs(blob, path)
}