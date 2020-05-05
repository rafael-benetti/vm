<?php
/**
 * Project:    mmn.dev
 * File:       format_helper.php
 * Author:     Felipe Medeiros
 * Createt at: 26/05/2016 - 23:55
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @param      $value
 * @param bool $currency
 * @param int  $decimal
 * @return string
 */

if (!function_exists('inverteData')) {

function inverteData($data){
    if(count(explode("/",$data)) > 1){
        return implode("-",array_reverse(explode("/",$data)));
    }elseif(count(explode("-",$data)) > 1){
        return implode("/",array_reverse(explode("-",$data)));
    }
}

}

if (!function_exists('inverteDataHora')) {

    function inverteDataHora($data, $time=true) {
        
            $data_ = explode("-", $data);
            $data__=explode(" ",$data_[2]);
     
            if($time)
            $nova_data = $data__[0]."/".$data_[1]."/".$data_[0]." ".$data__[1];
            else
                  $nova_data = $data__[0]."/".$data_[1]."/".$data_[0];
            
            return $nova_data;
        
    }

}
if (!function_exists('inverteDataBanco')) {

    function inverteDataBanco($data) {
        if (count(explode("/", $data)) > 1) {
            return implode("-", array_reverse(explode("-", $data)));
        } elseif (count(explode("-", $data)) > 1) {
            return implode("-", array_reverse(explode("-", $data)));
        }
    }

}

function display_money($value, $currency = FALSE, $decimal = 2) // EXIBIR EM TEXTO. (CONTEM SIMBOLO MONETARIO)
{
   
    if ($currency === FALSE) $currency = $settings->currency;
    switch ($settings->money_format)
    {
        case 1:
            $value = number_format($value, $decimal, '.', ',');
            break;
        case 2:
            $value = number_format($value, $decimal, ',', '.');
            break;
        case 3:
            $value = number_format($value, $decimal, '.', '');
            break;
        case 4:
            $value = number_format($value, $decimal, ',', '');
            break;
        default:
            $value = number_format($value, $decimal, '.', ',');
            break;
    }
    switch ($settings->money_currency_position)
    {
        case 1:
            $return = $currency . ' ' . $value;
            break;
        case 2:
            $return = $value . ' ' . $currency;
            break; 
        case FALSE:
            $return = $value;
            break;          
        default:
            $return = $currency . ' ' . $value;
            break;
    }

    return $return;
}

function formatar_moeda($value, $decimal = 2) //EXIBIR EM CAMPOS. (REMOVE SIMBOLO MONETARIO)
{
            return "R$ ". number_format($value, $decimal, ',', '.');
     
}

function grava_money($value, $decimal = 2) //TRATA PARA GRAVAR NA DB.
{

            $value = str_replace("." , "" , $value); // tira ponto
            $value = str_replace("," , "." , $value); // virgula por ponto
    return $value;
}

function diasSemana(){
    
   return array('0'=>'Domingo','1'=>'Segunda','2'=>'Terça', '3'=>'Quarta', '4'=>'Quinta', '5'=>'Sexta', '6'=>'Sabado'); 
}
