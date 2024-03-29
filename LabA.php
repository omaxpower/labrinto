<!DOCTYPE html>
<html>
<head>
    <title>A*</title>
    <meta charset="utf-8">
    <link href="css/bootstrap.min.css" rel="stylesheet"> 
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<header>
    <h1><strong><center>LABERINTO - ALGORITMO A*</center></strong></h1>
</header>
<body>



<?php
$A=rand(1,15);
$B=rand(1,15);
$N=$_POST['tam'];
$W=$_POST['wall'];
$laber = array(
    
    'inicio' => array($A, $B), 
    'final' => array($N, $N), 
    'x' => $N, 
    'y' => $N, 
    'paredes' => $W, 
);
 
$a = new aStar($laber['inicio'], $laber['final'], $laber['x'], $laber['y'], $laber['paredes']);
$a->displayPic();
 
class aStar
{
    private $_inicio; 
    private $_final; 
    private $_x;     
    private $_y; 
    private $_num; 
    private $_alrededor; 
    private $_g; 
    public $abierto; 
    public $cerrado;
    public $inhab = array(); 
    public $ruta = array(); 


      public function __construct($inicio, $final, $x, $y, $num)
    {
        $this->_inicio = $inicio;
        $this->_final = $final;
        $this->_x = $x;
        $this->_y = $y;
        $this->_num = $num;
        $this->_ruta();
    }
 
    private function _ruta()
    {
        $this->_Deshabilitar();
        $this->_inicio();
    }
 
    private function _inicio()
    {
        
        $punto[0] = $this->_inicio[0]; // x
        $punto[1] = $this->_inicio[1]; // y
        $punto['i'] = $this->_puntoInfo($this->_inicio); 
        $punto['f'] = 0; // f 
        $this->_g[$punto['i']] = 0; // g 
        $punto['h'] = $this->_getH($this->_inicio); // h 
        $punto['p'] = NULL;
 
        $this->abierto[$punto['i']] = $this->cerrado[$punto['i']] = $punto;
        while (count($this->abierto) > 0) {
            $f = 0;
            foreach ($this->abierto as $info => $nodo) {
                if ($f === 0 || $f > $nodo['f']) {
                    $minInfo = $info;
                    $f = $nodo['f'];
                }
            }
 
            $actual = $this->abierto[$minInfo];
            unset($this->abierto[$minInfo]);
            
            $this->cerrado[$minInfo] = $actual;
 
            // ruta
            if ($actual[0] == $this->_final[0] && $actual[1] == $this->_final[1]) {
                while ($actual['p'] !== null) {
                    $tmp = $this->cerrado[$this->_puntoInfo($actual['p'])];
                    array_unshift($this->ruta, array($tmp[0], $tmp[1]));
                    $actual = $this->cerrado[$this->_puntoInfo($actual['p'])];
                }
                array_push($this->ruta, $this->_final);
                break;
            }
             $this->_defAlrededor($actual);
            $this->_actAlrededor($actual);
        }
 
    }
 
    private function _actAlrededor($actual)
    {
        foreach ($this->_alrededor as $v) {
            if (!isset($this->cerrado[$this->_puntoInfo($v)])) { 
                if (isset($this->abierto[$this->_puntoInfo($v)])) { 
                    if ($this->_getG($actual) < $this->_g[$this->_puntoInfo($v)]) {
                        $this->_actPunto($actual, $v);
                    }
                } else { 
                    $this->abierto[$this->_puntoInfo($v)][0] = $v[0];
                    $this->abierto[$this->_puntoInfo($v)][1] = $v[1];
                    $this->_actPunto($actual, $v);
                }
            }
        }
    }
 
    private function _actPunto($actual, $alrededor)
    {
        $this->abierto[$this->_puntoInfo($alrededor)]['f'] = $this->_getF($actual, $alrededor);
        $this->_g[$this->_puntoInfo($alrededor)] = $this->_getG($actual);
        $this->abierto[$this->_puntoInfo($alrededor)]['h'] = $this->_getH($alrededor);
        $this->abierto[$this->_puntoInfo($alrededor)]['p'] = $actual; 
    }
 
     private function _defAlrededor($punto)
    {
        $roundX[] = $punto[0]; 
        ($punto[0] - 1 > 0) && $roundX[] = $punto[0] - 1; 
        ($punto[0] + 1 <= $this->_x) && $roundX[] = $punto[0] + 1; 
        
        $roundY[] = $punto[1];
        ($punto[1] - 1 > 0) && $roundY[] = $punto[1] - 1;
        ($punto[1] + 1 <= $this->_y) && $roundY[] = $punto[1] + 1;
 
        $this->_alrededor = array();
        foreach ($roundX as $vX) {
            foreach ($roundY as $vY) {
                $tmp = array(
                    0 => $vX,
                    1 => $vY,
                );
                if (
                    !in_array($tmp, $this->inhab) &&
                    !in_array($tmp, $this->cerrado) &&
                    !($vX == $punto[0] && $vY == $punto[1]) &&
                    ($vX == $punto[0] || $vY == $punto[1])
                )
                    $this->_alrededor[] = $tmp;
            }
        }
    }
 
    private function _puntoInfo($punto)
    {
        return $punto[0] . '_' . $punto[1];
    }
 
    //f
    private function _getF($parent, $punto)
    {
        return $this->_getG($parent) + $this->_getH($punto);
    }
 
    //g
    private function _getG($actual)
    {
        return isset($this->_g[$this->_puntoInfo($actual)]) ? $this->_g[$this->_puntoInfo($actual)] + 1 : 1;
    }
 
   //h
    private function _getH($punto)
    {
        return abs($punto[0] - $this->_final[0]) + abs($punto[1] - $this->_final[1]);
    }

    private function _Deshabilitar()
    {
        if ($this->_num > $this->_x * $this->_y)
            exit('Demasidas paredes');
 
        for ($i = 0; $i < $this->_num; $i++) {
            $tmp = array(
                rand(1, $this->_x),
                rand(1, $this->_y),
            );
            if ($tmp == $this->_inicio || $tmp == $this->_final || in_array($tmp, $this->inhab)) { 
                $i--;
                continue;
            }
            $this->inhab[] = $tmp;
        }
    }
 
    
    public function displayPic()
    {
        echo "<center>";
        $step = count($this->ruta);
        echo ($step > 0) ? '<font color="Black" size= "4"> LA DISTANCIA MINIMA RECORRIDA ES: ' .$step. ' </font>': '<font color="red" size="4"> NO HAY SOLUCION PARA EL LABERINTO </font>';
        echo "<br>";
        echo '<font color="Red" size="4.5"> I: Inicio';
        echo ' - ';
        echo '<font color="Green" size="4.5"> S: Final';
        echo "</center>";
        echo "<center>";
        echo '<TABLE BORDER CELLPADDING=1 CELLSPACING=1>';
        for ($y = 1; $y <= $this->_y; $y++) {
            echo '<tr>';
            for ($x = 1; $x <= $this->_x; $x++) {
                $actual = array($x, $y);
 
                if (in_array($actual, $this->inhab)) // 
                    $bg = 'bgcolor="#151515"';
                elseif (in_array($actual, $this->ruta)) // 
                    $bg = 'bgcolor="#F7FE2E"';
                else
                    $bg = 'bgcolor="#82f96f"';
 
                if ($actual == $this->_inicio)
                    $content = '<center><b><font color="red"> I</b></center>';
                elseif ($actual == $this->_final)
                    $content = '<center><b><font color="green"> S</b></center>';
                else
                    $content = ' ';
 
                echo '<td style="width:27px; height: 27px;" ' . $bg . '>' . $content . '</td>';
            }
            echo '</tr>';
        }
        echo '</table>';
        echo '</center>';

    }
 
}
?>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

		

