<?php

namespace App\Http\Controllers;
use App\Models\Estoque;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class EstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $estoque = new Estoque;
        return $estoque->getAllEstoque();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveProduct(Request $request)
    {
        
        $estoque = new Estoque;

        $validator = Validator::make($request->all(), [
            'nm_produto' => 'required|max:50',
            'sku_produto' => 'required|max:10',
            'qtd_produto' => 'required'    
        ]);
 
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = array();
            foreach ($messages->all(':message') as $message)
            {
                array_push($error,$message);
            }
            return $error;
        }

       $dados = $request->all();
       $insert = $estoque->saveProduct($dados);

       return $insert;
    }

    public function updateProduct(Request $request)
    {
        
        $estoque = new Estoque;

        $validator = Validator::make($request->all(), [
            
            'sku_produto' => 'required|max:10',
            'qtd_produto' => 'required'   
            
        ]);
 
        if ($validator->fails()) {
            $messages = $validator->messages();
            $error = array();
            foreach ($messages->all(':message') as $message)
            {
                array_push($error,$message);
            }
            return $error;
        }

       $dados = $request->all();
       $insert = $estoque->updateProduct($dados);

       return $insert;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
