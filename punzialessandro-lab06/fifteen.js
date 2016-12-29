"use strict";
var rows = 3;
var columns = 3;
var shuffled = 0;
var moves = 0;
var shuffled = false;

/* inizializza il puzzle */
window.onload = function() 
{
    var block = $("puzzlearea").childElements(); //array con i 15 div del puzzle
    $("shufflebutton").onclick=shuffle;
    var count = 0;
    for(var r = 0; r < 4; r++)
    {
        for(var c = 0; c < 4; c++)    
        {
            if(count < block.length)
            {
                block[count].className = "puzzle"; //assegna la classe puzzle del css ad ogni singolo blocco
                block[count].style.left = c * 100 +"px"; //modifica la posizione assoluta di 100px lungo l'asse x nella puzzle area
                block[count].style.top = r * 100 + "px"; //modifica la posizione assoluta di 100px lungo l'asse y nella puzzle area
                block[count].style.backgroundPosition = "-" + (c * 100) + "px " + "-" + (r * 100) + "px"; //associa 100 px della background image ad ogni blocco
                block[count].onclick = click;
                block[count].onmouseover = isHover;
                count++;
            }
        }
    }
}

/* mescola i blocchi del puzzle */
function shuffle() 
{
    shuffled = true;
    moves=0;
    $("text").addClassName("lose");
    $("text").innerHTML = "You made " + moves + " moves";
    while (moves < 50) 
    {
        click();
    }
    moves = 0;
}

/* determina quali blocchi si possono muovere cambiando il loro stile */
function isHover() 
{
    if(shuffled == true)
    {
        if (this.hasClassName("freeblock"))
        {
            this.removeClassName("freeblock");
        }
        var oldTop = parseInt(this.style.top, 10) / 100;
        var oldLeft = parseInt(this.style.left, 10) / 100;
        if ((oldLeft + 1 == columns && oldTop == rows)  || (oldLeft == columns && oldTop - 1 == rows) ||
            (oldLeft - 1 == columns && oldTop == rows) || (oldLeft == columns && oldTop + 1 == rows)) 
        {
            this.addClassName("freeblock");
        }
    }
}

/* gestisce il caso di vittoria */
function hasWon(puzzle)
{
    var i = 0;
    for (var r = 0; r < 4; r++) 
    {
        for (var c = 0; c < 4; c++) 
        {
            if (i < puzzle.length)
            {
                var currentRow = parseInt(puzzle[i].style.top, 10) / 100;
                var currentCol = parseInt(puzzle[i].style.left, 10) / 100;
                if (currentRow != r || currentCol != c)
                { 
                    return false;
                }
                i++;
            }
        }
    }
    $("text").removeClassName("lose");
    $("text").addClassName("win");
    $("text").innerHTML = "You've solved the puzzle in " + moves + " moves!";
    moves = 0;
    return true;
}

/* gestisce l'evento del click su un blocco del puzzle */
function click() 
{
    if(shuffled == true)
    {
        var top;
        var left;
        var puzzle = $("puzzlearea").childElements();

        if (this === undefined) 
        {
            var rand = parseInt(Math.random() * 15, 10);
            top = parseInt(puzzle[rand].style.top, 10) / 100;
            left = parseInt(puzzle[rand].style.left, 10) / 100;
            if ((left + 1 == columns && top == rows)  || (left == columns && top - 1 == rows) ||
            (left - 1 == columns && top == rows) || (left == columns && top + 1 == rows)) 
            {
                puzzle[rand].style.top = rows * 100 + "px";
                puzzle[rand].style.left = columns * 100 + "px";
                columns = left;
                rows = top;
                moves++;
            }
        }else 
        {
            top = parseInt(this.style.top, 10) / 100;
            left = parseInt(this.style.left, 10) / 100;
            if ((left + 1 == columns && top == rows)  || (left == columns && top - 1 == rows) ||
                (left - 1 == columns && top == rows) || (left == columns && top + 1 == rows)) 
            {
                this.style.top = rows * 100 + "px";
                this.style.left = columns * 100 + "px";
                columns = left;
                rows = top;
                moves++;
                $("text").addClassName("lose");
                $("text").innerHTML = "You made " + moves + " moves";
                hasWon(puzzle);
            }
        }
    }
}