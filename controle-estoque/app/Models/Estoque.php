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

        $estoque = $this->getProductBySku($sku);
       
        if(!$estoque){

            DB::insert('insert into tb_produtos (nm_produto, dsc_produto, sku_produto, qtd_produto, created_at) values (?, ?, ?, ?, ?)', [$nome, $desc, $sku,  $qtd, date("Y-m-d H:i:s")] );
            
            return "Produto registrado";

        }else{

            return "SKU já registrado";

        } 
        
    }
    public function getProductMov($dados)
    {

        $product = DB::table('tb_mov_produtos');
        if($dados['sku_produto']){
            $product = $product->where('tb_produtos.sku_produto', $dados['sku_produto']);
        }
        if($dados['tipo_operacao']){
            $product = $product->where('tb_mov_produtos.tipo_operacao', $dados['tipo_operacao']);
        }
        
        $product = $product->join('tb_produtos', 'tb_produtos.id_produto', '=', 'tb_mov_produtos.id_produto')->get();
       
        empty($product) ? $return = 'Dados não encontrados'  : $return = $product ;
        
        return $return;
        
    }
    
    public function getProductBySku($sku){

        $product = DB::table('tb_produtos')->where('sku_produto', $sku)->first();

        return $product;

    }

    public function insertMovProduct($idProduct, $data, $qtdInicial, $qtdFinal, $tipoOperacao){

        $product = DB::insert('insert into tb_mov_produtos (id_produto, dt_alteracao, qtd_inicial_produto, qtd_final_produto, tipo_operacao) values (?, ?, ?, ?, ?)', [$idProduct, $data, $qtdInicial, $qtdFinal, $tipoOperacao]);

        return $product;

    }

    public function updateQtProduct($qtd, $idProduct){

        $product = DB::update("update tb_produtos set qtd_produto = ?, updated_at = ? where id_produto = ?",[$qtd, date("Y-m-d H:i:s"), $idProduct]);

        return $product;

    }

    public function updateProduct($dados)
    {
        
        $sku = !empty($dados['sku_produto']) ? ($dados['sku_produto']) : '';
        $qtd = !empty($dados['qtd_produto']) ? ($dados['qtd_produto']) : '';

        $estoque = $this->getProductBySku($sku);
        
        if($estoque){

            if($estoque->qtd_produto == $qtd){

                return "Quantidade inserida igual a atual.";

            }

           ($estoque->qtd_produto > $qtd ) ? $tipoOperacao = 'remove' : $tipoOperacao = 'add';

           $this->insertMovProduct($estoque->id_produto, date("Y-m-d H:i:s"), $estoque->qtd_produto, $qtd, $tipoOperacao);
           $this->updateQtProduct($qtd, $estoque->id_produto);

           return "Produto atualizado.";

        }else{

            return "SKU não encontrado.";

        } 
        
    }

}
