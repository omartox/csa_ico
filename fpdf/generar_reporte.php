<?php
    require('fpdf.php');

   
class PDF extends FPDF
{
    public $semana= 0;

    public function semana($sem){
        $this->semana = $sem;
    }
   
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('../img/logo.jpg',3,3,19);
    // Arial bold 15
    $this->SetFont('Arial','B',20);
    // Movernos a la derecha
    $this->Cell(85);
    // Título
    $this->Cell(85,6,'Reporte de llamadas semana '.$this->semana,0,0,'C',0);
    // Salto de línea
    $this->Ln(15);
    $this->SetFont('Arial','B',10);
    $this->Cell(15,6,'PROF.',1,0,'C',0);
    $this->Cell(25,6,'HORARIO',1,0,'C',0);
    $this->Cell(13,6,'CRED.',1,0,'C',0);
    $this->Cell(18,6,'NOMBRE',1,0,'C',0);
    $this->Cell(24,6,'APELLIDOS',1,0,'C',0);
    $this->Cell(79  ,6,'RESP. PROFESOR',1,0,'C',0);
    $this->Cell(80,6,'RESP. SECRETARIA',1,0,'C',0);
    $this->Ln(6);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,utf8_decode('Página ').$this->PageNo().'/{nb}',0,0,'C');
}
}
    $sem =$_POST['semana'];
    $profe =$_POST['prof'];
    require_once ("../model/conexion.php");//Contiene funcion que conecta a la base de datos
    $campos = "id_llamada, Llamadas.usuario, Usuarios.nombre as nombre_p , Usuarios.apellidos as apellidos_p, Llamadas.credencial, Alumnos.nombre as nombre_a, Alumnos.apellidos as apellidos_a, Alumnos.telefono as telefono_a, horario, semana, fecha, respuesta_1, respuesta_2";
    $tabla = "Llamadas INNER JOIN Usuarios on Llamadas.usuario = Usuarios.usuario INNER JOIN Alumnos on Llamadas.credencial = Alumnos.credencial INNER JOIN Horario on Horario.id_horario = Alumnos.id_horario";
    if($profe=='todos')
        $sWhere= "WHERE semana = $sem ORDER BY Usuarios.nombre, Alumnos.id_horario ASC";
    else
        $sWhere= "WHERE semana = $sem and Llamadas.usuario = '$profe' ORDER BY Usuarios.nombre, Alumnos.id_horario ASC";
    $query = mysqli_query($con,"SELECT $campos FROM  $tabla $sWhere");

// Creación del objeto de la clase heredada
$pdf = new PDF('L','mm','Letter');
$pdf->semana($sem);
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',10);
$pag =0;
    while($row=mysqli_fetch_array($query)){
        $query_idllamada=$row['id_llamada'];
		$query_usuario=utf8_decode($row['usuario']);
	    $query_nombre_p=utf8_decode($row['nombre_p']);
		$query_credencial=$row['credencial'];
		$query_nombre_a=utf8_decode($row['nombre_a']);
		$query_apellidos_a=utf8_decode($row['apellidos_a']);
		$query_telefono_a=$row['telefono_a'];
		$query_horario=utf8_decode($row['horario']);
        if($row['respuesta_1']==null)
            $query_respuesta_1="Sin respuesta";
        else
            $query_respuesta_1=utf8_decode($row['respuesta_1']);

        if($row['respuesta_2']==null)
            $query_respuesta_2="Sin respuesta";
        else
            $query_respuesta_2=utf8_decode($row['respuesta_2']);
        $p = $pdf->GetY()+0.5;
        $pdf->Multicell(15,4,$query_nombre_p,0,'C');
        $pdf->SetXY(25,$p);
       
        $pdf->Multicell(25,4,$query_horario,0,'C');
        $pdf->SetXY(50,$p);
        
        $pdf->Multicell(13,4,$query_credencial,0,'C');
        $pdf->SetXY(63,$p);
        
        $pdf->Multicell(18,4,$query_nombre_a,0,'J');
      
        $pdf->SetXY(80,$p);
        $pdf->Multicell(25,4,$query_apellidos_a,0,'J');
       
        $pdf->SetXY(104,$p);
        $pdf->Multicell(80,4,$query_respuesta_1,0,'J');
        $pdf->SetXY(184,$p);
        $pdf->Multicell(0,12,'','L');
        $pdf->SetXY(184,$p);
        $pdf->Multicell(80,4,$query_respuesta_2,0,'J');
        $pdf->SetY($p+12);
        $pdf->Multicell(255,0,'',1,'J');
        $pag+= 1;
        if($pag==13){
            $pag=0;
            $pdf->AddPage();
        }
    }

$pdf->Output();
?>