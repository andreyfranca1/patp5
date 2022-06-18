<?php

use patp\Classes\MainModel;

/**
 * Classe para registros de usuários
 *
 * @package TutsupMVC
 * @since 0.1
 */

class HomeModel
{

	/**
	 * $form_data
	 *
	 * Os dados do formulário de envio.
	 *
	 * @access public
	 */	
	public $form_data;

	/**
	 * $form_msg
	 *
	 * As mensagens de feedback para o usuário.
	 *
	 * @access public
	 */	
	public $form_msg;

	/**
	 * $db
	 *
	 * O objeto da nossa conexão PDO
	 *
	 * @access public
	 */
	public $db;

	/**
	 * Construtor
	 * 
	 * Carrega  o DB.
	 *
	 * @since 0.1
	 * @access public
	 */
	public function __construct( $db = false ) {
		$this->db = $db;
	}
    
    public function retornaDataCalendario($id)
    {
        $horarios = [];
        
        $data_inicio = str_replace('T', ' ', explode('-03:00', $_GET['start'])[0]);
        $data_fim = str_replace('T', ' ', explode('-03:00', $_GET['end'])[0]);
        
        $query = $this->db->query("SELECT * FROM Solicitacoes WHERE id_usuario = $id AND status = 1 AND datainicio BETWEEN '$data_inicio' AND '$data_fim'")->fetchAll(PDO::FETCH_ASSOC);
       
        foreach ($query as $item) {
            $horarios[] = [
                'id'      => $item['id'],
                'title'   => $item['titulo'],
                'start'   => $item['datainicio'],
                'end'     => $item['datafim'],
                'display' => 'background',
                'color'   => '#D0021B'
            ];
        }
        
        return $horarios;
	}
}