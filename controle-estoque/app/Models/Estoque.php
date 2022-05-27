<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Estoque extends Model
{
    use HasFactory;

    public function getAllEstoque()
    {
        $estoque = DB::table('tb_produtos')->get();
        return $estoque;
    }

    public function saveProduct($dados)
    {
        $nome = !empty($dados['nm_produto']) ? ($dados['nm_produto']) : '';
        $desc = !empty($dados['dsc_produto']) ? ($dados['dsc_produto']) : '';
        $sku = !empty($dados['sku_produto']) ? ($dados['sku_produto']) : '';
        $qtd = !empty($dados['qtd_produto']) ? ($dados['qtd_produto']) : '';

        $estoque = DB::table('tb_produtos')->where('sku_produto', $sku)->first();
       
        if(!$estoque){

            DB::insert('insert into tb_produtos (nm_produto, dsc_produto, sku_produto, qtd_produto) values (?, ?, ?, ?)', [$nome, $desc, $sku,  $qtd] );
            
            return "Sucesso produto registrado";

        }else{

            return "SKU já registrado";

        } 
        
    }

}
