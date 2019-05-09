<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Library_model extends CI_Model {

    public function get_last_ten_entries()
    {
        $this->db->select('*');
        $this->db->from('autori');
        $this->db->join('libri', 'autori.id_autore = libri.fk_id_autore','left');
        $this->db->limit(10); 
        $query = $this->db->get();
        
        return $query->result();
    }

    /*
    *  Inserisce un libro, se l'autore e' gia' presente viene recuperato l'id e viene associato 
    *  al nuovo libro.
    */
    public function insert_book($p_author , $p_title)
    {
		$author = array(
			'nome_cognome' => $p_author
		);

		$title = array(
			'titolo' => $p_title
        );
        
        $this->db->select('*');
        $this->db->from('autori');
        $this->db->like('nome_cognome', $author['nome_cognome']);
        $query = $this->db->get();

        if ( $query->num_rows() > 1 ){
            $row = $query->row();
            $title['fk_id_autore'] = $row->id_autore;
        }else{
            $this->db->insert('autori', $author);
            $title['fk_id_autore'] =  $this->db->insert_id();
        }
       
        $this->db->insert('libri', $title);
        if ($this->db->affected_rows() == 1){
            return $this->db->insert_id();
        }
        return FALSE;
    }

    public function update_book($p_author , $p_title, $p_key_book, $p_key_auth)
    {       

        $this->db->set('titolo',  $p_title);
        $this->db->where('id_libro', $p_key_book);
        $this->db->update('libri');

        $this->db->set('nome_cognome',  $p_author);
        $this->db->where('id_autore', $p_key_auth);
        $this->db->update('autori');
        
        if ($this->db->affected_rows() == 1){
            return $p_key_book;
        }
        return FALSE;
    }
    
    /**
     * Ricerca un libro ne trova l'autore, se l'autore e' associato ad piu di un libro non lo cancella 
     * altrimenti si
     */
    public function delete_book($id)
    {
        $this->db->select('*');
        $this->db->from('libri');
        $this->db->where('id_libro', $id);
        $query = $this->db->get();

        foreach ($query->result() as $row)
        {
            $id_autore = $row->fk_id_autore;
        }
        if( !isset($id_autore) ){
            return FALSE;
        }

        $this->db->from('libri');
        $this->db->where('fk_id_autore', $id_autore);
        $total = $this->db->count_all_results();
       
        $this->db->delete('libri', array('id_libro' => $id));
        if ($this->db->affected_rows() != 1){
            return FALSE;
        }

        if($total == 1 ){
            $this->db->delete('autori', array('id_autore' => $id_autore));
        }
        if ($this->db->affected_rows() == 1){
            return TRUE;
        }
        return FALSE;
    }
    
    /*  
        Cerca un libro/autore in base a una stringa
    */
    public function search_book($what)
    {
        $this->db->select('*');
        $this->db->from('autori');
        $this->db->join('libri', 'autori.id_autore = libri.fk_id_autore','left');
        $this->db->like('nome_cognome', $what); 
        $this->db->or_like('titolo', $what);
        $query = $this->db->get();
        
        return $query->result();
    }

    public function get_book($id)
    {
        $this->db->select('*');
        $this->db->from('libri');
        $this->db->join('autori', 'autori.id_autore = libri.fk_id_autore','left');
        $this->db->where('id_libro', $id);
        $query = $this->db->get();
        
        return $query->row_array();
    }

}

?>